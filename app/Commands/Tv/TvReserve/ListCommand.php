<?php

namespace App\Commands\Tv\TvReserve;

use App\Models\Tv\TvReserve;
use Illuminate\Console\Command;

/**
 * TV番組の一覧を取得するコマンド
 *
 * @author 江澤
 */
class ListCommand extends Command{

    /**
     * コンストラク
     * @param array $sort 並び順
     * @param $requestObj 検索条件
     */
    public function __construct( $sort, $requestObj, $showType="" ){
        $this->sort = $sort;
        $this->requestObj = $requestObj;
        $this->showType = $showType;

        // カラムとヘッダーの値を取得
        $csvParams = $this->getCsvParams();
        // カラムを取得
        $this->columns = array_keys( $csvParams );
        // ヘッダーを取得
        $this->headers = array_values( $csvParams );
    }

    /**
     * カラムとヘッダーの値を取得
     * @return array
     */
    private function getCsvParams(){

        return [
            'id' => 'id',
            'category' => 'カテゴリー',
            'name' => '番組名',
            'channel' => '放送チャンネル',
            'onair_weekday_num' => '放送曜日',
            'onair_time' => '放送時間',
            'onair_start_date' => '放送開始日',
            'onair_end_date' => '放送終了日',
            'memo' => '備考',
        ];
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 表示も問題で一度変数に格納
        $requestObj = $this->requestObj;
           
        // 検索条件を指定
        $builderObj = TvReserve::whereRequest( $this->requestObj );
        
        //dd($builderObj->toSql());
        
        // 並び替えの処理
        $builderObj = $builderObj->orderBys( $this->sort['sort'] );

        // ペジネートの処理
        $data = $builderObj
                    ->paginate( $this->requestObj->row_num, $this->columns )
                    // 表示URLをpagerに指定
                    ->setPath('pager');

        return $data;
    }

}
