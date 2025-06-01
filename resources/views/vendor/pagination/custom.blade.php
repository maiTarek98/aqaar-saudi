
@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="next"> <span aria-hidden="true">
                      <i class="fa-solid fa-chevron-right"></i>
                    </span></a></li>

            @foreach ($elements as $element)

                @if (is_string($element))

                    <li class="current page-item"><strong>{{ $element }}</strong></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="current page-item"><a class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><span aria-hidden="true">
                      <i class="fa-solid fa-chevron-left"></i>
                    </span>
                </a></li>
            @else
                <li class="page-item"><strong><span aria-hidden="true">
                      <i class="fa-solid fa-chevron-left"></i>
                    </span></strong></li>
            @endif
        </ul>
    </nav>
@endif
