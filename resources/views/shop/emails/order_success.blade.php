@php
	$checkout_info = $cart->getCheckoutInfo();
@endphp
Xin chào, {{ $checkout_info['customer_name'] }}<br/>
<br/>
Cảm ơn Anh/chị đã đặt hàng tại <b>{{ $web_name }}</b><br/>
<br/>
Đơn hàng của Anh/chị đã được tiếp nhận, chúng tôi sẽ nhanh chóng liên hệ với Anh/chị.<br/>
<hr/>
<b>Thông tin khách hàng</b><br/>
{{ $checkout_info['customer_name'] }}<br/>
{{ $checkout_info['customer_phone'] }}<br/>
{{ $checkout_info['customer_email'] }}<br/>
{{ $checkout_info['customer_address'] }} {{ $checkout_info['customer_district'] }} {{ $checkout_info['customer_province'] }}<br/>
<br/>
<b>Hình thức thanh toán</b><br/>
@php
	$payment_methods = trans('auth.payment_methods');
@endphp
{{ $payment_methods[$checkout_info['payment_method']] }}<br/>
<br/>
<b>Thông tin đơn hàng</b><br/>
Mã đơn hàng: #{{ $checkout_info['id'] }}<br/>
Ngày đặt hàng: {{ Utils::formatDate($checkout_info['created_at']) }}<br/>
<br/>
<table>
    <tbody>
    @foreach($cart->getCart() as $cartItem)
    	<tr >
    		<td style="padding:5px"><img src="{{ $cartItem->getImage() }}" width="55px" /></td>
    		<td style="padding:5px">{{ $cartItem->getName() }} x {{ $cartItem->getQty() }}</td>
    		<td style="padding:5px">{{ $cartItem->getCostFormat() }}</td>
    	</tr>
    	@foreach($cartItem->getDetailList() as $detail)
    	<tr>
    		<td style="padding:5px"></td>
    		<td style="padding:5px"><b>{{ $detail->getGroupName() }}:</b> {{ $detail->getName() }}</td>
    		<td style="padding:5px">{{ $detail->getCostFormat() }}</td>
    	</tr>
    	@endforeach
    @endforeach
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan="2" align="right"><b>{{ trans('shop.checkout.subtotal') }}</b></td>
    		<td>{{ $cart->getSubTotalFormat() }}</td>
    	</tr>
    	<tr>
    		<td colspan="2" align="right"><b>{{ trans('shop.checkout.ship') }}</b></td>
    		<td>{{ $cart->getShipFeeFormat() }}</td>
    	</tr>
    	<tr>
    		<td colspan="2" align="right"><b>{{ trans('shop.checkout.total') }}</b></td>
    		<td>{{ $cart->getTotalFormat() }}</td>
    	</tr>
    </tfoot>
</table><br/>
<b>Ghi chú:</b>{{ $checkout_info['customer_note'] }}<br/>
<br/>
Nếu Anh/chị có bất kỳ câu hỏi nào, xin liên hệ với chúng tôi tại <a href="mailto:{{ $web_email }}">{{ $web_email }}</a><br/>
<br/>
Trân trọng<br/>
<br/>
