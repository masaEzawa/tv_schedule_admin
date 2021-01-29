<?php

namespace App\Commands\Event\Medley\Result;

use App\Models\Event\Medley;
use Illuminate\Console\Command;
use App\Http\Requests\Event\MedleyRequest;

/**
 *  メドレーフェスティバル実績を更新するコマンド
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
        $targetMObj = Medley::findOrFail( $this->id );
        
        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        
        // 成形後の値を格納する配列を初期化
        $setValues['result_date'] = [];
        
        // 配列の先頭は空なので取り除く
        array_shift( $setValues['result_day'] ); // 実績日
        array_shift( $setValues['result_time'] ); // 実績時刻
        array_shift( $setValues['result_point'] ); // 実績ポイント
        
        // 実績日付が空でないとき
        if( !empty( $setValues['result_day'] ) == True && !empty( $setValues['result_time'] ) == True ){
            
            // ループ回数を初期化
            $i = 1;
            foreach( $setValues['result_day'] as $key => $value ){
                // DB登録用の配列に実績日付のデータを格納する
                $setValues['result_date'][$i] = $setValues['result_day'][$key] . " " . $setValues['result_time'][$key];
                $i ++; // インデックスを1増やす
            }
        }
        
        // 実績ポイントが空でないとき
        if( !empty( $setValues['result_point'] ) == True ){
            
            // ループ回数を初期化
            $i = 1;
            foreach( $setValues['result_point'] as $key => $value ){
                // DB登録用の配列に実績日付のデータを格納する
                $result_point[$i] = $value;
                $i ++; // インデックスを1増やす
            }
            $setValues['result_point'] = $result_point;
        }

        // 実績日付を配列からJSONに変換する
        $setValues['result_date'] = json_encode( $setValues['result_date'] );
        // 実績ポイントを配列からJSONに変換する
        $setValues['result_point'] = json_encode( $setValues['result_point'] );
        
        // 更新を行うカラム名
        $colums = [
            'result_date', // 実績日付
            'result_point' // 実績ポイント
        ];
        
        foreach ( $colums as $colum ) {
            $targetMObj->{$colum} = $setValues[$colum];
        }

        // データの更新
        $targetMObj->save();
                
        return $targetMObj;
    }
    
}
