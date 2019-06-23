<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
	<input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ $maxlength }} {{ $disable }} />
	<div class="input-group-btn">
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#selectPostModal"><i class="fa fa-link fa-fw"></i> URL bài viết</button>
	</div>
</div>