<?php

namespace App\Original\Codes\Event;

use App\Original\Codes\Code;

/**
 * 選択難易度を表すコード
 *
 * @author 江澤
 *
 */
class DifficultyCodes extends Code {

    private $codes = [
        '4' => 'Expart',
        '3' => 'Hard',
        '2' => 'Normal',
        '1' => 'Easy'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
