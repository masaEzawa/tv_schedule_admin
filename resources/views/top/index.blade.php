{{-- カテゴリーレイアウトを継承 --}}
@extends('master._master')

{{-- CSSの定義 --}}
@section('css')
@parent
<style>
	.fc-day[data-date="{{ $target }}"]{
		background-color:#83e45b; !important
	}
</style>
@stop

{{-- JSの定義 --}}
@section('js')
@parent
	<script>
		var eventData = []
		$(function () {
			// コントローラー上で、取得したイベントデータのJSONを、JS上に格納する
			eventData = {!! $calEventJson !!};

			console.log( eventData );
			$('#calendar').fullCalendar({
				editable: true, // イベントを編集するか
				allDaySlot: false, // 終日表示の枠を表示するか

				selectLongPressDelay:0,
				eventDurationEditable: false, // イベント期間をドラッグしで変更するかどうか

				slotEventOverlap: false, // イベントを重ねて表示するか

				selectable: true,
				// 高さ(px)
        		height: 430,

				selectHelper: true,
				// デフォルト日付を変更する
				defaultDate: '{{ $target }}',

				// 日の枠内を選択したときの処理
				select: function(data) {
					var str = moment(data).format( 'YYYY-MM-DD' );
					console.log(str);
					window.location.href = "{{ url('top/index') }}?date=" + str;
				},

				// イベントをクリックしたときの処理
				eventClick: function(calEvent, jsEvent, view) {			
					// モーダルを開く
					$('#modal2').modal('show');

					showEditData( calEvent.id );
		
				},

				droppable: true,// イベントをドラッグできるかどうか
				
				// 登録されているイベントの一覧
				events: eventData,

			});

		});

		// イベントの編集画面のデータを AJAX より取得する
		function showEditData( id ){
			$.ajax({
				// 編集対象のイベントデータを取得するAPIのURL
				url:'{{ url('top/eventEdit') }}/' + id,
				type:'GET',
				dataType: 'json',
				// イベントデータが取得出来たらHRMLの値に格納する
				success: function( data ) {
					// イベントのID
					$('input[name="id"]').val( data['id'] );
					// イベントの日付
					$('input[name="target"]').val( data['target'] );
					$('.target_date').text( data['target'] );
					// 開始時間
					$('select[name="start_time1"]').val( data['start_time1'] );
					// 開始分
					$('select[name="start_time2"]').val( data['start_time2'] );
					// 終了時間
					$('select[name="end_time1"]').val( data['end_time1'] );
					// 終了分
					$('select[name="end_time2"]').val( data['end_time2'] );
					// カテゴリー
					$('select[name="category"]').val( data['category'] );
					// イベント名
					$('input[name="name"]').val( data['name'] );
					// 備考
					$('input[name="memo"]').val( data['memo'] );
				},
				error: function( data ) {

					// console.log(data.errors);
					alert('error');
				}
			})
		}
	</script>
@stop

{{-- メイン部分の呼び出し --}}
@section('content')
<div class="row">
	
	<div id="main" class="col-sm-12">
		
		<h5 class="mb30"><i class="fa fa-th-list"></i> {{ $title }}</h5>

		<div class="panel panel-default col-md-12" style="padding: 20px 20px 20px 20px; height: 1200px;">
		
			<div class="row">
				<div class="col col-sm-7">
					{{-- calenderを表示する --}}
					<div id="calendar"></div>
				</div>
			</div><br>

			<div class="row">

				{{-- イベント追加ボタン --}}
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">
					イベント追加
				</button>
				
				<table class="table table-bordered table-hover tbl-pdg">
					<thead>
						<tr class="bg-primary tbl-txt-center">
							<th>時間</th>
							<th>イベント名</th>
							<th>操作</th>
					</thead>
					<tbody>
						{{-- データが存在するとき --}}
						@forelse($showDayEvents as $event)
							<tr>
								{{-- 時間 --}}
								<td class="list_td col-sm-3">
									{{ date( "H:i", strtotime( $event->start_date ) ) }} ~ {{ date( "H:i", strtotime( $event->end_date ) ) }}
								</td>
								{{-- イベント名 --}}
								<td class="list_td">
									{{ $event->name }}
									<hr>
									{!! nl2br( $event->memo ) !!}
								</td>
								{{-- 操作 --}}
								<td class="list_td col-sm-3">

									{{-- 編集ボタン --}}
									<button type="button" class="btn btn-primary" onclick="showEditData( {{ $event->id }} );" data-toggle="modal" data-target="#modal2">
									{{--<button type="button" class="btn btn-primary" onclick="window.open('{{ url('top/eventEdit') }}');">--}}
										イベント編集
									</button>
								</td>
							</tr>
						@empty

						@endforelse

					</tbody>
				</table>
			</div>
		</div>{{-- panel --}}

	</div>{{-- main --}}
</div>{{-- row --}}

{{-- 登録用モーダルウィンドウの呼び出し --}}
@include('modal.event.input')

{{-- 編集用モーダルウィンドウの呼び出し --}}
@include('modal.event.update')

@stop