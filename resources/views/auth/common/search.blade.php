@php
	$f = trans('auth.' . $name);
@endphp
@if(isset($f['search_form']))
@php
	$form = $f['search_form'];
@endphp
<div class="box">
    <!-- Box Body -->
    <div class="box-body">
        <form id="search_form">
                <div class="form-group">
                  @foreach($form as $key=>$value)
                  @php
                  	$placeholder = isset($value['placeholder']) ? $value['placeholder'] : '';
                  	$table = isset($value['table']) ? $value['table'] : '';
                  	$emptyText = isset($value['empty_text']) ? $value['empty_text'] : trans('auth.select_empty_text');
                  @endphp
                  @if($value['type'] == 'text')
                  	<div class="col-md-3">
                        <div class="form-group has-feedback">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                          <input type="text" class="form-control" name="{{ $key }}" id="{{ $key }}" placeholder="{{ $placeholder }}" />
                          </div>
                          
                        </div>
                     </div>
                  @endif
                  
                  @if($value['type'] == 'calendar')
                  	<div class="col-md-3">
                        <div class="form-group has-feedback">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" id="datepicker" class="form-control" name="{{ $key }}" id="{{ $key }}" placeholder="{{ $placeholder }}" />
                          </div>
                          
                        </div>
                     </div>
                  @endif
                  
                  @if($value['type'] == 'status_select')
                  	<div class="col-md-3">
                        <div class="form-group">
                          <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                          	<option value="">{{ $emptyText }}</option>
                          	{!! Status::createSelectList() !!}
                          </select>
                        </div>
                     </div>
                  @endif
                  
                  @if($value['type'] == 'data_select')
                  	<div class="col-md-3">
                        <div class="form-group">
                          <select class="form-control" name="{{ $key }}" id="{{ $key }}">
                          	<option value="">{{ $emptyText }}</option>
                          	{!! Utils::createSelectList($table) !!}
                          </select>
                        </div>
                     </div>
                  @endif
                  @endforeach
                </div>
                
                @php
                	$currentUrl = url()->current();
                	
                	$createUrl = $currentUrl . '/create';
                	$removeUrl = $currentUrl . '/remove';
                	$searchUrl = $currentUrl . '/search';
                	
                	$routes = Route::getRoutes();
                	$createRoute = Route::currentRouteName() . '_create';
                @endphp
                
                <div class="col-md-12 nopadding">
                	 @if($routes->hasNamedRoute($createRoute))
                     <div class="col-md-6">
                    	<div class="btn-group">
                        	<button type="button" id="create" class="btn btn-warning pull-left" onclick="window.location='{{ $createUrl }}'">{{ trans('auth.button.create') }}</button>
                     	</div>
                     </div>
                     <div class="col-md-6">
                    	<button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ $searchUrl }}">{{ trans('auth.button.search') }}</button>
                  	 </div>
                  	 @else
                  	 <div class="col-md-12">
                    	<button type="button" id="search" class="btn btn-primary pull-right" data-url="{{ $searchUrl }}">{{ trans('auth.button.search') }}</button>
                  	 </div>
                     @endif
                 	 
                </div>
         </form>
     </div>
 </div>
 @endif