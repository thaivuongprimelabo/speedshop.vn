@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div class="row">
		<div class="col-lg-12 ">
			<h3 class="title-head a-center">{!!trans('shop.unactive_account_failed') !!}</h3>
		</div>
	</div>
</div>
@endsection