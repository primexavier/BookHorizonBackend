<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Book Horizon') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet"> <!--load all styles -->

    
    @stack('headScripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('backend.home') }}">
                    {{ config('app.name', 'Book Horizon') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('backend.login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- <a class="dropdown-item" href="{{route('backend.author.index')}}" >
                                        Author
                                    </a> -->
                                    <a class="dropdown-item" href="{{route('backend.bank.index')}}" >
                                        Bank
                                    </a>
                                    <!-- <a class="dropdown-item" href="{{route('backend.blog.index')}}" >
                                        Blog
                                    </a> -->
                                    <a class="dropdown-item" href="{{route('backend.book.index')}}" >
                                        Book
                                    </a>
                                    <a class="dropdown-item" href="{{route('backend.category.index')}}" >
                                        Category
                                    </a>
                                    <!-- <a class="dropdown-item" href="{{route('backend.currency.index')}}" >
                                        Currency
                                    </a> -->
                                    <a class="dropdown-item" href="{{route('backend.genre.index')}}" >
                                        Genre
                                    </a>
                                    <a class="dropdown-item" href="{{route('backend.member.index')}}" >
                                        Member
                                    </a>
                                    <a class="dropdown-item" href="{{route('backend.membership.index')}}" >
                                        Membership
                                    </a>
                                    <!-- <a class="dropdown-item" href="{{route('backend.paymentMethod.index')}}" >
                                        Payment Method
                                    </a> -->
                                    <!-- <a class="dropdown-item" href="{{route('backend.promotion.index')}}" >
                                        Promotion
                                    </a> -->
                                    <a class="dropdown-item" href="{{route('backend.users.index')}}" >
                                        User
                                    </a>
                                    <!-- <a class="dropdown-item" href="{{route('backend.setting.index')}}" >
                                        Setting
                                    </a> -->
                                    <a class="dropdown-item" href="{{route('backend.supplier.index')}}" >
                                        Supplier
                                    </a>
                                    <a class="dropdown-item" href="{{route('backend.stock.index')}}" >
                                        Stock
                                    </a>
                                    <a class="dropdown-item" href="{{route('backend.transactions.index')}}" >
                                        Transaction
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
