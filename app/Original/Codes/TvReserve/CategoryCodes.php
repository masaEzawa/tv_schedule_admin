<?php

namespace App\Original\Codes\TvReserve;

use App\Original\Codes\Code;

/**
 * カテゴリーを表すコード
 *
 * @author 江澤
 *
 */
class CategoryCodes extends Code {

    private $codes = [
        '1' => 'アニメ',
        '2' => '映画/アニメ',
        '3' => '映画/その他',
        '4' => 'バラエティ',
        '5' => 'ドラマ'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
