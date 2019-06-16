@if($data->count())
<ul>
	@foreach($data as $product)
    <li>
    	<a href="{{ $product->getLink() }}" title="{{ $product->getName() }}">
    		<div class="item_image">
            	<img src="{{ $product->getFirstImage('small') }}" alt="{{ $product->getName() }}">
            </div>
            <div class="item_detail">
                    <div class="item_title">
                            <h4>{{ $product->getName() }}</h4>
                    </div>
                    <div class="item_price">
                            <ins>{{ $product->getPrice() }}</ins>
                    </div>
            </div>
         </a>
    </li>
    @endforeach
</ul>
@endif