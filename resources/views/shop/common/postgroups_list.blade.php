@if($postGroups->count())
<aside class="aside-item sidebar-category collection-category">
	<div class="aside-title">
		<h2 class="title-head margin-top-0"><span>{{ trans('shop.postgroups_txt') }}</span></h2>
	</div>
	<div class="aside-content">
		<div class="nav-category navbar-toggleable-md">
			<ul class="nav navbar-pills">
				@foreach($postGroups as $group)
				<li class="nav-item">
					<i class="fa fa-arrow-circle-right"></i>
					<a class="nav-link" href="{{ $group->getLink() }}">{{ $group->getName() }}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</aside>
@endif