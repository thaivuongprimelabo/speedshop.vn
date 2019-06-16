@if($product->price > 0 && $product->avail_flg == ProductStatus::AVAILABLE)
<button type="button" class="btn-buy btn-cart btn btn-primary left-to add_to_cart" title="{{ trans('shop.button.add_to_cart') }}" data-qty="1" data-id="{{ $product->id }}">
	<i class="fa fa-shopping-bag"></i>
</button>
@endif