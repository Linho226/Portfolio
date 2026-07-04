<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — {{ config('app.name', 'Portfolio') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    @stack('scripts-head')
</head>
<body>
<div class="admin-shell">
    @include('layouts.navigation')

    <div class="admin-content">
        <div class="container-xl py-3">
            @isset($header)
                <div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                    {{ $header }}
                </div>
            @endisset
            <main class="pb-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
