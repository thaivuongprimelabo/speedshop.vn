@extends('layouts.shop')

@section('content')
<div class="container">
    <div class="row">
        <!-- ASIDE -->
        <div id="aside" class="col-md-3">
        	
        </div>
        <div id="main" class="col-md-9">
        	<!-- store top filter -->
			<div class="store-filter clearfix">
				<div class="pull-left">
					<div class="sort-filter">
						<span class="text-uppercase">Sắp xếp:</span>
						<select class="input" id="sort">
							<option value="">Tất cả</option>
							<option value="price_asc">Giá tăng dần</option>
							<option value="price_desc">Giá giảm dần</option>
						</select>
						<a id="do_sort" href="javascript:void(0)" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></a>
					</div>
				</div>
				<div id="paging_link" class="pull-right">
				</div>
			</div>
			<!-- /store top filter -->
        	<div id="store">
        		<div id="product_block" class="row">
        			
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var data = {
			type : 'post',
			async : false,
			page_name: 'product-page',
			sort: $('#sort').val(),
			container: '#product_block',
			paging: '#paging_link',
			widget: '#aside',
			limit_product: '{{ $config['limit_product_show'] }}'
		}

		loadProducts('{{ route('loadData') }}', data);

		$('#do_sort').click(function(e) {
			data.sort = $('#sort').val();
			loadProducts('{{ route('loadData') }}', data);
		});

		$(document).on('click', '.page-number', function(e) {
			data.sort = $('#sort').val();
			var page = $(this).attr('data-page');
			loadProducts('{{ route('loadData') }}?page=' + page, data);
		});

	})
</script>
@endsection
