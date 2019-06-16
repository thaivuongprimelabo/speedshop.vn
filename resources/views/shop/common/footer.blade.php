@php
	$subFooter = Utils::createNavigation('sub_footer');
@endphp
<footer class="footer">
	<div class="content">
		<div class="site-footer">

			<div class="footer-inner padding-top-35 pb-lg-5">
				<div class="container">
					<div class="row">

						<div class="col-xs-12 col-sm-6 col-lg-4">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.main_nav.contact.text') }}</span></h3>
									
								<ul class="list-menu list-showroom">		 						
									<li class="clearfix"><i class="block_icon fa fa-home"></i>
										<p><b>{{ $config['web_name'] }}</b></p>
									</li>
									<li class="clearfix"><i class="block_icon fa fa-map-marker"></i>
										@php
											$branch = explode('|', $config['web_address'])
										@endphp
										@if(count($branch))
										@foreach($branch as $key=>$address)
										<p>
											<b>{{ trans('shop.branch_txt',['stt' => ++$key]) }}:</b> {{ $address }}
										</p>
										@endforeach
										@endif
									</li>
									@php
                                    	$hotline = explode('|', $config['web_hotline']);
                                    	$hotline_cskh = explode('|', $config['web_hotline_cskh']);
                                    @endphp
									<li class="clearfix"><i class="block_icon fa fa-phone"></i>
										<p><b>{{ trans('shop.hotline_tech_txt') }}</b></p>
										@if(count($hotline))
										@foreach($hotline as $tel)
										<p><a href="tel:{{ $tel }}">{{ $tel }}</a></p>
										@endforeach
										@endif
									</li>
									<li class="clearfix"><i class="block_icon fa fa-phone"></i>
										<p><b>{{ trans('shop.hotline_cskh_txt') }}</b></p>
										@if(count($hotline_cskh))
										@foreach($hotline_cskh as $tel)
										<p><a href="tel:{{ $tel }}">{{ $tel }}</a></p>
										@endforeach
										@endif
									</li>
									<li class="clearfix"><i class="block_icon fa fa-envelope"></i>
										<a href="mailto:{{ $config['web_email'] }}">{{ $config['web_email'] }}</a>
									</li>
									<li class="clearfix"><i class="block_icon fa fa-clock-o"></i>
										<p>{!! $config['web_working_time'] !!}</p>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-2">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.category_txt') }}</span></h3>
								{!! $subFooter !!}
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.policy.title') }}</span></h3>
								<ul class="list-menu list-blogs">
									<li>
										<a href="{{ route('guarantee_policy') }}" >{{ trans('shop.policy.guarantee_txt') }}</a>
									</li>
									<li>
										<a href="{{ route('shipment_policy') }}" >{{ trans('shop.policy.shipment_txt') }}</a>
									</li>
								</ul>
							</div>
						</div>


						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="footer-widget">
								<h3 class="hastog"><span>{{ trans('shop.social_txt') }}</span></h3>
								<ul class="list-menu">
									<li>
										<a href="https://www.facebook.com/sharer.php?u={{ route('home') }}" target="_blank" title="Facebook"><img src="{{ url('shop/facebook_icon.png') }}" style="width:50px; height:50px" /></a>
										<a href="{{ $config['youtube_channel'] }}" target="_blank" title="Youtube"><img src="{{ url('shop/youtube_icon.png') }}" style="width:50px; height:50px" /></a>
										<a href="{{ $config['zalo_page'] }}" target="_blank" title="Zalo"><img src="{{ url('shop/zalo_logo.png') }}" style="width:56px; height:56px" /></a>
										<a href="{{ $config['shopee_page'] }}" target="_blank" title="Shopee"><img src="{{ url('shop/shopee_icon.png') }}" style="width:50px; height:50px" /></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="copyright clearfix">
				<div class="container">
					<div class="inner clearfix">
						<div class="row">
							<div class="col-md-4 text-center text-lg-left">
								{!! $config['footer_text'] !!}
							</div>
							<div class="col-md-8 text-center text-lg-right hidden-xs">
								{!! Utils::createNavigation('footer') !!}
							</div>

						</div>
					</div>
					
					<div class="back-to-top">
						<i class="fa  fa-angle-up"></i>
					</div>
					
					@if(count($hotline))
					<a href="tel:{{ $hotline[0] }}" class="suntory-alo-phone bottom-left  suntory-alo-green " id="suntory-alo-phoneIcon">

						<div class="suntory-alo-ph-img-circle"><i class="fa fa-phone"></i></div>
					</a>
					@endif
				</div>
			</div>
		</div>

	</div>
</footer>