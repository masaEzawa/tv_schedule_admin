<?php

namespace App\Commands\Other\Account;

use App\Lib\Util\DateUtil;
use App\Models\UserAccount;
use Illuminate\Console\Command;
use App\Http\Requests\UserAccountRequest;

/**
 * 担当者を更新するコマンド
 *
 * @author 江澤
 */
class UpdateCommand extends Command{

    /**
     * コンストラクタ
     * @param [type]      $id         [description]
     * @param UserAccountRequest $requestObj [description]
     * @param [type]      $file_name  [description]
     */
    public function __construct( $id, UserAccountRequest $requestObj ){
        $this->id = $id;
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 指定したIDのモデルオブジェクトを取得
        $userMObj = UserAccount::findOrFail( $this->id );
        
        // 更新する値の配列を取得
        $setValues = $this->requestObj->all();
        
        // 更新を行うカラム名
        $colums = [
            'user_login_id',
            'user_password',
            'password',
            'user_name',
            'account_level',
            'bikou',
        ];
        
        foreach ( $colums as $colum ) {
            $userMObj->{$colum} = $this->requestObj->{$colum};
        }
        
        // データの更新
        $userMObj->save();
                
        return $userMObj;
    }
    
}
