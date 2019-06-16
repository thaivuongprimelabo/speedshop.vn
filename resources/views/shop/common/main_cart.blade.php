<div class="cart page_cart hidden-xs">
	<form action="/cart" method="post" novalidate="" class="margin-bottom-0">
		<div class="bg-scroll">
			<div class="cart-thead">
				<div style="width: 19%;">{{ trans('shop.cart.table_header.image') }}</div>
				<div style="width: 28%; padding-left: 5px;">
					<span class="nobr">{{ trans('shop.cart.table_header.product') }}</span>
				</div>
				<div style="width: 17%" class="a-center">
					<span class="nobr">{{ trans('shop.cart.table_header.price') }}</span>
				</div>
				<div style="width: 18%" class="a-center">{{ trans('shop.cart.table_header.qty') }}</div>
				<div style="width: 13%;" class="a-center">{{ trans('shop.cart.table_header.cost') }}</div>
				<div style="width: 5%" class="a-center"></div>
			</div>
			<div class="cart-tbody">
				@if($cart->getCount())
				@foreach($cart->getCart() as $cartItem)
				<div class="item-cart main-item-cart">
					<div style="width: 19%" class="image">
						<a class="product-image" title="{{ $cartItem->getName() }}" href="{{ $cartItem->getLink() }}">
							<img alt="{{ $cartItem->getName() }}" src="{{ $cartItem->getImage('small') }}" />
						</a>
					</div>
					<div style="width: 28%; align-items: flex-start;"
						class="a-center">
						<h2 class="product-name">
							<a href="{{ $cartItem->getLink() }}">{{ $cartItem->getName() }}</a>
						</h2>
						<div
							style="height: 30px; position: relative; width: 78px; padding: 10px 0; border: none;"></div>
					</div>
					<div style="width: 17%" class="a-center">
						<span class="item-price"> <span class="price">{{ $cartItem->getPriceFormat() }}</span></span>
					</div>
					<div style="width: 18%" class="a-center">
						<div class="input_qty_pr relative ">
							<button class="reduced_pop items-count btn-minus btn-minus-item" data-id="{{ $cartItem->getId() }}" type="button">–</button>
							<input type="text" maxlength="12" min="0" class="input-text number-sidebar input_pop" data-id="{{ $cartItem->getId() }}" size="4" value="{{ $cartItem->getQty() }}">
							<button class="increase_pop items-count btn-plus btn-plus-item" data-id="{{ $cartItem->getId() }}" type="button">+</button>
						</div>
					</div>
					<div style="width: 13%;" class="a-center">
						<span class="cart-price"> <span class="price">{{ $cartItem->getCostFormat() }}</span>
						</span>
					</div>
					<div style="width: 5%" class="a-center">
						<a class="button remove-item remove-item-cart" title="Xóa" href="javascript:void(0)" data-id="{{ $cartItem->getId() }}"><span><i class="fa fa-remove"></i></span></a>
					</div>
				</div>
    				@php
    					$detailList = $cartItem->getDetailList();
    				@endphp
    				@foreach($detailList as $detail)
    				<div class="item-cart main-item-cart">
    					<div style="width: 19%" class="image">
    					</div>
    					<div style="width: 28%; align-items: flex-start;"
    						class="a-center">
    						<h2 class="product-name">
    							<a href="#"><strong>{{ $detail->getGroupName() }}</strong>: {{ $detail->getName() }}</a>
    						</h2>
    						<div
    							style="height: 30px; position: relative; width: 78px; padding: 10px 0; border: none;"></div>
    					</div>
    					<div style="width: 17%" class="a-center">
    						<span class="item-price"> <span class="price">{{ $detail->getPriceFormat() }}</span></span>
    					</div>
    					<div style="width: 18%" class="a-center">
    						<div class="input_qty_pr relative ">
    							<div class="input_qty_pr relative ">
        							<button class="reduced_pop items-count btn-minus-detail btn-minus" data-product-id="{{ $cartItem->getId() }}" data-qty="{{ $cartItem->getQty() }}" data-id="{{ $detail->getId() }}" type="button">–</button>
        							<input type="text" maxlength="12" min="0" class="input-text number-sidebar input_pop qty-detail" data-id="{{ $detail->getId() }}" size="4" value="{{ $detail->getQty() }}">
        							<button class="increase_pop items-count btn-plus-detail btn-plus" data-product-id="{{ $cartItem->getId() }}" data-qty="{{ $cartItem->getQty() }}" data-id="{{ $detail->getId() }}" type="button">+</button>
        						</div>
    						</div>
    					</div>
    					<div style="width: 13%;" class="a-center">
    						<span class="cart-price"> <span class="price">{{ $detail->getCostFormat() }}</span>
    						</span>
    					</div>
    					<div style="width: 5%" class="a-center">
    						<a class="button remove-item remove-detail-item" title="Xóa" href="javascript:void(0)" data-product-id="{{ $cartItem->getId() }}" data-id="{{ $detail->getId() }}"><span><i class="fa fa-remove"></i></span></a>
    					</div>
    				</div>
    				@endforeach
				@endforeach
				@endif
			</div>
		</div>
	</form>
	<div class="cart-collaterals cart_submit row">
		<div class="totals col-sm-12 col-md-12 col-xs-12">
			<div class="totals">
				<div class="inner">
					<table class="table shopping-cart-table-total margin-bottom-0"
						id="shopping-cart-totals-table">
						<colgroup>
							<col>
							<col>
						</colgroup>
						<tfoot>
							<tr></tr>
						</tfoot>
					</table>
					<ul class="checkout">
						<li class="clearfix"><div class="inline-block">
								<span>{{ trans('shop.cart.subtotal') }}:</span> <strong><span class="totals_price price top_cart_total">{{ $cart->getSubTotalFormat() }}</span></strong>
							</div>
							@if($cart->getCount())
							<button id="checkout_btn" class="btn btn-primary button btn-proceed-checkout f-right" title="{{ trans('shop.button.order') }}" type="button"
								onclick="window.location.href='{{ route('checkout') }}'">
								<span style="text-transform: initial;">{{ trans('shop.button.order') }}</span>
							</button>
							@endif
							<button class="btn btn-gray margin-right-15 f-right" title="{{ trans('shop.button.back_to_shopping') }}" type="button"
								onclick="window.location.href='{{ route('home') }}'">
								<span style="text-transform: initial;">{{ trans('shop.button.back_to_shopping') }}</span>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>