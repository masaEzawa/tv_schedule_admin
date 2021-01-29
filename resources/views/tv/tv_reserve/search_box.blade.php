{{-- 検索部分のレイアウトを継承 --}}
@extends('master.list.search_box')

{{-- 検索項目の表示 --}}
@section('search_input')

{{-- 検索 --}}
{{-- Form開始 --}}
{!! Form::model(
    $search,
    ['id'=> 'searchForm', 'method' => 'GET', 'url' => action( $displayObj->ctl . '@getList' ) . "#test"]
) !!}

    {{-- 表示件数の値を格納できるように必ずすること --}}
    {!! Form::hidden( 'row_num', null ) !!}

    <tr>
        {{-- カテゴリー --}}
        <th class="bg-primary list_th" style="width: 100px;">
            カテゴリー
        </th>
        <td style="width: 250px;">
            @include( 'elements.tv_reserve.category_select', ['id' => 'category', 'options' => ['class' => 'form-control']] )
        </td>

        {{-- 番組名 --}}
        <th class="bg-primary list_th" style="width: 100px;">
            番組名
        </th>
        <td style="width: 250px;">
            {!! Form::text( 'name', null, ['class' => 'form-control'] ) !!}
        </td>
        
        {{-- 放送チャンネル --}}
        <th class="bg-primary list_th" style="width: 100px;">
            放送チャンネル
        </th>
        <td style="width: 280px;">
            @include( 'elements.tv_reserve.channel_select', ['id' => 'channel', 'options' => ['class' => 'form-control']] )
        </td>
    
    </tr>
    <tr>

        {{-- 放送曜日 --}}
        <th class="bg-primary list_th" style="width: 100px;">
            放送曜日
        </th>
        <td style="width: 250px;">
            @include( 'elements.date.week_select', ['id' => 'onair_weekday_num', 'options' => ['class' => 'form-control']] )
        </td>
        
        {{-- 放送開始月 --}}
        <th class="bg-primary list_th" style="width: 100px;">
            放送開始月
        </th>
        <td style="width: 280px;">
            {!! Form::text( 'onair_start_ym', null, ['class' => 'form-control ympicker', 'placeholder' => '日付を入力してください'] ) !!}
        </td>

    </tr>

{!! Form::close() !!}

@stop

{{-- 検索ボタン等の表示 --}}
@section('search_button')
    {{-- 新規作成・検索機能 --}}
    <div class="col col-sm-4">
        <button type="button" onClick="location.href ='{{ action( $displayObj->ctl . '@getCreate') }}'" class="btn btn-warning btn-block btn-embossed">
            <i class="fa fa-pencil-square-o"></i> 新規作成
        </button>
    </div>

    <div class="col col-sm-4">
    <button type="submit" class="btn btn-info btn-block btn-embossed" onclick="$('#searchForm').submit();">
        <i class="fa fa-search"></i> 検索
    </button>
    </div>

    {{-- 
    <div class="col col-sm-4">
        <button type="button" onClick="location.href ='{{ action( $displayObj->ctl . '@getCsv') }}'" class="btn btn-success btn-block btn-embossed">
            <i class="fa fa-pencil-square-o"></i> CSVダウンロード
        </button>
    </div>
    --}}

@stop