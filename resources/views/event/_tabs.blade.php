{{-- イベントのメニュータブ --}}
<ul class="nav nav-tabs main-nav-tabs">
    {{-- イベント一覧 --}}
	<li role="presentation" class="{!! Request::is( 'event/search*' ) ? 'active' : '' !!}">
		<a href="{{ url( 'event/list' ) }}">
            <i class="fa fa-list-alt"></i> イベント一覧
        </a>
	</li>

    {{-- イベント入力 --}}
	<li role="presentation" class="{!! Request::is( 'event/create*' ) ? 'active' : '' !!}">
		<a href="{{ url( 'event/create' ) }}">
            <i class="fa fa-list-alt"></i> イベント入力
        </a>
	</li>
</ul>
