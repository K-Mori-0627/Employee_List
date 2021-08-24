<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee List | @yield('Title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/default.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
            <a href="{{ route('user.home.index') }}" class="navbar-brand"><i class="fab fa-d-and-d"></i><b>Employee List</b></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav ml-auto">
                    <a style="font-size: 16px" href="{{ route('user.home.index') }}" class="nav-item nav-link d-flex align-items-center {{ request()->route()->named('*home*') ? 'active' : '' }}"><i class="fa fa-home"></i>Home</a>
                    <a style="font-size: 16px" href="{{ route('user.employee.index') }}" class="nav-item nav-link d-flex align-items-center {{ request()->route()->named('*employee*') ? 'active' : '' }}"><i class="fa fa-address-book"></i>団員リスト</a>
                    <div class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action {{ request()->route()->named('*profile*') ? 'active' : '' }}">
                            <img src="{{ asset(Auth::user()->profile_img) }}" class="avatar" alt="Avatar">{{ Auth::user()->name_kana }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('user.profile.show', ['profile' => Auth::user()->employee_id]) }}" class="dropdown-item"><i class="fa fa-user-circle"></i>プロフィール</a>
                            <div class="divider dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @include('components.toastr')

        <script type="module">
            $(function() {
                var topBtn = $('#page-top');
                topBtn.hide();
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        topBtn.fadeIn();
                    } else {
                        topBtn.fadeOut();
                    }
                });
                topBtn.click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 100);
                    return false;
                });
            });
        </script>

        <main>
            @yield('content')
            @yield('script')
            <p id="page-top"><a href="#"><i class="fas fa-arrow-circle-up"></i></a></p>
        </main>

        <footer class="footer mt-auto py-3">
            <div class="container px-3" style="text-align:center;">
                <i class="fa fa-copyright"></i> 2021 Employee List Ver.1.0.1
            </div>
        </footer>
    </div>
</body>

</html>
