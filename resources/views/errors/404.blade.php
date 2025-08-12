<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        .map {
            background-image: radial-gradient(circle, #d7d7d7 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .traveler {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="antialiased bg-gray-100 min-h-screen overflow-hidden">
    <div class="relative min-h-screen flex items-center justify-center">
        <!-- Background Map -->
        <div class="absolute inset-0 map opacity-50"></div>
        
        <!-- Lost Traveler Visual -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div id="compass" class="absolute w-64 h-64 opacity-10">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="48" fill="none" stroke="#000" stroke-width="1" />
                    <circle cx="50" cy="50" r="40" fill="none" stroke="#000" stroke-width="0.5" />
                    <line x1="50" y1="2" x2="50" y2="10" stroke="#000" stroke-width="1" />
                    <line x1="50" y1="90" x2="50" y2="98" stroke="#000" stroke-width="1" />
                    <line x1="2" y1="50" x2="10" y2="50" stroke="#000" stroke-width="1" />
                    <line x1="90" y1="50" x2="98" y2="50" stroke="#000" stroke-width="1" />
                    <text x="50" y="16" font-size="5" text-anchor="middle">N</text>
                    <text x="50" y="88" font-size="5" text-anchor="middle">S</text>
                    <text x="88" y="52" font-size="5" text-anchor="middle">E</text>
                    <text x="12" y="52" font-size="5" text-anchor="middle">W</text>
                </svg>
            </div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 max-w-md bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="p-2 bg-purple-100 border-b flex items-center">
                <span class="text-xs font-mono text-purple-800 bg-purple-200 px-2 py-1 rounded">404 Not Found</span>
                <div class="flex-grow"></div>
                <div class="w-3 h-3 rounded-full bg-red-400 ml-1"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-400 ml-1"></div>
                <div class="w-3 h-3 rounded-full bg-green-400 ml-1"></div>
            </div>
             
            <div class="p-8">
                <div class="mb-8 text-center">
                    <div class="traveler w-32 h-32 mx-auto">
                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" stroke="#8B5CF6" stroke-width="1.5"></circle>
                            <path d="M12 2a15 15 0 0 1 0 20" stroke="#8B5CF6" stroke-width="1.5"></path>
                            <path d="M2 12h20" stroke="#8B5CF6" stroke-width="1.5"></path>
                            <path d="M12 9a3 3 0 0 0 0 6" fill="#8B5CF6"></path>
                            <circle cx="12" cy="12" r="3" fill="#8B5CF6"></circle>
                            <circle cx="12" cy="12" r="1" fill="white"></circle>
                        </svg>
                    </div>
                </div>
                
                <div class="text-center mb-6">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Destination Not Found</h1>
                    <p class="text-gray-600">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-purple-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-sm font-semibold text-gray-700">URL: <span class="font-mono text-purple-600" id="current-url"></span></p>
                    </div>
                    <p class="text-xs text-gray-500">Check the URL for errors or try navigating back to our homepage.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ url('/') }}" class="flex-1 px-6 py-3 bg-purple-600 text-white font-medium rounded-lg text-center hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Return Home
                    </a>
                    <button onclick="window.history.back()" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg text-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Go Back
                    </button>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 border-t">
                <div class="text-center">
                    <p class="text-sm text-gray-500">Still lost? <a href="{{ url('/contact') }}" class="text-purple-600 hover:underline">Contact Support</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Display current URL
            document.getElementById('current-url').textContent = window.location.pathname;
            
            // Rotate compass animation
            gsap.to("#compass", {
                rotation: 360,
                duration: 120,
                repeat: -1,
                ease: "none"
            });
        });
    </script>
</body>
</html>