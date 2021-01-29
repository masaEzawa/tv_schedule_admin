
{{-- 検索内容 --}}
<div class="row">
	<div class="col col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">

		<div class="panel panel-default" style="margin-bottom: 5px;">
			<div class="panel-heading">
				<h3 class="panel-title text-center search-head">検索項目</h3>
			</div>
			
			<div class="panel-body" style="padding: 0px;">
				<table class="table table-bordered tbl-input-line search" style="margin-bottom: 0px;">
					<tbody>
						
						{{-- 検索項目の表示 --}}
						@section('search_input')
						@show
						
					</tbody>
				</table>
			</div>
		</div><!-- .panel -->

	</div>
</div>

{{-- 新規作成・検索ボタン等 --}}
<div class="row">
	<div class="col col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
		
		<div class="row">
			
			{{-- 検索ボタン等の表示 --}}
			@section('search_button')
			@show
			
		</div><!-- .row -->

	</div><!-- .col -->
</div><!-- .row -->

