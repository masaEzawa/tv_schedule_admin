<?php

namespace App\Original\Codes\TvReserve;

use App\Original\Codes\Code;

/**
 * 放送チャンネルを表すコード
 *
 * @author 江澤
 *
 */
class ChannelCodes extends Code {

    private $codes = [
        '9' => '9: TOKYO MX',
        '3' => '3: チバテレビ',
        '4' => '4: 日本テレビ',
        '5' => '5: テレビ朝日',
        '6' => '6: TBS',
        '7' => '7: テレビ東京',
        '8' => '8: フジテレビ',
        '2' => '2: NHK Eテレ',
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
