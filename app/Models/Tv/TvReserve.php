<?php

namespace App\Models\Tv;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AbstractModel;
use DB;

/**
 * メドレーフェスティバルのモデル
 *
 * @author 江澤
 *
 */
class TvReserve extends AbstractModel {

    use SoftDeletes;
    
    // テーブル名
    protected $table = 'tb_tv_reserve';
    
    // 変更可能なカラム
    protected $fillable = [
        'category', // カテゴリー
        'name', // 番組名
        'channel', // 放送チャンネル
        'onair_weekday_num', // 放送曜日（数値）
        'onair_time', // 放送時間
        'onair_start_date', // 放送開始日
        'onair_end_date', // 放送終了日
        'memo' // 備考
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
                // 番組名
                ->whereLike( 'name', $requestObj->name )
                // 放送チャンネル
                ->whereMatch( 'channel', $requestObj->channel )
                // 放送曜日
                ->whereMatch( 'onair_weekday_num', $requestObj->onair_weekday_num )
                // 放送開始日
                ->whereYm( 'onair_start_date', $requestObj->onair_start_ym );
            
        return $query;
    }

    

    

    ###########################
    ## CSVの処理
    ###########################
    
    /**
     * データの登録と更新
     * @param  [type] $values [description]
     * @return [type]         [description]
     */
    public static function merge( $values ) {
        \Log::debug( $values );
        Medley::insert( $values );
    }

}
