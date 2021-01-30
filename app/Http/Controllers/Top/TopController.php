<?php

namespace App\Http\Controllers\Top;

use App\Lib\Util\DateUtil;
use App\Original\Util\SessionUtil;
use App\Commands\Event\ListCommand;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\Event\EventModalRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tCommon;
use App\Models\Event\Event;
use DB;

/**
 * TOP画面用コントローラー
 *
 * @author 江澤
 *
 */
class TopController extends Controller{
    
    use tCommon;

    /**
     * コンストラクタ
     */
    public function __construct(){
        // 表示部分で使うオブジェクトを作成
        $this->initDisplayObj();
        
        // top画面を開いた時は検索項目は消去
        SessionUtil::removeSearch();
    }

    #######################
    ## initalize
    #######################

    /**
     * 表示部分で使うオブジェクトを作成
     * @return [type] [description]
     */
    public function initDisplayObj(){
        // 表示部分で使うオブジェクトを作成
        $this->displayObj = app('stdClass');
        // カテゴリー名
        $this->displayObj->category = "top";
        // 画面名
        $this->displayObj->page = "index";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "App\Http\Controllers\Top\TopController";
    }

    #######################
    ## 検索・並び替え
    #######################

    /**
     * 画面固有の初期条件設定
     *
     * @return array
     */
    public function extendSearchParams(){
        $search = [];

        return $search;
    }

    #######################
    ## Controller method
    #######################
    
    /**
     * 一覧画面のデータを表示
     * @param  [type] $search     [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function showListData( $search, $sort, $requestObj ){
        $calEventList = [];
        $target = date( 'Y-m-d' );
        if( !empty( $search['date'] ) ){
            $target = $search['date'];
        }
        $requestObj->row_num = 10000;
        // カレンダー表示用データを取得
        $calEventData = $this->dispatch(
            new ListCommand(
                $sort,
                $requestObj
            )
        );
        
        // DBから取得したデータを配列に格納する
        foreach( $calEventData as $value ){
            $calEventList[] = [

                // ID
                'id' => $value['id'],
                // イベント名
                'title' => $value['name'],
                // 開始日時
                'start' => date( "Y-m-d H:i:s", strtotime( $value['start_date'] ) ),
                // 終了日時
                'end' => date( "Y-m-d H:i:s", strtotime( $value['end_date'] ) )
            ];
        }


        $calEventJson = json_encode( $calEventList );

        $sql = "
            (
                start_date = '{$target}' OR
                end_date = '{$target}' OR
                (
                    DATE_FORMAT(start_date,'%Y-%m-%d') <= '{$target}' AND
                    DATE_FORMAT(end_date,'%Y-%m-%d') >= '{$target}'
                )
           ) 
        ";

        $showDayEvents = Event::whereRaw( DB::Raw( $sql ) )
                             ->orderby( 'start_date', 'asc' )
                             ->get();

        return view(
            $this->displayObj->tpl,
            compact(
                'search',
                'target',
                'calEventJson',
                'showDayEvents'
            )
        )
        ->with( 'displayObj', $this->displayObj )
        ->with( 'title', "メニューインデックス" );
    }

    #######################
    ## Controller method
    #######################

    /**
     * イベントの登録を行う
     */
    public function postEventCreate( SearchRequest $request ){
        $setValues = [];
        
        // 対象のモデルオブジェクトを取得する
        $targetMObj = new Event();
        
        $requestAll = $request->all();
        // 対象日の設定
        $target = date( 'Y-m-d' );
        if( !empty( $requestAll['target'] ) ){
            $target = $requestAll['target'];
        }

        /*
         * 配列で渡されるリクエストの処理
         */
        if( !empty( $requestAll['name'] ) == True ){

            foreach( $requestAll['name'] as $key => $value ){
                // イベント名が入力されているとき、登録する
                if( !empty( $value ) ){

                    // イベント開始時間の設定
                    $start_date = null;
                    if( isset( $requestAll['start_time1'][$key] ) && isset( $requestAll['start_time2'][$key] ) ){
                        $start_date = $target . " " . $requestAll['start_time1'][$key] . ":" . $requestAll['start_time2'][$key]; // イベント名
                    }

                    // イベント終了時間の設定
                    $end_date = null;
                    if( isset( $requestAll['end_time1'][$key] ) && isset( $requestAll['end_time2'][$key] ) ){
                        $end_date = $target . " " . $requestAll['end_time1'][$key] . ":" . $requestAll['end_time2'][$key]; // イベント名
                    }

                    $setValues['category'] = $requestAll['category'][$key]; // カテゴリー
                    $setValues['name'] = $requestAll['name'][$key]; // イベント名

                    $setValues['start_date'] = $start_date;
                    $setValues['end_date'] = $end_date;
                    $setValues['memo'] = $requestAll['memo'][$key]; // 備考

                    // dd( $setValues );

                    // データの更新
                    $targetMObj->create( $setValues );
                }
            }

        }
        
        // 一覧画面にリダイレクト
        return redirect( action( $this->displayObj->ctl, '@getList' ) );
    }

