@if(isset($details))
@foreach($details as $key=>$service)
@php
	$names = explode(',', $service->service_names);
    $prices = explode(',', $service->service_prices);
@endphp
<table class="table box table-bordered table-responsive toy-item" data-index="{{ $key }}" data-row-index="{{ count($names) - 1 }}">
    <thead style="cursor: pointer;">
      <tr>
        <th colspan="2">{{ $service->group_name }}
        	<input type="hidden" name="service[{{ $key }}][group_name]" class="service-group-name" value="{{ $service->group_name }}" />
        </th>
        <th>
        	<button type="button" class="btn btn-danger btn-xs remove-group" title="Remove group"><span class="glyphicon glyphicon-remove"></span> {{ trans('auth.button.remove') }}</button>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($names as $k=>$service_name)
      @php
      	$row_index = $k;
      @endphp
      @include('auth.products.detail_row',['service_name' => $service_name, 'service_price' => $prices[$k]])
      @endforeach
      <tr class="add-item">
        <td colspan="8">  <button type="button" class="btn btn-sm btn-success add-service-item" title="Add new item"><i class="fa fa-plus"></i> {{ trans('auth.button.add_item') }}</button></td>
      </tr>
      <tr></tr>
    </tbody>
</table>

@endforeach
@else
<table class="table box table-bordered table-responsive toy-item" data-index="-1" data-row-index="-1">
    <thead style="cursor: pointer;">
      <tr>
        <th colspan="2"><span class="service-group-name-title"></span>
        	<input type="hidden" name="" class="service-group-name" value="" /></th>
        <th>
        	<button type="button" class="btn btn-danger btn-xs remove-group" title="Remove group"><span class="glyphicon glyphicon-remove"></span> {{ trans('auth.button.remove') }}</button>
        </th>
      </tr>
    </thead>
    <tbody>
      @include('auth.products.detail_row',['class' => 'hide_element'])
      <tr class="add-item">
        <td colspan="8">  <button type="button" class="btn btn-sm btn-success add-service-item" title="Add new item"><i class="fa fa-plus"></i> {{ trans('auth.button.add_item') }}</button></td>
      </tr>
      <tr></tr>
    </tbody>
</table>
@endif