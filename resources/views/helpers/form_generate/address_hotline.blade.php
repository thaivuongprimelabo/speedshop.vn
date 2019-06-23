<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
	@if(count($value))
    	@foreach($value as $el)
    	<input type="text" class="form-control" name="{{ $key }}[]" value="{{ $el }}" placeholder="{{ $placeholder }}" {{ $maxlength }} {{ $disable }} />
    	@endforeach
	@else
		<input type="text" class="form-control" name="{{ $key }}[]" value="{{ $el }}" placeholder="{{ $placeholder }}" {{ $maxlength }} {{ $disable }} />
	@endif
</div>
<button type="button" class="btn btn-danger add-info mt-1"><i class="fa fa-plus"></i> Thêm</button>