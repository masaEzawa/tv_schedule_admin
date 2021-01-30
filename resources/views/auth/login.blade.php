{{-- トップマスターレイアウトを継承 --}}
@extends('master._master')

{{-- メイン部分の呼び出し --}}
@section('content')
<br/><br/>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<form method="POST" action="" name="login">
			<div class="login-form">
			
				{{-- エラーメッセージ --}}
                @include('_errors.list')
                <br/>
			
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				{{-- ユーザーID --}}
				<div class="form-group">
					<div class="row">
						<div class="col col-sm-3 text-center">
							<label>ユーザーID</label>
						</div>
						<div class="col col-sm-9">
							<input type="text" name="user_login_id" value="{{ old('user_login_id') }}" class="form-control login-field" placeholder="" id="login-name">
						</div>
					</div>
				</div>

				{{-- パスワード --}}
				<div class="form-group">
					<div class="row">
						<div class="col col-sm-3 text-center">
							<label>パスワード</label>
						</div>
						<div class="col col-sm-9">
							<input type="password" name="password" value="{{ old('password') }}" class="form-control login-field" placeholder="" id="login-pass">
						</div>
					</div>
				</div>
			
			</div><br/>
			
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
			
					{{-- ログインボタン --}}
		            <input type="submit" value="ログイン" class="btn btn-info btn-lg btn-block btn-embossed" >
	            </div>
            </div>
		</form>
	</div>
</div>
@stop