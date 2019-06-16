@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div id="update_profile_success" class="alert alert-success" style="display:none">
    </div>
    <div id="update_profile_error" class="alert alert-danger" style="display:none">
    </div>
	<h1 class="title-head"><a href="#">{{ trans('shop.profile_txt') }}</a></h1>
	<div class="row">
		<div class="col-lg-12 ">
			<div class="page-login">
				<div id="login">
					<form accept-charset="UTF-8" action="?" id="submit_form" method="post">
    					<div class="form-signup clearfix">
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.name') }}: </label>
    									<input type="text" class="form-control form-control-lg" name="name" id="update_profile_name" value="{{ Auth::user()->name }}" placeholder="{{ trans('shop.user.name') }}" maxlength="200" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.email') }}: </label>
    									<input type="email" class="form-control form-control-lg" name="email" id="update_profile_email"  value="{{ Auth::user()->email }}" placeholder="{{ trans('shop.user.email') }}" maxlength="150" required="" disabled="disabled">
    								</fieldset>
    							</div>
    						</div>
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.password') }}: </label>
    									<input type="password" class="form-control form-control-lg" value="" name="update_profile_password" id="update_profile_password" placeholder="{{ trans('shop.user.password') }}" maxlength="40" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.conf_password') }}: </label>
    									<input type="password" class="form-control form-control-lg" value="" name="update_profile_conf_password" id="update_profile_conf_password" placeholder="{{ trans('shop.user.conf_password') }}" maxlength="40" required="">
    								</fieldset>
    							</div>
    						</div>
    						
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.address') }}: </label>
    									<input type="tel" class="form-control form-control-lg"  value="{{ Auth::user()->address }}" name="update_profile_address" id="update_profile_address" placeholder="{{ trans('shop.user.address') }}" maxlength="150" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    
    								<fieldset class="form-group">
    									<label>{{ trans('shop.user.phone') }}: </label>
    									<input type="tel" class="form-control form-control-lg"  value="{{ Auth::user()->phone }}" name="update_profile_phone" id="update_profile_phone" placeholder="{{ trans('shop.user.phone') }}" maxlength="15" required="">
    								</fieldset>
    							</div>
    						</div>
    						
    						<div class="row">
    							<div class="col-md-6">
    								<fieldset class="form-group">
    									<label><span id="captcha_img">{!! captcha_img('flat') !!}</span> <button type="button" id="reset_captcha" class="btn btn-primary"><i class="fa fa-refresh"></i></button></label>
    									<input type="text" class="form-control form-control-lg" value="" name="captcha" id="update_profile_captcha" placeholder="{{ trans('shop.user.captcha') }}" maxlength="3" required="">
    								</fieldset>
    							</div>
    							<div class="col-md-6">
    
    							</div>
    						</div>
    
    
    						<div class="col-xs-12 text-xs-left margin-bottom-30" style="margin-top:6px; padding: 0">
    							<button type="button" id="update_profile_btn" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.update') }}">{{ trans('shop.button.update') }}</button>
    						</div>
    					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {

	$('#update_profile_btn').click(function() {
    	var data = {
    		type : 'post',
    		async : true,
    		container: ['#update_profile_success', '#update_profile_error', '#captcha_img'],
    		name: $('#update_profile_name').val(),
    		email: $('#update_profile_email').val(),
    		password: $('#update_profile_password').val(),
    		conf_password: $('#update_profile_conf_password').val(),
    		address: $('#update_profile_address').val(),
    		phone: $('#update_profile_phone').val(),
    		captcha: $('#update_profile_captcha').val(),
    	}

    	$('#update_profile_error').hide();
    
    	callAjax('{{ route('account_profile') }}', data, $(this));
	});

	$('#reset_captcha').click(function() {

		refreshCaptcha('{{ route('refreshcaptcha') }}');
	});
});
</script>
@endsection