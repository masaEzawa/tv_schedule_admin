<?php

namespace App\Commands\Tv\TvReserve;

use App\Models\Tv\TvReserve;
use Illuminate\Console\Command;

/**
 * メドレーフェスティバルを新規作成するコマンド
 *
 * @author 江澤
 */
class CreateCommand extends Command{
    
    /**
     * コンストラクタ
     * @param SlideRequest $requestObj [description]
     */
    public function __construct( $requestObj ){
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        $targetMObj = new TvReserve();
        // 追加する値の配列を取得
        $setValues = $this->requestObj->all();
        ####################
        # 個別に値を加工する
        ####################
        
        // 放送時間が空でないとき
        if( !empty( $setValues['onair_time'] ) == True ){
            // 放送時間を成形する
            $setValues['onair_time'] = $setValues['onair_time'] . ":00";
        }else{
            // 放送時間が空の時はNULLにする
            $setValues['onair_time'] = NULL;
        }

        // データの更新
        $targetMObj->create( $setValues );
        
        return $targetMObj;
    }

}
