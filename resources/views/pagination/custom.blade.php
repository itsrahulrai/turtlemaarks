@if ($paginator->hasPages())
<nav>
    <ul class="pagination justify-content-end gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link rounded text-white" style="background-color:#314E52;">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link rounded text-white" href="{{ $paginator->previousPageUrl() }}" style="background-color:#314E52;">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link rounded text-muted">{{ $element }}</span>
                </li>
            @endif

            {{-- Array of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item">
                            <span class="page-link rounded fw-bold text-white" style="background-color:#AF905F;">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded text-dark" href="{{ $url }}" 
                               style="background-color:#f0f0f0;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link rounded text-white" href="{{ $paginator->nextPageUrl() }}" style="background-color:#314E52;">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link rounded text-white" style="background-color:#314E52;">&raquo;</span>
            </li>
        @endif
    </ul>
</nav>

<style>
    .pagination .page-link {
        transition: all 0.3s ease;
        border: none;
        min-width: 38px;
        min-height: 38px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .pagination .page-link:hover:not(.disabled):not(.active) {
        background-color: #AF905F !important;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .pagination .page-item.active .page-link {
        background-color: #AF905F !important;
        color: #fff !important;
    }
</style>
@endif
