<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forbidden - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-red-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-xl w-full relative">
        <!-- Backdrop elements -->
        <div class="absolute inset-0 z-0 overflow-hidden opacity-50">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-700 rounded-full"></div>
            <div class="absolute bottom-10 -left-10 w-24 h-24 bg-red-800 rounded-full"></div>
            <div class="absolute top-1/2 right-1/4 w-16 h-16 bg-red-600 rounded-full"></div>
        </div>
        
        <!-- Card content -->
        <div class="relative z-10 bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="p-2 bg-red-100 flex items-center border-b border-red-200">
                <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-400 mr-2"></div>
                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                <div class="ml-auto px-3 py-1 bg-red-50 rounded text-xs font-mono text-red-600">403</div>
            </div>
            
            <div class="p-8 text-center">
                <!-- Warning Sign -->
                <div class="relative mx-auto w-32 h-32 mb-8">
                    <div class="absolute inset-0 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-24 h-24 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Access Denied</h1>
                <h2 class="text-xl font-semibold text-red-600 mb-6">403 Forbidden</h2>
                
                <div class="bg-red-50 p-4 rounded-lg mb-8">
                    <p class="text-red-800">
                        You don't have permission to access this page. This area is restricted.
                    </p>
                </div>
                
                <div class="flex items-center justify-center space-x-4">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Return Home
                    </a>
                    <button onclick="window.history.back()" class="inline-flex items-center px-4 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Go Back
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                <p class="text-sm text-gray-500 text-center">
                    If you need access to this resource, please contact the administrator.
                </p>
            </div>
        </div>
    </div>
</body>
</html>