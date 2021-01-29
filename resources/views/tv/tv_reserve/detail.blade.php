{{-- カテゴリーレイアウトを継承 --}}
@extends('master.detail')

{{-- JSの定義 --}}
@section('js')
@parent
@stop

{{-- メニューの読み込み --}}
@section("tabs")
	@include( 'tv._tabs' )
@stop

{{-- 詳細内容 --}}
@section("detail")

<div class="row">
    <div class="panel panel-default">
        <table class="table table-bordered tbl-txt-center tbl-input-line">
            <tbody>
                {{-- カテゴリー --}}
                <tr>
                    <th class="bg-primary">カテゴリー</th>
                    <td>
                        {{ $CodeUtil::getCategoryName( $targetMObj->category ) }}
                    </td>
                </tr>

                {{-- 番組名 --}}
                <tr>
                    <th class="bg-primary">番組名</th>
                    <td>
                        {{ $targetMObj->name }}
                    </td>
                </tr>

                {{-- 放送チャンネル --}}
                <tr>
                    <th class="bg-primary">放送チャンネル</th>
                    <td>
                        {{ $CodeUtil::getChannelName( $targetMObj->channel ) }}
                    </td>
                </tr>

                {{-- 放送曜日 --}}
                <tr>
                    <th class="bg-primary">放送曜日</th>
                    <td>
                        {{ $DateUtil::getWeekjpName( $targetMObj->onair_weekday_num ) }}
                    </td>
                </tr>

                {{-- 放送時間 --}}
                <tr>
                    <th class="bg-primary"> 放送時間</th>
                    <td>
                        {{ $targetMObj->onair_time }}
                    </td>
                </tr>
                
                {{-- 放送開始日 --}}
                <tr>
                    <th class="bg-primary"> 放送開始日</th>
                    <td>
                        {{ $targetMObj->onair_start_date }}
                    </td>
                </tr>
                
                {{-- 放送終了日 --}}
                <tr>
                    <th class="bg-primary"> 放送終了日</th>
                    <td>
                        {{ $targetMObj->onair_start_date }}
                    </td>
                </tr>

                {{-- 備考 --}}
                <tr>
                    <th class="bg-primary">備考</th>
                    <td>
                        {!! nl2br( $targetMObj->memo ) !!}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="row">
    {{-- 戻るボタン --}}
    <div class="col-sm-2">
        <button type="button" onClick="location.href ='{{ action( $displayObj->ctl . '@getIndex') }}'" class="btn btn-warning btn-block btn-embossed">
            <i class="fa fa-mail-reply"></i> 戻る
        </button>
    </div>

    {{-- 確認画面 --}}
    <div class="col-sm-4 col-sm-offset-2">
        
    </div>

    {{-- 削除 --}}
    <div class="col-sm-2">
        <a href="{{ action( $displayObj->ctl . '@getDelete', ['id' => $targetMObj->id] ) }}" onclick="return confirm('本当に削除してよろしいでしょうか？');" title="削除" class="btn btn-default btn-block btn-embossed">
            <i class="fa fa-mail-reply"></i> 削除
        </a>
    </div>
</div>

@stop
