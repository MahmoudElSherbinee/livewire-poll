<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Live Poll System</title>
    <meta name="description" content="Interactive real-time polling system built with Laravel Livewire">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📊</text></svg>">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @layer base {
            body {
                background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
                min-height: 100vh;
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
            }

            ::selection {
                background-color: rgba(59, 130, 246, 0.2);
                color: #1e3a8a;
            }

            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 9999px;
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 9999px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        }

        @layer components {
            .glass-card {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
        }
    </style>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased text-gray-800">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-300/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-300/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <header class="mb-12 text-center">
            <div class="inline-block p-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl mb-6 shadow-lg animate-float">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>

            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-3">
                Live Poll System
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Create interactive polls and see real-time results. Built with Laravel Livewire and Tailwind CSS.
            </p>
        </header>

        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            <!-- Create Poll Section -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-2xl p-1 shadow-xl">
                    @livewire('create-poll')
                </div>
            </div>

            <!-- Polls Section -->
            <div class="lg:col-span-2">
                <div class="glass-card rounded-2xl p-1 shadow-xl">
                    @livewire('polls')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-16 text-center text-gray-500 text-sm">
            <div class="flex items-center justify-center gap-4 mb-4">
                <div class="h-px w-12 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                <span>📊 Live Poll System</span>
                <div class="h-px w-12 bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            </div>
            <p>Built with Laravel Livewire • Real-time updates • Modern design</p>
            <p class="mt-2 text-xs">© {{ date('Y') }} All rights reserved</p>
        </footer>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Notification Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Livewire event listeners for better UX
            Livewire.on('pollCreated', () => {
                // Scroll to polls section
                const pollsSection = document.querySelector('@livewire("polls")');
                if (pollsSection) {
                    pollsSection.scrollIntoView({ behavior: 'smooth' });
                }
            });

            // Add loading states
            Livewire.hook('request', ({ fail }) => {
                fail(() => {
                    // Handle request failures
                });
            });
        });
    </script>
</body>

</html>
