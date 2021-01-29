
{{-- リストマスターレイアウトを継承 --}}
@extends('master.list')

{{-- CSSの定義 --}}
@section('css')
@parent
<style>
    .item-border {
        border: 1px solid red;
    }

    .row-eq-height {
        display: flex;
        flex-wrap: wrap;
    }
</style>
@stop

{{-- JSの定義 --}}
@section('js')
@parent
@stop

{{-- メイン部分の呼び出し --}}
@section('content')
<div class="row">

    {{-- トップメニューの読み込み --}}
    @include( 'tv._tabs' )

    {{-- メイン --}}
    <div id="main" class="col col-sm-12">

        <h5 class="mb30"><i class="fa fa-th-list"></i> {{ $title }}一覧</h5>

        {{-- 検索の読み込み --}}
        @include( 'tv.tv_reserve.search_box_sp' )

        {{-- ページネーション --}}
        @section('table_pager')
            {{-- ペジネートをインポート --}}
            @include( 'master.list.paginate', ['data' => $showData] )
        @show

        <div class="panel panel-default col col-md-12" style="padding: 20px 20px 20px 20px; vertical-align: middle;">
            @include( 'master.list.sort', [
                'name' => 'カテゴリー', 'url' => $sortUrl,
                'sort_key' => 'category', 'sortTypes' => $sortTypes
            ]) |
            @include( 'master.list.sort', [
                'name' => '番組名', 'url' => $sortUrl,
                'sort_key' => 'name', 'sortTypes' => $sortTypes
            ]) | 
            @include( 'master.list.sort', [
                'name' => '放送チャンネル', 'url' => $sortUrl,
                'sort_key' => 'channel', 'sortTypes' => $sortTypes
            ]) | 
            @include( 'master.list.sort', [
                'name' => '放送曜日', 'url' => $sortUrl,
                'sort_key' => 'onair_weekday_num', 'sortTypes' => $sortTypes
            ]) | 
            @include( 'master.list.sort', [
                'name' => '放送時間', 'url' => $sortUrl,
                'sort_key' => 'onair_time', 'sortTypes' => $sortTypes
            ]) | 
            @include( 'master.list.sort', [
                'name' => '放送開始日', 'url' => $sortUrl,
                'sort_key' => 'onair_start_date', 'sortTypes' => $sortTypes
            ])
        </div>

        <div class="panel panel-default col col-md-12" style="padding: 20px 20px 20px 20px; vertical-align: middle;">
            <div class="row row-eq-height">

                {{-- データがある時の表示 --}}
                @if( !$showData->isEmpty() )
                    @foreach( $showData as $key => $value )
                        <div class="col col-md-3 col-sm-4 col-xs-12" style="padding: 10px 10px 10px 10px">
                            <table class="table table-bordered tbl-pdg tbl-txt-center" style="font-size: 13px;">
                                <thead>
                                    <tr class="bg-primary">

                                        {{-- 番組名 --}}
                                        <th class="list_th" colspan="2">
                                            {{ $value->name }}
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        {{-- カテゴリー --}}
                                        <th class="list_th">
                                            カテゴリー
                                        </th>
                                        <td class="list_td">
                                            {{ $CodeUtil::getCategoryName( $value->category ) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 放送チャンネル --}}
                                        <th class="list_th">
                                            放送チャンネル
                                        </th>
                                        <td class="list_td">
                                            {{ $CodeUtil::getChannelName( $value->channel ) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 放送曜日 --}}
                                        <th class="list_th">
                                            放送曜日
                                        </th>
                                        <td class="list_td">
                                            {{ $DateUtil::getWeekjpName( $value->onair_weekday_num ) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 放送時間 --}}
                                        <th class="list_th">
                                            放送時間
                                        </th>
                                        <td class="list_td">
                                            {{ $value->onair_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 放送開始日 --}}
                                        <th class="list_th">
                                            放送開始日
                                        </th>
                                        <td class="list_td">
                                            {{ $value->onair_start_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 放送終了日 --}}
                                        <th class="list_th">
                                            放送終了日
                                        </th>
                                        <td class="list_td">
                                            {{ $value->onair_end_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- 詳細・編集ボタン --}}
                                        <td class="list_td" colspan="2">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-6">
                                                    <a href="{{ action( $displayObj->ctl . '@getDetail', ['id' => $value->id] ) }}" class="btn btn-info btn-block btn-embossed" title="詳細">
                                                        <i class="fa fa-mail-reply"></i> 詳細
                                                    </a>
                                                </div>

                                                <div class="col-sm-6 col-xs-6">
                                                    <a href="{{ action( $displayObj->ctl . '@getEdit', ['id' => $value->id] ) }}" class="btn btn-success btn-block btn-embossed" title="実績入力">
                                                        <i class="fa fa-mail-reply"></i> 編集
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else

                @endif

            </div>
        </div>

        {{-- ページネーション --}}
        @yield('table_pager')

    </div><!-- top row -->
</div><!-- main -->
@stop
