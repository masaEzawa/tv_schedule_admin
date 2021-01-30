<?php

namespace App\Http\Controllers\Event;

use App\Original\Util\ViewUtil;
use App\Original\Util\ImageUtil;
use App\Commands\Event\ListCommand;
use App\Commands\Event\CreateCommand;
use App\Commands\Event\UpdateCommand;
use App\Commands\Event\DeleteCommand;
use App\Models\Event\Event;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\Event\EventRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tCommon;

/**
 * イベント画面用コントローラー
 *
 * @author 江澤
 *
 */
class EventController extends Controller{
    
    use tCommon;
    
    /**
     * コンストラクタ
     */
    public function __construct(){
        // 表示部分で使うオブジェクトを作成
        $this->displayObj = app('stdClass');
        // カテゴリー名
        $this->displayObj->category = "event";
        // 画面名
        $this->displayObj->page = "main";
        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;
        // コントローラー名
        $this->displayObj->ctl = "App\Http\Controllers\Event\EventController";
    }

    #######################
    ## initalize
    #######################

    /**
     * 表示部分で使うオブジェクトを作成
     * @return [type] [description]
     */
    public function initDisplayObj(){
        
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

    /**
     * 並び順のデフォルト値を指定
     * ※継承先で主に定義
     * @return [type] [description]
     */
    public function extendSortParams() {
        // 複数テーブルにあるidが重複するため明示的にエイリアス指定
        $sort = [ 'created_at' => 'asc'];
        
        return $sort;
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
        
        // 表示データを取得
        $showData = $this->dispatch(
            new ListCommand(
                $sort,
                $requestObj
            )
        );

        //　表示用に、並び替え情報を取得
        if( isset( $sort['sort'] ) == True && !empty( $sort['sort'] ) == True ){
            foreach ( $sort['sort'] as $key => $value ) {
                // 並び替え情報を格納
                $sortTypes = [
                    'sort_key' => $key,
                    "sort_by" => $value
                ];
            }
        }

        // テンプレートのパスを設定
        $tpl_path = $this->displayObj->tpl . '.list';

        // スマートフォンで開かれたとき
        if( ViewUtil::isSmartphone() == True ){
            // スマートフォンのテンプレートパスを格納する
            $tpl_path = $this->displayObj->tpl . '.list_sp';
        }

        return view(
            $tpl_path,
            compact(
                'search',
                'sortTypes',
                'showData'
            )
        )
        ->with( 'displayObj', $this->displayObj )
        ->with( "sortUrl", route( 'event.sort' ) )
        ->with( 'title', "イベント" );
    }
    
    #######################
    ## 追加画面
    #######################
    
    /**
     * 登録画面を開く時の画面
     * @return [type] [description]
     */
    public function getCreate() {
        // 対象モデルオブジェクトを取得
        $targetMObj = new Event();
        
        // 開始日時がからでないとき
        if( !empty( $targetMObj->start_date ) == True ){
            // 開始日を取得
            $targetMObj->start_day = date( "Y-m-d", strtotime( $targetMObj->start_date ) );
            // 開始時刻を取得
            $targetMObj->start_time = date( "H:i", strtotime( $targetMObj->start_date ) );
        }
        // 終了日時がからでないとき
        if( !empty( $targetMObj->end_date ) == True ){
            // 終了日を取得
            $targetMObj->end_day = date( "Y-m-d", strtotime( $targetMObj->end_date ) );
            // 終了時刻を取得
            $targetMObj->end_time = date( "H:i", strtotime( $targetMObj->end_date ) );
        }
        
        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "イベント" )
        ->with( 'displayObj', $this->displayObj )
        ->with( "type", "create" )
        ->with( "buttonId", 'regist-button' );
    }

    /**
     * 値の登録処理
     * @param  EventRequest $requestObj [description]
     * @return [type]                  [description]
     */
    public function postCreate( EventRequest $requestObj ) {
        
        //$requestObj->flash();
        // 登録画面で入力された値を登録
        $this->dispatch(
            new CreateCommand( $requestObj )
        );
        
        return redirect( action( $this->displayObj->ctl . '@getIndex' ) );
    }
    
    #######################
    ## 編集画面
    #######################

    /**
     * 編集画面を開く時の画面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getEdit( $id ){
        // 対象モデルオブジェクトを取得
        $targetMObj = Event::findOrFail( $id );
        
         // 開始日時がからでないとき
        if( !empty( $targetMObj->start_date ) == True ){
            // 開始日を取得
            $targetMObj->start_day = date( "Y-m-d", strtotime( $targetMObj->start_date ) );
            // 開始時刻を取得
            $targetMObj->start_time = date( "H:i", strtotime( $targetMObj->start_date ) );
        }
        // 終了日時がからでないとき
        if( !empty( $targetMObj->end_date ) == True ){
            // 終了日を取得
            $targetMObj->end_day = date( "Y-m-d", strtotime( $targetMObj->end_date ) );
            // 終了時刻を取得
            $targetMObj->end_time = date( "H:i", strtotime( $targetMObj->end_date ) );
        }

        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "イベント／編集" )
        ->with( 'displayObj', $this->displayObj )
        ->with( "type", "edit" )
        ->with( "buttonId", 'update-button' );
    }
    
    /**
     * 編集画面で入力された値を登録
     * @param  [type]      $id         [description]
     * @param  EventRequest $requestObj [description]
     * @return [type]                  [description]
     */
    public function postEdit( $id, EventRequest $requestObj ) {
        // 編集画面で入力された値を更新
        $this->dispatch(
            new UpdateCommand( $id, $requestObj )
        );
        
        return redirect( action( $this->displayObj->ctl . '@getList' ) );
    }

    #######################
    ## 詳細画面
    #######################

    /**
     * 詳細画面を開く時の画面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDetail( $id ){
        // 対象モデルオブジェクトを取得
        $targetMObj = Event::findOrFail( $id );     

        return view(
            $this->displayObj->tpl . '.detail',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "イベント／確認" )
        ->with( 'displayObj', $this->displayObj );
    }

    #######################
    ## 削除
    #######################

    /**
     * 編集画面で入力された値を登録
     * @return [type]                  [description]
     */
    public function getDelete( $id ) {
        // 編集画面で入力された値を更新
        $this->dispatch(
            new DeleteCommand( $id )
        );
        
        return redirect( action( $this->displayObj->ctl . '@getList' ) );
    }

    #######################
    ## 画像アップロード
    #######################

    /**
     * 画像アップロード処理を行う
     * @return [type]                  [description]
     */
    public function postUploadImage( SearchRequest $requestObj ){
        // 画像ファイルの保存先パス
        $path = "images";
        
        // 画像が空でないかつ、正常にがアップロードされたか調べる
        if( !empty( $requestObj->file ) == True && $requestObj->file( 'file' )->isValid() == True ) {
            $file = $requestObj->file('file');

            return asset("") . ImageUtil::adjustImage( $file, $path );
            /*
            // ファイル名を取得する。
            $filename = $file->getClientOriginalName();
            // アップロードされた画像ファイルを移動させる
            $file->move( base_path( "tv_schedule/images"), $filename );
            */
        }
    }

}
