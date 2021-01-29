<?php

namespace App\Original\Codes\Event;

use App\Original\Codes\Code;

/**
 * スコアを表すコード
 *
 * @author 江澤
 *
 */
class ScoreCodes extends Code {

    private $codes = [
        '5' => 'S',
        '4' => 'A',
        '3' => 'B',
        '2' => 'C',
        '1' => 'なし'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
