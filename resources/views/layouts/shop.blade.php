<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	{!! SEO::generate() !!}
	<meta property="fb:app_id" content="135671569954053" />
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(!Utils::blank($config['web_ico']))
    <link rel="shortcut icon" href="{{ $config['web_ico'] . '?t=' . time() }}">
    @endif
    
   	
    
	<link rel="stylesheet" href="{{ url('shop/cdn.linearicons.com/free/1.0.0/icon-font.min.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&amp;subset=vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('shop/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}">
	<!-- Plugin CSS -->			
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/plugin.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/base.scss4d7c.css') }}" rel="stylesheet" type="text/css" />		
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/style.scss4d7c.css') }}" rel="stylesheet" type="text/css" />				
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/module.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/responsive.scss4d7c.css') }}" rel="stylesheet" type="text/css" />

	<!-- Theme Main CSS -->
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/bootstrap-theme4d7c.css') }}" rel="stylesheet" type="text/css" />		
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/style-theme.scss4d7c.css?t='. time()) }}" rel="stylesheet" type="text/css" />
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/responsive-update.scss4d7c.css') }}" rel="stylesheet" type="text/css" />
	
	<link href="{{ url('shop/frontend/100/308/325/themes/665783/assets/iwish4d7c.css') }}" rel="stylesheet" type="text/css" />
	
	<link href="{{ url('shop/css/custom.shop.css') }}" rel="stylesheet" type="text/css" />
	<!-- Header JS -->	
	<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/jquery-2.2.3.min4d7c.js') }}" type="text/javascript"></script> 
	
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=135671569954053&autoLogAppEvents=1"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139235768-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-139235768-1');
    </script>


</head>

