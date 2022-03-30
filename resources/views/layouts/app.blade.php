<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MatabeOnline Clinic Management Software</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('resources/css/app.css') }}">

    <?php
    echo '
    <!-- Bootstrap -->
    <link href="'.url('back/vendors/bootstrap/dist/css/bootstrap.min.css').'" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="'.url('back/vendors/font-awesome/css/font-awesome.min.css').'" rel="stylesheet">
    <!-- NProgress -->
    <link href="'.url('back/vendors/nprogress/nprogress.css').'" rel="stylesheet">
    <!-- iCheck -->
    <link href="'.url('back/vendors/iCheck/skins/flat/green.css').'" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="'.url('back/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css').'" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="'.url('back/build/css/custom.min.css" rel="stylesheet').' " >' ;
    ?>

</head>

<body style="background: #fff;text-align: center;">
    <div class="col-md-12 col-sm-12 col-xs-12"  >

        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;margin-bottom: 50px;">
            <h1>
                MatabeOnline Clinic Management Software
            </h1>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            @yield('content')
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" >

            <div class="col-md-12 col-sm-12 col-xs-12" >
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-link">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-link">{{ __('Register') }}</a>
                    @endif
                @else

                    <a href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12" >
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            @endguest

        </div>

    </div>
</body>
</html>
