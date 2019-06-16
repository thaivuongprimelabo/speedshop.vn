<div class="form-group">
	<label>SEO Keywords</label>
	<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
		<input type="text" name="seo_keywords" id="seo_keywords" class="form-control" placeholder="Keyword 1, Keyword 2, Keyword 3" value="{{ $data != null ? $data->seo_keywords : '' }}">
	</div>
</div>
<div class="form-group">
	<label>SEO Description</label>
	<div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
		<textarea name="seo_description" id="seo_description" rows="6" class="form-control" >{{ $data != null ? $data->seo_description : '' }}</textarea>
	</div>
</div>