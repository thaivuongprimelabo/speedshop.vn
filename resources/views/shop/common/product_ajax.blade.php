@if($data->count())
@foreach($data as $product)
@if($view_type == 'grid')
<div class="col-xs-6 col-xss-6 col-sm-4 col-md-4 col-lg-4">
	<div class="product-box">															
    	<div class="product-thumbnail flexbox-grid">	
    		<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    			<img src="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}">
    		</a>	
    		{!! $product->getDisCount() !!}
    		<div class="product-action hidden-md hidden-sm hidden-xs clearfix">
				<div>
					<form action="?" method="post" class="variants form-nut-grid margin-bottom-0" enctype="multipart/form-data">
					@include('shop.common.button_add_to_cart')
					<a href="{{ $product->getLink() }}" data-handle="cherry-do-canada-loai-to" data-toggle="tooltip" title="Xem nhanh" class="btn-gray btn_view btn right-to quick-view">
						<i class="fa fa-eye"></i></a>
					</form>
				</div>
    		</div>
    	</div>
    	<div class="product-info a-center">
    		<h3 class="product-name"><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
    		@include('shop.common.price_box')
    	</div>
    </div>
</div>
@else
<div class="col-xs-12">
	<div class="product-box clearfix">															
    	<div class="product-thumbnail f-left">	
    		<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    			<img src="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}" style="width:{{ $product->getImageWidth() }}px; height:{{ $product->getImageHeight() }}px">
    		</a>	
    	</div>
    	<div class="product-info f-left">
    		<h3 class="product-name"><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
    		@include('shop.common.price_box')
    		<div class="product-summary margin-top-10">
				{!! $product->getSummary() !!}
			</div>
			<form action="?" method="post" class="variants pro-action-btn margin-top-15" enctype="multipart/form-data">
    			@include('shop.common.button_add_to_cart')
    			<a href="{{ $product->getLink() }}" class="btn-gray btn_view btn right-to quick-view"><i class="fa fa-search-plus"></i></a>
    		</form>
    	</div>
    </div>
</div>
@endif
@endforeach
@endif