@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div class="row">
		<div class="col-lg-12 ">
			<h3 class="title-head a-center"><a href="{{ route('account_login') }}">{{ trans('shop.active_account_success') }}</a></h3>
		</div>
	</div>
</div>
@endsection