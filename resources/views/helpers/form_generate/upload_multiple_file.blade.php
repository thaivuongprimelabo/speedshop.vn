<div>
    <button type="button" id="upload_button" data-name="{{ $key }}[]" data-preview-control="preview_list" data-limit-upload="{{ $limit_upload }}" class="btn btn-primary">
    	<i class="fa fa-image"></i> Tải hình sản phẩm
    </button>
    <div id="preview_list" class="preview_area">
    	<span class="spinner_preview" style="display:none"><i class="fa fa-circle-o-notch fa-spin"></i>{{ trans('auth.upload_check_txt') }}</span>
    	@if(count($image_using))
    		@foreach($image_using as $image)
    			<div class="img-wrapper" data-filename="{{ $image->id }}" style="display:inline-block; position:relative">
    				@if($image->is_main)
    					<i class="fa fa-check" aria-hidden="true" style="position:absolute; top:15px; left:15px; font-size:24px; color:#31a231"></i>
    				@endif
    				<a href="javascript:void(0)" class="remove-img" style="position:absolute; top:15px; right:15px" data-id="{{ $image->id }}"><i class="fa fa-trash" style="font-size:24px;"></i></a>
    				<img src="{{ Utils::getImageLink($image->image) }}" class="img-thumbnail" style="max-width:110px; max-height:150px;margin-top:10px; margin-right:5px">
    			</div>
    		@endforeach
    	@endif
    </div>
    <input type="hidden" id="is_main" name="is_main" value="" />
    <input type="hidden" id="file_selected" />
</div>