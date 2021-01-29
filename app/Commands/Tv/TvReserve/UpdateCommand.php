<?php

namespace App\Commands\Tv\TvReserve;

use App\Models\Tv\TvReserve;
use Illuminate\Console\Command;

/**
 *  メドレーフェスティバルを更新するコマンド
 *
 * @author 江澤
 */
class UpdateCommand extends Command{

    /**
     * コンストラクタ
     * @param [type]      $id         [description]
     * @param SlideRequest $requestObj [description]
     * @param [type]      $file_name  [description]
     */
    public function __construct( $id, $requestObj ){
        $this->id = $id;
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定したIDのモデルオブジェクトを取得
        $targetMObj = TvReserve::findOrFail( $this->id );
        
        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        // データの更新
        $targetMObj->update( $setValues );
                
        return $targetMObj;
    }
    
}
