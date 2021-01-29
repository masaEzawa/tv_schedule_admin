<?php

namespace App\Http\Controllers\Tv\TvReserve;

use App\Lib\Util\DateUtil;
use App\Original\Util\ViewUtil;
use App\Commands\Tv\TvReserve\ListCommand;
use App\Commands\Tv\TvReserve\CreateCommand;
use App\Commands\Tv\TvReserve\UpdateCommand;
use App\Commands\Tv\TvReserve\DeleteCommand;
use App\Models\Tv\TvReserve;
use App\Http\Requests\TvReserve\TvReserveRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\tInitSearch;

/**
 * TV番組画面用コントローラー
 *
 * @author 江澤
 *
 */
class MainController extends Controller{
    
    use tInitSearch;
    
    /**
     * コンストラクタ
     */
    public function __construct(){
        // 表示部分で使うオブジェクトを作成
        $this->initDisplayObj();
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
        $this->displayObj->category = "tv";
        // 画面名
        $this->displayObj->page = "tv_reserve";

        // 基本のテンプレート
        $this->displayObj->tpl = $this->displayObj->category . "." . $this->displayObj->page;

        
       
        // コントローラー名
        $this->displayObj->ctl = "Tv\TvReserve\MainController";
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

        // 今シーズンの開始月を取得する
        $seasonMonth = DateUtil::getSeasonMonth();

        $search['onair_start_ym'] = date( 'Y-' . str_pad( $seasonMonth, 2, '0', STR_PAD_LEFT ) );
        
        return $search;
    }

    /**
     * 並び順のデフォルト値を指定
     * ※継承先で主に定義
     * @return [type] [description]
     */
    public function extendSortParams() {
        // 複数テーブルにあるidが重複するため明示的にエイリアス指定
        $sort = [
                'onair_weekday_num' => 'asc', // 放送曜日
                'onair_time' => 'asc', // 放送時間
            ];
        
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
        ->with( "sortUrl", action( $this->displayObj->ctl . '@getSort' ) )
        ->with( 'title', "TV番組" );
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
        $targetMObj = new TvReserve();
        
        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "TV番組" )
        ->with( 'displayObj', $this->displayObj )
        ->with( "type", "create" )
        ->with( "buttonId", 'regist-button' );
    }

    /**
     * 値の登録処理
     * @param  TvReserveRequest $requestObj [description]
     * @return [type]                  [description]
     */
    public function putCreate( TvReserveRequest $requestObj ) {

        // 登録画面で入力された値を登録
        $this->dispatch(
            new CreateCommand( $requestObj )
        );
        
        return redirect( action( $this->displayObj->ctl . '@getList' ) );
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
        $targetMObj = TvReserve::findOrFail( $id );

        return view(
            $this->displayObj->tpl . '.input',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "TV番組／編集" )
        ->with( 'displayObj', $this->displayObj )
        ->with( "type", "edit" )
        ->with( "buttonId", 'update-button' );
    }
    
    /**
     * 編集画面で入力された値を登録
     * @param  [type]      $id         [description]
     * @param  TvReserveRequest $requestObj [description]
     * @return [type]                  [description]
     */
    public function putEdit( $id, TvReserveRequest $requestObj ) {
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
        $targetMObj = TvReserve::findOrFail( $id );     

        return view(
            $this->displayObj->tpl . '.detail',
            compact(
                'targetMObj'
            )
        )
        ->with( "title", "TV番組／確認" )
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
    
}
