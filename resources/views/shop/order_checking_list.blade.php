	<table class="table table-bordered">
		<thead>
			<tr>
				<col width="5%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="15%" />
				<th>#</th>
				<th>{{ trans('shop.order_checking.customer') }}</th>
				<th>{{ trans('shop.order_checking.phone') }}</th>
				<th>{{ trans('shop.order_checking.email') }}</th>
				<th>{{ trans('shop.order_checking.address') }}</th>
				<th>{{ trans('shop.order_checking.total') }}</th>
				<th>{{ trans('shop.order_checking.status') }}</th>
			</tr>
		</thead>
		<tbody>
			@if($orders->count())
			@foreach($orders as $order)
			<tr>
				<td>{{ $order->id }}</td>
				<td>{{ $order->customer_name }}</td>
				<td>{{ $order->customer_phone }}</td>
				<td>{{ $order->customer_email }}</td>
				<td>{{ $order->getAddress() }}</td>
				<td>{{ $order->getTotal() }}</td>
				<td>{{ $order->getStatus() }}</td>
			</tr>
			@endforeach
			@else
			<tr>
				<td colspan="7">{{ trans('shop.order_checking.no_data') }}</td>
			</tr>
			@endif
		</tbody>
	</table>
