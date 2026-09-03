@if ($paginator->hasPages())
    <nav class="tm-pagination-nav d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination tm-pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="tm-pagination-summary">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination tm-pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="bi bi-chevron-left"></i></a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{--
        Self-contained theme: this same view is shared by the light storefront
        (public/frontend-assets/css/style.css, --tm-* vars) and the dark admin
        panel (public/assets/css/admin.css, --admin-* vars), so every color
        falls back through both var sets before a hard-coded brand value —
        whichever stylesheet is actually loaded on the page wins.
    --}}
    <style>
        .tm-pagination-nav {
            --pg-navy:   var(--tm-navy, var(--admin-primary, #0c3c64));
            --pg-orange: var(--tm-orange, var(--admin-accent, #ff9501));
            --pg-text:   var(--tm-text, var(--admin-text, #263746));
            --pg-muted:  var(--tm-muted, var(--admin-muted, #7a8794));
            --pg-border: var(--tm-border, var(--admin-border, #e5eaee));
            --pg-hover:  var(--tm-orange-light, var(--admin-light, #fff3e2));
            margin-top: .5rem;
        }

        .tm-pagination-summary { font-size: .82rem; color: var(--pg-muted); margin: 0; }
        .tm-pagination-summary .fw-semibold { color: var(--pg-text); }

        .tm-pagination { gap: 6px; }

        .tm-pagination .page-item .page-link {
            border: 1.5px solid var(--pg-border);
            color: var(--pg-navy);
            background: transparent;
            border-radius: 10px;
            min-width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: .85rem;
            margin: 0;
            transition: all .2s ease;
        }

        .tm-pagination .page-item:not(.disabled):not(.active) .page-link:hover {
            border-color: var(--pg-orange);
            background: var(--pg-hover);
            color: var(--pg-orange);
        }

        .tm-pagination .page-item.active .page-link {
            background: var(--pg-navy);
            border-color: var(--pg-navy);
            color: #fff;
            box-shadow: 0 4px 12px rgba(12, 60, 100, .25);
        }

        .tm-pagination .page-item.disabled .page-link {
            color: var(--pg-muted);
            border-color: var(--pg-border);
            opacity: .55;
        }

        .tm-pagination .page-item .page-link:focus {
            box-shadow: 0 0 0 3px rgba(255, 149, 1, .25);
        }
    </style>
@endif
