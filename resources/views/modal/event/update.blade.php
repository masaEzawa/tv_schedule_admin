{{-- JSの定義 --}}
@section('js')
@parent
	<script>
		$(function () {
			// 送信ボタンが押させたとき
			$('#editSubmitBtn').on('click',function(){
				console.log(11111);
			     // フォームのエラーチェックを行う。
			     errorList = modalEditCheck();

			     console.log(errorList);

			     if( errorList === false ){
			     	console.log(33333);
			     	// フォームの送信を行う
			     	modalEditSubmit();
			     }
			});
		});

		/**
		 * フォームのエラーチェックを行う。
		 */
		function modalEditCheck(){
			var errorList = [];
			var start_time1 = $('select[name="start_time1"]').val();
			var start_time2 = $('select[name="start_time2"]').val();
			var end_time1 = $('select[name="end_time1"]').val();
			var end_time2 = $('select[name="end_time2"]').val();
			var category = $('select[name="category"]').val();
			var name = $('input[name="name"]').val();

			if( start_time1 == "" ){
				errorList.push( "時間：開始の時間を入力してください" );
			}

			if( start_time2 == "" ){
				errorList.push( "時間：開始の分を入力してください" );
			}

			if( end_time1 == "" ){
				errorList.push( "時間：終了の時間を入力してください" );
			}

			if( end_time2 == "" ){
				errorList.push( "時間：終了の分を入力してください" );
			}

			if( category == "" ){
				errorList.push( "カテゴリーを入力してください" );
			}

			if( name == "" ){
				errorList.push( "イベント名の分を入力してください" );
			}

			if( start_time1 !== "" && end_time1 !== "" && start_time1 > end_time1 ){
				errorList.push( "時間：終了時間は開始時間よりも後の時間を入力してください" );
			}

			// エラーがあるとき
			if( errorList.length !== 0 ){
				$('#error').show();
				$('#error').empty();

				$.each( errorList, function(key, value){
					$('#error').append(value + "<br/>");
				})

				return errorList;
			}else{
				$('#error').hide();
				return false;
			}
			
		}

		/**
		 * フォームの送信を行う
		 */
		function modalEditSubmit(){

			// フォームを送信する
			$('#modal-edit-form').submit();
			// モーダルを閉じる
			$('#modal2').modal('hide');
			
		}
	</script>
@stop

{{-- モーダルウィンドウ --}}
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
  	<div id="app">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				

				{!! Form::open( ['id' => 'modal-edit-form', 'method' => 'POST', 'route' => 'top.eventEdit'] ) !!}

					{{-- 対象月を保持しておく --}}
					{!! Form::hidden( 'target', null ) !!}
					{!! Form::hidden( 'id', null ) !!}

					{{-- ヘッダーの設定部分 --}}
					<div class="modal-header">
						<div class="row">
							<div class="list_td col-md-10 col-sm-10">
								<h5 class="modal-title" id="label1">イベント登録／編集 <span class="target_date">{{ $target }}</span></h5>
							</div>
							<div class="list_td col-md-2 col-sm-2">
								<button type="submit" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
					<div class="modal-body">

						{{-- エラーメッセージの表示 --}}
						<div id="error" class="alert alert-danger block-center text-center" style="display: none;">
					  	</div>

						<div class="row" >

							{{-- イベント入力用テーブル --}}
							<table class="table table-bordered table-hover tbl-pdg" >
								<tbody>
									<tr>
										{{-- 時間 --}}
										<td class="list_td bg-info">
											時間
										</td>
									</tr>
									<tr>
										{{-- 時間 --}}
										<td class="list_td">
											<div class="row">
												<div class="form-group" style="margin-left: 10px;">
													<?php
													// 時間の配列を取得する
													$hourList = $DateUtil::getHourList();
													?>
													{{-- 時間 --}}
													{!! Form::select( 'start_time1', $hourList, null, [
														'placeholder' => '----', 'class' => 'form-control inline-block', 'style' => 'width: 93px'
													] ) !!}
													<label>時</label>
												
													<?php
													// 分の配列を取得する
													$minuteList = $DateUtil::getMinuteList();
													?>

													{{-- 分 --}}
													{!! Form::select( 'start_time2', $minuteList, null, [
														'placeholder' => '----', 'class' => 'form-control inline-block', 'style' => 'width: 93px'
													] ) !!}
													<label>分 ~ </label>
												
													{{-- 時間 --}}
													{!! Form::select( 'end_time1', $hourList, null, [
														'placeholder' => '----', 'class' => 'form-control inline-block', 'style' => 'width: 93px'
													] ) !!}
													<label>時</label>
												
													{{-- 分 --}}
													{!! Form::select( 'end_time2', $minuteList, null, [
														'placeholder' => '----', 'class' => 'form-control inline-block', 'style' => 'width: 93px'
													] ) !!}
													<label>分</label>
												</div>
											</div>
										</td>
									</tr>
									{{-- カテゴリー --}}
									<tr>
										<td class="list_td bg-info">
											カテゴリー
										</td>
									</tr>
									{{-- カテゴリー --}}
									<tr>
										<td class="list_td">
											@include( 'elements.event.category_select', ['id' => 'category', 'options' => ['class' => 'form-control']] )
										</td>
									</tr>
									{{-- イベント名 --}}
									<tr>
										<td class="list_td bg-info">
											イベント名
										</td>
									</tr>
									{{-- イベント名 --}}
									<tr>
										<td class="list_td">
											{!! Form::text( 'name', null, ['class' => 'form-control'] ) !!} 
										</td>
									</tr>
									{{-- 備考 --}}
									<tr>
										<td class="list_td bg-info">
											備考
										</td>
									</tr>
									{{-- 備考 --}}
									<tr>
										<td class="list_td">
											{!! Form::textarea( 'memo', null, [
												'class' => 'form-control', 'cols' => '30', 'rows' => '2'
											] ) !!} 
										</td>
									</tr>
								</tbody>
	
							</table>

						</div>
					</div>

					{{-- フッター部分 --}}
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="editSubmitBtn">OK</button>
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>