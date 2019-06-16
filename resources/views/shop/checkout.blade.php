<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="anyflexbox boxshadow display-table">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Checkout</title>
      <link rel="stylesheet" href="{{ url('shop/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ url('shop/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ url('shop/css/checkout.css') }}" rel="stylesheet" type="text/css" />
   </head>
   <body class="body--custom-background-color ">
   	  <div class="banner" data-header="">
         <div class="wrap">
           	<div class="shop logo logo--left ">
                    <h1 class="shop__name">
                        <a href="/">
                            {{ $config['web_name'] }}
                        </a>
                    </h1>
           		</div>
            </div>
        </div>
    	<button class="order-summary-toggle">
            <div class="wrap">
                <h2>
                    <label class="control-label">Đơn hàng</label>
                    <label class="control-label hidden-small-device">
                        ({{ $cart->getCount() }} sản phẩm)
                    </label>
                    <label class="control-label visible-small-device inline">
                        (1)
                    </label>
                </h2>
                <a id="show-order-summary" class="underline-none expandable pull-right" href="javascript:void(0)">
                    Xem chi tiết
                </a>
            </div>
    	</button>
           	  
      <form id="submit_form" method="post" action="" class="content stateful-form formCheckout">
         <div class="wrap">
            <div class="sidebar ">
               <div class="sidebar_header">
                  <h2>
                     <label class="control-label">{{ trans('shop.checkout.order_title', ['count' => $cart->getCount()]) }}</label>
                  </h2>
                  <hr class="full_width">
               </div>
               <div class="sidebar__content">
                  <div class="order-summary order-summary--product-list order-summary--is-collapsed">
                     <div class="summary-body summary-section summary-product">
                        <div class="summary-product-list">
                           @foreach($cart->getCart() as $cartItem)
                           <table class="product-table">
                              <tbody>
                                 <tr class="product product-has-image clearfix">
                                    <td>
                                       <div class="product-thumbnail">
                                          <div class="product-thumbnail__wrapper">
                                             <img src="{{ $cartItem->getImage() }}" class="product-thumbnail__image">
                                          </div>
                                          <span class="product-thumbnail__quantity"
                                             aria-hidden="true">{{ $cartItem->getQty() }}</span>
                                       </div>
                                    </td>
                                    <td class="product-info"><span class="product-info-name"> {{ $cartItem->getName() }} </span>
                                    </td>
                                    <td class="product-price text-right">{{ $cartItem->getCostFormat() }}</td>
                                 </tr>
                              </tbody>
                           </table>
                           @php
            					$detailList = $cartItem->getDetailList();
            			   @endphp
            			   @foreach($detailList as $detail)
            			   <table class="product-table">
                              <tbody>
                                 <tr class="product product-has-image clearfix">
                                    <td>
