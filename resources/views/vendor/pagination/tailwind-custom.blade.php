
@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-center space-x-2 mt-4">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 mt-4 text-gray-400 bg-gray-200 dark:bg-gray-700 rounded-md cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-4 py-2 mt-4 text-gray-700 dark:text-white bg-white dark:bg-slate-950 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">&laquo;</a>
        @endif

        {{-- Nomor Halaman --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $start = max(1, $currentPage - 2);
            $end = min($lastPage, $currentPage + 3);
        @endphp

        {{-- Tampilkan Halaman Pertama jika Tidak Termasuk dalam Rentang --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="px-4 py-2 mt-4 text-gray-700 dark:text-white bg-white dark:bg-slate-950 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">1</a>
            @if ($start > 2)
                <span class="px-4 py-2 mt-4 text-gray-400">...</span>
            @endif
        @endif

        {{-- Looping Nomor Halaman --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $currentPage)
                <span class="px-4 py-2 mt-4 text-white bg-blue-500 border border-blue-500 rounded-md">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" 
                   class="px-4 py-2 mt-4 text-gray-700 dark:text-white bg-white dark:bg-slate-950 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">{{ $i }}</a>
            @endif
        @endfor

        {{-- Tampilkan Halaman Terakhir jika Tidak Termasuk dalam Rentang --}}
        @if ($end < $lastPage)
            @if ($end < $lastPage - 1)
                <span class="px-4 py-2 mt-4 text-gray-400">...</span>
            @endif
            <a href="{{ $paginator->url($lastPage) }}" class="px-4 py-2 mt-4 text-gray-700 dark:text-white bg-white dark:bg-slate-950 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">{{ $lastPage }}</a>
        @endif

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-4 py-2 mt-4 text-gray-700 dark:text-white bg-white dark:bg-slate-950 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">&raquo;</a>
        @else
            <span class="px-4 py-2 mt-4 text-gray-400 bg-gray-200 dark:bg-gray-700 rounded-md cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
@endif
