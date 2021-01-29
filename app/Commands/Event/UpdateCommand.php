<?php

namespace App\Commands\Event;

use App\Models\Event\Event;
use Illuminate\Console\Command;

/**
 *  イベントを更新するコマンド
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
        $targetMObj = Event::findOrFail( $this->id );
        
        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        
        ####################
        # 個別に値を加工する
        ####################
        
        // 開始日時が空でないとき
        if( !empty( $setValues['start_day'] ) == True && !empty( $setValues['start_time'] ) == True ){
            // 開始日時を成形する
            $setValues['start_date'] = $setValues['start_day'] . " " . $setValues['start_time'];
        }else{
            // 開始日時が空の時はNULLにする
            $setValues['start_date'] = NULL;
        }
        // 終了日時が空でないとき
        if( !empty( $setValues['end_day'] ) == True && !empty( $setValues['end_time'] ) == True ){
            // 終了日時を成形する
            $setValues['end_date'] = $setValues['end_day'] . " " . $setValues['end_time'];
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
        $targetMObj->update( $setValues );
                
        return $targetMObj;
    }
    
}
