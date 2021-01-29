{{-- リストマスターレイアウトを継承 --}}
@extends('master.list')

{{-- メイン部分の呼び出し --}}
@section('content')
<div class="row">
	
	{{-- トップメニューの読み込み --}}
	@include( 'other._tabs' )
	
	{{-- メイン --}}
	<div id="main" class="col-sm-12">
		<h5 class="mb30"><i class="fa fa-th-list"></i> {{ $title }}</h5>
		
		{{-- 新規作成・検索機能 --}}
		<div class="row mb30">
			<div class="col-sm-2">
				<button type="button" onClick="location.href='{{ action( $displayObj->ctl . '@getCreate') }}'" class="btn btn-warning btn-block btn-embossed">
					<i class="fa fa-pencil-square-o"></i> 新規作成
				</button>
			</div>
		</div>

        {{-- ページネーション --}}
        @section('table_pager')
            {{-- ペジネートをインポート --}}
            @include( 'master.list.paginate', ['data' => $showData] )
        @show

		{{-- 販社一覧 --}}
		<div class="row">
			<div class="panel panel-default">
				<table class="table table-bordered table-hover tbl-pdg">
					<thead>
						<tr class="bg-primary tbl-txt-center">
							<th>
								@include( 'master.list.sort', [
									'name' => 'ID', 'url' => $sortUrl,
									'sort_key' => 'id', 'sortTypes' => $sortTypes
								])
							</th>
							<th>ユーザー名</th>
							<th>ユーザーID</th>
							<th>パスワード</th>
							<th>権限</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@if( !$showData->isEmpty() )
							@foreach( $showData as $key => $value )
								<tr>
									{{-- ID --}}
									<td class="list_td">
										{{ $value->id }}
									</td>

									{{-- ユーザー名 --}}
									<td class="list_td">
										{{ $value->user_name }}
									</td>

									{{-- ユーザーID --}}
									<td class="list_td">
										{{ $value->user_login_id }}
									</td>

									{{-- パスワード --}}
									<td class="list_td">
										{{ $value->user_password }}
									</td>
									
									{{-- 権限 --}}
									<td class="list_td">
										{{ $CodeUtil::getRoleName( $value->account_level ) }}
									</td>

									{{-- 操作 --}}
									<td class="list_td">
										{{-- 詳細 --}}
										<a href="{{ action( $displayObj->ctl . '@getDetail', ['id' => $value->id] ) }}" title="詳細">
											<i class="fui-search"></i>
										</a>
										{{-- 編集 --}}
										<a href="{{ action( $displayObj->ctl . '@getEdit', ['id' => $value->id] ) }}" title="編集">
											<i class="fui-new"></i>
										</a>
										{{-- 削除 --}}
										<a href="{{ action( $displayObj->ctl . '@getDelete', ['id' => $value->id] ) }}" onclick="return confirm('本当に削除してよろしいでしょうか？');" title="削除">
											<i class="fui-trash"></i>
										</a>
										
									</td>

								</tr>
							@endforeach
						@else
							{{-- データがない時の表示 --}}
							@include( 'master.list.none' )

						@endif
					</tbody>
				</table>
			</div>

		</div>
		
        {{-- ページネーション --}}
        @yield('table_pager')
        
	</div><!-- top row -->
</div><!-- main -->
@stop
