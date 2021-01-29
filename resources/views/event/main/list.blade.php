{{-- リストマスターレイアウトを継承 --}}
@extends('master.list')

{{-- メイン部分の呼び出し --}}
@section('content')
<div class="row">
	
	{{-- トップメニューの読み込み --}}
	@include( 'event._tabs' )
	
	{{-- メイン --}}
	<div id="main" class="col-sm-12">
		<h5 class="mb30"><i class="fa fa-th-list"></i> {{ $title }}</h5>
		
		{{-- 検索の読み込み --}}
        @include( 'event.main.search_box' )

        {{-- ページネーション --}}
        @section('table_pager')
            {{-- ペジネートをインポート --}}
            @include( 'master.list.paginate', ['data' => $showData] )
        @show

		{{-- 販社一覧 --}}
		<div class="row">
			<div class="panel panel-default">
				<table class="table table-bordered table-hover tbl-pdg">
					<thead>
						<tr class="bg-primary tbl-txt-center">
							<th>
								@include( 'master.list.sort', [
									'name' => 'ID', 'url' => $sortUrl,
									'sort_key' => 'id', 'sortTypes' => $sortTypes
								])
							</th>
							<th>
								@include( 'master.list.sort', [
									'name' => 'カテゴリー', 'url' => $sortUrl,
									'sort_key' => 'category', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => 'イベント名', 'url' => $sortUrl,
									'sort_key' => 'name', 'sortTypes' => $sortTypes
								])
							</th>
							<th>
								@include( 'master.list.sort', [
									'name' => '開始日時', 'url' => $sortUrl,
									'sort_key' => 'start_date', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '終了日時', 'url' => $sortUrl,
									'sort_key' => 'end_date', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '備考', 'url' => $sortUrl,
									'sort_key' => 'memo', 'sortTypes' => $sortTypes
								])
							</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@if( !$showData->isEmpty() )
							@foreach( $showData as $key => $value )
								<tr>
									{{-- ID --}}
									<td class="list_td">
										{{ $value->id }}
									</td>

									{{-- カテゴリー --}}
									<td class="list_td">
										{{ $CodeUtil::getCategoryName( $value->category ) }}
									</td>

									{{-- イベント名 --}}
									<td class="list_td">
										{{ $value->name }}
									</td>

									{{-- 開始日時 --}}
									<td class="list_td">
										@if( !empty( $value->start_date ) == True )
											{{ date( "Y-m-d", strtotime( $value->start_date ) ) }}
										@endif
									</td>

									{{-- 終了日時 --}}
									<td class="list_td">
										@if( !empty( $value->start_date ) == True )
											{{ date( "Y-m-d", strtotime( $value->end_date ) ) }}
										@endif
									</td>
									
									{{-- 備考 --}}
									<td class="list_td">
                                        {{ $value->memo }}
									</td>

									{{-- 操作 --}}
									<td class="list_td">
										{{-- 詳細 --}}
										<a href="{{ action( $displayObj->ctl . '@getDetail', ['id' => $value->id] ) }}" title="詳細">
											<i class="fui-search"></i>
										</a>
										{{-- 編集 --}}
										<a href="{{ action( $displayObj->ctl . '@getEdit', ['id' => $value->id] ) }}" title="編集">
											<i class="fui-new"></i>
										</a>
										{{-- 削除 --}}
										<a href="{{ action( $displayObj->ctl . '@getDelete', ['id' => $value->id] ) }}" onclick="return confirm('本当に削除してよろしいでしょうか？');" title="削除">
											<i class="fui-trash"></i>
										</a>
										
									</td>

								</tr>
							@endforeach
						@else
							{{-- データがない時の表示 --}}
							@include( 'master.list.none' )

						@endif
					</tbody>
				</table>
			</div>

		</div>
		
        {{-- ページネーション --}}
        @yield('table_pager')
        
	</div><!-- top row -->
</div><!-- main -->
@stop
