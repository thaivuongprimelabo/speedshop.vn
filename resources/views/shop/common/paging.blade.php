@if ($paginator->hasPages())
    <div class="shop-pag text-center">
    	<nav>
          <ul class="pagination clearfix">
            	<li class="page-item text hidden-xs text"><a class="page-link" href="javascript:void(0)" data-page-number="1"><i class="fa fa-angle-left"></i></a></li>
            	@foreach ($elements as $element)
            	@if (is_string($element))
                    <li class="active page-item disabled"><span>{{ $element }}</span></li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                	@foreach ($element as $page => $url)
                		 @if ($page == $paginator->currentPage())
                		 	<li class="active page-item disabled"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                		 @else
                		 	<li class="page-item"><a class="page-link" data-page-number="{{ $page }}" href="javascript:void(0)">{{ $page }}</a></li>
                		 @endif
                	@endforeach
                @endif
        		
        		@endforeach
            	<li class="page-item hidden-xs text"><a class="page-link" data-page-number="{{ $paginator->lastPage() }}" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
          </ul>
    	</nav>
    </div>
@endif