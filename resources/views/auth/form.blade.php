@extends('layouts.app')

@section('content')
@include('auth.common.content_header')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form role="form" id="submit_form" action="?" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
    			{!! Utils::generateForm($config, $name, $data) !!}
    			@if($name == 'orders')
    			<div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">{{ isset($forms['text']) ? $forms['text'] : trans('auth.edit_box_title') }}</h3>
                    </div>
                	<div class="box-body">
                		{!! Utils::generateList($config, $name, $orderDetails, $data, 'table_product_header') !!}
                	</div>
                </div>
                @endif
            </form>
		</div>
	</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	var validateObject = {!! Utils::generateValidation($name, $rules, $data) !!}
    var validatorEventSetting = $("#submit_form").validate({
        ignore: '',
    	onfocusout: false,
    	success: function(label, element) {
        	var jelm = $(element);
        	var parent = jelm.parent().parent();
        	parent.removeClass('has-error');
        	parent.find('.help-block').empty();
    	},
    	rules: validateObject.rules,
    	messages: validateObject.messages,
    	errorPlacement: function(error, element) {
    		customErrorValidate(error, element);
	  	},
    	submitHanlder: function(form) {
    	    form.submit();
    	}
    });
</script>
@endsection