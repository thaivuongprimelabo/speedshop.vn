@php
	$mainNav = trans('shop.main_nav');
@endphp
<ul id="nav-mobile" class="nav hidden-md hidden-lg">
	<li class="h3">
		MENU
	</li>
	@foreach($mainNav as $route=>$nav)
		@if($route == 'products')
		<li class="nav-item ">
			<a href="{{ route($route) }}" class="nav-link">{{ $nav['text'] }} <i class="fa faa fa-angle-right"></i></a>
			@if($categories->count())
			<ul class="dropdown-menu">
				@foreach($categories as $category)
				<li class="dropdown-submenu nav-item-lv2">
					<a class="nav-link" href="{{ $category->getLink() }}">{{ $category->getName() }} <i class="fa faa fa-angle-right"></i></a>
					@php $childCategories = $category->getChildCategory(); @endphp
					<ul class="dropdown-menu">
						@foreach($childCategories as $child)
						<li class="nav-item-lv3">
							<a class="nav-link" href="{{ $child->getLink() }}">{{ $child->getName() }}</a>
						</li
						@endforeach>						
					</ul>                      
				</li>
				@endforeach
			</ul>
			@endif
		</li>
		@elseif($route == 'posts')
		<li class="nav-item ">
			<a href="{{ route($route) }}" class="nav-link">{{ $nav['text'] }} <i class="fa faa fa-angle-right"></i></a>
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
		<li class="nav-item "><a class="nav-link" href="{{ route($route) }}">{{ $nav['text'] }}</a></li>
		@endif
	@endforeach
</ul>