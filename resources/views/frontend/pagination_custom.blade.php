@if ($paginator->hasPages())
    <ul class="pagination justify-content-center mb-0">
       
        @if ($paginator->onFirstPage())
              <li class="page-item disabled"><a class="page-link prev" href="{!! $paginator->previousPageUrl() !!}" rel="prev"> <i class="simple-icon-arrow-left"></i></a></li>
        @else
            <li class="page-item"><a class="page-link prev" href="{!! $paginator->previousPageUrl() !!}" rel="prev"> <i class="simple-icon-arrow-left"></i></a></li>
        @endif


        
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="page-item disabled"><span>{!! $element !!}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a  class="page-link" href="{!! $url !!}">{!! $page !!}</a></li>
                    @else
                         <li class="page-item"><a  class="page-link" href="{!! $url !!}">{!! $page !!}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


       
        @if ($paginator->hasMorePages())
            <li class="page-item">
				 <a class="page-link next" href="{!! $paginator->nextPageUrl() !!}" aria-label="Next" rel="next">
					<i class="simple-icon-arrow-right"></i>
				</a>
			</li>
        @else
            <li class="page-item disabled">
				 <a class="page-link next" href="{!! $paginator->nextPageUrl() !!}" aria-label="Next" rel="next">
					<i class="simple-icon-arrow-right"></i>
				</a>
			</li>
        @endif
    </ul>
@endif