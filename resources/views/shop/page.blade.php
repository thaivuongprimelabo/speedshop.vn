@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="content-page rte">
					{!! $page->content !!}
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
