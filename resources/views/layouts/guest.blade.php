<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Login | {{ config('app.name', 'CarTicket Booking') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            
            .text-cyan-600 { color: #174753; }
            .border-cyan-600 { border-color: #0891b2; }
            .bg-cyan-600 { background-color: #0891b2; }
            .hover\:bg-cyan-700:hover { background-color: #0e7490; }
            .focus\:ring-cyan-500:focus { --tw-ring-color: #06b6d4; }
            
            .admin-heading {
                font-size: 2.25rem; 
                font-size: clamp(1.75rem, 3vw, 2.5rem); 
                font-weight: 400;
                letter-spacing: -0.015em;
                line-height: 1.1;
                text-transform: uppercase;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.08);
            }
            
            @media (min-width: 640px) {
                .admin-heading {
                    letter-spacing: -0.05em;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-cyan-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="text-center mb-10 w-full px-4">
                <h1 class="admin-heading text-cyan-600 mb-3">ADMIN PORTAL</h1>
                <p class="text-sm text-gray-500">CarTicket Booking System</p>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white card shadow-lg border-start border-3 overflow-hidden sm:rounded-lg border-t-4 border-cyan-600">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>