    /**
     * イベントの編集画面を開く
     */
    public function getEventEdit( $id ){

        // 対象のモデルオブジェクトを取得する
        $targetMObj = Event::findOrFail( $id );

        // イベント開始日時が空でないとき
        if( $targetMObj->start_date ){
            $targetMObj->target = date( "Y-m-d", strtotime( $targetMObj->start_date ) );
            // 日付のフォーマットを設定し、時間のみ取り出す
            $start_time = date( "H:i", strtotime( $targetMObj->start_date ) );
            // 日付と時間を分割して、配列化する。
            $start_time = explode( ":", $start_time );
            // イベント開始時間の時を格納する
            $targetMObj->start_time1 = $start_time[0];
            // イベント開始時間の分を格納する
            $targetMObj->start_time2 = $start_time[1];
        }

        // イベント終了日時が空でないとき
        if( $targetMObj->end_date ){
            // 日付のフォーマットを設定し、時間のみ取り出す
            $end_time = date( "H:i", strtotime( $targetMObj->end_date ) );
            // 日付と時間を分割して、配列化する。
            $end_time = explode( ":", $end_time );
            // イベント終了時間の時を格納する
            $targetMObj->end_time1 = $end_time[0];
            // イベント終了時間の分を格納する
            $targetMObj->end_time2 = $end_time[1];
        }

        return response()->json( $targetMObj );
    }

    /**
     * イベントの編集を行う
     */
    public function postEventEdit( SearchRequest $request ){
        $setValues = [];
        
        $requestAll = $request->all();
        
        // 対象のモデルオブジェクトを取得する
        $targetMObj = Event::findOrFail( $requestAll['id'] );
        // 対象日の設定
        $target = date( 'Y-m-d' );
        if( !empty( $requestAll['target'] ) ){
            $target = $requestAll['target'];
        }

        /*
         * 配列で渡されるリクエストの処理
         */
        if( !empty( $requestAll['name'] ) == True ){

            // イベント開始時間の設定
            $start_date = null;
            if( isset( $requestAll['start_time1'] ) && isset( $requestAll['start_time2'] ) ){
                $start_date = $target . " " . $requestAll['start_time1'] . ":" . $requestAll['start_time2']; // イベント名
            }

            // イベント終了時間の設定
            $end_date = null;
            if( isset( $requestAll['end_time1'] ) && isset( $requestAll['end_time2'] ) ){
                $end_date = $target . " " . $requestAll['end_time1'] . ":" . $requestAll['end_time2']; // イベント名
            }

            $setValues['category'] = $requestAll['category']; // カテゴリー
            $setValues['name'] = $requestAll['name']; // イベント名

            $setValues['start_date'] = $start_date;
            $setValues['end_date'] = $end_date;
            $setValues['memo'] = $requestAll['memo']; // 備考

            // データの更新
            $targetMObj->update( $setValues );
            
        }
        
        // 一覧画面にリダイレクト
        return redirect( action( $this->displayObj->ctl, '@getList' ) );
    }

}
