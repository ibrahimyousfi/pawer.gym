<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SubscriptionHub') }}</title>

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div :class="$store.sidebar.open ? 'lg:ml-64' : 'lg:ml-16'"
                 class="flex-1 transition-all duration-300 ease-in-out min-h-screen flex flex-col w-full lg:w-auto">
                
                <!-- Mobile Header with Menu Button -->
                <div x-data="{ openSidebar() { $dispatch('toggle-mobile-sidebar'); } }" class="lg:hidden bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 sticky top-0 z-20">
                    <button @click="$dispatch('toggle-mobile-sidebar')"
                            class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-lg font-bold text-gray-900">SubscriptionHub</h1>
                    <div class="w-10"></div>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif
                
                @if(session('error'))
                    <x-alert type="error">{{ session('error') }}</x-alert>
                @endif
                
                @if(session('warning'))
                    <x-alert type="warning">{{ session('warning') }}</x-alert>
                @endif

                <!-- Page Header -->
                @include('layouts.header')

                <!-- Page Content -->
                <main class="flex-1 pb-4 lg:pb-8">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
