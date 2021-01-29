<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AbstractModel;
use DB;

class Event extends AbstractModel
{
    use SoftDeletes;
    
    // テーブル名
    protected $table = 'tb_event';
    
    // 変更可能なカラム
    protected $fillable = [
        'category', // カテゴリー
        'name', // イベント名
        'start_date', // 開始日時
        'end_date', // 終了日時
        'memo', // 備考
        'report' // レポート
    ];

    ######################
    ## request
    ######################

    /**
     * 検索条件を指定するメソッド
     * @param  [type] $query      [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function scopeWhereRequest( $query, $requestObj ){
        $query = $query
                // カテゴリー
                ->whereMatch( 'category', $requestObj->category )
                // start_time
                ->whereLike( 'name', $requestObj->name );
            
        return $query;
    }
}
