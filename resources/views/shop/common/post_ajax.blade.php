@if($data->count())
@foreach($data as $post)
<div class="col-xs-12">
	<article class="blog-item">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="blog-item-thumbnail">						
					<a href="{{ $post->getLink() }}">
						<img src="{{ $post->getImage() }}" alt="{{ $post->getTitle() }}">
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8">
				<div class="blog-item-info">
					<h3 class="blog-item-name"><a href="{{ $post->getLink() }}">{{ $post->getTitle() }}</a></h3>
					<div class="post-time">							
						<div class="inline-block">{{ $post->getCreatedAt() }}
						</div>
					</div>
					<p class="blog-item-summary"> {!! $post->getSummary() !!}</p>
				</div>
			</div>
		</div>
	</article>
</div>
@endforeach
@endif