<!--                                        <span class="product-thumbnail__quantity" aria-hidden="true">{{ $detail->getQty() }}</span> -->
                                    </td>
                                    <td class="product-info"><span class="product-info-name"> <strong>{{ $detail->getGroupName() }}:</strong> {{ $detail->getName() }} <small>x {{ $detail->getQty() }}</small> </span>
                                    </td>
                                    <td class="product-price text-right">{{ $detail->getCostFormat() }}</td>
                                 </tr>
                              </tbody>
                           </table>
            			   @endforeach
                           @endforeach
                        </div>
                     </div>
                     <hr class="m0">
                  </div>
                  <div class="order-summary order-summary--total-lines">
                     <div class="summary-section border-top-none--mobile">
                        <div class="total-line total-line-subtotal clearfix">
                           <span class="total-line-name pull-left"> {{ trans('shop.checkout.subtotal') }} </span> 
                           <span class="total-line-subprice pull-right"  id="sub_total" data-total="{{ $cart->getSubTotal() }}" >{{ $cart->getSubTotalFormat() }}</span>
                        </div>
                        <div class="total-line total-line-shipping clearfix">
                           <span class="total-line-name pull-left"> {{ trans('shop.checkout.ship') }} </span>
                           <span class="total-line-shipping pull-right" id="ship_fee">0₫</span>
                        </div>
                        <div class="total-line total-line-total clearfix">
                           <span class="total-line-name pull-left"> {{ trans('shop.checkout.total') }} </span> <span class="total-line-price pull-right" id="total">{{ $cart->getTotalFormat() }}</span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group clearfix hidden-sm hidden-xs">
                     <div class="field__input-btn-wrapper mt10">
                        <a class="previous-link" href="{{ route('cart') }}"> <i
                           class="fa fa-angle-left fa-lg" aria-hidden="true"></i> <span>{{ trans('shop.button.back_to_cart') }}</span>
                        </a> 
                        <button class="btn btn-primary btn-checkout checkout_btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.checkout_order') }}" type="button">{{ trans('shop.button.checkout_order') }}</button>
                     </div>
                  </div>
                  <div class="form-group has-error">
                     <div class="help-block ">
                        <ul class="list-unstyled">
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="main" role="main">
               <div class="main_header">
                  <div class="shop logo logo--left ">
                     <h1 class="shop__name">
                        <a href="/"> {{ $config['web_name'] }} </a>
                     </h1>
                  </div>
               </div>
               <div class="main_content" data-select2-id="13">
                  <div class="row">
                     <div class="col-md-6 col-lg-6">
                        <div class="section">
                           <div class="section__header">
                              <div class="layout-flex layout-flex--wrap">
                                 <h2
                                    class="section__title layout-flex__item layout-flex__item--stretch">
                                    <i
                                       class="fa fa-id-card-o fa-lg section__title--icon hidden-md hidden-lg"
                                       aria-hidden="true"></i> <label class="control-label">{{ trans('shop.checkout.customer_info') }}</label>
                                 </h2>
                              </div>
                           </div>
                           <div class="section__content">
                              	<div class="form-group">
                                     <div class="field__input-wrapper">
                                        <input type="text" class="field__input form-control" name="checkout_email" placeholder="{{ trans('shop.user.email') }}*" id="checkout_email" value="" />
                                     </div>
                                     <div class="help-block"></div>
                              	</div>
                                <div class="form-group">
                                   <div class="field__input-wrapper">
                                      <input type="text" name="checkout_name" id="checkout_name" type="text" placeholder="{{ trans('shop.user.name') }}*" class="field__input form-control" value="" />
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                   <div class="field__input-wrapper">
                                      <input type="tel" name="checkout_phone" class="field__input form-control" id="checkout_phone" placeholder="{{ trans('shop.user.phone') }}*" value="" />
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                   <div class="field__input-wrapper">
                                      <input type="text" name="checkout_address" class="field__input form-control" id="checkout_address"  placeholder="{{ trans('shop.user.address') }}*" value=""/>
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                   <div>
                                       <select name="checkout_province" id="checkout_province" class="form-control">
                                       </select>
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                 	<div>
                                       <select name="checkout_district" id="checkout_district" class="form-control">
                                       </select>
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                   <div class="field__input-wrapper">
                                      <textarea name="checkout_note" id="checkout_note" class="field__input form-control m0" placeholder="{{ trans('shop.checkout.note') }}"></textarea>
                                   </div>
                                   <div class="help-block"></div>
                                </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-6">
                        <div class="section payment-methods p0--desktop">
                           <div class="section__header">
                              <h2 class="section__title">
                                 <i class="fa fa-credit-card fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i> <label class="control-label">{{ trans('shop.checkout.payment') }}</label>
                              </h2>
                           </div>
                           <div class="section__content">
                           	  @php
                           	  	$payment_methods = trans('auth.payment_methods');
                           	  	unset($payment_methods['header']);
                           	  @endphp
                           	  @foreach($payment_methods as $key=>$method)
                              <div class="content-box">
                                 <div class="content-box__row">
                                    <div class="radio-wrapper">
                                       <div class="radio__input">
                                          <input class="input-radio" type="radio" name="payment_method" id="payment_method_{{ $key }}" value="{{ $key }}" @if($key == 'cash_info'){{'checked=checked'}}@endif>
                                       </div>
                                       <label class="radio__label" for="payment_method_{{ $key }}">
                                          <span class="radio__label__primary">{{ $method }}</span> 
                                          <span class="radio__label__accessory">
                                             <ul>
                                                <li class="payment-icon-v2 payment-icon--4"><i
                                                   class="fa fa-money payment-icon-fa" aria-hidden="true"></i>
                                                </li>
                                             </ul>
                                          </span>
                                       </label>
                                    </div>
                                    <!-- /radio-wrapper-->
                                 </div>
                                 <div
                                    class="radio-wrapper content-box__row content-box__row--secondary"
                                    id="payment-gateway-subfields-315961"
                                    >
                                    <div class="blank-slate">
                                       <p>{!! $config[$key] !!}</p>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                           <div class="section hidden-md hidden-lg">
                                <div class="form-group clearfix m0">
                                    <button class="btn btn-primary btn-checkout checkout_btn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.checkout_order') }}" type="button">{{ trans('shop.button.checkout_order') }}</button>
                                </div>
                                <div class="text-center mt20">
                                    <a class="previous-link" href="{{ route('cart') }}">
                                        <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                                        <span>{{ trans('shop.button.back_to_cart') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </body>
   <script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/jquery-2.2.3.min4d7c.js') }}" type="text/javascript"></script>
   <script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
   <script src="{{ url('js/custom.shop.js') }}" type="text/javascript"></script>
   <script src="{{ url('shop/maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>
   <script type="text/javascript">
   $(document).ready(function() {

	   $.validator.addMethod("valid_email", function (value, element) {
			var regex = /^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if(!value.match(regex)) {
		        return false;
		    }
		    return true;
		});

		$.validator.addMethod('valid_phone', function(value, element, params) {
			var regex = /^([0-9,\+,\-,\(,\),\.]{8,20})$/;
			if(!value.match(regex)) {
		        return false;
		    }
		    return true;
		});

		var required_msg = '{{ trans('validation.required', ['attribute' => '']) }}';
		var required_select_msg = '{{ trans('validation.required_select', ['attribute' => '']) }}';
		var valid_email_msg = '{{ trans('validation.email') }}';
		var valid_phone_msg = '{{ trans('validation.phone') }}';
		
		var validatorEventSetting = $("#submit_form").validate({
	    	onfocusout: false,
	    	success: function(label, element) {
	        	var jelm = $(element);
	        	var parent = jelm.parent().parent();
	        	parent.removeClass('has-error');
	        	parent.find('.help-block').empty();
	    	},
	    	rules: {
				checkout_email: {
					required: true,
					valid_email: true
				},
				checkout_name: {
					required: true,
				},
				checkout_phone: {
					required: true,
					valid_phone: true
				},
				checkout_address: {
					required: true,
				},
				checkout_province: {
					required: true,
				},
				checkout_district: {
					required: true,
				}
	    	},
	    	messages: {
	    		checkout_email: {
					required: required_msg,
					valid_email: valid_email_msg
				},
				checkout_name: {
					required: required_msg,
				},
				checkout_phone: {
					required: required_msg,
					valid_phone: valid_phone_msg
				},
				checkout_address: {
					required: required_select_msg,
				},
				checkout_province: {
					required: required_select_msg,
				},
				checkout_district: {
					required: required_select_msg,
				}
	    	},
	    	errorPlacement: function(error, element) {
	    		element.parent().parent().find('.help-block').html(error[0].innerHTML);
	    		element.parent().parent().find('.help-block').addClass('with-errors');
	    		element.parent().parent().addClass('has-error');
		  	}
	    });

	    $('.checkout_btn').click(function(e) {
			if($('#submit_form').valid()) {
				var data = {
	        		type : 'post',
	        		async : true,
	        		container: ['#contact_success', '#contact_error'],
	        		customer_name: $('#checkout_name').val(),
	        		customer_email: $('#checkout_email').val(),
	        		customer_phone: $('#checkout_phone').val(),
	        		customer_address: $('#checkout_address').val(),
	        		customer_province: $('#checkout_province option:selected').text(),
	        		customer_district: $('#checkout_district option:selected').text(),
	        		customer_note: $('#checkout_note').val(),
	        		payment_method: $('input[name="payment_method"]:checked').val(),
	        		checkout_success_url: '{{ route('checkoutSuccess') }}',
	        		ship_fee: $('#ship_fee').attr('data-ship-fee')
	        	}

	        	callAjax('{{ route('checkout') }}', data, $(this));
						
			}

	    });

	    $.get('{{ route('loadCity') }}', function( data ) {
			   $('#checkout_province').html(data);
		});

	    $('#checkout_province').change(function(e) {
		    var shipFee = Number($('#checkout_province option:selected').attr('data-ship-fee'));
			var cityId = $(this).val();
			$.get('{{ route('loadDistrict') }}?city_id=' + cityId, function( data ) {
				   $('#checkout_district').html(data);
			});
			$('#ship_fee').attr('data-ship-fee', shipFee);
			$('#ship_fee').html(formatCurrency(shipFee, '.' , '.'));

			var sub_total = Number($('#sub_total').attr('data-total'));
			var total = sub_total + shipFee;
			$('#total').html(formatCurrency(total, '.' , '.'));
	    });

	    $('#checkout_district').change(function(e) {
		    var shipFee = Number($('#checkout_district option:selected').attr('data-ship-fee'));
			$('#ship_fee').attr('data-ship-fee', shipFee);
			$('#ship_fee').html(formatCurrency(shipFee, '.' , '.'));

			var sub_total = Number($('#sub_total').attr('data-total'));
			var total = sub_total + shipFee;
			$('#total').html(formatCurrency(total, '.' , '.'));
	    });

	    $('#show-order-summary').click(function(e) {
	    	var $toggle = $(this).parent().parent();
            var $container = $(".order-summary--product-list");

            $container.wrapInner("<div />");

            var i = $container.height();
            var r = $container.find("> div").height();
            var n = 0 === i ? r : 0;

            $container.css("height", i);
            $container.find("> div").contents().unwrap();

            setTimeout(function (i) {
                return function () {
                    $toggle.toggleClass("order-summary-toggle--hide");
                    $container.toggleClass("order-summary--is-collapsed");
                    $container.addClass("order-summary--transition");
                    $container.css("height", n);
                }
            }(this), 0);

	    });
		    
	});
   </script>
</html>