<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * 担当者モデル
 *
 * @author 江澤
 *
 */
class UserAccount extends AbstractModel implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword, SoftDeletes;

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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
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
        //return UserAccount::whereNotIn( 'account_level', [6] )
        return UserAccount::orderBys( ['id' => 'asc'] )
            ->lists( 'user_name', 'user_id' );
    }
        
    /**
     * ユーザーIDの重複をチェックする
     * カスタムバリデーション用メソッド
     * @param unknown $value
     * @return boolean
     */
    public function unique( $value ) {
        $count = UserAccount::where( 'user_id', $value )
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
        $count = UserAccount::where( 'user_login_id', $value )
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
     * 検索条件を指定するメソッド
     * @param  [type] $query      [description]
     * @param  [type] $requestObj [description]
     * @return [type]             [description]
     */
    public function scopeWhereRequest( $query, $requestObj ){
        // 検索条件を指定
        $query = $query->includeDeleted( "1" ); // 削除データを含めるか
        
        return $query;
    }
    
}