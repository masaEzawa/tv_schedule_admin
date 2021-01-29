<?php

namespace App\Http\Requests\TvReserve;

use App\Http\Requests\SearchRequest;

/**
 * TV番組の登録・編集用のフォームリクエスト
 *
 * @author 江澤
 *
 */
class TvReserveRequest extends SearchRequest {
    
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
    public function rules()
    {
        $rules = [
            'category' => 'required', // カテゴリー
            'name' => 'required', // 番組名
            'channel' => 'required', // 放送チャンネル
            'onair_weekday_num' => 'required', // 放送曜日（数値）
            'onair_time' => 'required', // 放送時間
        ];
        
        return $rules;
    }
    
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'category.required' => 'カテゴリーを入力してください。',
            'name.required' => '番組名を入力してください。',
            'channel.required' => '放送チャンネルを入力してください。',
            'onair_weekday_num.required' => '放送曜日を入力してください。',
            'onair_time.required' => '放送時間を入力してください。'
        ];
        
        return $messages;
    }

}
