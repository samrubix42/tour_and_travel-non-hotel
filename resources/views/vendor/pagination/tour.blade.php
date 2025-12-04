@if ($paginator->hasPages())
<div class="row">
    <div class="col-12 mt-6 d-flex justify-content-center">

        <ul class="pagination pagination-style-01 fs-13 mb-0 fw-500"
            data-anime='{"translate":[0,0],"opacity":[0,1],"duration":600,"delay":50,"staggervalue":150,"easing":"easeOutQuad"}'>

            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link">
                        <i class="feather icon-feather-arrow-left fs-18 text-dark-gray d-xs-none"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled">
                        <i class="feather icon-feather-arrow-left fs-18 text-dark-gray d-xs-none"></i>
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                {{-- "..." separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link">{{ sprintf('%02d', $page) }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                   wire:click="gotoPage({{ $page }})"
                                   wire:loading.attr="disabled">
                                   {{ sprintf('%02d', $page) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled">
                        <i class="feather icon-feather-arrow-right fs-18 text-dark-gray d-xs-none"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link">
                        <i class="feather icon-feather-arrow-right fs-18 text-dark-gray d-xs-none"></i>
                    </a>
                </li>
            @endif

        </ul>

    </div>
</div>
@endif
