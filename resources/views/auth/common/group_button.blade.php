@php
	$currentUrl = url()->current();
	
	$createUrl = $currentUrl . '/create';
	$removeUrl = $currentUrl . '/remove';
	$searchUrl = $currentUrl . '/search';
@endphp

<div class="col-md-12 nopadding">
    <div class="col-md-6">
    	<div class="btn-group">
        	<button type="button" id="create" class="btn btn-warning pull-left" onclick="window.location='{{ $createUrl }}'">{{ trans('auth.button.create') }}</button>
        	@if(isset($page))
        	<button type="button" id="remove_all" class="btn btn-danger pull-left" onclick="window.location='{{ $removeUrl }}'">{{ trans('auth.button.remove') }}</button>
     		@endif
     	</div>
     </div>
 	 <div class="col-md-6">
    	<button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ $searchUrl }}">{{ trans('auth.button.search') }}</button>
  	 </div>
</div>