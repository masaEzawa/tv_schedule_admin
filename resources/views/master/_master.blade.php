<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="format-detection" content="telephone=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="robots" content="noindex,nofollow">
<meta name="googlebot" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TV番組予約イベント管理ツール</title>

{{-- CSSの定義 --}}
@section('css')
{!! Html::style( 'css/vendor/bootstrap.min.css' ) !!}
{!! Html::style( 'css/vendor/jquery-ui.css' ) !!}
{!! Html::style( 'css/vendor/bootstrap-clockpicker.min.css' ) !!}
{!! Html::style( 'css/vendor/flat-ui.css' ) !!}
{!! Html::style( 'css/slide-message-box.css' ) !!}
{!! Html::style( 'css/modal/modaal.css' ) !!}
{!! Html::style( 'fullcalendar/fullcalendar.css' ) !!}
{!! Html::style( 'css/style.css' ) !!}
@show

{{-- JSの定義 --}}
@section('js')
	{!! Html::script( 'js/vendor/jquery.min.js' ) !!}
	{!! Html::script( 'js/vendor/jquery-ui.min.js' ) !!}
	{!! Html::script( 'js/vendor/datepicker-ja.js' ) !!}
	{!! Html::script( 'js/vendor/ympicker/jquery.ui.ympicker.js' ) !!}
	{!! Html::script( 'js/vendor/bootstrap-clockpicker.min.js' ) !!}
	{!! Html::script( 'js/vendor/video.js' ) !!}
	{!! Html::script( 'js/vendor/flat-ui.min.js' ) !!}

	{!! Html::script( 'js/slide-message-box.js' ) !!}
	{!! Html::script( 'fullcalendar/lib/moment.min.js' ) !!}
	{!! Html::script( 'fullcalendar/fullcalendar.js' ) !!}
	{!! Html::script( 'fullcalendar/locale/ja.js' ) !!}

	{{-- デバッグモードかどうかでjsの読み込みを分ける --}}
	@if( env( 'APP_DEBUG' ) == True )
		{!! Html::script( 'js/vue/vue.js' ) !!}
    @else
		{!! Html::script( 'js/vue/vue.min.js' ) !!}
    @endif
	{!! Html::script( 'js/common.js' ) !!}
@show

{{-- タブのアイコン --}}
@section('img')
<link rel="shortcut icon" href="{{ asset('img/icon.gif') }}">
@show

</head>

{{-- Loginの時に処理を分ける --}}
<body {{ isset( $loginAccountObj ) == true ? 'class="login-b"' : "" }} >

<div id="wrap">

	{{-- ヘッダー部分の呼び出し --}}
	@include('master._header')

	<div id="contents">
		<div class="container">
			{{-- タブ部分の呼び出し --}}
			@yield('content')
		</div>
	</div>

	{{-- フッター部分の呼び出し --}}
	@include('master._footer')

</div>

</body>
</html>
