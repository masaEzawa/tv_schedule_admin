<?php

namespace App\Http\Requests;

use App\Http\Requests\SearchRequest;

/**
 * アカウントの登録・編集用のフォームリクエスト
 *
 * @author 江澤
 *
 */
class UserRequest extends SearchRequest {

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
            //'user_id' => 'required|unique:tb_user_account'
            'user_login_id' => 'required',
            'user_password' => 'required',
            'user_name' => 'required',
            'account_level' => 'required'
        ];
        
        return $rules;
    }
    
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'user_login_id.required' => 'ログインIDを入力してください。',
            'user_password.required' => 'パスコードを入力してください。',
            'user_name.required' => '担当者を入力してください。',
            'account_level.required' => '機能権限を入力してください。'
        ];
        
        return $messages;
    }

}
