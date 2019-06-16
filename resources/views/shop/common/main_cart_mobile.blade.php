<div class="cart_page_mobile content-product-list">
	@foreach($cart->getCart() as $cartItem)
	<div class="item-product item ">
		<div class="item-product-cart-mobile">
			<a href="{{ $cartItem->getLink() }}" class="product-images1" title="{{ $cartItem->getName() }}">
				<img alt="" src="{{ $cartItem->getImage('small') }}">
			</a>
		</div>
		<div class="title-product-cart-mobile">
			<h3>
				<a href="{{ $cartItem->getLink() }}" title="Dưa leo Đà Lạt">{{ $cartItem->getName() }}</a>
			</h3>
			<p>
				{{ trans('shop.cart.price') }}: <span>{{ $cartItem->getPriceFormat() }}</span>
			</p>
		</div>
		<div class="select-item-qty-mobile">
			<div class="txt_center">
				<button class="reduced items-count btn-minus btn-minus-item" data-id="{{ $cartItem->getId() }}" type="button">–</button>
				<input type="text" maxlength="12" min="0" class="input-text number-sidebar input_pop"  data-id="{{ $cartItem->getId() }}" value="{{ $cartItem->getQty() }}" size="4">
				<button class="increase items-count btn-plus btn-plus-item" data-id="{{ $cartItem->getId() }}" type="button">+</button>
			</div>
			<a class="button remove-item remove-item-cart" href="javascript:;" data-id="{{ $cartItem->getId() }}">{{ trans('shop.button.remove') }}</a>
		</div>
	</div>
	@php
		$detailList = $cartItem->getDetailList();
	@endphp
	@foreach($detailList as $detail)
	<div class="item-product item ">
		<div class="item-product-cart-mobile">
			<a style="visibility: hidden;">
				<img alt="" src="">
			</a>
		</div>
		<div class="title-product-cart-mobile">
			<h3>
				<a href="{{ $cartItem->getLink() }}" title="Dưa leo Đà Lạt">{{ $detail->getName() }}</a>
			</h3>
			<p>
				{{ trans('shop.cart.price') }}: <span>{{ $detail->getPriceFormat() }}</span>
			</p>
		</div>
		<div class="select-item-qty-mobile">
			<div class="txt_center">
				<button class="reduced items-count btn-minus btn-minus-detail" data-product-id="{{ $cartItem->getId() }}" data-qty="{{ $cartItem->getQty() }}" data-id="{{ $detail->getId() }}" type="button">–</button>
				<input type="text" maxlength="12" min="0" class="input-text number-sidebar input_pop qty-detail"  data-id="{{ $detail->getId() }}" value="{{ $detail->getQty() }}" size="4">
				<button class="increase items-count btn-plus btn-plus-detail" data-product-id="{{ $cartItem->getId() }}" data-qty="{{ $cartItem->getQty() }}" data-id="{{ $detail->getId() }}" type="button">+</button>
			</div>
			<a class="button remove-item remove-detail-item" href="javascript:void(0)" data-product-id="{{ $cartItem->getId() }}" data-id="{{ $detail->getId() }}">{{ trans('shop.button.remove') }}</a>
		</div>
	</div>
	@endforeach
	@endforeach
</div>
<div class="header-cart-price" style="">
	<div class="title-cart ">
		<h3 class="text-xs-left">{{ trans('shop.cart.total') }}</h3>
		<a class="text-xs-right totals_price_mobile">{{ $cart->getSubTotalFormat() }}</a>
	</div>
	<div class="checkout">
		<button class="btn-proceed-checkout-mobile"
			title="Tiến hành thanh toán" type="button"
			onclick="window.location.href='{{ route('checkout') }}'">
			<span>{{ trans('shop.button.order') }}</span>
		</button>
		<button class="btn-proceed-checkout-mobile margin-top-10"
			title="Tiếp tục mua hàng" type="button"
			onclick="window.location.href='{{ route('home') }}'">
			<span>{{ trans('shop.button.back_to_shopping') }}</span>
		</button>
	</div>
</div>