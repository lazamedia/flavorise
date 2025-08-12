<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Unavailable - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        .bg-pattern {
            background-color: #4f46e5;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23a5b4fc' fill-opacity='0.1'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .worker {
            animation: working 2s infinite ease-in-out;
        }

        @keyframes working {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .progress-bar {
            overflow: hidden;
            height: 8px;
            border-radius: 4px;
            background-color: #e5e7eb;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #4f46e5;
            border-radius: 4px;
            width: 0%;
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .spin-slow {
            animation: spin 8s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="antialiased bg-pattern min-h-screen flex items-center justify-center p-4">
    <div class="max-w-3xl w-full bg-white rounded-xl shadow-2xl overflow-hidden relative z-10">
        <div class="flex items-center justify-between border-b border-gray-200 p-4 bg-indigo-50">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="font-medium text-indigo-700">System Status</span>
            </div>
            <div class="flex items-center">
                <span class="px-3 py-1 text-xs font-mono bg-indigo-100 text-indigo-800 rounded-full border border-indigo-200">
                    503 Service Unavailable
                </span>
            </div>
        </div>
        
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
                <!-- Maintenance Illustration -->
                <div class="flex-shrink-0 w-64 h-64 relative">
                    <!-- Background elements -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-48 h-48 bg-indigo-100 rounded-full opacity-50 spin-slow"></div>
                        <div class="absolute w-36 h-36 bg-indigo-200 rounded-full opacity-30 spin-slow" style="animation-direction: reverse;"></div>
                    </div>
                    
                    <!-- Workers -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div id="maintenanceScene" class="relative w-full h-full flex items-center justify-center">
                            <!-- Server tower -->
                            <div class="absolute w-20 h-32 bg-gray-700 rounded-lg left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <!-- Server details -->
                                <div class="w-full h-4 bg-gray-800 mt-2"></div>
                                <div class="w-full h-4 bg-gray-800 mt-4"></div>
                                <div class="w-full h-4 bg-gray-800 mt-4"></div>
                                <div class="absolute right-1 top-3 w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                <div class="absolute right-1 top-11 w-2 h-2 rounded-full bg-green-500"></div>
                                <div class="absolute right-1 top-19 w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></div>
                            </div>
                            
                            <!-- Worker 1 -->
                            <div class="worker absolute left-2 bottom-6 w-12 h-16">
                                <div class="w-6 h-6 bg-blue-500 rounded-full mx-auto"></div>
                                <div class="w-8 h-8 bg-blue-600 rounded-md mt-1 mx-auto"></div>
                                <div class="flex justify-center mt-0.5">
                                    <div class="w-2 h-4 bg-blue-700"></div>
                                    <div class="w-2 h-4 bg-blue-700 ml-2"></div>
                                </div>
                            </div>
                            
                            <!-- Worker 2 -->
                            <div class="worker absolute right-2 bottom-12 w-12 h-16" style="animation-delay: -1s;">
                                <div class="w-6 h-6 bg-indigo-500 rounded-full mx-auto"></div>
                                <div class="w-8 h-8 bg-indigo-600 rounded-md mt-1 mx-auto"></div>
                                <div class="flex justify-center mt-0.5">
                                    <div class="w-2 h-4 bg-indigo-700"></div>
                                    <div class="w-2 h-4 bg-indigo-700 ml-2"></div>
                                </div>
                            </div>
                            
                            <!-- Floating gears -->
                            <div class="floating absolute top-6 right-12" style="animation-delay: -0.5s;">
                                <svg class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            
                            <div class="floating absolute top-12 left-10" style="animation-delay: -1.5s;">
                                <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="flex-grow text-center md:text-left">
                    <div class="inline-flex items-center justify-center md:justify-start px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Scheduled Maintenance
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">We'll be back soon</h1>
                    <p class="text-lg text-gray-600 mb-4">Our system is currently undergoing scheduled maintenance.</p>
                    
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 mb-6">
                        <div class="mb-3">
                            <div class="text-sm font-medium text-gray-700 mb-1">Maintenance Progress</div>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" id="progressBar"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Estimated completion:</span>
                            <span id="completionTime" class="font-mono">Calculating...</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="javascript:void(0)" onclick="checkStatus()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                            Check Status
                        </a>
                        <a href="{{ url('/') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-center">
                            Return Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 p-4 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-gray-500 text-sm">
                <div class="flex items-center mb-2 sm:mb-0">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Server status updates available on our status page
                </div>
                <a href="#" class="text-indigo-600 hover:text-indigo-700">
                    Powered by Mixucode
                </a>
            </div>
        </div>
    </div>
    
    <!-- Animated background elements -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-1/4 right-1/4 w-32 h-32 bg-indigo-400 rounded-full opacity-10 floating"></div>
        <div class="absolute bottom-1/3 left-1/4 w-40 h-40 bg-blue-400 rounded-full opacity-10 floating" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 right-1/3 w-24 h-24 bg-purple-400 rounded-full opacity-10 floating" style="animation-delay: -1s;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Progress bar animation
            const progressBar = document.getElementById('progressBar');
            const completionTime = document.getElementById('completionTime');
            
            // Calculate a random completion percentage between 30% and 90%
            const progress = Math.floor(Math.random() * 60) + 30;
            
            // Random time between 5 and 30 minutes from now
            const minutesLeft = Math.floor(Math.random() * 25) + 5;
            const now = new Date();
            const completion = new Date(now.getTime() + minutesLeft * 60000);
            const formattedTime = completion.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            // Update DOM
            gsap.to(progressBar, {
                width: progress + "%",
                duration: 1.5,
                ease: "power2.out"
            });
            
            completionTime.textContent = formattedTime;
            
            // Animation for the maintenance scene
            gsap.fromTo("#maintenanceScene", 
                { y: 10, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 1 }
            );
            
            // Random movements of workers
            gsap.to(".worker:first-child", {
                x: "+=5",
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });
            
            gsap.to(".worker:last-child", {
                x: "-=5",
                duration: 2.5,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 0.5
            });
        });
        
        // Status check function
        function checkStatus() {
            const progressBar = document.getElementById('progressBar');
            const currentWidth = parseFloat(progressBar.style.width || "0");
            
            // Increase progress by a random amount between 5-15%
            const increment = Math.min(100 - currentWidth, Math.floor(Math.random() * 10) + 5);
            
            gsap.to(progressBar, {
                width: (currentWidth + increment) + "%",
                duration: 0.8,
                ease: "power1.out"
            });
            
            // Show a message
            alert("Status checked! Maintenance is still in progress. Please check back later.");
        }
    </script>
</body>
</html>