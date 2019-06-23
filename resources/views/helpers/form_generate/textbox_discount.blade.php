<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
	<input type="number" class="form-control textbox_discount" name="{{ $key }}" id="{{ $key }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $maxlength }} {{ $disable }} />
</div>
<span id="format_discount" class="format_discount"><strong><small>Giá sau khi giảm: <i>{{ $discount_value }}</i></small></strong></span>