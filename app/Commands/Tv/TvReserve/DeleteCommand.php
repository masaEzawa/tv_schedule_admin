<?php

namespace App\Commands\Tv\TvReserve;

use App\Models\Tv\TvReserve;
use Illuminate\Console\Command;

/**
 * TV番組の削除コマンド
 *
 * @author 江澤
 */
class DeleteCommand extends Command{

    /**
     * コンストラクタ
     * @param [type]      $id         [description]
     * @param [type]      $file_name  [description]
     */
    public function __construct( $id ){
        $this->id = $id;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定したIDのモデルオブジェクトを取得
        $slideMObj = TvReserve::findOrFail( $this->id );
        
        // ソフトデリート
        $slideMObj->delete();
    }
    
}
