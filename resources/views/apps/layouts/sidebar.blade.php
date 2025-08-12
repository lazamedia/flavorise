<div id="sidebar" class="bg-white text-black w-64 fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 overflow-y-auto flex flex-col">
    <div class="flex items-center justify-between p-6 ">
        <h1 class="text-xl font-bold">Flavorise</h1>
        <button id="closeSidebar" class="lg:hidden text-black">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <nav class="mt-3 flex-1 flex flex-col">

        @php
            $userId = auth()->id() ?: optional(\App\Models\User::orderBy('id')->first())->id;
            $activeShift = $userId ? \App\Models\Shift::where('user_id', $userId)->active()->first() : null;
        @endphp

        <div class="flex items-center px-3 pb-4 gap-2 flex-col">
            @if($activeShift)
                <a href="{{ route('apps.pos.index') }}" class="bg-purple-200 border-2 border-purple-700 hover:bg-purple-300 hover:border-purple-500 font-bold text-purple-950 rounded w-full text-center py-3">
                POS - KASIR
            </a>
                <a href="{{ route('apps.shifts.close-form', $activeShift) }}" class="bg-gray-100 border border-gray-300 hover:bg-gray-200 text-gray-800 rounded w-full text-center py-2 text-sm">
                    Tutup Shift
                </a>
            @else
                <a href="{{ route('apps.shifts.create') }}" class="bg-purple-200 border-2 border-purple-700 hover:bg-purple-300 hover:border-purple-500 font-bold text-purple-950 rounded w-full text-center py-3">
                    Buka Shift
                </a>
            @endif
        </div>

        <a href="{{ route('apps.dashboard') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.dashboard') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.dashboard'))
            <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-regular fa-house mr-3"></i>
            <span class="font-semibold">Dashboard</span>
        </a>

        <a href="{{ route('apps.shifts.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.shifts.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.shifts.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-regular fa-clock mr-3"></i>
            <span>Shift</span>
        </a>

        <a href="{{ route('apps.menus.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.menus.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.menus.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <svg
            class="w-5 h-5 mr-3"
            aria-hidden="true"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
            ></path>
            </svg>
            <span>Produk</span>
        </a>

        <a href="{{ route('apps.categories.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.categories.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.categories.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <svg
                    class="w-5 h-5 mr-3"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                <path
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                ></path>
            </svg>
            <span>Kategori</span>
        </a>

        <a href="{{ route('apps.transactions.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.transactions.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.transactions.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-solid fa-cart-shopping mr-3"></i>
            <span>Transaksi</span>
        </a>

        <a href="{{ route('apps.reports.sales') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.reports.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.reports.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-regular fa-chart-bar mr-3"></i>
            <span>Laporan</span>
        </a>

        <a href="{{ route('apps.expenses.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.expenses.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.expenses.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-regular fa-credit-card mr-3"></i>
            <span>Expenses</span>
        </a>

        <div class="px-6 py-2 mt-6">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Pengaturan</p>
        </div>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('apps.users.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.users.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
                @if(request()->routeIs('apps.users.*'))
                    <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
                @endif
                <i class="fa fa-user-shield mr-3"></i>
                <span>Manage User</span>
            </a>
        @endif


        {{-- <a href="{{ route('apps.profile.index') }}" class="relative flex items-center px-6 py-3 {{ request()->routeIs('apps.profile.*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} font-semibold transition-colors">
            @if(request()->routeIs('apps.profile.*'))
                <span class="absolute h-12 left-0 w-1 bg-purple-600 rounded-br-lg rounded-tr-lg"></span>
            @endif
            <i class="fa-regular fa-pen-to-square mr-3"></i>
            <span>Profile</span>
        </a> --}}

        <div class="px-6 py-4 border-t border-gray-200 flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&color=fff" 
                alt="Avatar" 
                class="w-7 h-7 rounded-full">
            <div>
                <p class="font-semibold text-gray-800 m-0">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500 m-0">{{ auth()->user()->email }}</p>
            </div>
        </div>


        <div class="px-6 py-4 mt-auto">
            <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="button" id="logoutBtn" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Logout</button>
            </form>
        </div>
    </nav>

</div>