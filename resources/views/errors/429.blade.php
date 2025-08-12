<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Too Many Requests - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%2310B981' fill-opacity='0.2' d='M0,192L48,181.3C96,171,192,149,288,154.7C384,160,480,192,576,197.3C672,203,768,181,864,170.7C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: 1440px 100px;
            animation: wave 10s linear infinite;
        }
        .wave:nth-child(2) {
            bottom: 0;
            opacity: 0.5;
            animation: wave 8s linear reverse infinite;
        }
        .wave:nth-child(3) {
            bottom: 0;
            opacity: 0.2;
            animation: wave 6s linear infinite;
        }
        
        @keyframes wave {
            0% { background-position-x: 0; }
            100% { background-position-x: 1440px; }
        }
        
        .counter {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body class="antialiased bg-emerald-50 min-h-screen flex flex-col">
    <div class="flex-grow flex items-center justify-center p-4 relative overflow-hidden">
        <!-- Water Wave Effect -->
        <div class="absolute bottom-0 left-0 right-0 h-48 overflow-hidden">
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
        
        <div class="max-w-lg w-full bg-white rounded-lg shadow-xl overflow-hidden relative z-10">
            <div class="bg-emerald-100 p-3 border-b border-emerald-200 flex items-center">
                <div class="flex items-center">
                    <div class="pulse-slow w-3 h-3 bg-emerald-500 rounded-full mr-2"></div>
                    <span class="text-sm font-medium text-emerald-800">Rate Limit</span>
                </div>
                <div class="ml-auto">
                    <span class="text-xs bg-emerald-200 text-emerald-800 px-2 py-1 rounded font-mono">429</span>
                </div>
            </div>
            
            <div class="p-8">
                <div class="mb-8 flex justify-center">
                    <!-- Traffic Light Visualization -->
                    <div class="bg-gray-200 w-24 h-64 rounded-xl p-3 flex flex-col items-center justify-between">
                        <div class="w-14 h-14 rounded-full bg-red-500 shadow-inner flex items-center justify-center">
                            <div class="w-10 h-10 rounded-full bg-red-600 shadow-inner pulse-slow"></div>
                        </div>
                        <div class="w-14 h-14 rounded-full bg-gray-300 shadow-inner"></div>
                        <div class="w-14 h-14 rounded-full bg-gray-300 shadow-inner"></div>
                    </div>
                </div>
                
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Too Many Requests</h1>
                    <p class="text-gray-600">You've hit our rate limit. Please slow down and try again later.</p>
                </div>
                
                <div class="bg-emerald-50 rounded-lg p-5 mb-6">
                    <h3 class="text-sm font-semibold text-emerald-800 mb-3">Why this happened:</h3>
                    <ul class="space-y-2 text-sm text-emerald-700">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Our server detected too many requests in a short period
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            This limit helps protect our infrastructure
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Rate limits ensure fair usage for all users
                        </li>
                    </ul>
                </div>
                
                <!-- Countdown Timer -->
                <div class="mb-6">
                    <div class="bg-gray-100 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600 mb-2">You can try again in:</p>
                        <div class="counter text-2xl font-mono font-bold text-emerald-600" id="countdown">
                            00:30
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <a id="retry-btn" href="javascript:window.location.reload()" class="px-5 py-3 bg-emerald-100 text-emerald-700 rounded-lg font-medium opacity-50 cursor-not-allowed border border-emerald-200">
                        Retry Request
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 border-t border-gray-100">
                <p class="text-sm text-gray-500 text-center">
                    If you believe this is an error, please contact support.
                </p>
            </div>
        </div>
    </div>
    
    <script>
        // Simulate countdown timer
        document.addEventListener('DOMContentLoaded', function() {
            let seconds = 30;
            const countdownEl = document.getElementById('countdown');
            const retryBtn = document.getElementById('retry-btn');
            
            const countdown = setInterval(function() {
                seconds--;
                
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                
                countdownEl.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                
                if (seconds <= 0) {
                    clearInterval(countdown);
                    retryBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-200');
                    retryBtn.classList.add('bg-emerald-500', 'text-white', 'hover:bg-emerald-600');
                }
            }, 1000);
        });
    </script>
</body>
</html>