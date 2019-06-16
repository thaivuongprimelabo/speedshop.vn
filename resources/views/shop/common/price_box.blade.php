<div class="price-box clearfix">
	@if($product->avail_flg == ProductStatus::OUT_OF_STOCK)
	<div class="special-price">
		<span class="price product-price">{{ $product->getStatusName() }}</span>
	</div>
	@elseif($product->price > 0 && $product->discount > 0)
	<div class="special-price">
		<span class="price product-price">{{ $product->getPriceDiscount() }}</span>
	</div>
	<div class="old-price">
		<span class="price product-price-old">{{ $product->getPrice() }}</span>
	</div>
	@else
	<div class="special-price">
		<span class="price product-price">{{ $product->getPrice() }}</span>
	</div>
	@endif											
</div>