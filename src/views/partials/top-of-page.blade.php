<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('browser-title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/css/custom.css">
    @yield('css')
</head>
<body>

<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 hidden-xs">
                <div class="top-bar-socials">
                    <a href="#" target="_blank" class="social-icon">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="#" target="_blank" class="social-icon">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="#" target="_blank" class="social-icon">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="#" target="_blank" class="social-icon">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-8 text-right">
                <ul class="list-inline top-right">
                    <li class="hidden-sm hidden-xs">
                        <a href="mailto:info@worldwidetourism.com">
                            <i class="fa fa-envelope"></i> info@worldwidetourism.com
                        </a>
                    </li>
                    <li class="hidden-sm hidden-xs">
                        <a href="tel:12125551212">
                            <i class="fa fa-phone"></i> 212.555.1212
                        </a>
                    </li>
                    <li class="hidden-xs">
                        <div id="search-form" style="line-height: 12px">
                            <form method="POST" action="" accept-charset="UTF-8">
                                <input class="search-text-box" name="searchterm" type="text">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            </li>
            </ul>
        </div>
    </div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/services">Services</a></li>
                <li><a href="/register">Register</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            @if(isset($session))
                @if($session->has('user'))
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/admin/dashboard">Admin</a></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/login"><i class="fa fa-lock"></i></a></li>
                </ul>
                @endif
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/login"><i class="fa fa-lock"></i></a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>
