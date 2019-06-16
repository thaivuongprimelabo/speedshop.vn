@extends('layouts.shop')



@section('content')

@include('shop.common.breadcrumb')

<div class="container">

	<div class="row">

		<section class="right-content col-md-9 col-md-push-3">

			<article class="article-main">		

    			<div class="row">

    				<div class="col-lg-12">

    						<div class="article-details">

    							<h1 class="article-title"><a href="{{ $data->getLink() }}">{{ $data->getTitle() }}</a></h1>

    							<div class="post-time">

    								<label>Ngày đăng: {{ $data->getCreatedAt() }}</label> 

    								@include('shop.common.share_social')

    							</div>

    							<div class="article-image">

    								<a href="{{ $data->getLink() }}">

    									<img class="img-fluid" src="{{ $data->getPhoto() }}" alt="{{ $data->getTitle() }}">

    								</a>

    							</div>	

    							<div class="article-content">

    								<div class="rte">

    									{!! $data->getSummary() !!}

    									{!! $data->getContent() !!}

    								</div>

    							</div>

    						</div>

    						<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=135671569954053&autoLogAppEvents=1"></script>

    						<div class="fb-comments" data-href="{{ $data->getLink() }}" data-width="800" data-numposts="5"></div>

    					</div>

    			</div>

			</article>	

		</section>

		<aside class="dqdt-sidebar sidebar left left-content col-lg-3 col-lg-pull-9">

			{!! Utils::createSidebarShop('postgroups_list'); !!}

		</aside>

	</div>

</div>

@endsection

