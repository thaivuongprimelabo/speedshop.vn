@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container container-fix-hd contact margin-bottom-30">
	<div id="contact_success" class="alert alert-success" style="display:none">
    </div>
    <div id="contact_error" class="alert alert-danger" style="display:none">
    </div>
	<h2 class="title-head"><span> Gửi tin nhắn cho chúng tôi</span></h2>
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-6">
					<div id="login">
						@include('shop.common.alert')
						<form accept-charset="UTF-8" action="?" id="submit_form" method="post">
							{{ csrf_field() }}
    						<div id="emtry_contact" class="form-signup form_contact clearfix">
    							<div class="row row-8Gutter">
    								<div class="col-md-12">
    									<fieldset class="form-group">							
    										<input type="text" placeholder="{{ trans('shop.contact.name') }}" name="name" id="contact_name" class="form-control  form-control-lg" maxlength="200" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">							
    										<input type="email" placeholder="{{ trans('shop.contact.email') }}" name="email" id="contact_email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,63}$" data-validation="email" id="email" class="form-control form-control-lg" maxlength="150" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">						
    										<input type="tel" placeholder="{{ trans('shop.contact.phone') }}" name="phone" id="contact_phone" class="form-control form-control-lg fixnumber" maxlength="15" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">						
    										<input type="text" placeholder="{{ trans('shop.contact.subject') }}" name="subject" id="contact_subject" class="form-control form-control-lg" maxlength="200" required="">
    									</fieldset>
    								</div>
    								<div class="col-md-12">
    									<fieldset class="form-group">							
            								<textarea placeholder="{{ trans('shop.contact.comment') }}" name="content" id="contact_content" class="form-control form-control-lg" rows="6" required=""></textarea>
            							</fieldset>
    								</div>
    								<div class="col-md-12">
    									<label><span id="captcha_img">{!! captcha_img('flat') !!}</span><button type="button" id="reset_captcha" class="btn btn-primary"><i class="fa fa-refresh"></i></button></label>
    									<fieldset class="form-group">
    										<input type="text" placeholder="{{ trans('shop.contact.captcha') }}" name="captcha" id="contact_captcha" class="form-control form-control-lg" required="">					
    									</fieldset>
    								</div>
    							</div>
    							<div class="mt-2">
    								<button type="button" id="contact_btn" class="btn btn-primary" style="padding:0 40px;text-transform: inherit;" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.send_contact') }}">{{ trans('shop.button.send_contact') }}</button>
    							</div> 
    						</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="contact-box-info clearfix margin-bottom-30">
						<div>
							<div class="item">	
							
								<div><i class="block_icon fa fa-home"></i>
									<div class="info">
										<label>{{ $config['web_name'] }}</label>
										<small>{{ $config['web_name'] }}</small>
									</div>
								</div>	

								<div><i class="fa fa-map-marker"></i> 
									@php
										$branch = explode('|', $config['web_address'])
									@endphp
									@if(count($branch))
									@foreach($branch as $key=>$address)
									<div class="info">
										<label>{{ trans('shop.branch_txt',['stt' => ++$key]) }}: <span style="font-weight: normal;">{{ $address }}</span></label>
									</div>
									@endforeach
									@endif
									
								</div>
								@php
                                	$hotline = explode('|', $config['web_hotline']);
                                	$hotline_cskh = explode('|', $config['web_hotline_cskh']);
                                @endphp
								<div>
									<i class="fa fa-phone"></i> 
									<div class="info">
										<label>{{ trans('shop.hotline_tech_txt') }}</label>
										@if(count($hotline))
										@foreach($hotline as $tel)
										<p>{{ $tel }}</p>
										@endforeach
										@endif
									</div>
								</div>
								<div>
									<i class="fa fa-phone"></i> 
									<div class="info">
										<label>{{ trans('shop.hotline_cskh_txt') }}</label>
										@if(count($hotline_cskh))
										@foreach($hotline_cskh as $tel)
										<p>{{ $tel }}</p>
										@endforeach
										@endif
									</div>
								</div>
								<div><i class="fa fa-envelope"></i> 
									<div class="info">
										<label>{{ trans('shop.email_txt') }}</label>
										<a href="mailto:{{ $config['web_email'] }}">{{ $config['web_email'] }}
										</a>
									</div>
								</div>		
								
								<div><i class="fa fa-clock-o"></i> 
									<div class="info">
										<label>{{ trans('shop.working_txt') }}</label>
										<p>{{ $config['web_working_time'] }}</p>
									</div>
								</div>																	
								
							</div>
							

						</div>		

					</div>
				</div>

			</div>
		</div>
		<div class="col-sm-12">
			<div class="box-maps margin-bottom-30">
				<div class="iFrameMap">
					<div class="google-map">
						<div id="contact_map" class="map"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<style>
	.google-map {width:100%;}
	.google-map .map {width:100%; height:450px; background:#dedede}
</style>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOvgMzMavm0loFdwqNrzzVh42X_-lDZ3w&callback=initMap"></script>

<script src="{{ url('shop/frontend/100/308/325/themes/665783/assets/jquery.gmap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

    	$('#contact_map').gMap({
    		zoom: 16,
    	    scrollwheel: false,
    	    maptype: 'ROADMAP',
    	    markers:[{
    		   		address: '{{ $config['web_address'] }}',
    		   		html: '_address'
    	   		}]
	    });

    	$('#contact_btn').click(function() {
        	var data = {
        		type : 'post',
        		async : true,
        		container: ['#contact_success', '#contact_error', '#captcha_img'],
        		name: $('#contact_name').val(),
        		email: $('#contact_email').val(),
        		phone: $('#contact_phone').val(),
        		subject: $('#contact_subject').val(),
        		content: $('#contact_content').val(),
        		captcha: $('#contact_captcha').val()
        	}

        	$('#contact_error').hide();
        
        	callAjax('{{ route('contact') }}', data, $(this));
    	});

    	$('#reset_captcha').click(function() {
    		refreshCaptcha('{{ route('refreshcaptcha') }}');
    	});
    });

</script>
@endsection
