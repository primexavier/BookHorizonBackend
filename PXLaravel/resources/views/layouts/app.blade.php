<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">

        <!-- Icons-->
        <link href="{{ asset('backend/css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
        <link href="{{ asset('backend/css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
 
        <!-- Main styles for this application-->
        <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

        @livewireStyles
        
        @stack('styles')

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <link href="/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
        <link href="{{ asset('backend/css/coreui-chartjs.css') }}" rel="stylesheet">

    </head>
    <body class="c-app">        
        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            @include('layouts.nav-builder')

            @include('layouts.header')

            <div class="c-body">
                <main class="c-main">
                    <div class="container">
                        <div class="row fade-in">
                            <div class="col">
                                {{ $slot }}
                            </div>

                            @if (isset($aside))
                                <div class="col-lg-3">
                                    {{ $aside ?? '' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </main>
                @include('layouts.footer')
            </div>

        </div>

        @stack('modals')

        <!-- CoreUI and necessary plugins-->
        <script src="{{ asset('backend/js/coreui.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/js/coreui-utils.js') }}"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
