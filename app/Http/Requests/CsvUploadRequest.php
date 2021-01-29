<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvUploadRequest extends FormRequest {

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
            'csv_file' => 'required|mimes:csv,txt'    // mimes: csvがうまく動作しない
        ];
    }
    
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'csv_file.required' => 'CSVファイルを選択してください。',
            'csv_file.mimes' => 'CSVの拡張子のファイルをアップロードしてください。'
        ];
        
        return $messages;
    }
}
