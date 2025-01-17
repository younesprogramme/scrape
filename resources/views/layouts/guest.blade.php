<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app_blade.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app_blade.js') }}" defer></script>
    </head>
    <body class="d-flex align-items-center justify-content-center">
        <div class="">
            {{ $slot }}
        </div>
    </body>
</html>
