{{-- TV番組のメニュータブ --}}
<ul class="nav nav-tabs main-nav-tabs">
    {{-- TV番組一覧 --}}
	<li role="presentation" class="{!! Request::is( 'tv/tv_reserve/list*' ) ? 'active' : '' !!}">
		<a href="{{ url( 'tv/tv_reserve/list' ) }}">
            <i class="fa fa-list-alt"></i> TV番組一覧
        </a>
	</li>
    {{-- TV番組入力 --}}
	<li role="presentation" class="{!! Request::is( 'tv/tv_reserve/create*' ) ? 'active' : '' !!}">
		<a href="{{ url( 'tv/tv_reserve/create' ) }}">
            <i class="fa fa-list-alt"></i> TV番組入力
        </a>
	</li>
</ul>
