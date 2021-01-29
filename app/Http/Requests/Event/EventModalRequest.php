<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\SearchRequest;
use Illuminate\Contracts\Validation\Validator;  // 追加
use Illuminate\Http\Exceptions\HttpResponseException;  // 追加

/**
 * イベントの登録・編集用のフォームリクエスト
 *
 * @author 江澤
 *
 */
class EventModalRequest extends SearchRequest
{
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
            'category' => 'required', // カテゴリー
            'name' => 'required', // イベント名
        ];
    }

    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'category.required' => 'カテゴリーを入力してください。',
            'name.required' => 'イベント名を入力してください。',
        ];
        
        return $messages;
    }

    // FormRequest::failedValidation() をオーバーライド

    protected function failedValidation( Validator $validator )
    {
        $response['data']    = [];
        $response['status']  = 'NG';
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json( $response )
        );
    }
}
