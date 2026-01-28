@if ($pages->hasPages())
    <ul class="pagination">
        {{-- Əvvəlki Səhifə --}}
        @if ($pages->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&lt;</span></li>
        @else
            <li class="page-item">
                <a class="page-link"
                   href="{{ route($routeName, ['page' => $pages->currentPage() - 1]) }}">&lt;</a>
            </li>
        @endif

        {{-- Səhifə Nömrələri --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ $page == $pages->currentPage() ? 'active' : '' }}">
                        @if($page == $pages->currentPage())
                            {{-- Əgər cari səhifədəyiksə, linki deaktiv edə bilərik ki, təkrar kliklənməsin --}}
                            <span class="page-link">{{ $page }}</span>
                        @else
                            <a class="page-link" href="{{ route($routeName, ['page' => $page]) }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Növbəti Səhifə --}}
        @if ($pages->hasMorePages())
            <li class="page-item">
                <a class="page-link"
                   href="{{ route($routeName, ['page' => $pages->currentPage() + 1]) }}">&gt;</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">&gt;</span></li>
        @endif
    </ul>
@endif
