@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-end space-x-1 mt-4 text-sm">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1.5 mt-4 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-3 py-1.5 mt-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">&laquo;</a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1.5 mt-4 text-gray-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 mt-4 text-white bg-slate-800 border border-slate-800 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" 
                           class="px-3 py-1.5 mt-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-3 py-1.5 mt-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">&raquo;</a>
        @else
            <span class="px-3 py-1.5 mt-4 text-gray-400 bg-gray-200 rounded-md cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
@endif
