<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\SearchRequest;

/**
 * メドレーフェスティバル実績の登録・編集用のフォームリクエスト
 *
 * @author 江澤
 *
 */
class MedleyResultRequest extends SearchRequest {
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        // リクエストを取得する
        $request = $this->request->all();
        $rules = [];
        // 実績日が空でないとき
        if( $request['result_day'] == True ){
            for( $i = 1; $i < count( $request['result_day'] ); $i ++ ){
                $rules["result_day.{$i}"] = 'required'; // 実績日
            }
        }
        // 実績時刻が空でないとき
        if( $request['result_time'] == True ){
            for( $i = 1; $i < count( $request['result_time'] ); $i ++ ){
                $rules["result_time.{$i}"] = 'required'; // 実績時刻
            }
        }
        // 実績ポイントが空でないとき
        if( $request['result_point'] == True ){
            for( $i = 1; $i < count( $request['result_point'] ); $i ++ ){
                $rules["result_point.{$i}"] = 'required'; // 実績ポイント
            }
        }
        
        return $rules;
    }
    
    public function messages(){
        // リクエストを取得する
        $request = $this->request->all();
        $messages = [];
        
        // 実績日が空でないとき
        if( $request['result_day'] == True ){
            for( $i = 1; $i < count( $request['result_day'] ); $i ++ ){
                $messages["result_day.{$i}.required"] = "実績{$i}の実績日を入力してください"; // 実績日
            }
        }
        // 実績時刻が空でないとき
        if( $request['result_time'] == True ){
            for( $i = 1; $i < count( $request['result_time'] ); $i ++ ){
                $messages["result_time.{$i}.required"] = "実績{$i}の実績時刻を入力してください"; // 実績時刻s
            }
        }
        // 実績ポイントが空でないとき
        if( $request['result_point'] == True ){
            for( $i = 1; $i < count( $request['result_point'] ); $i ++ ){
                $messages["result_point.{$i}.required"] = "実績{$i}の実績ポイントを入力してください"; // 実績ポイント
            }
        }
        
        return $messages;
    }

}
