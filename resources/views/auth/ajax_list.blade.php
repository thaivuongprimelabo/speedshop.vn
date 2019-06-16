<div class="box-header">
  <div class="col-md-6">
  		@php $routes = Route::getRoutes(); @endphp
  		@if($routes->hasNamedRoute('auth_' . $name . '_remove'))
      	<button type="button" id="remove_many" class="btn btn-danger" data-url="{{ route('auth_' . $name . '_remove') }}"><i class="fa fa-trash"></i> Xóa</button>
  		@endif
  		{{ trans('auth.count', ['count' => $data_count]) }}
  </div>
  <div class="col-md-6">
  		{{ $data_list->links('auth.common.paging', ['paging' => $paging]) }}
  </div>
</div>
<div class="box-body">
	{!! Utils::generateList($config, $name, $data_list) !!}
</div>
<div class="box-footer clearfix">
	{{ $data_list->links('auth.common.paging', ['paging' => $paging]) }}
</div>

