
{{-- カテゴリーレイアウトを継承 --}}
@extends('master.detail')

{{-- メニューの読み込み --}}
@section("tabs")
	@include( 'other._tabs' )
@stop

{{-- 詳細内容 --}}
@section("detail")
	<div class="row">
		<div class="panel panel-default">
			<table class="table table-bordered tbl-txt-center tbl-input-line">
				<tbody>
					{{-- ログインID --}}
					<tr>
						<th class="bg-primary">ログインID</th>
						<td>
							{{ $userMObj->user_login_id }}
						</td>
					</tr>

					{{-- パスワード --}}
					<tr>
						<th class="bg-primary">パスワード</th>
						<td>
							{{ $userMObj->user_password }}
						</td>
					</tr>
					
					{{-- ユーザー名 --}}
					<tr>
						<th class="bg-primary"> ユーザー名</th>
						<td>
							{{ $userMObj->user_name }}
						</td>
					</tr>

					{{-- 機能権限 --}}
					<tr>
						<th class="bg-primary">機能権限</th>
						<td>
							{{ $userMObj->account_level }}
						</td>
					</tr>

					{{-- 備考 --}}
					<tr>
						<th class="bg-primary">備考</th>
						<td>
							{!! nl2br( $userMObj->bikou ) !!}
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
	</div>
	
	{!! Form::close() !!}

@stop
