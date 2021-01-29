<?php

namespace App\Original\Codes\Event;

use App\Original\Codes\Code;

/**
 * 消費LPを表すコード
 *
 * @author 江澤
 *
 */
class ConsumptionLpCodes extends Code {

    private $codes = [
        '25' => '25',
        '15' => '15',
        '10' => '10',
        '5' => '5'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
