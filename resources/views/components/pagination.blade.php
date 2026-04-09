@if ($paginator->hasPages())
    <nav class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="flex items-center justify-center w-9 h-9 rounded-full text-black/20">
                <i class="size-4" data-lucide="chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="flex items-center justify-center w-9 h-9 rounded-full text-black/60 hover:bg-(--third-color) hover:text-white transition-all duration-200">
                <i class="size-4" data-lucide="chevron-left"></i>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="flex items-center justify-center w-9 h-9 text-black/30 text-sm">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-(--third-color) text-white text-sm font-semibold shadow-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="flex items-center justify-center w-9 h-9 rounded-full text-black/60 hover:bg-(--third-color)/10 text-sm font-medium transition-all duration-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="flex items-center justify-center w-9 h-9 rounded-full text-black/60 hover:bg-(--third-color) hover:text-white transition-all duration-200">
                <i class="size-4" data-lucide="chevron-right"></i>
            </a>
        @else
            <span class="flex items-center justify-center w-9 h-9 rounded-full text-black/20">
                <i class="size-4" data-lucide="chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
