@extends('layouts.shop')
@section('content')
@include('shop.common.breadcrumb')
<section class="main-cart-page main-container col1-layout">
	<div class="main container hidden-xs">
		<div id="main_cart" class="col-main cart_desktop_page cart-page">{!! $cart->getMainCart() !!}</div>

	</div>
	@if($cart->getCount())
	<div class="cart-mobile hidden-md hidden-lg hidden-sm">
		<form action="/cart" method="post" novalidate="" class="margin-bottom-0">
			<div class="header-cart" style="background: #fff;">

				<div class="title-cart">
					<h3>{{ trans('shop.cart_txt') }}</h3>
				</div>

			</div>
			<div id="main_cart_mobile" class="header-cart-content" style="background: #fff;">
				{!! $cart->getMainCartMobile() !!}
			</div>

		</form>

	</div>
	@endif
</section>
@endsection
