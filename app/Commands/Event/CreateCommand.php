<?php

namespace App\Commands\Event;

use App\Models\Event\Event;
use Illuminate\Console\Command;

/**
 * イベントを新規作成するコマンド
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
        $targetMObj = new Event();
        // 追加する値の配列を取得
        $setValues = $this->requestObj->all();

        ####################
        # 個別に値を加工する
        ####################
        
        // 開始日時が空でないとき
        if( !empty( $setValues['start_day'] ) == True && !empty( $setValues['start_time'] ) == True ){
            // 開始日時を成形する
            $setValues['start_date'] = $setValues['start_day'] . " " . $setValues['start_time'] . ":00";
        }else{
            // 開始日時が空の時はNULLにする
            $setValues['start_date'] = NULL;
        }
        // 終了日時が空でないとき
        if( !empty( $setValues['end_day'] ) == True && !empty( $setValues['end_time'] ) == True ){
            // 終了日時を成形する
            $setValues['end_date'] = $setValues['end_day'] . " " . $setValues['end_time'] . ":00";
        }else{
            // 終了日時が空の時はNULLにする
            $setValues['end_date'] = NULL;
        }

        ####################
        # 不要なカラムを削除する
        ####################
        
        unset( $setValues['start_day'] );
        unset( $setValues['start_time'] );
        unset( $setValues['end_day'] );
        unset( $setValues['end_time'] );

        
        // データの更新
        $targetMObj->create( $setValues );
        
        return $targetMObj;
    }

}
