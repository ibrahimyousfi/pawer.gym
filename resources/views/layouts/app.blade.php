<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gym Platform') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-zinc-950 text-zinc-300">
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-400 p-4 rounded shadow-sm flex justify-between items-center" x-data="{ show: true }" x-show="show">
                            <p>{{ session('success') }}</p>
                            <button @click="show = false" class="text-emerald-400 hover:text-emerald-300">&times;</button>
                        </div>
                    </div>
                @endif

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-zinc-900 border-b border-zinc-800">
                        <div class="py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
