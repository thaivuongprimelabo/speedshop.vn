@if($vendors->count())
<section class="awe-section-10" id="awe-section-10">
	<div class="section section-brand mb-5">
		<div class="container">
    		<div class="section-title a-center">
    			<h2><a href="javascript:void(0)">{{ trans('shop.vendor_txt') }}</a></h2>			
    		</div>
			<div class="owl-carousel owl-theme" data-lg-items="6" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xss-items="2" data-margin="30">
				@foreach($vendors as $vendor)
				<div class="brand-item">
    				<a href="{{ $vendor->getLink() }}" class="img25" title="{{ $vendor->getName() }}"><img src="{{ $vendor->getLogo() }}"  alt="{{ $vendor->getName() }}" >
    				</a>
    			</div>
    			@endforeach	
			</div>
		</div>
	</div>
</section>
@endif