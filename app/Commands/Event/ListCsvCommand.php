<?php

namespace App\Commands\Event;

use App\Lib\Csv\Csv;
use App\Models\Event\Event;
use Illuminate\Console\Command;

/**
 * 登録リスト表示・抽出一覧のCSVダウンロードをするコマンド
 * 
 * @author 江澤
 */
class ListCsvCommand extends Command{
    
    /**
     * コンストラクタ
     * @param array $sort 並び順
     * @param $requestObj 検索条件
     * @param [type] $filename 出力ファイル名
     */
    public function __construct( $sort, $requestObj, $filename ){
        $this->sort = $sort;
        $this->requestObj = $requestObj;
        $this->filename = $filename;

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
        // 検索条件を指定
        $builderObj = Event::joinBasePoint() // 基本ポイントテーブルとJOIN
                            ->whereRequest( $this->requestObj );
        
        // 検索条件を指定
        $builderObj = $builderObj->whereRequest( $this->requestObj );
        
        // 並び替えの処理
        $builderObj = $builderObj->orderBys( $this->sort['sort'] );
        
        // csvの値を取得
        $data = $builderObj->get( $this->columns )
                           ->toArray();

        // 検索結果をCSV出力ように変換
        $export = $this->convert( $data );

        return CSV::download( $export, $this->headers, $this->filename );
    }

    /**
     * 出力形式に変換
     * @param $data
     * @return
     */
    private function convert( $data ){
        $export = [];
        
        // CSVのレコードのループ
        foreach( $data as $recordkey => $record ){
            $setValue = [];
            
            // CSVの指定カラムの出力形式を変換する
            foreach( $record as $column => $value ){
                $setValue[$column] = $record[$column];
            }
            
            $export[$recordkey] = $setValue;
        }
        
        return $export;
    }

}
