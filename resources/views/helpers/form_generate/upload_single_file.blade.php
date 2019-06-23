<div>
	<input type="file" class="form-control upload-simple" name="{{ $key }}" data-preview-control="{{ $preview_control_id }}" data-limit-upload="{{ $limit_upload }}" />
	<div class="preview_area" style="width:{{ $width }}px;position:relative">
		<span class="spinner_preview" style="display:none"><i class="fa fa-circle-o-notch fa-spin"></i>{{ trans('auth.upload_check_txt') }}</span>
		@if($value)
		<a href="javascript:void(0)" class="remove-img-simple" style="position:absolute; top:20px; right:10px"><i class="fa fa-trash" style="font-size:18px;"></i></a>
		<img id="{{ $preview_control_id }}" src="{{ Utils::getImageLink($value) }}" class="img-thumbnail" style="margin-top:10px;width:{{ $width }}px;height:{{ $height }}px">
		@else
		<img id="{{ $preview_control_id }}" src="{{ Utils::getImageLink(Common::NO_IMAGE_FOUND) }}" class="img-thumbnail" style="margin-top:10px;width:{{ $width }}px;height:{{ $height }}px">
		@endif
		<input type="hidden" class="filename_hidden" name="{{ $key_data }}_hidden" value="{{ $value }}" />
	</div>
</div>
