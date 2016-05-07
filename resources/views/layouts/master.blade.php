<html>
    <head>
        <title>Fancy Blog</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href= "{{ URL::asset('assets/css/main.css')}}" />
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>


        <style>
        body{background-image: url({{URL::asset('images/blog20.jpg')}});}

        </style>
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>

    <body class="landing">
        <div id="page-wrapper">

            <!-- Header -->
                <header id="header" class="alt">
                    <h1><a href="{{ url('/index') }}">Blog</h1>
                    <nav id="nav">
                        <ul>
                            <li><a href="{{ url('/blank') }}">Home</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                            @if (Auth::guest())
                                  <li><a href="{{ url('/register') }}" class="button">Sign Up</a></li>
                            @else
                                  <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                          {{ Auth::user()->name }} <span class="caret"></span>
                                      </a>

                                      <ul class="dropdown-menu" role="menu">
                                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                      </ul>
                                  </li>
                            @endif
                        </ul>
                    </nav>
                </header>
        </div>



        @section('sidebar')
        @show

        <div class="container">
            @yield('content')
        </div>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.dropotron.min.js"></script>
            <script src="assets/js/jquery.scrollgress.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>
    </body>
</html>