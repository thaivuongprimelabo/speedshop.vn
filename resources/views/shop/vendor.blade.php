@extends('layouts.shop')

@section('content')
<div class="container">
	<div id="main" class="col-md-12">
		<div class="store-filter clearfix">
			<div class="pull-right paging_link">
			</div>
		</div>
		<div id="product_block" class="row">
			
		</div>
		<div class="store-filter clearfix">
			<div class="pull-right paging_link">
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var current_url = window.location.href.split('/');
		var data = {
			type : 'post',
			async : false,
			page_name: 'vendor-page',
			slug: current_url[current_url.length - 1].replace('{{ $config['url_ext'] }}', ''),
			container: '#product_block',
			paging: '.paging_link',
			limit_product: '{{ $config['limit_product_show'] }}'
		}

		loadProducts('{{ route('loadData') }}', data);

		$(document).on('click', '.page-number', function(e) {
			var page = $(this).attr('data-page');
			loadProducts('{{ route('loadData') }}?page=' + page, data);
		});
	})
</script>
@endsection
