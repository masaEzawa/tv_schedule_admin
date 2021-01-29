<?php

namespace App\Lib\CsvData;

use App\Lib\Csv\iParser;
use App\Lib\CsvData\tCsvImport;
use App\Models\Event\Medley;

/**
 * メドフェス用CSVデータ
 *
 * @author 江澤
 *
 */
class MedleyData implements iParser {

    use tCsvImport;

    /**
     * カラムのリスト
     * CSVのカラム順と以下の順が一致している必要がある
     */
    protected $_cols = [
        1 => 'id',
        2 => 'event_name',
        3 => 'start_date',
        4 => 'end_date',
        5 => 'music_num',
        6 => 'difficulty',
        7 => 'score',
        8 => 'combo',
        9 => 'goal_point',
        10 => 'main_image',
        11 => 'result_date',
        12 => 'result_point',
        13 => 'created_at',
        14 => 'updated_at',
        15 => 'deleted_at',
        16 => 'created_by',
        17 => 'updated_by',
    ];

    /**
     * バリデーションルール
     */
    private $_validate_rules = [
        'id' => 'required'
    ];

    /**
     * CSV外の値を埋め込む
     * 画面の選択値とうを埋め込む
     *
     * @param unknown $storeData
     * @param unknown $value
     * @return unknown
     */
    public function inject( $storeData, $value ){
        return $storeData;
    }

    /**
     * DBへの登録更新処理を行う
     *
     * @param unknown $storeData
     */
    public function store( $storeData ){
        /**
         * 登録する値の加工
         */

        // idの空白を0埋め
        //$storeData['id'] = $this->convertCustomerCode( $storeData['id'] );
        
        Medley::merge( $storeData );
    }

    /**
     * CSVカラムの定義を返送する
     *
     * @return string[]
     */
    public function getColumns() {
        return $this->_cols;
    }

    /**
     * バリデーションルールを返送する
     *
     * @return string[]
     */
    public function getValidateRules() {
        return $this->_validate_rules;
    }

    /**
     * CSV項目数を返送する
     *
     * @return number
     */
    public function getItemNum() {
        return 18;
    }
}
