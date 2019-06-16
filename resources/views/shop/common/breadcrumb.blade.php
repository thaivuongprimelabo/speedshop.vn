<section class="bread_crumb py-4">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul class="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">	

					<li class="home">
						<a itemprop="url" href="/"><span itemprop="title">{{ trans('shop.main_nav.home.text') }}</span></a>						
						<span> <i class="fa fa-angle-right"></i> </span>
					</li>
					@foreach($breadcrumbs as $key=>$item)
					@if($key == (count($breadcrumbs) - 1))
					<li><strong><span itemprop="title">{{ $item['text'] }}</span></strong></li><li>
					@else
					<li>
						<a itemprop="url" href="{{ $item['link'] }}"><span itemprop="title">{{ $item['text'] }}</span></a>						
						<span> <i class="fa fa-angle-right"></i> </span>
					</li>
					@endif
					@endforeach
				</li></ul>
			</div>
		</div>
	</div>
</section>