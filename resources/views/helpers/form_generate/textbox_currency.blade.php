<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
	<input type="number" class="form-control textbox_currency" name="{{ $key }}" id="{{ $key }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $maxlength }} {{ $disable }} />
</div>
<span id="format_currency" class="format_currency"><strong><small>Định dạng tiền tệ: <i>{{ $value_format }}</i></small></strong></span>