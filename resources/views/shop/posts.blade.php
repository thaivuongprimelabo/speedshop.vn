@extends('layouts.shop')

@section('content')
@include('shop.common.breadcrumb')
<div class="container">
	<div class="row">
		<section class="right-content col-md-9 col-md-push-3">			
			<div class="box-heading relative">
				<h1 class="title-head page_title">{{ $title }}</h1>
			</div>
			<section class="list-blogs blog-main">
            	<div class="row">
            		<div id="ajax_list">
            		</div>	
            	</div>
			</section>
			<div id="ajax_paging">
			</div>
		</section>
		<aside class="dqdt-sidebar sidebar left left-content col-lg-3 col-lg-pull-9">
			{!! Utils::createSidebarShop('postgroups_list'); !!}
		</aside>
	</div>
</div>
<input type="hidden" id="id" value="{{ isset($data) ? $data->id : '' }}" />
<input type="hidden" id="page_name" value="{{ $page_name }}" />
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
    	var data = {
    		type : 'post',
    		async : true,
    		id: $('#id').val(),
    		page_name: $('#page_name').val(),
    		container: ['#ajax_list','#ajax_paging'],
    		spinner: '#ajax_list',
    		limit_product: '{{ $config['limit_post_show'] }}'
    	}
    
    	callAjax('{{ route('loadData') }}', data);

    	$(document).on('click', '.page-link', function(e) {
			var page_number = $(this).attr('data-page-number');
			callAjax('{{ route('loadData') }}?page=' + page_number, data, page_name);
    	});

    })
</script>
@endsection