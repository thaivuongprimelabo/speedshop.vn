@php
	$hotline = explode('|', $config['web_hotline']);
	$web_address = explode('|', $config['web_address']);
@endphp
<div class="topbar-mobile hidden-lg hidden-md text-center text-md-left">
	<div class="container">
		<i class="fa fa-mobile" style=" font-size: 20px; display: inline-block; position: relative; transform: translateY(2px); "></i> {{ trans('shop.hotline_txt') }}: 
		<span>
			 {{ $hotline[0] }}
		</span>
	</div>
	<div class="container">
		<i class="fa fa-map-marker" style=" font-size: 20px; display: inline-block; position: relative; transform: translateY(2px); "></i> {{ trans('shop.address_txt') }}: 
		<span>
			 {{ $web_address[0] }}
		</span>
	</div>
</div>
<div class="topbar hidden-sm hidden-xs">
	<div class="container">
		<div>
			<div class="row">
				<div class="col-sm-12 col-md-12 a-left">
					<ul class="list-inline f-left">
						<li>
							<i class="fa fa-mobile" style=" font-size: 20px; display: inline-block; position: relative; transform: translateY(2px); "></i> {{ trans('shop.hotline_txt') }}: 
							<span>
								@if(count($hotline))
								<a href="tel:{{ $hotline[0] }}">{{ $hotline[0] }}</a>
								@endif
							</span>
						</li>
						<li>
							<i class="fa fa-map-marker"></i> {{ trans('shop.address_txt') }}: 
							<span>
								<a href="javascript:void(0)">{{ $web_address[0] }}</a>
							</span>

						</li>
					</ul>
				</div>
<!-- 				<div class="col-sm-6 col-md-3"> -->

					<!-- <ul class="list-inline f-right">
						@if(Auth::check())
						<li>
							<a href="{{ route('account_profile') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a> | <a href="{{ route('account_logout') }}">{{ trans('shop.button.logout') }}</a>
						</li>
						@else
						<li>
							<a data-toggle="modal" href="{{ route('account_login') }}"><i class="fa fa-user"></i> {{ trans('shop.button.login') }}</a>
						</li>
						<li><span>hoặc</span></li>
						<li><a data-toggle="modal" href="{{ route('account_register') }}">{{ trans('shop.button.register') }}</a>
						</li>
						@endif
					</ul> -->

<!-- 				</div> -->

			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="header-content clearfix a-center">
		<div class="row">
			<div class="col-xs-12 col-md-3 text-lg-center">
				<div class="logo inline-block">
					
					<a href="/" class="logo-wrapper ">
						@if(!Utils::blank($config['web_logo']))					
						<img src="{{ Utils::getImageLink($config['web_logo']) }}" alt="{{ $config['web_logo'] }}">
						@endif					
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-md-8 col-lg-7 hidden-xs">
				<div class="policy d-flex justify-content-around">
					@if(!Utils::blank($config['freeship']))
					<div class="item-policy d-flex">
						<a href="#" class="policy-icon">
							<img src="{{ url('shop/frontend/thumb/medium/100/308/325/themes/665783/assets/policy14d7c.png') }}" >
						</a>
						<div class="info a-left policy-content">
							<a href="#">{{ trans('shop.free_ship_txt') }}</a>
							<p>{{ $config['freeship'] }}</p>
						</div>
					</div>
					@endif
					@if(count($hotline))
					<div class="item-policy d-flex">
						<a href="#" class="policy-icon">
							<img src="{{ url('shop/frontend/thumb/medium/100/308/325/themes/665783/assets/policy24d7c.png') }}" style="height:28px" >
						</a>
						<div class="info a-left policy-content">
							<a href="#">{{ trans('shop.support_txt') }}</a>
							@foreach($hotline as $tel)
							<p>{{ $tel }}</p>
							@endforeach
						</div>
					</div>
					@endif
					@if(!Utils::blank($config['web_working_time']))	
					<div class="item-policy d-flex">
						<a href="#" class="policy-icon">
							<img src="{{ url('shop/frontend/thumb/medium/100/308/325/themes/665783/assets/policy34d7c.png') }}" style="height:28px" >
						</a>
						<div class="info a-left policy-content">
							<a href="#">{{ trans('shop.working_txt') }}</a>
							<p>{!! $config['web_working_time'] !!}</p>
						</div>
					</div>
					@endif	
				</div>
			</div>
			<div class="col-xs-12 col-md-1 col-lg-2 hidden-sm hidden-xs">
				<div class="top-cart-contain f-right ">
					<div class="mini-cart text-xs-center">
						<div class="heading-cart">
							<a href="{{ route('cart') }}">
								<div class="icon f-left relative">
									<i class="fa fa-shopping-bag"></i>
									<span class="cartCount count_item_pr hidden-lg" id="cart-total">{{ $cart->getCount() }}</span>
								</div>
								<div class="right-content hidden-md">
									<span class="label">{{ trans('shop.cart_txt') }}</span>
									(<span class="cartCount2">{{ $cart->getCount() }}</span>)
								</div>
							</a>
						</div>
						<div id="top_cart">
						{!! $cart->getTopCart() !!}
						</div>				
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="menu-bar hidden-md hidden-lg">
		<img src="{{ url('shop/frontend/100/308/325/themes/665783/assets/menu-bar4d7c.png') }}" alt="menu bar" />
	</div>
	<div class="icon-cart-mobile hidden-md hidden-lg f-left absolute" onclick="window.location.href='{{ route('cart') }}'">
		<div class="icon relative">
			<i class="fa fa-shopping-bag"></i>
			<span class="cartCount count_item_pr">{{ $cart->getCount() }}</span>
		</div>
	</div>
</div>
<!-- /HEADER -->