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
        <th class="bg-primary list_th">
            カテゴリー
        </th>
        <td>
            @include( 'elements.tv_reserve.category_select', ['id' => 'category', 'options' => ['class' => 'form-control']] )
        </td>
    </tr>
    <tr>
        {{-- イベント名 --}}
        <th class="bg-primary list_th">
            イベント名
        </th>
        <td>
            {!! Form::text( 'name', null, ['class' => 'form-control'] ) !!}
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