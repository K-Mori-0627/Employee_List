<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee List | @yield('Title')</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0182f41647.js" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/user/default.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/face_to_faith.ico') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <a href="{{ route('user.home.index') }}" class="navbar-brand"><i class="fab fa-d-and-d"></i><b>Employee List</b></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
            <div class="navbar-nav ml-auto">
                <a href="{{ route('user.home.index') }}" class="nav-item nav-link {{ request()->route()->named('*home*') ? 'active' : '' }}"><i class="fa fa-home"></i><span>Home</span></a>
                <a href="{{ route('user.member.index') }}" class="nav-item nav-link {{ request()->route()->named('*member*') ? 'active' : '' }}"><i class="fa fa-address-book"></i><span>団員リスト</span></a>
                <div class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action {{ request()->route()->named('*profile*') ? 'active' : '' }}">
                        @if (is_null(Auth::user()->profile_img))
                        <img src="{{ asset('img/image.png') }}" class="avatar" alt="Avatar">{{ Auth::user()->name_kana }}
                        @else
                        <img src="{{ Auth::user()->profile_img }}" class="avatar" alt="Avatar">{{ Auth::user()->name_kana }}
                        @endif
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('user.profile.show', ['profile' => Auth::user()->member_id]) }}" class="dropdown-item"><i class="fa fa-user-circle"></i>プロフィール</a>
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

    <script type="text/javascript">
        @if (session('msg_success'))
            $(function () {
                toastr.success('{{ session('msg_success') }}');
            });
        @endif

        @if (session('msg_error'))
            $(function () {
                toastr.error('{{ session('msg_error') }}');
            });
        @endif

        $(function () {
            var topBtn = $('#page-top');
            topBtn.hide();
            $(window).scroll(function () {
                if ($(this).scrollTop() > 500) {
                    topBtn.fadeIn();
                } else {
                    topBtn.fadeOut();
                }
            });
            topBtn.click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 500);
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
</body>

</html>
