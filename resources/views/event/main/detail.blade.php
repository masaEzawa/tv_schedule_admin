{{-- カテゴリーレイアウトを継承 --}}
@extends('master.detail')

{{-- JSの定義 --}}
@section('js')
@parent
@stop

{{-- メニューの読み込み --}}
@section("tabs")
	@include( 'event._tabs' )
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

                {{-- イベント名 --}}
                <tr>
                    <th class="bg-primary">イベント名</th>
                    <td>
                        {{ $targetMObj->name }}
                    </td>
                </tr>

                {{-- 開始日時 --}}
                <tr>
                    <th class="bg-primary">開始日時</th>
                    <td>
                        {{ date( "Y-m-d", strtotime( $targetMObj->start_date ) ) }}
                    </td>
                </tr>

                {{-- 終了日時 --}}
                <tr>
                    <th class="bg-primary">終了日時</th>
                    <td>
                        {{ date( "Y-m-d", strtotime( $targetMObj->end_date ) ) }}
                    </td>
                </tr>

                {{-- 備考 --}}
                <tr>
                    <th class="bg-primary">備考</th>
                    <td>
                        {!! nl2br( $targetMObj->memo ) !!}
                    </td>
                </tr>

                {{-- レポート --}}
                <tr>
                    <th class="bg-primary">レポート</th>
                    <td>
                        {!! nl2br( $targetMObj->report ) !!}
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
