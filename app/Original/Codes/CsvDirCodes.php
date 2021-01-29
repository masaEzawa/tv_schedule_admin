<?php

namespace App\Original\Codes;

/**
 * CSV取込ファイルを保持するコード
 *
 * @author 江澤
 *
 */
class CsvDirCodes extends Code {

    const MEDLEY = 'csv_medley';   // メドフェス

    private $codes = [
        'csv_medley' => 'medley' // メドフェス
    ];
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct( $this->codes );
    }

    ########################
    ## 新車のCSVアップロード
    ########################
    
    // メドフェスデータのとき
    public static function isMedley( $type ) {
        return static::MEDLEY == $type;
    }

}
