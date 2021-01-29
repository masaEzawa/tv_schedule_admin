
{{-- カテゴリーレイアウトを継承 --}}
@extends('master.input')

{{-- JSの定義 --}}
@section('js')
@parent
@stop

{{-- メニューの読み込み --}}
@section("tabs")
@include( 'tv._tabs' )
@stop

{{-- 入力内容 --}}
@section("input")

{{-- 追加と編集の時で処理を分ける --}}
@if( $type == "edit" )
    {{-- 編集の時の処理 --}}
    {!! Form::model(
        $targetMObj,
        ['id'=> 'regEditForm', 'method' => 'PUT', 'url' => action( $displayObj->ctl . '@putEdit', ['id' => $targetMObj->id] ), 'enctype' => 'multipart/form-data']
    ) !!}

@else
    {{-- 確認画面に遷移 --}}
    {!! Form::model(
        $targetMObj,
        ['id'=> 'regEditForm', 'method' => 'PUT', 'url' => action( $displayObj->ctl . '@putCreate' ), 'enctype' => 'multipart/form-data']
    ) !!}

@endif

<div class="row">
    <div class="panel panel-default">
        <table class="table table-bordered tbl-txt-center tbl-input-line">
            <tbody>
                {{-- カテゴリー --}}
                <tr>
                    <th class="bg-primary">カテゴリー <span class="color-dpink">※</span></th>
                    <td>
                        @include( 'elements.tv_reserve.category_select', ['id' => 'category', 'options' => ['class' => 'form-control']] )
                    </td>
                </tr>

                {{-- 番組名 --}}
                <tr>
                    <th class="bg-primary">番組名 <span class="color-dpink">※</span></th>
                    <td>
                        {!! Form::text( 'name', null, ['class' => 'form-control'] ) !!}
                    </td>
                </tr>

                {{-- 放送チャンネル --}}
                <tr>
                    <th class="bg-primary">放送チャンネル <span class="color-dpink">※</span></th>
                    <td>
                        @include( 'elements.tv_reserve.channel_select', ['id' => 'channel', 'options' => ['class' => 'form-control']] )
                    </td>
                </tr>

                {{-- 放送曜日 --}}
                <tr>
                    <th class="bg-primary">放送曜日 <span class="color-dpink">※</span></th>
                    <td>
                        @include( 'elements.date.week_select', ['id' => 'onair_weekday_num', 'options' => ['class' => 'form-control']] )
                    </td>
                </tr>

                {{-- 放送時間 --}}
                <tr>
                    <th class="bg-primary"> 放送時間 <span class="color-dpink">※</span></th>
                    <td>
                        {!! Form::text( 'onair_time', null, ['class' => 'form-control clockpicker', 'placeholder' => '時間を入力してください'] ) !!}
                    </td>
                </tr>
                
                {{-- 放送開始日 --}}
                <tr>
                    <th class="bg-primary"> 放送開始日</th>
                    <td>
                        {!! Form::text( 'onair_start_date', null, ['class' => 'form-control datepicker', 'placeholder' => '日付を入力してください'] ) !!}
                    </td>
                </tr>
                
                {{-- 放送終了日 --}}
                <tr>
                    <th class="bg-primary"> 放送終了日</th>
                    <td>
                        {!! Form::text( 'onair_end_date', null, ['class' => 'form-control datepicker', 'placeholder' => '日付を入力してください'] ) !!}
                    </td>
                </tr>

                {{-- 備考 --}}
                <tr>
                    <th class="bg-primary">備考</th>
                    <td>
                        {!! Form::textarea( 'memo', null, ['class' => 'form-control'] ) !!}
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
        {!! Form::submit( $type == "edit" ? '編集' : '登録', ['id' => $buttonId, 'class' => 'btn btn-info btn-block btn-embossed']) !!}
    </div>

    <div class="col-sm-2">
    </div>
</div>

{!! Form::close() !!}

@stop
