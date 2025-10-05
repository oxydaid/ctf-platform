{{-- resources/views/layouts/blank-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"> {{-- Tambahkan 'dark' di sini --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    {{-- Tambahkan kelas background gelap di sini --}}
    <body class="font-sans antialiased bg-gray-900 text-gray-200">
        {{ $slot }}
        @livewireScripts
    </body>
</html>