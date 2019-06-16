
<div class="top-cart-content">
	<ul id="cart-sidebar" class="mini-products-list count_li">
		<li class="list-item-cart">
			@if($cart != null)
			<ul class="list-item-cart">
				@foreach($cart->getCart() as $cartItem)
    			<li class="item productid-17898173"><div class="border_list">
    					<a class="product-image" href="{{ $cartItem->getLink() }}" title="{{ $cartItem->getName() }}"><img alt="{{ $cartItem->getName() }}" src="{{ $cartItem->getImage() }}" width="100"></a>
    					<div class="detail-item">
    						<div class="product-details">
    							<p class="product-name">
    								<a href="{{ $cartItem->getLink() }}" title="{{ $cartItem->getName() }}">{{ $cartItem->getName() }}</a>
    							</p>
    						</div>
    						<div class="product-details-bottom">
    							<span class="price">{{ $cartItem->getPriceFormat() }}</span>
    							@php
    								$detailList = $cartItem->getDetailList();
    							@endphp
    							@if(count($detailList))
    							<div class="detail-item-list">
    								<ul>
    									@foreach($detailList as $detail)
    									<li style="position: relative;">
    										<small style="display: block;height:15px;">{{ $detail->getGroupName() }}:</small>
    										<span class="label label-success" style="color:#ffffff; font-weight: bold; margin-left: 10px;">{{ $detail->getName() }} - {{ $detail->getPriceFormat() }}</span> x {{ $detail->getQty() }}
    										<a href="javascript:void(0)" class="remove-detail-item" title="Xóa {{ $detail->getGroupName() }}" data-product-id="{{ $cartItem->getId() }}" data-id="{{ $detail->getId() }}"><i class="fa fa-remove" style="top:16px;"></i></a>
    									</li>
    									@endforeach
    								</ul>
    							</div>
    							@endif
    							<a href="javascript:void(0)" title="Xóa" class="remove-item-cart fa fa-remove" data-id="{{ $cartItem->getId() }}">&nbsp;</a>
    							<div class="quantity-select qty_drop_cart">
    								<button class="btn_reduced reduced items-count btn-minus btn-minus-topcart" type="button"  data-id="{{ $cartItem->getId() }}">–</button>
    								<input type="text" maxlength="12" min="0" class="input-text number-sidebar" value="{{ $cartItem->getQty() }}"  data-id="{{ $cartItem->getId() }}">
    								<button class="btn_increase increase items-count btn-plus  btn-plus-topcart" type="button"  data-id="{{ $cartItem->getId() }}">+</button>
    							</div>
    						</div>
    					</div>
    				</div>
    			</li>
    			@endforeach
			</ul>
			@endif
		</li>
		<li class="pd">
			<div class="top-subtotal">
				{{ trans('shop.cart.subtotal') }}: <span class="price top_cart_total">{{ $cart->getSubTotalFormat() }}</span>
			</div>
		</li>
		<li class="pd right_ct">
			<a href="{{ route('cart') }}" class="btn btn-primary"><span>{{ trans('shop.cart.txt') }}</span></a><a
				href="{{ route('checkout') }}" class="btn btn-primary"><span>{{ trans('shop.cart.checkout_txt') }}</span></a>
		</li>
	</ul>
</div>
