<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Typo correction">
        <meta name="author" content="Suyanwar">
        <title>TypoOffline</title>
        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{asset('css/logo-nav.css')}}" rel="stylesheet">
        <!-- Bootstrap core JavaScript -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('images/typonesia-02.png')}}" width="150" height="30" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/')}}">
                                <img class='image-menu' src="{{asset('images/pensil.png')}}" alt='word' />
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/doc')}}">
                                <img class='image-menu' src="{{asset('images/dokumen.png')}}" alt='doc' />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        @yield('content')
        <!-- End of page content -->
    </body>
</html>

