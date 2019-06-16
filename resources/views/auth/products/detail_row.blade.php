@php
	$service_name = isset($service_price) ? $service_name : '';
	$service_price = isset($service_price) ? $service_price : '';
	$class = isset($class) ? $class : '';
	$k = isset($k) ? $k : -1;
@endphp
@if($k >= 0)
<tr class="{{ $class }}">
    <td>
    	<div class="input-group">
    		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
    		<input type="text" name="service[{{ $key }}][item][{{ $k }}][name]" value="{{ $service_name }}" class="form-control service-name" placeholder="Tên dịch vụ">
    	</div>
    </td>
    <td>
    	<div class="input-group">
    		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
    		<input type="number" name="service[{{ $key }}][item][{{ $k }}][price]" value="{{ $service_price }}" class="form-control service-price" placeholder="Giá tiền">
    	</div>
    </td>
    <td>
    	<button type="button" class="btn btn-danger btn-xs remove-detail" title="Remove item"><span class="glyphicon glyphicon-remove"></span> {{ trans('auth.button.remove') }}</button>
    </td>
</tr>
@else
<tr id="hidden-item" class="{{ $class }}">
    <td>
    	<div class="input-group">
    		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
    		<input type="text" name="" value="" class="form-control service-name" placeholder="Tên dịch vụ">
    	</div>
    </td>
    <td>
    	<div class="input-group">
    		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
    		<input type="number" name="" value="" class="form-control service-price" placeholder="Giá tiền">
    	</div>
    </td>
    <td>
    	<button type="button" class="btn btn-danger btn-xs remove-detail" title="Remove item"><span class="glyphicon glyphicon-remove"></span> {{ trans('auth.button.remove') }}</button>
    </td>
</tr>
@endif