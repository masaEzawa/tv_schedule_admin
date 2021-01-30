
{{-- カテゴリーレイアウトを継承 --}}
@extends('master.input')

{{-- JSの定義 --}}
@section('js')
@parent
{!! Html::script( 'js/tinymce/tinymce.min.js' ) !!}
{!! Html::script( 'js/tinymce/tinymce_setting.js' ) !!}
@stop

{{-- メニューの読み込み --}}
@section("tabs")
@include( 'event._tabs' )
@stop

{{-- 入力内容 --}}
@section("input")

{{-- 追加と編集の時で処理を分ける --}}
@if( $type == "edit" )
    {{-- 編集の時の処理 --}}
    {!! Form::model(
        $targetMObj,
        ['id'=> 'regEditForm', 'method' => 'POST', 'url' => route( 'event.edit', ['id' => $targetMObj->id] ), 'enctype' => 'multipart/form-data']
    ) !!}

@else
    {{-- 確認画面に遷移 --}}
    {!! Form::model(
        $targetMObj,
        ['id'=> 'regEditForm', 'method' => 'POST', 'url' => route( 'event.create' ), 'enctype' => 'multipart/form-data']
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
                        @include( 'elements.event.category_select', ['id' => 'category', 'options' => ['class' => 'form-control']] )
                    </td>
                </tr>

                {{-- イベント名 --}}
                <tr>
                    <th class="bg-primary">イベント名 <span class="color-dpink">※</span></th>
                    <td>
                        {!! Form::text( 'name', null, ['class' => 'form-control'] ) !!}
                    </td>
                </tr>

                {{-- 画像アップロード --}}
                <tr>
                    <th class="bg-primary">画像アップロード</th>
                    <td>
                        {{--<div id="my-awesome-dropzone" class="dropzone" style="width: 1265px; height:350px;overflow:scroll;"></div>--}}
                        <div id="my-awesome-dropzone" class="dropzone" style="height:350px;overflow:scroll;"></div>
                        <div id="upload_msg"></div>
                    </td>
                </tr>

                {{-- レポート --}}
                <tr>
                    <th class="bg-primary">レポート</th>
                    <td>
                        {!! Form::textarea( 'report', null, ['class' => 'form-control', 'id' => 'tinymce'] ) !!}
                    </td>
                </tr>
                
                {{-- 開始日時 --}}
                <tr>
                    <th class="bg-primary"> 開始日時 <span class="color-dpink">※</span></th>
                    <td>
                        <div class="row">
                            <div class="col col-sm-6">
                                {!! Form::text( 'start_day', null, ['class' => 'form-control datepicker', 'placeholder' => '日付を入力してください'] ) !!}
                            </div>
                            <div class="col col-sm-6">
                                {!! Form::text( 'start_time', null, ['class' => 'form-control clockpicker', 'placeholder' => '時間を入力してください'] ) !!}
                            </div>
                        </div>
                    </td>
                </tr>
                
                {{-- 終了日時 --}}
                <tr>
                    <th class="bg-primary"> 終了日時 <span class="color-dpink">※</span></th>
                    <td>
                        <div class="row">
                            <div class="col col-sm-6">
                                {!! Form::text( 'end_day', null, ['class' => 'form-control datepicker', 'placeholder' => '日付を入力してください'] ) !!}
                            </div>
                            <div class="col col-sm-6">
                                {!! Form::text( 'end_time', null, ['class' => 'form-control clockpicker', 'placeholder' => '時間を入力してください'] ) !!}
                            </div>
                        </div>
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

<form
             method="POST"
             action="/demo/public/user/upload"
             class="dropzone"
             id="imageUpload"
             enctype="multipart/form-data">
             {{ csrf_field() }}
         </form>

<link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
<style>
#imageUpload {
    display: none;
}
</style>

{!! Html::script( 'js/dropzone/dropzone.js' ) !!}

<script type="text/javascript">
    $(function(){

        var filenames = [];
        var cnt = 0;
        var id = '/';

        // おまじない
        //Dropzone.autoDiscover = false;

        Dropzone.options.myAwesomeDropzone = {
            paramName : "file",         // input fileの名前
            parallelUploads:1,            // 1度に何ファイルずつアップロードするか
            acceptedFiles:'image/*',   // 画像だけアップロードしたい場合
            maxFiles:100,                      // 1度にアップロード出来るファイルの数
            maxFilesize:5,                // 1つのファイルの最大サイズ(1=1M)
            dictInvalidFileType: "画像ファイル以外です。",
            dictMaxFilesExceeded: "一度にアップロード出来るのは100ファイルまでです。",
            dictDefaultMessage: "ここへファイルをドラッグ＆ドロップするとアップロードされます。<br>最大100個までアップ可能です。それ以上になる場合は分割して下さい。<br><br>（もしくはここをクリックするとファイル選択ウインドウが表示されますのでそこで選択してもアップ可能です）",
            headers: {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
            }
        };

        // urlは実際に画像をアップロードさせるURLパスを入れる
        const token = '{{ csrf_token() }}';

        const imageUploadUrl = "{{ action( $displayObj->ctl . '@postUploadImage' ) }}";

        console.log(imageUploadUrl);

        // urlは実際に画像をアップロードさせるURLパスを入れる
        var myDropzone = new Dropzone( "div#my-awesome-dropzone",{
            url: imageUploadUrl,
            method: 'post',
            // addRemoveLinks: true,
            params: {
                _token: token,
            },
            init: function () {
                this.on("complete", function (file) {
                    let fileUrl = typeof file.xhr !== 'undefined' ? file.xhr.responseText : file.dataUrl;

                    //var src = $(".media-checked .img-box img").attr('src');
                    var media = tinymce.activeEditor.dom.createHTML( 'img', {src: fileUrl, style:'max-width:100%;', class:'mce-img'}, '');
                
                    tinymce.activeEditor.selection.setContent(media);
                });
            }
        });

        //
        /*
        myDropzone.on( "success", function( file ){
            console.log(111111);
            var filename_enc = encodeURIComponent( file.name );
            // filename_enc = filename_enc.replace(/%/g,'');
            filenames[cnt] = '{{ url( "images") }}/' + filename_enc;

            //var src = $(".media-checked .img-box img").attr('src');
            var media = tinymce.activeEditor.dom.createHTML( 'img', {src: filenames[cnt], style:'max-width:100%;', class:'mce-img'}, '');
        
            tinymce.activeEditor.selection.setContent(media);

            // var filetag = '<img src="/upload/' + filenames[cnt] + '?cachetime_[NOWTIME]" alt="" style="max-width:100%;"><br />\n';
            // var textval = $('#tinymce').val() + filetag;
            // $('#tinymce').val(textval);
        });
        */
    });
    </script>

@stop
