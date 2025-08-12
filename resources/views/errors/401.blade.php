<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unauthorized - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
</head>
<body class="antialiased bg-gradient-to-br from-indigo-900 to-blue-700 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-xl w-full bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-4 bg-yellow-50 border-b border-yellow-100 flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-4V8m0 0V6m0 0h2m-2 0H9" />
                </svg>
                <h2 class="text-sm font-medium text-yellow-800">Authentication Required</h2>
            </div>
            <div class="text-xs font-mono text-yellow-600 bg-yellow-100 px-2 py-1 rounded">401</div>
        </div>
        
        <div class="py-12 px-6 text-center">
            <div class="mb-8">
                <div id="lockAnimation" class="w-32 h-32 mx-auto">
                    <svg class="w-full h-full text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Authentication Required</h1>
            <p class="text-gray-600 mb-8">You need to be logged in to access this page. Please login to continue.</p>
            
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/login') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </a>
                <a href="{{ url('/') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Return Home
                </a>
            </div>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
            <p class="text-sm text-gray-500 text-center">
                If you believe this is an error, please contact support.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.from('#lockAnimation', {
                y: -20,
                opacity: 0,
                duration: 0.8,
                ease: "back.out(1.7)"
            });
            
            gsap.to('#lockAnimation', {
                rotation: 5,
                duration: 0.3,
                repeat: 3,
                yoyo: true,
                delay: 1
            });
        });
    </script>
</body>
</html>