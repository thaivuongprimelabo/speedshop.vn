Xin chào, {{ $name }}<br/>
@yield('content')
<hr/>
<b>{{ $config['web_name'] }}</b><br/>
@php
	$branch = explode('|', $config['web_address'])
@endphp
@if(count($branch))
@foreach($branch as $key=>$address)
<b>{{ trans('shop.branch_txt',['stt' => ++$key]) }}:</b> {{ $address }}<br/>
@endforeach
@endif
@php
	$hotline = explode('|', $config['web_hotline']);
	$hotline_cskh = explode('|', $config['web_hotline_cskh']);
@endphp
<b>Hotline mua hàng và tư vấn kĩ thuật:</b><br/>
@if(count($hotline))
@foreach($hotline as $tel)
{{ $tel }}<br/>
@endforeach
@endif
<b>Hotline CSKH:</b><br/>
@if(count($hotline_cskh))
@foreach($hotline_cskh as $tel)
{{ $tel }}<br/>
@endforeach
@endif
<b>Email:</b> {{ $config['web_email'] }}<br/>
<b>Giờ làm việc:</b> {{ $config['web_working_time'] }}<br/>