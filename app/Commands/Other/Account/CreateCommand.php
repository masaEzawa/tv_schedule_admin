<?php

namespace App\Commands\Other\Account;

use App\Lib\Util\DateUtil;
use App\Models\User;
use Illuminate\Console\Command;
use App\Http\Requests\UserRequest;

/**
 * 担当者を新規作成するコマンド
 *
 * @author 江澤
 */
class CreateCommand extends Command{
    
    /**
     * コンストラクタ
     * @param UserRequest $requestObj [description]
     */
    public function __construct( UserRequest $requestObj ){
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     * @return [type] [description]
     */
    public function handle(){
        // 追加する値の配列を取得
        $setValues = $this->requestObj->all();
        
        // 登録されたデータを持つモデルオブジェクトを取得
        $userMObj = User::create( $setValues );
        
        return $userMObj;
    }

}
