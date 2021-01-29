
{{-- カテゴリーレイアウトを継承 --}}
@extends('master.input')

{{-- メニューの読み込み --}}
@section("tabs")
	@include( 'other._tabs' )
@stop

{{-- 入力内容 --}}
@section("input")
	
	{{-- 追加と編集の時で処理を分ける --}}
	@if( $type == "edit" )
		{{-- 編集の時の処理 --}}
		{!! Form::model(
			$userMObj,
			['id'=> 'regEditForm', 'method' => 'PUT', 'url' => action( $displayObj->ctl . '@putEdit',['id'=> $userMObj->id] ), 'enctype' => 'multipart/form-data']
		) !!}

	@else
		{{-- 確認画面に遷移 --}}
		{!! Form::model(
			$userMObj,
			['id'=> 'regEditForm', 'method' => 'PUT', 'url' => action( $displayObj->ctl . '@putCreate'), 'enctype' => 'multipart/form-data']
		) !!}

	@endif

	<div class="row">
		<div class="panel panel-default">
			<table class="table table-bordered tbl-txt-center tbl-input-line">
				<tbody>
					{{-- ログインID --}}
					<tr>
						<th class="bg-primary">ログインID <span class="color-dpink">※</span></th>
						<td>
							{!! Form::text('user_login_id', null, ['size' => '10', 'maxlength' => '10', 'class' => 'form-control']) !!}
							<div>※半角英数字</div>
						</td>
					</tr>

					{{-- パスワード --}}
					<tr>
						<th class="bg-primary">パスワード <span class="color-dpink">※</span></th>
						<td>
							{!! Form::text('user_password', null, ['size' => '10', 'maxlength' => '12', 'class' => 'form-control']) !!}
							<div>※半角英数字</div>
						</td>
					</tr>
					
					{{-- ユーザー名 --}}
					<tr>
						<th class="bg-primary"> ユーザー名 <span class="color-dpink">※</span></th>
						<td>
							{!! Form::text('user_name', null, ['size' => '20', 'maxlength' => '20', 'class' => 'form-control']) !!}
						</td>
					</tr>

					{{-- 機能権限 --}}
					<tr>
						<th class="bg-primary">機能権限 <span class="color-dpink">※</span></th>
						<td>
							@include('elements.tag.role_select', ['id' => 'account_level'], ['options' => ['class' => 'form-control']])
						</td>
					</tr>

					{{-- 備考 --}}
					<tr>
						<th class="bg-primary">備考</th>
						<td>
							{!! Form::text('bikou', null, ['size' => '40', 'maxlength' => '200', 'class' => 'form-control']) !!}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		{{-- 戻るボタン --}}
		<div class="col-sm-2">
			<button type="button" onClick="location.href='{{ action( $displayObj->ctl . '@getIndex') }}'" class="btn btn-warning btn-block btn-embossed">
				<i class="fa fa-mail-reply"></i> 戻る
			</button>
		</div>
		
		{{-- 確認画面 --}}
		<div class="col-sm-4 col-sm-offset-2">
			{!! Form::submit( $type == "edit" ? '編集' : '登録', ['id' => $buttonId, 'class' => 'btn btn-info btn-block btn-embossed']) !!}
		</div>

		<div class="col-sm-2">
		</div>
	</div>

	{!! Form::close() !!}

@stop
