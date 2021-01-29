
<ul class="nav navbar-nav">

    {{-- TV番組 --}}
    <li>
        <a href="{{ url( 'tv/tv_reserve/list' ) }}" {!! Request::is( 'tv/*' ) ? 'style="color: #ee8"' : '' !!}>
            TV番組管理
        </a>
    </li>
    
    {{-- イベント管理 --}}
    <li>
        <a href="{{ url( 'event/list' ) }}" {!! Request::is( 'event/*' ) ? 'style="color: #ee8"' : '' !!}>
            イベント管理
        </a>
    </li>
    
    {{-- 管理者権限の時に表示 --}}
    @if( $loginAccountObj->getRolePriority() <= 1 )
        <li>
            <a href="{{ url( 'other/account/list' ) }}" {!! Request::is( 'other/*' ) ? 'style="color: #ee8"' : '' !!}>
                その他
            </a>
        </li>
    @endif
</ul>
