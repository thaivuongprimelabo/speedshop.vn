@if($categories->count())
<aside class="aside-item sidebar-category collection-category">
	<div class="aside-title">
		<h2 class="title-head margin-top-0"><span>{{ trans('shop.category_txt') }}</span></h2>
	</div>
	<div class="aside-content">
		<div class="nav-category navbar-toggleable-md">
			<ul class="nav navbar-pills">
				@foreach($categories as $category)
				@php
					$childCategories = $category->getChildCategory();
				@endphp
				@if($childCategories->count())
				<li class="nav-item okactive">
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					<a href="{{ $category->getLink() }}" class="nav-link">{{ $category->getName() }}</a>
					<i class="fa fa-angle-down"></i>
					<ul class="dropdown-menu">
						@foreach($childCategories as $child)
							<li class="dropdown-submenu nav-item">
								<a class="nav-link" href="{{ $child->getLink() }}">{{ $child->getName() }} </a>
								@php
									$childCategories1 = $child->getChildCategory();
								@endphp
								@if($childCategories1->count())
								<i class="fa fa-angle-down"></i>
								<ul class="dropdown-menu">
								@foreach($childCategories1 as $child1)
								<li class="dropdown-submenu nav-item">
									<a class="nav-link" href="{{ $child1->getLink() }}">{{ $child1->getName() }} </a>
								</li>
								@endforeach
								</ul>
								@endif
							</li>
						@endforeach
					</ul>
				</li>
				@else
				<li class="nav-item">
					<i class="fa fa-arrow-circle-right"></i>
					<a class="nav-link" href="{{ $category->getLink() }}">{{ $category->getName() }}</a>
				</li>
				@endif
				@endforeach
				<li class="xemthem  nav-item">
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					<a class="nav-link" href="javascript:void(0)">
						<span> Xem thêm</span>			
					</a> 
				</li>
				<li class="thugon  nav-item">
					<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
					<a class="nav-link" href="javascript:void(0)">
						<span> Rút gọn</span>			
					</a> 
				</li>
			</ul>
		</div>
	</div>
</aside>
@endif