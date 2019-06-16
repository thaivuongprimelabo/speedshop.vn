@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
@php
	$images = $data->getImageDetails();
@endphp
<div class="container">
	<div class="row">
			<div class="col-lg-9 ">
				<div class="details-product">
					<div class="row">
						@if($images->count())
						<div class="col-xs-12 col-sm-12 col-md-5">
							<div class="large-image">
								<a href="{{ $images->first()->getImageLink() }}" data-rel="">
									<img id="zoom_01" src="{{ $images->first()->getImageLink('medium') }}"  data-zoom-image="{{ $images->first()->getImageLink() }}" alt="{{ $data->getName() }}">
								</a>
							</div>
							
							<div id="gallery_01" class="fixborder  owl-carousel owl-theme thumbnail-product" data-md-items="4" data-sm-items="4" data-xs-items="4" data-xss-items="2" data-margin="10" data-nav="true">
    							@foreach($images as $img)
    							<div class="item">
									<a class="clearfix" href="#" data-image="{{ $img->getImageLink('medium') }}" data-zoom-image="{{ $img->getImageLink() }}">
										<img  src="{{ $img->getImageLink('small') }}" alt="{{ $data->getName() }}">
									</a>
								</div>
								@endforeach
							</div>
						</div>
						@endif
						<div class="col-xs-12 col-sm-12 col-md-7 details-pro">
							<h1 class="title-head">{{ $data->getName() }}</h1>
							<div class="status clearfix">
								{{ trans('shop.status_txt') }}:
								<label class="label @if($data->avail_flg == ProductStatus::AVAILABLE){{ 'label-success' }}@else{{ 'label-danger' }}@endif"><i class="fa fa-check"></i>{{ $data->getStatusName() }}</label>
							</div>
							<div class="price-box clearfix">
							@if($data->price > 0 && $data->discount > 0)
							<div class="special-price">
								<span id="product_price_format" class="price product-price">{{ $data->getPriceDiscount() }}</span>
								<input type="hidden" id="product_price" value="{{ $data->getPriceDiscount(false) }}" /> 
							</div> <!-- Giá -->
							<div class="old-price">															 
								<span class="price product-price-old">Giá gốc: <del class="price product-price-old">{{ $data->getPrice() }}</del> <span class="discount">(-{{ $data->discount }}%)</span></span>
							</div>
							@else
							<div class="special-price">
								<span id="product_price_format" class="price product-price">{{ $data->getPrice() }}</span>
								<input type="hidden" id="product_price" value="{{ $data->price }}" /> 
							</div> <!-- Giá -->
							@endif
							@if($data->price > 0)
							@php
								$productDetails = $data->getProductDetails();
							@endphp
							@foreach($productDetails as $detail)
							<div class="status clearfix mt-5">
								{{ $detail->group_name }}:
								@php
									$ids = explode(',', $detail['detail_id']);
									$names = explode(',', $detail['detail_name']);
									$prices = explode(',', $detail['detail_price']);
								@endphp
								@foreach($ids as $k=>$id)
								<span class="label label-default detail-item group-{{ $detail['group_id'] }}" style="cursor: pointer;padding:5px 10px;" data-group-id="{{ $detail['group_id'] }}" data-group-name="{{ $detail['group_name'] }}" data-id="{{ $id }}" data-product-id="{{ $data->id }}" data-name="{{ $names[$k] }}" data-price="{{ $prices[$k] }}"> {{ $names[$k] }}</span>
								@endforeach
							</div>
							@endforeach
							@endif
						</div>
						<div class="product-summary product_description margin-bottom-15">
							<div class="rte description">
								{!! $data->getSummary() !!}</p>
							</div>
						</div>
						<div class="form-product ">
							@if($data->price > 0 && $data->avail_flg == ProductStatus::AVAILABLE)
							<form enctype="multipart/form-data" id="add-to-cart-form" action="?" method="post" class="form-inline margin-bottom-10 dqdt-form">
								<div class="box-variant clearfix ">
								</div>
								<div class="form-group form-groupx form-detail-action clearfix ">
									<label class="f-left">{{ trans('shop.cart.qty_txt') }}: </label>
									<div class="custom custom-btn-number">
										<span class="qtyminus" data-id="{{ $data->id }}">-</span>
										<input type="text" class="input-text qty" title="Só lượng" value="1" maxlength="12" id="qty" name="quantity"  data-id="{{ $data->id }}">
										<span class="qtyplus" data-id="{{ $data->id }}">+</span>
									</div>
									<button type="button" class="btn btn-lg btn-primary btn-cart btn-cart2 btn-buy" title="{{ trans('shop.button.add_to_cart') }}"  data-id="{{ $data->id }}" data-qty="1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.add_to_cart') }}">
										<span>{{ trans('shop.button.add_to_cart') }}  <i class="fa .fa-caret-right"></i></span>
									</button>
								</div>
							</form>
							@endif
							@include('shop.common.share_social')
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-lg-12 margin-top-15 margin-bottom-10">
						<!-- Nav tabs -->
						<div class="product-tab e-tabs">
							<ul class="tabs tabs-title clearfix">
								<li class="tab-link" data-tab="tab-1">
									<h3><span>{{ trans('shop.description_txt') }}</span></h3>
								</li>
								<li class="tab-link" data-tab="tab-2">
									<h3><span>{{ trans('shop.info_txt') }}</span></h3>
								</li>
								<li class="tab-link" data-tab="tab-3">
									<h3><span>{{ trans('shop.comment_txt') }}</span></h3>
								</li>
							</ul>
							<div class="tab-1 tab-content">
								<div class="rte">
									<p>{!! $data->getSummary() !!}</p>
								</div>
							</div>
							<div class="tab-2 tab-content">
								{!! $data->getDescription() !!}
							</div>
							<div class="tab-3 tab-content">
								<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=135671569954053&autoLogAppEvents=1"></script>
    							<div class="fb-comments" data-href="{{ $data->getLink() }}" data-width="800" data-numposts="5"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<aside class="dqdt-sidebar sidebar right left-content col-lg-3 aside-vetical-menu">
			{!! Utils::createSidebarShop('category_list') !!}
            {!! Utils::createSidebarShop('popular_products') !!}
		</aside>
	</div>
		
