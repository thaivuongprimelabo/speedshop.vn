<section class="content-header">
  <h1>
  	@php
  		$title = trans('auth.' . $name . '.create_title');
  		if(isset($data) && $data->id) {
  			$title =  trans('auth.' . $name . '.edit_title');
  		}
  	@endphp
    {{ $title }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_' . $name) }}">{{ trans('auth.' . $name . '.list_title') }}</a></li>
    <li class="active">{{ $title }}</li>
  </ol>
</section>