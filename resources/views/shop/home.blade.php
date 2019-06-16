@extends('layouts.shop')
@section('content')
@include('shop.common.sidebar')
@php
	$limit_product = isset($config['limit_product_show_tab']) ? $config['limit_product_show_tab'] : 8;
@endphp
<section class="awe-section-3" id="awe-section-3">
	<div class="section section-collection section-collection-1">
		<div class="container">
			<div class="collection-border">
				<div class="collection-main">
						{!! Utils::createProductTab(trans('shop.new_product_txt'), ProductType::IS_NEW, $limit_product) !!}
				</div>
			</div>
		</div>
	</div>
</section>
<section class="awe-section-4" id="awe-section-4">
	<div class="section section-collection section-collection-1">
		<div class="container">
			<div class="collection-border">
				<div class="collection-main">
						{!! Utils::createProductTab(trans('shop.best_selling_txt'), ProductType::IS_BEST_SELLING, $limit_product) !!}
				</div>
			</div>
		</div>
	</div>
</section>
<section class="awe-section-5" id="awe-section-5">
	<div class="section section-collection section-collection-1">
		<div class="container">
			<div class="collection-border">
				<div class="collection-main">
						{!! Utils::createProductTab(trans('shop.popular_txt'), ProductType::IS_POPULAR, $limit_product) !!}
				</div>
			</div>
		</div>
	</div>
</section>
@if($posts->count())
<section class="awe-section-8" id="awe-section-8">	
	<div class="section section_blog">
		<div class="container">
    		<div class="section-title a-center">
    			<h2><a href="{{ route('posts') }}">{{ trans('shop.news_txt') }}</a></h2>			
    			<p>{!! trans('shop.news_short_txt') !!}</p>
    		</div>
    		<div class="section-content">
    			<div class="blog-slider owl-carousel" data-lg-items='3' data-md-items='3' data-sm-items='2' data-xs-items="2" data-nav="true">
    				@foreach($posts as $post)
    				<article class="blog-item text-center">
    					<div>
    						<div class="blog-item-thumbnail">						
    							<a href="{{ $post->getLink() }}">
    								
    								<img src="{{ $post->getImage() }}" alt="{{ $post->getTitle() }}">
    								
    							</a>
    						</div>
    						<div class="blog-item-info m-4">
    							<h3 class="blog-item-name"><a href="{{ $post->getLink() }}">{{ $post->getTitle() }}</a></h3>
    							<p class="blog-item-summary"> {!! $post->getSummary() !!}</p>
    							<a class="btn" href="{{ $post->getLink() }}">Chi tiết</a>
    
    						</div>
    					</div>
    				</article>
    				@endforeach
    			</div>
    		</div>
    	</div>
	</div>
</section>
@endif
{!! Utils::createVendorSection() !!}
@endsection
