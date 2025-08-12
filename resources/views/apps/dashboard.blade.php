@extends('apps.layouts.main')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <div class="text-sm text-gray-500">{{ date('d F Y') }}</div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow border hover:border-gray-300 transition-colors">
            <div class="text-sm text-gray-500">Penjualan Hari Ini</div>
            <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($todaySales, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border hover:border-gray-300 transition-colors">
            <div class="text-sm text-gray-500">Transaksi Hari Ini</div>
            <div class="text-2xl font-bold text-gray-800">{{ $todayCount }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border hover:border-gray-300 transition-colors">
            <div class="text-sm text-gray-500">Omzet Bulan Ini</div>
            <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($monthSales, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow border hover:border-gray-300 transition-colors">
            <div class="text-sm text-gray-500">Profit Bulan Ini</div>
            <div class="text-2xl font-bold text-green-700">Rp {{ number_format($monthProfit, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Payment Chart & Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Payment Pie Chart -->
        <div class="bg-white p-6 rounded-xl shadow-lg h-content">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Pembayaran Hari Ini</h3>
                <div class="text-sm text-gray-500">Total: Rp {{ number_format(($byPaymentToday['cash'] ?? 0) + ($byPaymentToday['qris'] ?? 0), 0, ',', '.') }}</div>
            </div>
            
            @php
                $cashAmount = $byPaymentToday['cash'] ?? 0;
                $qrisAmount = $byPaymentToday['qris'] ?? 0;
                $total = $cashAmount + $qrisAmount;
                
                if ($total > 0) {
                    $cashPercent = ($cashAmount / $total) * 100;
                    $qrisPercent = ($qrisAmount / $total) * 100;
                    $cashAngle = ($cashAmount / $total) * 360;
                    $qrisAngle = ($qrisAmount / $total) * 360;
                } else {
                    $cashPercent = $qrisPercent = 50;
                    $cashAngle = $qrisAngle = 180;
                }
            @endphp
            
            <div class="flex items-center justify-center mb-4">
                <div class="relative">
                    <svg width="200" height="200" class="transform -rotate-90">
                        @if($total > 0)
                            <!-- Cash slice -->
                            <circle cx="100" cy="100" r="80" fill="transparent" stroke="#3b82f6" stroke-width="40" 
                                stroke-dasharray="{{ ($cashAngle/360) * 502.65 }} 502.65" stroke-dashoffset="0"/>
                            <!-- QRIS slice -->
                            <circle cx="100" cy="100" r="80" fill="transparent" stroke="#10b981" stroke-width="40" 
                                stroke-dasharray="{{ ($qrisAngle/360) * 502.65 }} 502.65" stroke-dashoffset="-{{ ($cashAngle/360) * 502.65 }}"/>
                        @else
                            <circle cx="100" cy="100" r="80" fill="transparent" stroke="#e5e7eb" stroke-width="40"/>
                        @endif
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-800">{{ $todayCount }}</div>
                            <div class="text-sm text-gray-500">Transaksi</div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="flex justify-center gap-10 items-center content-center mt-2">
                <div class="flex gap-3 items-center content-center">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <div class="text-sm text-gray-500">Cash = {{ $byPaymentTodayCount['cash'] ?? 0 }}</div>
                </div>
                <div class="flex gap-3 items-center content-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <div class="text-sm text-gray-500">Qris = {{ $byPaymentTodayCount['qris'] ?? 0 }}</div>
                </div>
            </div>
            
        </div>

        <!-- Top Products Ranking -->
        <div class="bg-white p-4 rounded-lg shadow border hover:border-gray-300 transition-colors">
            <div class="font-semibold text-gray-800 mb-4">Top Produk Bulan Ini</div>
            
            <div class="space-y-2">
                @forelse($topMenus->take(4) as $index => $row)
                    
                    <div class="border-2 {{ $rankColors[$index] ?? 'border-gray-200' }} rounded-lg p-3 hover:border-gray-400 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-white border-2 bg-gray-100 border-gray-300 flex items-center justify-center">
                                    <span class="text-sm font-bold {{ $numbers[$index] ?? 'text-gray-600' }}">{{ $index + 1 }}</span>
                                </div>
                                <span class="font-medium {{ $textColors[$index] ?? 'text-gray-800' }}">{{ $row->product_name }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-bold text-gray-800">{{ $row->qty }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-gray-500 text-center py-4">Tidak ada data.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Shifts and Stock -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Shifts Management -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Penghasilan per Shift</h3>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">{{ $activeShifts }} Aktif</span>
            </div>
            
            <div class="space-y-3 mb-4">
                @forelse($shiftsToday as $shift)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gray-100 border border-gray-300 text-slate-950 w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold">
                                {{ substr($shift['user'], 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-700">{{ $shift['user'] }}</span>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-gray-900">Rp {{ number_format($shift['sales'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <div class="text-gray-400 text-3xl mb-2"><i class="fa-solid fa-ban"></i></div>
                        <div class="text-gray-500">Tidak ada shift hari ini</div>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('apps.shifts.index') }}" 
               class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 hover:bg-gray-200 hover:border-gray-400 text-gray-900 rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                Kelola Shift
            </a>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Stok Menipis</h3>
                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">≤ 5 Item</span>
            </div>
            
            <div class="space-y-3 mb-4">
                @forelse($lowStockMenus as $menu)
                    <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">{{ $menu->name }}</span>
                        </div>
                        <div class="text-right">
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-semibold">{{ $menu->stock }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <div class="text-green-400 rounded-full bg-green-100 border border-green-300 w-10 h-10 flex items-center justify-center  mx-auto p-3"><i class="fa-solid fa-check"></i></div>
                        <div class="text-green-600 font-medium">Stok Aman!</div>
                        <div class="text-gray-500 text-sm">Semua produk memiliki stok cukup</div>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('apps.menus.index') }}" 
               class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 hover:bg-gray-200 hover:border-gray-400 text-gray-900 rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                Kelola Produk
            </a>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Penjualan 7 Hari Terakhir</h3>
                @if($bestDay)
                    <div class="text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full">
                        <i class="fa-solid fa-fire"></i> {{ $bestDay->date }}: Rp {{ number_format($bestDay->total, 0, ',', '.') }}
                    </div>
                @endif
            </div>
            
            <div class="relative">
                <svg viewBox="0 0 400 200" class="w-full h-48">
                    <!-- Grid lines -->
                    <defs>
                        <pattern id="grid" width="40" height="20" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 20" fill="none" stroke="#f3f4f6" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                    
                    @php
                        $max = max(1, $dailySeries->max('total'));
                        $count = max(1, $dailySeries->count());
                        $stepX = 360 / max(1, $count - 1);
                        $points = [];
                        $circlePoints = [];
                        foreach ($dailySeries as $i => $row) {
                            $x = 20 + $i * $stepX;
                            $y = 180 - (160 * ($row->total / $max));
                            $points[] = $x . ',' . $y;
                            $circlePoints[] = ['x' => $x, 'y' => $y, 'value' => $row->total];
                        }
                    @endphp
                    
                    <!-- Area under curve -->
                    @if(count($points) > 0)
                        <path d="M 20,180 L {{ implode(' L ', $points) }} L {{ explode(',', end($points))[0] }},180 Z" 
                              fill="url(#gradient)" opacity="0.2"/>
                        
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.8" />
                                <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0.1" />
                            </linearGradient>
                        </defs>
                    @endif
                    
                    <!-- Line -->
                    @if(count($points) > 0)
                        <polyline fill="none" stroke="#3b82f6" stroke-width="3" points="{{ implode(' ', $points) }}" 
                                  stroke-linecap="round" stroke-linejoin="round"/>
                    @endif
                    
                    <!-- Data points -->
                    @foreach($circlePoints as $point)
                        <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4" fill="#3b82f6" stroke="white" stroke-width="2"/>
                    @endforeach
                    
                    <!-- Axes -->
                    <line x1="20" y1="180" x2="380" y2="180" stroke="#d1d5db" stroke-width="2"/>
                    <line x1="20" y1="20" x2="20" y2="180" stroke="#d1d5db" stroke-width="2"/>
                </svg>
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl border border-blue-200">
            <div class="flex items-center mb-3">
                <div class="bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-blue-800">Tips & Info</h3>
            </div>
            <ul class="space-y-3 text-sm text-blue-700">
                <li> Gunakan laporan untuk menganalisa performa penjualan dan tren pelanggan.</li>
                <li> Monitor produk terlaris untuk optimasi stok dan menu unggulan.</li>
                <li> Perhatikan alert stok menipis untuk menghindari kehabisan produk populer.</li>
                <li> Update data real-time membantu pengambilan keputusan yang tepat.</li>
            </ul>
        </div>
    </div>
</div>
@endsection