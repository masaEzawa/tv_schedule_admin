<?php

namespace App\Original\Codes\Event;

use App\Original\Codes\Code;

/**
 * 順位を表すコード
 *
 * @author 江澤
 *
 */
class RankingCodes extends Code {

    private $codes = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
