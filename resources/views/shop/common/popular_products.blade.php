@if($products->count())
<div class="aside-item aside-mini-list-product mb-5">
	<div>
		<div class="aside-title">
			<h2 class="title-head">
				<a href="{{ route('popularProducts') }}" title="{{ trans('shop.popular_txt') }}">{{ trans('shop.popular_txt') }}</a>
			</h2>
		</div>
		<div class="aside-content related-product">
			<div class="product-mini-lists">											
				<div class="products">					
					@foreach($products as $product) 					
					<div class="row row-noGutter">						
						<div class="col-sm-12">
                            <div class="product-mini-item clearfix  ">
                            	<div class="product-img relative">
                            		<a href="{{ $product->getLink() }}">
                            			<img src="{{ $product->getFirstImage('medium') }}" alt="{{ $product->getName() }}">
                            		</a>
                            	</div>
                            	<div class="product-info">
                            		<h3><a href="{{ $product->getLink() }}" title="{{ $product->getName() }}" class="product-name">{{ $product->getName() }}</a></h3>
                            		<div class="price-box">
                            			<div class="special-price"><span class="price product-price">{{ $product->getPrice() }}</span> </div> <!-- Giá -->
                            		</div>
                            	</div>
                            </div>																
						</div>
					</div>
					@endforeach			
				</div><!-- /.products -->
			</div>
		</div>
	</div>
</div>
@endif