<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Error - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        .error-bg {
            background-color: #2d3748;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zm20.97 0l9.315 9.314-1.414 1.414L34.828 0h2.83zM22.344 0L13.03 9.314l1.414 1.414L25.172 0h-2.83zM32 0l12.142 12.142-1.414 1.414L30 .828 17.272 13.556l-1.414-1.414L28 0h4zM.284 0l28 28-1.414 1.414L0 2.544v2.83L26.272 32l-1.414 1.414L0 8.685v2.83L23.03 36l-1.414 1.414L0 14.828v2.83L19.757 40l-1.414 1.414L0 20.97v2.83L16.485 44l-1.414 1.414L0 27.113v2.83L13.243 48l-1.414 1.414L0 33.256v2.83L10 48.485 8.586 49.9 0 39.4v2.83L6.758 52.485 5.344 53.9 0 45.543v2.83L3.515 56.485 2.1 57.9 0 51.687v2.83L.343 60H3.17L3.513 60 0 57.828v-2.83L3.515 60h2.83L0 54.485v-2.83L6.757 60h2.83L0 51.142v-2.83L10 60h2.83L0 47.8v-2.83L13.244 60h2.83L0 44.456v-2.83L16.485 60h2.83L0 41.113v-2.83L19.757 60h2.83L0 37.77v-2.83L23.03 60h2.828L0 34.428v-2.83L26.272 60h2.828L0 31.085v-2.83L29.514 60h2.83L0 27.742v-2.83L32.757 60h2.83L0 24.4v-2.83L36 60h2.83L0 21.057v-2.83L39.243 60h2.83L0 17.714v-2.83L42.485 60h2.83L0 14.37v-2.83L45.728 60h2.83L0 11.03v-2.83L49 60h2.83L0 7.685v-2.83L52.243 60h2.83L0 4.342v-2.83L55.486 60h2.83L0 .998V0h60L30 30 0 0zm0 60h60v-2.83L32.243 30 60 57.17V54.34L29.515 30 60 54.34V51.51L26.758 30 60 51.51V48.68L23.97 30 60 48.68V45.85L21.214 30 60 45.85V43.02L18.456 30 60 43.02V40.19L15.7 30 60 40.19V37.36L12.94 30 60 37.36V34.53L10.184 30 60 34.53V31.7L7.427 30 60 31.7V28.868L4.67 30 60 28.868V26.036L1.913 30 60 26.036V23.206L0 30l60-6.794v-2.83L0 30l60-9.627v-2.83L0 30l60-12.46v-2.83L0 30l60-15.292v-2.83L0 30l60-18.124v-2.83L0 30l60-20.956v-2.83L0 30l60-23.79v-2.828L0 30 60 0H0v60z' fill='%23a0aec0' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        .gear-container {
            perspective: 1000px;
        }
        
        .gear {
            transform-style: preserve-3d;
        }
        
        .terminal-code {
            font-family: monospace;
            border-radius: 6px;
            color: #e2e8f0;
            background-color: #1a202c;
        }
        
        .cursor {
            display: inline-block;
            width: 10px;
            height: 18px;
            background-color: #e2e8f0;
            animation: blink 1s step-end infinite;
        }
        
        @keyframes blink {
            from, to { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>
</head>
<body class="antialiased error-bg text-white min-h-screen flex flex-col">
    <div class="flex-grow flex items-center justify-center p-4">
        <div class="max-w-2xl w-full bg-gray-800 rounded-lg shadow-2xl overflow-hidden backdrop-filter backdrop-blur-sm bg-opacity-75 border border-gray-700">
            <div class="flex items-center justify-between border-b border-gray-700 p-3">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                </div>
                <div class="text-xs px-2 py-1 bg-red-900 bg-opacity-50 rounded text-white font-mono border border-red-700">
                    Error 500
                </div>
            </div>
            
            <div class="p-6">
                <!-- Server with smoke animation -->
                <div class="mb-8 text-center">
                    <div class="gear-container inline-block">
                        <div id="serverRack" class="relative w-48 h-48 mx-auto">
                            <!-- Server Rack -->
                            <svg class="w-full h-full" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="12" y="10" width="40" height="44" rx="2" fill="#4A5568" />
                                <rect x="14" y="14" width="36" height="8" rx="1" fill="#2D3748" />
                                <rect x="16" y="16" width="2" height="4" rx="1" fill="#FC8181" />
                                <rect x="20" y="16" width="2" height="4" rx="1" fill="#68D391" />
                                <rect x="24" y="16" width="24" height="4" rx="1" fill="#4A5568" />
                                
                                <rect x="14" y="24" width="36" height="8" rx="1" fill="#2D3748" />
                                <rect x="16" y="26" width="2" height="4" rx="1" fill="#FC8181" />
                                <rect x="20" y="26" width="2" height="4" rx="1" fill="#F6AD55" />
                                <rect x="24" y="26" width="24" height="4" rx="1" fill="#4A5568" />
                                
                                <rect x="14" y="34" width="36" height="8" rx="1" fill="#2D3748" />
                                <rect x="16" y="36" width="2" height="4" rx="1" fill="#FC8181" />
                                <rect x="20" y="36" width="2" height="4" rx="1" fill="#FC8181" />
                                <rect x="24" y="36" width="24" height="4" rx="1" fill="#4A5568" />
                                
                                <rect x="14" y="44" width="36" height="8" rx="1" fill="#2D3748" />
                                <rect x="16" y="46" width="2" height="4" rx="1" fill="#F6AD55" />
                                <rect x="20" y="46" width="2" height="4" rx="1" fill="#68D391" />
                                <rect x="24" y="46" width="24" height="4" rx="1" fill="#4A5568" />
                                
                                <!-- Gears -->
                                <g id="gear1">
                                    <path d="M56 20C56 22.2091 54.2091 24 52 24C49.7909 24 48 22.2091 48 20C48 17.7909 49.7909 16 52 16C54.2091 16 56 17.7909 56 20Z" fill="#A0AEC0"/>
                                    <path d="M52 15V11M52 29V25M46.101 16.101L43.272 13.272M60.728 26.728L57.899 23.899M45 20H41M63 20H59M46.101 23.899L43.272 26.728M60.728 13.272L57.899 16.101" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round"/>
                                </g>
                                
                                <g id="gear2">
                                    <path d="M60 38C60 40.2091 58.2091 42 56 42C53.7909 42 52 40.2091 52 38C52 35.7909 53.7909 34 56 34C58.2091 34 60 35.7909 60 38Z" fill="#A0AEC0"/>
                                    <path d="M56 33V29M56 47V43M50.101 34.101L47.272 31.272M64.728 44.728L61.899 41.899M49 38H45M67 38H63M50.101 41.899L47.272 44.728M64.728 31.272L61.899 34.101" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round"/>
                                </g>
                                
                                <!-- Smoke -->
                                <g id="smoke1" class="opacity-0">
                                    <circle cx="38" cy="7" r="2" fill="#A0AEC0" fill-opacity="0.6"/>
                                </g>
                                <g id="smoke2" class="opacity-0">
                                    <circle cx="32" cy="5" r="2" fill="#A0AEC0" fill-opacity="0.6"/>
                                </g>
                                <g id="smoke3" class="opacity-0">
                                    <circle cx="28" cy="7" r="2" fill="#A0AEC0" fill-opacity="0.6"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-red-500 mb-2">Server Error</h1>
                    <p class="text-gray-300 mb-2">Something went wrong on our servers</p>
                    <p class="text-sm text-gray-400">Our technical team has been notified and is working to resolve the issue.</p>
                </div>
                
                <!-- Error Code Terminal -->
                <div class="terminal-code p-4 mb-6 overflow-x-auto">
                    <div class="flex items-center text-gray-400 mb-2">
                        <span class="text-green-400 mr-2">$</span>
                        <span id="terminalText">Error diagnostic...</span>
                        <span class="cursor ml-1"></span>
                    </div>
                    <div class="text-red-400" id="errorCode">
                        Fatal error: Uncaught exception 'ServerException' with message 'Internal server error'
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ url('/') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 text-center">
                        Return Home
                    </a>
                    <button onclick="window.location.reload()" class="px-6 py-3 bg-gray-700 text-white font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                        Try Again
                    </button>
                </div>
            </div>
            
            <div class="bg-gray-900 p-4 border-t border-gray-700">
                <div class="text-center text-gray-400 text-sm flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    This error has been logged and our team will investigate it.
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rotating gears animation
            gsap.to("#gear1", { rotation: 360, duration: 10, repeat: -1, ease: "none", transformOrigin: "52px 20px" });
            gsap.to("#gear2", { rotation: -360, duration: 8, repeat: -1, ease: "none", transformOrigin: "56px 38px" });
            
            // Smoke animation
            const smokeTimeline = gsap.timeline({repeat: -1});
            
            smokeTimeline.to("#smoke1", {opacity: 0.8, y: -10, duration: 1, ease: "power1.out"})
                         .to("#smoke1", {opacity: 0, y: -20, duration: 1, ease: "power1.in"});
            
            smokeTimeline.to("#smoke2", {opacity: 0.8, y: -15, duration: 1, ease: "power1.out", delay: -1.5})
                         .to("#smoke2", {opacity: 0, y: -25, duration: 1, ease: "power1.in"});
            
            smokeTimeline.to("#smoke3", {opacity: 0.8, y: -12, duration: 1, ease: "power1.out", delay: -1.5})
                         .to("#smoke3", {opacity: 0, y: -22, duration: 1, ease: "power1.in"});
            
            // Server shake on error
            gsap.to("#serverRack", {
                x: 2,
                duration: 0.1,
                repeat: 5,
                yoyo: true,
                delay: 2,
                repeatDelay: 5
            });
            
            // Terminal typing effect
            const text = "Error diagnostic complete";
            const terminalText = document.getElementById('terminalText');
            let i = 0;
            
            function typeWriter() {
                if (i < text.length) {
                    terminalText.textContent = text.substring(0, i+1);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            }
            
            setTimeout(typeWriter, 1000);
        });
    </script>
</body>
</html>