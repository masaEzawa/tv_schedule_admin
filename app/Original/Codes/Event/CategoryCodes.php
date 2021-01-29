<?php

namespace App\Original\Codes\Event;

use App\Original\Codes\Code;

/**
 * カテゴリーを表すコード
 *
 * @author 江澤
 *
 */
class CategoryCodes extends Code {

    private $codes = [
        '1' => 'ライブ / コンサート',
        '2' => '展示イベント / コミケ',
        '3' => '映画',
        '4' => 'DVD鑑賞',
        '5' => '旅行',
        '99' => 'その他趣味'
    ];

    /**
     * コンストラクタ
     */
    public function __construct() {
        parent::__construct($this->codes);
    }
    
}
