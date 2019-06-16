<div class="btn-group mb-1">
<button id="add_new_service" type="button" class="btn btn-sm btn-success" title="Add new services"><i class="fa fa-plus"></i> {{ trans('auth.button.add_service') }}</button>
</div>
<div id="services" class="form-group">
	@if($data != null)
	{!! $data->getServices() !!}
	@endif
</div>