<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SimAcademy</title>

    <link rel="shortcut icon" href="/favicon_io/favicon.ico">
    <link rel="shortcut icon" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="shortcut icon" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo.png">

    <!-- Scripts -->
    <script src="/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="/js/app.js" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="/js/jquery-3.6.0.min.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white border-btm-e6">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="bi bi-house"></i> SimAcademy
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        @php
                            $latest_school_session = \App\Models\SchoolSession::latest()->first();
                            $current_school_session_name = null;
                            if ($latest_school_session) {
                                $current_school_session_name = $latest_school_session->session_name;
                            }
                        @endphp
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                @if (session()->has('browse_session_name') && session('browse_session_name') !== $current_school_session_name)
                                    <a class="nav-link text-danger disabled" href="#" tabindex="-1"
                                        aria-disabled="true"><i class="bi bi-exclamation-diamond-fill me-2"></i> Browsing as
                                        Academic Session {{ session('browse_session_name') }}</a>
                                @elseif(\App\Models\SchoolSession::latest()->count() > 0)
                                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Current
                                        Academic Session {{ $current_school_session_name }}</a>
                                @else
                                    <a class="nav-link text-danger disabled" href="#" tabindex="-1"
                                        aria-disabled="true"><i class="bi bi-exclamation-diamond-fill me-2"></i> Create an
                                        Academic Session.</a>
                                @endif
                            </li>
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->role) }}</span>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="https://sim-academy.vercel.app/change-password">
                                        <i class="bi bi-key me-2"></i> Change Password
                                    </a>
                                    <a class="dropdown-item" href="https://sim-academy.vercel.app/logout">
                                        <i class="bi bi-door-open me-2"></i>Logout
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>

    <div id="watermark">
        <p>SimAcademy</p>
    </div>

</body>

</html>
