<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\SearchRequest;

/**
 * メドレーフェスティバルの登録・編集用のフォームリクエスト
 *
 * @author 江澤
 *
 */
class MedleyRequest extends SearchRequest {
    
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
            'event_name' => 'required', // イベント名
            'start_day' => 'required', // 開始日時
            'start_time' => 'required', // 開始日時
            'end_day' => 'required', // 終了日時
            'end_time' => 'required', // 終了日時
            'music_num' => 'required', // 曲数
            'difficulty' => 'required', // 選択難易度
            'score' => 'required', // スコア
            'combo' => 'required', // コンボ
            'goal_point' => 'required', // 目標ポイント
        ];
        
        return $rules;
    }
    
    public function messages()
    {
        // エントリーフォームの入力値確認
        $messages = [
            'event_name.required' => 'イベント名を入力してください。',
            'start_day.required' => '開始日時を入力してください。',
            'start_time.required' => '開始日時を入力してください。',
            'end_day.required' => '終了日時を入力してください。',
            'end_day.required' => '終了日時を入力してください。',
            'end_time.required' => '終了日時を入力してください。',
            'music_num.required' => '曲数を入力してください。',
            'difficulty.required' => '選択難易度を入力してください。',
            'score.required' => 'スコアを入力してください。',
            'combo.required' => 'コンボを入力してください。',
            'goal_point.required' => '目標ポイントを入力してください。'
        ];
        
        return $messages;
    }

}
