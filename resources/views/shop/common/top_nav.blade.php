@php
	$mainNav = trans('shop.main_nav');
@endphp
<ul class="nav nav-left">
	@foreach($mainNav as $route=>$nav)
		@if($route == 'products')
			<li class="nav-item  has-mega">
				<a href="{{ route($route) }}" class="nav-link">{{ $nav['text'] }} <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>			
				<div class="mega-content">
                    <div class="level0-wrapper2">
                       <div class="nav-block nav-block-center">
                       	   @if($categories->count())
                		   <ul class="level0">
                		   	   @foreach($categories as $category)
                			   
                			   <li class="level1 parent item"> <h2 class="h4"><a href="{{ $category->getLink() }}"><span>{{ $category->getName() }}</span></a></h2> 
                				   @php $childCategories = $category->getChildCategory(); @endphp
                				   <ul class="level1">
                					   @foreach($childCategories as $child)
                					   <li class="level2"> <a href="{{ $child->getLink() }}"><span>{{ $child->getName() }}</span></a> </li>
                					   @endforeach
                				   </ul>
                			   </li>
                			   @endforeach
                		   </ul>
                		   @endif
                	   </div>
                	 </div>
                </div>
			</li>
		@elseif($route == 'posts')
			<li class="nav-item ">
				<a href="{{ route($route) }}" class="nav-link">{{ $nav['text'] }} <i class="fa fa-angle-right" data-toggle="dropdown"></i></a>			
				@if($postGroups->count())
				<ul class="dropdown-menu">
					@foreach($postGroups as $group)
					<li class="nav-item-lv2">
						<a class="nav-link" href="{{ $group->getLink() }}">{{ $group->getName() }}</a>
					</li>
					@endforeach
				</ul>
				@endif
			</li>
		@else
			<li class="nav-item @if($route == 'home'){{'active'}}@endif"><a class="nav-link" href="{{ route($route) }}">{{ $nav['text'] }}</a></li>
		@endif
	@endforeach
</ul>