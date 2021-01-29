
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		
		{{-- メニューのタイトル部分 --}}
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
				<span class="sr-only"></span>
			</button>

			{{-- カテゴリー初期化 --}}
			<a class="navbar-brand" href="{{ url('top/index') }}">
				{{-- Config::get('original.title') --}}TV番組予約イベント管理ツール
			</a>
		</div><!-- /.navbar-header -->

		{{-- ログイン情報を表示 --}}
		@if( $loginAccountObj != null )
			<div class="collapse navbar-collapse" id="navbar-collapse-01">

				{{-- ログイン情報 --}}
				<div class="navbar-right">
					<p class="navbar-text">
						{{ $loginAccountObj->getUserName() }}様
					</p>
					<button type="button" onClick="location.href='{{ url('auth/logout') }}'" class="btn btn-default navbar-btn btn-sm">ログアウト</button>
				</div>
				
				{{-- システム毎のメニュー部分の呼び出し --}}
				@include('master._nav')
			</div>
		@endif
	</div>
</nav>
