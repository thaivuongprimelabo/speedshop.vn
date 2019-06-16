<div class="row row-noGutter">
	<div class="modal-left">
		<h3 class="title">
			<i class="fa fa-check-square-o"></i> {{ trans('shop.cart.add_to_cart_txt') }}
		</h3>
		<div class="modal-body">
			<div class="media">
            	<div class="media-left">
            		<div class="thumb-1x1">
            			<img src="{{ $cart->getCartItem()->getImage() }}" alt="{{ $cart->getCartItem()->getName() }}">
            		</div>
            	</div>
            	<div class="media-body">
            		<div class="product-title">
            			<a href="{{ $cart->getCartItem()->getLink() }}" title="{{ $cart->getCartItem()->getName() }}">{{ $cart->getCartItem()->getName() }}</a>
            		</div>
            		<div class="qty">
            			{{ trans('shop.cart.qty_txt') }}: <span>{{ $cart->getCartItem()->getQty() }}</span>
            		</div>
            		<div class="product-new-price">
            			{{ trans('shop.cart.price') }}: <span>{{ $cart->getCartItem()->getPriceFormat() }}</span>
            		</div>
            	</div>
            </div>
		</div>
	</div>
	<div class="modal-right">
		<h3 class="title">
			<a href="{{ route('cart') }}"><i class="fa fa-caret-right"></i> {!! trans('shop.cart.cart_qty_txt',['count' => $cart->getCount()]) !!} </a>
		</h3>
		<div class="total_price hidden">
			<span>{{ trans('shop.cart.total') }}: </span> <span class="">{{ $cart->getTotal() }}</span>
		</div>
		<a href="{{ route('checkout') }}" class="btn btn-block btn-red btn-full">{{ trans('shop.cart.checkout') }}</a>
	</div>
</div>
