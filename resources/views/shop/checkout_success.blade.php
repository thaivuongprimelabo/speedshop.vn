

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Shop name - Thanh toán đơn hàng" />
    
    <title>{{ $config['web_name'] }} - Cảm ơn</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="{{ url('shop/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ url('shop/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('shop/css/thankyou.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="body--custom-background-color ">
    
    <div class="container">
        <div class="header">
            <div class="wrap">
                <div class="shop logo logo--left ">
                    <h1 class="shop__name">
                        <a href="{{ route('home') }}">
                            {{ $config['web_name'] }}
                        </a>
                    </h1>
				</div>
            </div>
        </div>
        <div class="main">
            <div class="wrap clearfix">
                <div class="row thankyou-infos">
                    <div class="col-md-7 thankyou-message">
                        <div class="thankyou-message-icon unprint">
                            <div class="icon icon--order-success svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                                    <g fill="none" stroke="#8EC343" stroke-width="2">
                                        <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                        <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="thankyou-message-text">
                            <h3>{{ trans('shop.checkout_success.header') }}</h3>
                            <p>
                                {{ trans('shop.checkout_success.email_sent',['email' => '']) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 order-info">
                        <div class="order-summary order-summary--custom-background-color ">
                            <div class="order-summary-header summary-header--thin summary-header--border">
                                <h2>
                                    <label class="control-label">{{ trans('shop.checkout.order_title',['count' => 3]) }}</label>
                                </h2>
                            </div>
                            <div class="order-items mobile--is-collapsed">
                                <div class="summary-body summary-section summary-product">
                                    <div class="summary-product-list">
                                        <ul class="product-list">
                                        	@foreach($cart->getCart() as $cartItem)
                                            <li class="product product-has-image clearfix">
                                                <div class="product-thumbnail pull-left">
                                                    <div class="product-thumbnail__wrapper">
                                                        <img src="{{ $cartItem->getImage() }}" alt="{{ $cartItem->getName() }}" class="product-thumbnail__image" />
                                                    </div>
                                                    <span class="product-thumbnail__quantity unprint" aria-hidden="true">{{ $cartItem->getQty() }}</span>
                                                </div>
                                                <div class="product-info pull-left">
                                                    <span class="product-info-name">
                                                        <strong>{{ $cartItem->getName() }}</strong>
                                                        <label class="print">x{{ $cartItem->getQty() }}</label>
                                                    </span>
                                                </div>
                                                <strong class="product-price pull-right">
                                                    {{ $cartItem->getCostFormat() }}
                                                </strong>
                                            </li>
                                            @php
                            					$detailList = $cartItem->getDetailList();
                            			    @endphp
                            			    @foreach($detailList as $detail)
                                			   <li class="product product-has-image clearfix">
                                                    <div class="product-thumbnail pull-left" style="background: none">
                                                    </div>
                                                    <div class="product-info pull-left">
                                                        <span class="product-info-name">
                                                            <strong>{{ $detail->getGroupName() }}:</strong> {{ $detail->getName() }}
                                                            <label class="print">x{{ $detail->getQty() }}</label>
                                                        </span>
                                                    </div>
                                                    <strong class="product-price pull-right">
                                                        {{ $detail->getCostFormat() }}
                                                    </strong>
                                                </li>
                            			    @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="summary-section  border-top-none--mobile ">
                                <div class="total-line total-line-subtotal clearfix">
                                    <span class="total-line-name pull-left">
                                        {{ trans('shop.checkout.subtotal') }}
                                    </span>
                                    <span class="total-line-subprice pull-right">
                                        {{ $cart->getSubTotalFormat() }}
                                    </span>
                                </div>
                                
                                <div class="total-line total-line-subtotal clearfix">
                                    <span class="total-line-name pull-left">
                                        {{ trans('shop.checkout.ship') }}
                                    </span>
                                    <span class="total-line-subprice pull-right">
                                        {{ $cart->getShipFeeFormat() }}
                                    </span>
                                </div>
                                
                            </div>
                            <div class="summary-section">
                                <div class="total-line total-line-total clearfix">
                                    <span class="total-line-name total-line-name--bold pull-left">
                                        {{ trans('shop.checkout.total') }}
                                    </span>
                                    <span class="total-line-price pull-right">
                                        {{ $cart->getTotalFormat() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 customer-info">
                        
                        <div class="shipping-info">
                            <div class="row">
                                
                                <div class="col-md-6 col-sm-6">
                                    
                                    <div class="order-summary order-summary--white no-border">
                                        <div class="order-summary-header">
                                            <h2>
                                                <label class="control-label">{{ trans('shop.checkout.checkout_info') }}</label>
                                            </h2>
                                        </div>
                                        @php
                                        	$checkout_info = $cart->getCheckoutInfo();
                                        @endphp
                                        <div class="summary-section no-border no-padding-top">
                                            <p class="address-name">
                                                 {{ $checkout_info['customer_name'] }}
                                            </p>
                                            <p class="address-address">
                                                {{ $checkout_info['customer_address'] }}
                                            </p>
                                            <p class="address-district">
                                                {{ $checkout_info['customer_district'] }}
                                            </p>
                                            <p class="address-province">
                                                {{ $checkout_info['customer_province'] }}
                                            </p>
                                            <p class="address-phone">
                                                {{ $checkout_info['customer_phone'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="order-summary order-summary--white no-border">
                                        <div class="order-summary-header">
                                            <h2>
                                                <label class="control-label">{{ trans('shop.checkout.payment') }}</label>
                                            </h2>
                                        </div>
                                        <div class="summary-section no-border no-padding-top">
                                        	@php
                                        		$payment_methods = trans('auth.payment_methods');
                                        	@endphp
                                            <span>{{ $payment_methods[$checkout_info['payment_method']] }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="order-success unprint">
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                {{ trans('shop.button.back_to_shopping') }}
                            </a>
                            <div class="print-link__block print-link clearfix">
                            	<a onclick="window.print()" class="nounderline" href="javascript:void(0)">
                                  <i class="fa fa-print icon-print" aria-hidden="true"></i>In 
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</body>
</html>