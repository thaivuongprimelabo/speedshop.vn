@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div class="row">
		<section class="main_container collection col-lg-9 col-lg-push-3">
			<div class="box-heading hidden relative">
				<h1 class="title-head margin-top-0">Tất cả sản phẩm</h1>				
			</div>
			<div class="category-products products">
				<div class="sortPagiBar">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 text-xs-left text-sm-right">
							<div class="bg-white clearfix">
								<div id="sort-by">
                					<label class="left hidden-xs">Sắp xếp: </label>
                					<ul>
                						<li><span class="val">Mặc định</span>
                							<ul class="ul_2">
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="">Mặc định</a></li>								
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="name,asc">A → Z</a></li>
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="name,desc">Z → A</a></li>
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="price,asc">Giá tăng dần</a></li>
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="price,desc">Giá giảm dần</a></li>
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="created_at,asc" >Hàng mới nhất</a></li>
                								<li><a href="javascript:void(0)" class="sort-by" data-sort="created_at,desc">Hàng cũ nhất</a></li>
                							</ul>
                						</li>
                					</ul>
                				</div>
                				<div class="view-mode f-left">				
                					<a href="javascript:void(0)" data-view="grid" class="view-type">
                						<b class="btn button-view-mode view-mode-grid active ">
                							<i class="fa fa-th" aria-hidden="true"></i>					
                						</b>
                						<span>Lưới</span>
                					</a>
                					<a href="javascript:void(0)" data-view="list" class="view-type">
                						<b class="btn button-view-mode view-mode-list ">
                							<i class="fa fa-th-list" aria-hidden="true"></i>
                						</b>
                						<span>Danh sách</span>
                					</a>
                				</div>
							</div>
						</div>
					</div>
				</div>
				<section class="products-view products-view-{{ $view_type }}">
					<div id="ajax_list" class="row">
					</div>
				</section>
				<div id="ajax_paging">
				</div>
			</div>
		</section>
		<aside class="dqdt-sidebar sidebar left left-content col-lg-3 col-lg-pull-9">
		{!! Utils::createSidebarShop('category_list'); !!}
		{!! Utils::createSidebarShop('price_search'); !!}
		{!! Utils::createSidebarShop('popular_products'); !!}
		</aside>
	</div>
</div>
<input type="hidden" id="id" value="{{ isset($data) ? $data->id : '' }}" />
<input type="hidden" id="page_name" value="{{ $page_name }}" />
<input type="hidden" id="view_type" value="{{ $view_type }}" />
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
    	var data = {
    		type : 'post',
    		async : true,
    		id: $('#id').val(),
    		page_name: $('#page_name').val(),
    		view_type: $('#view_type').val(),
    		container: ['#ajax_list', '#ajax_paging'],
    		spinner: '#ajax_list',
    		limit_product: '{{ $config['limit_product_show'] }}'
    	}
    
    	callAjax('{{ route('loadData') }}', data);

    	$(document).on('click', '.view-type', function(e) {
        	$('.view-type b').removeClass('active');
        	$(this).find('b').addClass('active');
			var view_type = $(this).attr('data-view');
			$('.products-view').attr('class', 'products-view products-view-' + view_type);
			data['view_type'] = view_type;
			callAjax('{{ route('loadData') }}', data);
    	});

    	$(document).on('click', '.page-link', function(e) {
			var page_number = $(this).attr('data-page-number');
			callAjax('{{ route('loadData') }}?page=' + page_number, data);
    	});

    	$(document).on('click', '.sort-by', function(e) {
        	var text = $(this).text();
        	$('.val').html(text);
			var sort_by = $(this).attr('data-sort');
			data['sort_by'] = sort_by;
			callAjax('{{ route('loadData') }}', data);
    	});

    	$(document).on('click', '.price-search', function(e) {
        	var price_search = [];
			$('.price-search').each(function(index, item) {
				if(item.checked) {
					price_search.push(item.value);
				}
			});

			data['price_search'] = price_search.join(' OR ');
			callAjax('{{ route('loadData') }}', data);
    	});

    })
</script>
@endsection