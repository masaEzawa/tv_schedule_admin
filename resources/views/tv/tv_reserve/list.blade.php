{{-- リストマスターレイアウトを継承 --}}
@extends('master.list')

{{-- メイン部分の呼び出し --}}
@section('content')
<div class="row">
	
	{{-- トップメニューの読み込み --}}
	@include( 'tv._tabs' )
	
	{{-- メイン --}}
	<div id="main" class="col-sm-12">
		<h5 class="mb30"><i class="fa fa-th-list"></i> {{ $title }}</h5>
		
		{{-- 検索の読み込み --}}
        @include( 'tv.tv_reserve.search_box' )

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
									'name' => '番組名', 'url' => $sortUrl,
									'sort_key' => 'name', 'sortTypes' => $sortTypes
								])
							</th>
							<th>
								@include( 'master.list.sort', [
									'name' => '放送チャンネル', 'url' => $sortUrl,
									'sort_key' => 'channel', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '放送曜日', 'url' => $sortUrl,
									'sort_key' => 'onair_weekday_num', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '放送時間', 'url' => $sortUrl,
									'sort_key' => 'onair_time', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '放送開始日', 'url' => $sortUrl,
									'sort_key' => 'onair_start_date', 'sortTypes' => $sortTypes
								])
							</th>
                            <th>
								@include( 'master.list.sort', [
									'name' => '放送終了日', 'url' => $sortUrl,
									'sort_key' => 'onair_end_date', 'sortTypes' => $sortTypes
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

									{{-- 番組名 --}}
									<td class="list_td">
										{{ $value->name }}
									</td>

									{{-- 放送チャンネル --}}
									<td class="list_td">
										{{ $CodeUtil::getChannelName( $value->channel ) }}
									</td>

									{{-- 放送曜日 --}}
									<td class="list_td">
										{{ $DateUtil::getWeekjpName( $value->onair_weekday_num ) }}
									</td>
									
									{{-- 放送時間 --}}
									<td class="list_td">
                                        {{ $value->onair_time }}
									</td>

                                    {{-- 放送開始日 --}}
									<td class="list_td">
										{{ $value->onair_start_date }}
									</td>

									{{-- 放送終了日 --}}
									<td class="list_td">
										{{ $value->onair_end_date }}
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
