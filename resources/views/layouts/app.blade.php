<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'V12 Support panel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app_blade.css') }}">

    </head>
    <body class="font-sans antialiased">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow-sm mb-2 py-3 fs-5 fw-bold">
                <div class="container">
                    {{-- {{ $header }} --}}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="container">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- {{ $slot }} --}}
                @include('send')
            </main>

        <!-- Scripts -->
        <script src="{{ asset('js/app_blade.js') }}" ></script>

        {{ $scripts ?? '' }}
    </body>
</html>
