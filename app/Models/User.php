<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    // テーブル名
    protected $table = 'tb_user_account';

    // 変更可能なカラム
    protected $fillable = [
        'user_login_id',
        'user_password',
        'password',
        'user_name',
        'account_level',
        'bikou',
        'last_logined',
        'remember_token',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    ######################
    ## other
    ######################
    
    /**
     * 権限を動的にバインドする
     *
     */
    public function role() {
        return $this->hasOne( 'App\Models\Role', 'id', 'account_level' );
    }
    
    /**
     * 担当者選択用のOptionをDBから取得する
     *
     */
    public static function options() {
        // 拠点長は表示しない
        //return User::whereNotIn( 'account_level', [6] )
        return User::orderBys( ['id' => 'asc'] )
            ->lists( 'user_name', 'user_id' );
    }
        
    /**
     * ユーザーIDの重複をチェックする
     * カスタムバリデーション用メソッド
     * @param unknown $value
     * @return boolean
     */
    public function unique( $value ) {
        $count = User::where( 'user_id', $value )
                            ->whereNull( $this->getTableName().'.'.$this->getDeletedAtColumn() )
                            ->count();

        return $count == 0;
    }

    /**
     * ユーザーログインIDの重複チェックをする
     * カスタムバリデーション用メソッド
     * @param unknown $value
     * @return boolean
     */
    public function unique_login_id( $value ) {
        $count = User::where( 'user_login_id', $value )
                            ->whereNull( $this->getTableName().'.'.$this->getDeletedAtColumn() )
                            ->count();

        return $count == 0;
    }
    
    /**
     * 半角チェックをする
     * カスタムバリデーション用メソッド
     * @param unknown $value
     * @return boolean
     */
    public function is_alnum( $value ) {
        if (preg_match("/^[a-zA-Z0-9]+$/",$value)) {
            return TRUE;
    	} else {
            return FALSE;
    	}
    }

    ###########################
    ## User List Commands
    ###########################

    /**
     * 複数のorder byを指定するメソッド
     * @param  [type] $query  [description]
     * @param  [type] $orders [description]
     * @return [type]         [description]
     */
    public static function scopeOrderBys( $query, $orders ) {
        if( !empty( $orders ) ) {
            foreach ( $orders as $key => $value ) {
                $query->orderBy( \DB::raw($key), $value );
            }
        }
        return $query;
    }
    
    /**
     * 検索条件を指定するメソッド
     * @param  [type] $query      [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function scopeWhereRequest( $query, $requestObj ){
        // 検索条件を指定
        $query = $query;
        
        return $query;
    }
}