<body>
	<header>
	@include('shop.common.header')
	@include('shop.common.main_nav')
	</header>
	@yield('content')
	@include('shop.common.footer')
	@include('shop.modal.add_to_cart')
	<!-- Plugin JS -->
	<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/appear4d7c.js') }}" type="text/javascript"></script>
	<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/owl.carousel.min4d7c.js') }}" type="text/javascript"></script>		
	<script src="{{ url('shop/maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>

	<!-- Main JS -->	
	<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/dl_main4d7c.js') }}" type="text/javascript"></script>
	
	<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/jquery.elevatezoom308.min.js') }}" type="text/javascript"></script>	
	<script type="text/javascript" src="{{ url('js/custom.shop.js') }}" ></script>
	<script>
		$(document).ready(function() {
			
    		 $('.zoomContainer').remove();
    		 $('#zoom_01').elevateZoom({
    			 gallery:'gallery_01', 
    			 zoomWindowWidth:420,
    			 zoomWindowHeight:500,
    			 zoomWindowOffetx: 10,
    			 easing : true,
    			 scrollZoom : false,
    			 cursor: 'pointer', 
    			 galleryActiveClass: 'active', 
    			 imageCrossfade: true
    		 });

    		 $(document).on('keyup', '#keyword', function(e) {
        		 var value = $(this).val().trim();
        		 var page_name = 'search-suggestion-page';
        		 if(value.length > 0) {
        			var data = {
    		    		type : 'post',
    		    		async : true,
    		    		keyword: $(this).val(),
    		    		page_name: page_name,
    		    		container: ['#product_results'],
    		    		limit_product: '{{ $config['limit_product_show'] }}'
    		    	}
    				$('#search_suggestion').show();
      		    	$('.show_more span').html($(this).val());
    		    	callAjax('{{ route('loadData') }}', data);
        		 } else {
        			 $('#search_suggestion').hide();
        		 }
    		 });

    		 $(document).on('click', '.show_more', function(e) {
				window.location = '{{ route('search') }}?q=' + $('#keyword').val();
    		 });

    		 $(document).on('click', '.add_to_cart', function(e) {
 				 var data = {
					type : 'post',
		    		async : true,
		    		pid: $(this).attr('data-id'),
		    		qty: $(this).attr('data-qty'),
		    		container: ['#cart_1', '.cartCount2', '#top_cart'],
		    		dialog: '#popupCartModal'
 				 }

 				 callAjax('{{ route('addToCart') }}', data);
     		 });

    		 $(document).on('click', '.btn-minus-detail', function(e) {
        		 e.stopPropagation();
        		 var qty = Number($(this).next('.number-sidebar').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-product-id'),
 		    		did: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
  				 }

  				 callAjax('{{ route('updateCartDetail') }}', data);
        		 
     		 });

    		 $(document).on('click', '.btn-plus-detail', function(e) {
        		 var qty = Number($(this).prev('.number-sidebar').val()) + 1;
        		 var qty_item = Number($(this).attr('data-qty'));
        		 if(qty > qty_item) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-product-id'),
 		    		did: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
  				 }

  				 callAjax('{{ route('updateCartDetail') }}', data);
        		 
     		 });

    		 $(document).on('click', '.btn-minus-item, .btn-minus-topcart', function(e) {
        		 var qty = Number($(this).next('.number-sidebar').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }

        		 $(this).next('.number-sidebar').val(qty);
        		 $('.qty-detail').attr('data-qty');

        		 var data = {
 					type : 'post',
 		    		async : true,
 		    		pid: $(this).attr('data-id'),
 		    		qty: qty,
 		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
  				 }

  				 callAjax('{{ route('updateCart') }}', data);

        		 
     		 });
    		 
    		 $(document).on('click', '.btn-plus-item, .btn-plus-topcart', function(e) {
        		 var qty = Number($(this).prev('.number-sidebar').val()) + 1;
        		 if(qty > 20) {
					return false;
        		 }
        		 
        		 $(this).prev('.number-sidebar').val(qty);
        		 $('.qty-detail').attr('data-qty');

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: $(this).attr('data-id'),
  		    		qty: qty,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
   				 }

   				 callAjax('{{ route('updateCart') }}', data);
        		 
    		 });

    		 $(document).on('click', '.qtyminus', function(e) {
        		 var id = $(this).attr('data-id');
        		 var qty = Number($(this).next('.qty').val()) - 1;
        		 if(qty === 0) {
					return false;
        		 }
        		 
        		 $(this).next('.qty').val(qty);

				 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);
				 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);	 
    		 });

    		 $(document).on('click', '.qtyplus', function(e) {
    			 var id = $(this).attr('data-id');
        		 var qty = Number($(this).prev('.qty').val()) + 1;
        		 if(qty > 20) {
					return false;
        		 }
        		 
        		 $(this).prev('.qty').val(qty);

        		 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);  
        		 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);      		 
    		 });

    		 $(document).on('keyup', '.qty', function(e) {
        		 var qty = $(this).val();
        		 var id = $(this).attr('data-id');
        		 $(this).parent().parent().find('.add_to_cart').attr('data-id', id);  
        		 $(this).parent().parent().find('.add_to_cart').attr('data-qty', qty);    
     		 });

    		 $(document).on('keyup', '.number-sidebar', function(e) {
        		 var qty = $(this).val();

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: $(this).attr('data-id'),
  		    		qty: qty,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
   				 }

   				 callAjax('{{ route('updateCart') }}', data);
     		 });

    		 $(document).on('click', '.remove-item-cart', function(e) {

        		 var data = {
  					type : 'post',
  		    		async : true,
  		    		id: $(this).attr('data-id'),
  		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
  		    		checkout_btn: '#checkout_btn'
   				 }

   				 callAjax('{{ route('removeItem') }}', data);
     		 });

    		 $(document).on('click', '.remove-detail-item', function(e) {
				 var pid = $(this).attr('data-product-id');
				 var id = $(this).attr('data-id');
    			 var data = {
  					type : 'post',
  		    		async : true,
  		    		pid: pid,
  		    		id: id,
  		    		container: ['#top_cart', '.cartCount2', '#main_cart', '#main_cart_mobile'],
   				 }

   				 callAjax('{{ route('removeDetailItem') }}', data);
     		 });

     		 $(document).on('click', '#order_checking', function(e) {
         		var value = $('#checking').val();
         		if(value.length === 0) {
             		return false;
         		}
         		
     			var data = {
  					type : 'post',
  		    		async : true,
  		    		value: $('#checking').val(),
  		    		container: ['#order_checking_list'],
   				}

   				callAjax('{{ route('orderChecking') }}', data, $(this));
     		 });

		});

		$(document).mouseup(function(e) {
		    var container = $("#search_suggestion");
		    if (!container.is(e.target) && container.has(e.target).length === 0) {
		        container.hide();
		    }
		});

	</script>
	@yield('script')
</body>
<style>
.fb-livechat, .fb-widget {
	display: none
}

.ctrlq.fb-button {
	position: fixed;
	right: 10px;
	cursor: pointer
}

.ctrlq.fb-close {
    position: fixed;
	right: 20px;
	cursor: pointer
}

