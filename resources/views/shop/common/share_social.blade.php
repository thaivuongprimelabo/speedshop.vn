<div class="social-sharing">
    <div class="social-media" data-permalink="{{ $data->getLink() }}">
    	<label>{{ trans('shop.share_url') }}: </label>
    	
    	<a target="_blank" href="//www.facebook.com/sharer.php?u={{ $data->getLink() }}" class="share-facebook" title="Chia sẻ lên Facebook">
    		<i class="fa fa-facebook-official"></i>
    	</a>
    	<a target="_blank" href="//twitter.com/intent/tweet?url={{ $data->getLink() }}" class="share-twitter" title="Chia sẻ lên Twitter">
    		<i class="fa fa-twitter"></i>
    	</a>
    	<a target="_blank" href="//pinterest.com/pin/create/button/?url={{ $data->getLink() }}" class="share-pinterest" title="Chia sẻ lên pinterest">
    		<i class="fa fa-pinterest"></i>
    	</a>
    	<a target="_blank" href="//plus.google.com/share?url={{ $data->getLink() }}" class="share-google" title="+1">
    		<i class="fa fa-google-plus"></i>
    	</a>
    </div>
</div>