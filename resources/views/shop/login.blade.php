@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	@include('shop.common.alert')
	<h1 class="title-head"><span>{{ trans('shop.login') }}</span></h1>
	<div class="row">
		<div class="col-lg-6">
			<div class="page-login margin-bottom-30">
				<div id="login">
					<span>
						{{ trans('shop.login_txt') }}
					</span>
					<form accept-charset="UTF-8" action="?" id="customer_login" method="post">
						{{ csrf_field() }}
                        <input name="FormType" type="hidden" value="customer_login">
                        <input name="utf8" type="hidden" value="true">
    					<div class="form-signup clearfix">
    						<fieldset class="form-group">
    							<label>{{ trans('shop.user.email') }}: </label>
    							<input type="email" class="form-control form-control-lg" value="" name="email" id="email" placeholder="{{ trans('shop.user.email') }}" maxlength="150" required>
    						</fieldset>
    						<fieldset class="form-group">
    							<label>{{ trans('shop.user.password') }}: </label>
    							<input type="password" class="form-control form-control-lg" value="" name="password" id="password" placeholder="{{ trans('shop.user.password') }}" maxlength="40" required>
    						</fieldset>
    						<div class="pull-xs-left" style="margin-top: 25px;">
    							<input class="btn btn-primary" type="submit" id="login_btn" value="Đăng nhập">
    							<a href="{{ route('account_register') }}" class="btn-link-style btn-register" style="margin-left: 20px;text-decoration: underline; ">{{ trans('shop.button.register') }}</a>
    						</div>
    					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div id="recover-password" class="form-signup">
				<span>
					{{ trans('shop.forgot_password') }}
				</span>					
				<form accept-charset="UTF-8" action="{{ route('account_recover') }}" id="recover_customer_password" method="post">
					{{ csrf_field() }}
    				<div class="form-signup clearfix">
    					<fieldset class="form-group">
    						<label>{{ trans('shop.user.email') }}: </label>
    						<input type="email" class="form-control form-control-lg" value="" name="recover_email" id="recover_email" placeholder="{{ trans('shop.user.email') }}">
    					</fieldset>
    				</div>
    				<div class="action_bottom">
    					<input class="btn btn-primary" style="margin-top: 25px;" type="submit" value="{{ trans('shop.button.recover_password') }}">
    				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