.ctrlq.fb-button {
	z-index: 999;
	background:
		url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyOCAxMjgiIGhlaWdodD0iMTI4cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB3aWR0aD0iMTI4cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxyZWN0IGZpbGw9IiMwMDg0RkYiIGhlaWdodD0iMTI4IiB3aWR0aD0iMTI4Ii8+PC9nPjxwYXRoIGQ9Ik02NCwxNy41MzFjLTI1LjQwNSwwLTQ2LDE5LjI1OS00Niw0My4wMTVjMCwxMy41MTUsNi42NjUsMjUuNTc0LDE3LjA4OSwzMy40NnYxNi40NjIgIGwxNS42OTgtOC43MDdjNC4xODYsMS4xNzEsOC42MjEsMS44LDEzLjIxMywxLjhjMjUuNDA1LDAsNDYtMTkuMjU4LDQ2LTQzLjAxNUMxMTAsMzYuNzksODkuNDA1LDE3LjUzMSw2NCwxNy41MzF6IE02OC44NDUsNzUuMjE0ICBMNTYuOTQ3LDYyLjg1NUwzNC4wMzUsNzUuNTI0bDI1LjEyLTI2LjY1N2wxMS44OTgsMTIuMzU5bDIyLjkxLTEyLjY3TDY4Ljg0NSw3NS4yMTR6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnViYmxlX1NoYXBlIi8+PC9zdmc+)
		center no-repeat #0084ff;
	width: 60px;
	height: 60px;
	text-align: center;
	bottom: 65px;
	border: 0;
	outline: 0;
	border-radius: 60px;
	-webkit-border-radius: 60px;
	-moz-border-radius: 60px;
	-ms-border-radius: 60px;
	-o-border-radius: 60px;
	box-shadow: 0 1px 6px rgba(0, 0, 0, .06), 0 2px 32px rgba(0, 0, 0, .16);
	-webkit-transition: box-shadow .2s ease;
	background-size: 80%;
	transition: all .2s ease-in-out
}

.ctrlq.fb-button:focus, .ctrlq.fb-button:hover {
	transform: scale(1.1);
	box-shadow: 0 2px 8px rgba(0, 0, 0, .09), 0 4px 40px rgba(0, 0, 0, .24)
}

.fb-widget {
	background: #fff;
	z-index: 1000;
	position: fixed;
	width: 360px;
	height: 435px;
	overflow: hidden;
	opacity: 0;
	bottom: 0;
	right: 24px;
	border-radius: 6px;
	-o-border-radius: 6px;
	-webkit-border-radius: 6px;
	box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
	-webkit-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
	-moz-box-shadow: 0 5px 40px rgba(0, 0, 0, .16);
	-o-box-shadow: 0 5px 40px rgba(0, 0, 0, .16)
}

.fb-credit {
	text-align: center;
	margin-top: 8px
}

.fb-credit a {
	transition: none;
	color: #bec2c9;
	font-family: Helvetica, Arial, sans-serif;
	font-size: 12px;
	text-decoration: none;
	border: 0;
	font-weight: 400
}

.ctrlq.fb-overlay {
	z-index: 0;
	position: fixed;
	height: 100vh;
	width: 100vw;
	-webkit-transition: opacity .4s, visibility .4s;
	transition: opacity .4s, visibility .4s;
	top: 0;
	left: 0;
	background: rgba(0, 0, 0, .05);
	display: none
}

.ctrlq.fb-close {
	z-index: 4;
	padding: 0 6px;
	background: #365899;
	font-weight: 700;
	font-size: 11px;
	color: #fff;
	margin: 8px;
	border-radius: 3px
}

.ctrlq.fb-close::after {
	content: "X";
	font-family: sans-serif
}

.bubble {
	width: 20px;
	height: 20px;
	background: #c00;
	color: #fff;
	position: absolute;
	z-index: 999999999;
	text-align: center;
	vertical-align: middle;
	top: -2px;
	left: -5px;
	border-radius: 50%;
}

.bubble-msg {
	width: 120px;
	left: -140px;
	top: 5px;
	position: relative;
	background: rgba(59, 89, 152, .8);
	color: #fff;
	padding: 5px 8px;
	border-radius: 8px;
	text-align: center;
	font-size: 13px;
}
</style>
<div class="fb-livechat">
	<div class="ctrlq fb-overlay"></div>
	<div class="fb-widget">
		<div class="ctrlq fb-close"></div>
		<div class="fb-page" data-href="{{ $config['facebook_fanpage'] }}"
			data-tabs="messages" data-width="360" data-height="400"
			data-small-header="true" data-hide-cover="true"
			data-show-facepile="false"></div>
		<div class="fb-credit">
			<a href="https://facebook.com" target="_blank">Powered by Facebook</a>
		</div>
		<div id="fb-root"></div>
	</div>
	<a href="https://m.me/xeomshop"
		title="Gửi tin nhắn cho chúng tôi qua Facebook"
		class="ctrlq fb-button">
		<div class="bubble">1</div>
		<div class="bubble-msg">Bạn cần hỗ trợ?</div>
	</a>
</div>
<script
	src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script>
<script>jQuery(document).ready(function($){function detectmob(){if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){return true;}else{return false;}}var t={delay: 125, overlay: $(".fb-overlay"), widget: $(".fb-widget"), button: $(".fb-button")}; setTimeout(function(){$("div.fb-livechat").fadeIn()}, 8 * t.delay); if(!detectmob()){$(".ctrlq").on("click", function(e){e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({bottom: 0, opacity: 0}, 2 * t.delay, function(){$(this).hide("slow"), t.button.show()})) : t.button.fadeOut("medium", function(){t.widget.stop().show().animate({bottom: "30px", opacity: 1}, 2 * t.delay), t.overlay.fadeIn(t.delay)})})}});</script>
</html>
