<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Expired - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        .hourglass-container {
            perspective: 1000px;
        }
        
        .hourglass {
            transform-style: preserve-3d;
        }
        
        @keyframes sandfall {
            0%, 20% { height: 0%; top: 0%; }
            80%, 100% { height: 75%; top: 25%; }
        }
        
        .sand-top {
            clip-path: polygon(0 0, 100% 0, 80% 100%, 20% 100%);
        }
        
        .sand-bottom {
            animation: sandfall 3s ease-in infinite;
            clip-path: polygon(20% 0, 80% 0, 100% 100%, 0% 100%);
        }
    </style>
</head>
<body class="antialiased bg-amber-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full rounded-xl shadow-2xl overflow-hidden bg-white">
        <div class="p-2 bg-amber-100 border-b border-amber-200 flex items-center">
            <svg class="w-5 h-5 text-amber-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-sm font-medium text-amber-800">Session Expired</h2>
            <span class="ml-auto bg-amber-200 text-amber-800 text-xs font-mono px-2 py-1 rounded">419</span>
        </div>
        
        <div class="p-8 text-center">
            <!-- Animated Hourglass -->
            <div class="hourglass-container mb-8 w-32 h-32 mx-auto">
                <div id="hourglass" class="hourglass relative w-full h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-full h-full text-amber-900 opacity-10">
                        <path fill="currentColor" d="M6,2H18V4H16V6.1C16,7.8 15.1,9.3 13.5,10C15.1,10.7 16,12.2 16,13.9V16H18V18H6V16H8V13.9C8,12.2 8.9,10.7 10.5,10C8.9,9.3 8,7.8 8,6.1V4H6V2M10,6.1V4H14V6.1C14,7.8 12.2,9 10.5,9H13.5C11.8,9 10,7.8 10,6.1M10,13.9C10,12.2 11.8,11 13.5,11H10.5C12.2,11 14,12.2 14,13.9V16H10V13.9Z" />
                    </svg>
                    
                    <!-- Sand Animation -->
                    <div class="absolute inset-0 flex flex-col">
                        <div class="sand-top bg-amber-300 w-full h-6 opacity-75"></div>
                        <div class="flex-grow"></div>
                        <div class="sand-bottom bg-amber-300 w-full h-0 opacity-75 relative"></div>
                    </div>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-3">Page Expired</h1>
            <p class="text-gray-600 mb-6">Your session has timed out or the CSRF token has expired.</p>
            
            <div class="bg-amber-50 rounded-lg p-4 mb-8 text-left">
                <h3 class="text-sm font-semibold text-amber-800 mb-2">Why did this happen?</h3>
                <ul class="text-sm text-amber-700 space-y-2">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-amber-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Your session may have timed out due to inactivity
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-amber-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        The form was open for too long without submitting
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-amber-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Your browser may have blocked cookies
                    </li>
                </ul>
            </div>
            
            <div class="flex justify-center">
                <a href="{{ url()->previous() }}" class="px-5 py-3 bg-amber-600 text-white rounded-lg font-medium hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh Page & Try Again
                </a>
            </div>
        </div>
        
        <div class="bg-gray-50 p-4 border-t border-gray-100">
            <p class="text-sm text-gray-500 text-center">
                Please do not use the browser's back button when filling out forms.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Flip hourglass animation
            gsap.to("#hourglass", {
                rotationX: 180,
                duration: 1,
                delay: 3,
                repeat: -1,
                repeatDelay: 3
            });
        });
    </script>
</body>
</html>