</div>
@php
	$products = $data->getRelatedProducts();
@endphp
@if($products->count())
<section class="section featured-product wow fadeInUp mb-4">
	<div class="container">
		<div class="section-title a-center">
			<h2><a href="/san-pham-noi-bat">Sản phẩm liên quan</a></h2>			
			<p>Có phải bạn đang tìm những sản phẩm dưới đây</p>
		</div>
		<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs" data-lgg-items="4" data-lg-items='4' data-md-items='4' data-sm-items='3' data-xs-items="2" data-xss-items="2" data-nav="true">
    		@foreach($products as $k=>$product)
    		<div class="item item-carousel">
    			<div class="product-box">															
    				<div class="product-thumbnail flexbox-grid">	
    					<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    						<img src="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}">
    					</a>
    					{!! $product->getDisCount() !!} 	
    					<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
    						<form action="?" method="post" class="variants form-nut-grid margin-bottom-0" enctype="multipart/form-data">
    							<div>
    								@include('shop.common.button_add_to_cart')
    								<a href="{{ $product->getLink() }}" class="btn-gray btn_view btn right-to">
    									<i class="fa fa-eye"></i>
    								</a>
    							</div>
    						</form>
    					</div>
    				</div>
    				<div class="product-info a-center">
    					<h3 class="product-name"><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
    					@include('shop.common.price_box')
    				</div>
    			</div>
    		</div>
    		@endforeach
		</div>
	</div>
</section>
@endif
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.detail-item').click(function(e) {
			if($(this).hasClass('label-success')) {
				$(this).removeClass('label-success');
				$(this).find('i').remove();
				$(this).addClass('label-default');
				
			} else {
				var groupId = $(this).attr('data-group-id');
				$('.group-' + groupId).removeClass('label-success').addClass('label-default');
				$('.group-' + groupId).find('i').remove();
				$(this).prepend('<i class="fa fa-check"></i>');
				$(this).removeClass('label-default').addClass('label-success');
			}
			
			var id = $(this).data('id');
			var pid = $(this).attr('data-product-id');
			var product_price = Number($('#product_price').val());
			var new_price = 0;
			
			$('.detail-item').each(function(index, item) {
				var item = $(item);
				if(item.hasClass('label-success')) {
					var price = item.attr('data-price');
					product_price += Number(price);
				}
			});

			new_price = Number(product_price);
			$('#product_price_format').html(formatCurrency(new_price, '.', '.'));

		});

		$(document).on('click', '.btn-buy', function(e) {
			 var qty = $('.qty').val();
			 var items = [];
			 var data = {
				type : 'post',
	       		async : true,
	       		pid: $(this).attr('data-id'),
	       		qty: qty,
	       		items: [],
	       		container: ['#cart_1', '.cartCount2', '#top_cart'],
	       		dialog: '#popupCartModal'
			 }

			 $('.detail-item').each(function(index, item) {
				var item = $(item);
				if(item.hasClass('label-success')) {
					var item = {
						id: item.attr('data-id'),
						name: item.attr('data-name'),
						price: item.attr('data-price'),
						group_id: item.attr('data-group-id'),
						group_name: item.attr('data-group-name')
					}

					items.push(item);
				}
			 });

			 data.items = items;
			 callAjax('{{ route('addToCart') }}', data, $(this));
		 });
	});

</script>
@endsection