<?php

namespace App\Commands\Event;

use App\Models\Event\Event;
use Illuminate\Console\Command;

/**
 * イベントの一覧を取得するコマンド
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
            'name' => 'イベント名',
            'start_date' => '開始日時',
            'end_date' => '終了日時',
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
        $builderObj = Event::whereRequest( $this->requestObj );
        
        //dd($builderObj->toSql());
        
        // 並び替えの処理
        $builderObj = $builderObj->orderBys( $this->sort['sort'] );

        // ペジネートの処理
        $data = $builderObj->paginate( $this->requestObj->row_num, $this->columns )
                            // 表示URLをpagerに指定
                            ->setPath('pager');

        return $data;
    }

}
