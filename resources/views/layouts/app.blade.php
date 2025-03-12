<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{!! env('SITENAME') !!}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        #people {
            width: 100%;
            height: 600px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script   src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>

    @if(env('TREE_VIEW'))
    <script src="{{  url('/getorgchart/getorgchart.js') }}"></script>
    <link href="{{url('getorgchart/getorgchart.css')}}" rel="stylesheet" />
    @endif
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    {!! env('SITENAME') !!}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/publication/list') }}">{{env('PUBLICATION_LIST_NAME')}}</a></li>
                    @if(env('CONSTRUCT_LIST'))
                    <li><a href="{{ url('/construct/list') }}">Constructs</a></li>
                    <!--<li><a href="{{ url('/conflict/list') }}">Conflicts</a></li>-->
                    <li class=""><a href="{!! url('/suggest') !!}">Suggest Papers</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">


                    @can('rule','team')
                    <li class=""><a href="{!! url('/publication/create') !!}">Paper Submit</a></li>
                    <!-- Admin Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Team Dashboard <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/team/publication') }}"><i class="fa fa-btn fa-book"></i>Publications</a></li>
                            <li><a href="{{ url('/team/tag') }}"><i class="fa fa-btn fa-tag"></i>Tags</a></li>
                            <li><a href="{{ url('/team/conflict') }}"><i class="fa fa-btn fa-tag"></i>Conflicts</a></li>
                            @can('rule','admin')
                                <li><a href="{{ url('/admin/category') }}"><i class="fa fa-btn fa-navicon"></i>Category</a></li>
                                <li><a href="{{ url('/team/classification') }}"><i class="fa fa-btn fa-navicon"></i>Classification/Finalities</a></li>
                                <li><a href="{{ url('/team/representationform') }}"><i class="fa fa-btn fa-navicon"></i>Representation Forms</a></li>
                                <li><a href="{{ url('/admin/quality') }}"><i class="fa fa-btn fa-navicon"></i>Quality</a></li>
                                <li><a href="{{ url('/admin/user') }}"><i class="fa fa-btn fa-users"></i>Users</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan


                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Team Login <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/google') }}"><i class="fa fa-btn fa-google"></i>by Google</a></li>
                                <!--<li><a href="{{ url('/auth/facebook') }}"><i class="fa fa-btn fa-facebook-official"></i>by Facebook</a></li>
                                <li><a href="{{ url('/auth/github') }}"><i class="fa fa-btn fa-github-alt"></i>by GitHub</a></li>-->
                            </ul>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar }}" class="img-circle" height="25px">
                                {{ Auth::user()->name }}  <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>



    @if(session('status'))
        <div class="container">
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="container">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        </div>
    @endif

    @yield('content')


    <div class="container">
        This catalog manager is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" target="_blank">MIT License</a>. Copyright (c)  Tiago Heineck, Milene Cavalcante, Enyo Gonçalves, João Araújo
    </div>

    <link rel="stylesheet" href="{!! asset('app.css') !!}">

    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
