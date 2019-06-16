@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
    			<div id="recover-password" class="form-signup">
    				<div class="form-signup clearfix">
    					<div class="row">
        					<div class="col-md-6">
            					<fieldset class="form-group">
            						<label>{{ trans('shop.order_checking.email') }}: </label>
            						<input type="email" class="form-control form-control-lg" value="" id="checking" placeholder="{{ trans('shop.order_checking.email_input') }}">
            					</fieldset>
        					</div>
    					</div>
    				</div>
    				<div class="action_bottom">
    					<button type="button" id="order_checking" class="btn btn-primary"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> {{ trans('shop.button.order_checking') }}">{{ trans('shop.button.order_checking') }}</button>
    				</div>
    			</div>
    		</div>
		</div>
		<div class="row mt-4">
			<div id="order_checking_list" class="col-lg-12">
				
			</div>
		</div>
	</div>
</section>
@endsection
