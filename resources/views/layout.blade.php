<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>VietnamGo</title>
    <link rel="icon" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('assets/libs/fontawesome-free-6.0.0-web/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/fontawesome-free/css/all.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <style>
        .w-5 {
            display: none;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #form-background {
            background-image: url('/image/bgForm.png');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            max-height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <main>
        <section class="menu">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning">
                <a class="navbar-brand text-uppercase text-light font-weight-bold" href="{{route('home.page')}}" style="margin-left:4rem"><img src="{{ URL::to('/') }}/image/vngo-logo.png" style="width:4rem" /></a>
                <div class="navbar-brand text-uppercase text-light font-weight-bold" style="margin-left:2rem">Hotline:&nbsp<span class="text-primary"> <a href="#">1900.8080</a></span></div>
                <div class="collapse navbar-collapse d-flex justify-content-end" style="margin-right:4rem">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ (request()->is('home*')) ? 'active text-warning' : 'text-light' }}" href="{{route('home.page')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ (request()->is('travel*')) ? 'active text-warning' : 'text-light' }}" href="{{route('travel.list')}}">Travel</a>
                        </li>
                    </ul>
                </div>
            </nav>
    </main>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="{{ asset('
            assets / js / vendor / jquery - slim.min.js ') }}"><\/script>')
    </script>
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>

    @yield('after_script')
</body>

</html>