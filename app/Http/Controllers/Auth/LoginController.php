<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginedEvent;
use App\Http\Controllers\Controller;
use App\Original\Util\SessionUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Account\Account;
use App\Http\Requests\LoginRequest;
use Auth;
use Event;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'top/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postLogin( LoginRequest $request ){
        if (Auth::attempt(['user_login_id' => $request->id, 'password' => $request->password])) {
            Event::dispatch( new LoginedEvent( Auth::user() ) );
            $user = Auth::user();
            
            // ユーザー情報を登録(セッション)
            SessionUtil::putUser( new Account( $user ) );
            
            
            return redirect()->intended( 'top/' );
        }
        return redirect('auth/login')->with('error', 'IDまたはパスワードが間違っています');
    }

    public function getLogout() {

        // ユーザー情報を削除(セッション)
        SessionUtil::removeUser();

        if( session('csrf_error' ) ) {
            session('error', 'セッションが切れました。<br />セキュリティのためログアウトしました。');
        }

        $this->guard()->logout();

        return redirect('auth/login');

        //$this->getLogout();
    }
}
