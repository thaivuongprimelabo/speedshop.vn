<section class="awe-section-1" id="awe-section-1">
	<div class="section_category_slider">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-md-push-3 px-md-4 px-0 mt-md-5 mb-5">
					@if($banners->count())
    				<div class="home-slider owl-carousel" data-lg-items='1' data-md-items='1' data-sm-items='1' data-xs-items="1" data-margin='0'  data-nav="true">
    					@foreach($banners as $banner)
    					<div class="item">
    						@if($banner->select_type == 'use_image')
    						<a href="{{ $banner->link }}" class="clearfix" target="_blank">
    							<img src="{{ Utils::getImageLink($banner->banner) }}" class="img-thumbnail" style="width:{{ $config['banners_width'] }}px; height:{{ $config['banners_height'] }}px" />
    						</a>
    						@else
    						<iframe src="https://www.youtube.com/embed/{{ $banner->youtube_id }}" frameborder="0" allowfullscreen style="width:{{ $config['banners_width'] }}px; height:{{ $config['banners_height'] }}px"></iframe>
    						@endif
    					</div>
    					@endforeach
    				</div><!-- /.products -->
    				@endif
    			</div>
    			
    			<div class="col-md-3 col-md-pull-9 mt-5 hidden-xs aside-vetical-menu">
    				{!! Utils::createSidebarShop('category_list'); !!}
    			</div>
			</div>
		</div>
	</div>
</section>