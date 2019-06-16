@if($all_products->count())
<div class="e-tabs not-dqtab ajax-tab-{{ $type }}"  data-section="ajax-tab-{{ $type }}">
	<div class="row row-noGutter">
		<div class="col-sm-12">
			<div class="content">
				<div class="section-title">
					<h2 class="title-head">
						<a href="{{ $route }}" title="{{ $title }}">{{ $title }}</a>
					</h2>
				</div>
				<div>
					@php
						$tabIndex = 1;
					@endphp
					<ul class="tabs tabs-title tab-mobile clearfix hidden-sm hidden-md hidden-lg">
						<li class="prev"><i class="fa fa-angle-left"></i></li>
						<li class="tab-link tab-title hidden-sm hidden-md hidden-lg current tab-titlexs" data-tab="tab-{{ $tabIndex }}">
							<span>{{ trans('shop.all_txt') }}</span>
						</li>
						<li class="next"><i class="fa fa-angle-right"></i></li>
					</ul>
					<ul class="tabs tabs-title ajax clearfix hidden-xs owl-carousel owl-theme tab-product" data-lg-items="6" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xss-items="2" data-autowidth="true">
						<li class="tab-link has-content" data-tab="tab-{{ $tabIndex }}" data-url="">
							<span>{{ trans('shop.all_txt') }}</span>
						</li>
						@if($categories->count())
						@foreach($categories as $key=>$category)
						<li class="tab-link has-content" data-tab="tab-{{ ++$tabIndex }}" data-url="">
							<span>{{ $category->name }}</span>
						</li>
						@endforeach
						@endif
						
					</ul>
					@php
						$tabIndex = 1;
					@endphp
					<div class="tab-{{ $tabIndex }} tab-content">
						<div class="products products-view-grid">
							@foreach($all_products as $k=>$product)
								<div class="col-xs-6 col-xss-6 col-sm-4 col-md-3 col-lg-3">
									<div class="product-box">															
										<div class="product-thumbnail flexbox-grid">	
											<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
												<img src="{{ $product->getFirstImage('medium') }}"  data-lazyload="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}">
											</a>
											{!! $product->getDisCount() !!} 	
											<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
												<form action="?" method="post" class="variants form-nut-grid margin-bottom-0" enctype="multipart/form-data">
													<div>
														<input type="hidden" name="variantId" value="17898181" />
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
					@if($categories->count())
					@foreach($categories as $key=>$category)
					<div class="tab-{{ ++$tabIndex }} tab-content">
						<div class="products products-view-grid">
							@php
								$products = $category->getProductInCategory($type, true, $limit_product);
							@endphp
							<div class="products products-view-grid">
								@foreach($products as $k=>$product)
								<div class="col-xs-6 col-xss-6 col-sm-4 col-md-3 col-lg-3">
									<div class="product-box">															
										<div class="product-thumbnail flexbox-grid">	
											<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
												<img src="{{ $product->getFirstImage('medium') }}"  data-lazyload="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}">
											</a>
											{!! $product->getDisCount() !!} 	
											<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
												<form action="?" method="post" class="variants form-nut-grid margin-bottom-0" enctype="multipart/form-data">
													<div>
														<input type="hidden" name="variantId" value="17898181" />
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
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endif