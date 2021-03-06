<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

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
        return [
            'user_login_id' => 'required',
            'password' => 'required'
        ];
    }
    
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'user_login_id.required' => 'ログインIDを入力してください。',
            'password.required' => 'パスコードを入力してください。'
        ];
        
        return $messages;
    }

}
