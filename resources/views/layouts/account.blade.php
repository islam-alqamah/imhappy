<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ config('app.name', 'Laravel') }} @yield('title') - {{ \App\Models\Team::find(currentTeam()->id)->settings->company_name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="ImHappy"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/img/newlogo.png') }}">
    <link rel="icon" href="{{ url('assets/img/newlogo.png') }}" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <link href="{{ url('assets/dist/vendors') }}/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/dist/') }}/css/fancy-buttons.css" rel="stylesheet" type="text/css">
@yield('styles')
    <!-- Custom CSS -->
    <link href="{{ url('assets/dist/') }}/css/style.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="print">
        .dont-print
        {
            display:none;
        }
        .col-md-6{
            width: 45%;
            float: left;
            margin: 20px;
        }
    </style>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@0.3.0/dist/lottie-player.js"></script>
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"></div>
    <div id="app" style="margin: auto ;display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
">
        <center><lottie-player
                src="https://assets1.lottiefiles.com/packages/lf20_ziglw7bd.json"
                style="width: 200px; "
                autoplay
                loop
        ></lottie-player></center>
    </div>
</div>
<!-- /Preloader -->
<div class="wrapper theme-1-active pimary-color-blue">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top dont-print">
        <div class="mobile-only-brand pull-left dont-print">
            <div class="nav-header pull-left">
                <div class="logo-wrap ">
                    <a href="{{ route('dashboard') }}" >
                        <img class="brand-img" width="100git" src="{{ url('images/logos/logo-h.png') }}" alt="brand"/>
                    </a>
                </div>
            </div>
            <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
            <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
            <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
            <form id="search_form" role="search" class="top-nav-search collapse pull-left">
                <div class="input-group mt-10">
                    <a href="#" style="color:#15E2BE">{{ currentTeam()->settings->company_name }} - {{ (currentTeam()->subscribe)?currentTeam()->subscribe->ends_at:'' }}</a>
                </div>
            </form>
        </div>
        <div id="mobile_only_nav" class="mobile-only-nav pull-right dont-print">
            <ul class="nav navbar-right top-nav pull-right">
                <li class="dropdown auth-drp">
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <li>
                            <a href="{{ route('account.profile') }}"><i class="zmdi zmdi-account"></i><span>{{ __('Profile') }}</span></a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
                                <i class="zmdi zmdi-power"></i><span>{{ __('Logout') }}</span></a>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown auth-drp">
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                        <i class="fa fa-globe"></i> {{ App::getLocale() }}</a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <li>
                            <a href="{{ url('languages/en/back') }}"><i class="zmdi zmdi-account"></i><span>{{ __('EN') }}</span></a>
                        </li>
                        <li>
                            <a href="{{ url('languages/ar/back') }}"><i class="zmdi zmdi-account"></i><span>{{ __('AR') }}</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left dont-print">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li class="navigation-header">
                <span>Main</span>
                <i class="zmdi zmdi-more"></i>
            </li>
            <li>
                <a class="{{ return_if(on_page('dashboard'), ' active') }}" href="{{ url('/dashboard') }}" >
                    <div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i>
                        <span class="right-nav-text">{{ __('Dashboard') }}</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a class="{{ return_if(on_page('charts'), ' active') }}" href="{{ url('/charts') }}" >
                    <div class="pull-left"><i class="zmdi zmdi-chart mr-20"></i>
                        <span class="right-nav-text">{{ __('Charts & Analytics') }}</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li>
                <a class="{{ return_if(on_page('reports'), ' active') }}" href="{{ url('/reports') }}" >
                    <div class="pull-left"><i class="zmdi zmdi-comment-list mr-20"></i>
                        <span class="right-nav-text">{{ __('Reports') }}</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li><hr class="light-grey-hr mb-10"/></li>
            <li>
                <a class="{{ return_if(on_page('branches.branches') , ' active') }}" href="{{ route('branches.branches') }}">
                    <div class="pull-left">
                        <i class="zmdi zmdi-store mr-20"></i>
                        <span class="right-nav-text">{{ __('Branches') }}</span></div>
                    <div class="clearfix"></div></a>
            </li>

            <li><hr class="light-grey-hr mb-10"/></li>
            <li>
                <a class="{{ return_if(on_page('points.all') , ' active') }}" href="{{ route('points.all') }}">
                    <div class="pull-left">
                        <i class="zmdi zmdi-tab mr-20"></i>
                        <span class="right-nav-text">{{ __('All Points') }}</span></div>
                    <div class="clearfix"></div></a>
            </li>
            <li><hr class="light-grey-hr mb-10"/></li>

            <li>
                <a class="{{ return_if(on_page('account.profile') or on_page('account.settings') or on_page('account.preference') or on_page('account.social') , ' active') }}" href="javascript:void(0);" data-toggle="collapse" data-target="#account">
                    <div class="pull-left">
                        <i class="zmdi zmdi-account mr-20"></i>
                        <span class="right-nav-text">{{ __('Account') }}</span></div>
                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                    <div class="clearfix"></div></a>
                <ul id="account" class="collapse collapse-level-1">
                    <li>
                        <a class="{{ return_if(on_page('account.settings'), ' active-page ') }}" href="{{ route('account.settings') }}">{{ __('Settings') }}</a>
                    </li>
                    <li>
                        <a class="{{ return_if(on_page('account.profile'), ' active-page ') }}" href="{{ route('account.profile') }}">{{ __('Profile') }}</a>
                    </li>
                    <li>
                        <a class="{{ return_if(on_page('account.payments'), ' active-page ') }}" href="{{ route('account.payments') }}">{{ __('Payments History') }}</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid ">
<div class="dont-print">
    @if(!isset(currentTeam()->subscribe))
        @if(\Carbon\Carbon::today() > currentTeam()->trial_ends_at)
            <div class="alert alert-danger text-center">
                <h3 style="color: #ffffff"><i class="zmdi zmdi-block pr-15 pull-left"></i>{{ __('You are in a trial mode .') }}</h3>
                <h6 style="color: #ffffff">{{ __('Your free trial is Ended') }}</h6>
                <p> {{ __('Your clients now not be able to access your points') }}</p>
                <br/>
                <a href="{{ route('account.plan') }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="row">
                    <div class="col-md-8">
                        <h4 style="color: #ffffff"> <i class="zmdi zmdi-alert-circle-o pr-15 pull-left"></i> {{ __('You are in a trial mode .') }}</h4>
                        <p style="color: #ffffff">{{ __('Your free trial will ends at') }} {{ currentTeam()->trial_ends_at }}</p>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('account.plan') }}" class="btn btn-primary pull-right">{{ __('Subscribe Now') }}</a>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

                @yield('content')

        </div>

        <!-- Footer -->
        <footer class="footer container-fluid pl-30 pr-30">
            <div class="row">
                <div class="col-sm-12">
                    <p>2021 &copy; I'M Happy Network</p>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Content -->


</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Data table JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ url('assets/dist/') }}/js/jquery.slimscroll.js"></script>

<!-- Progressbar Animation JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="{{ url('assets/dist/vendors') }}/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ url('assets/dist/') }}/js/dropdown-bootstrap-extended.js"></script>

<!-- Sparkline JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

<!-- Owl JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- Switchery JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.js"></script>

<!-- EChartJS JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/echarts/dist/echarts-en.min.js"></script>
<script src="{{ url('assets/dist/vendors') }}/echarts-liquidfill.min.js"></script>

<!-- Toast JavaScript -->
<script src="{{ url('assets/dist/vendors') }}/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

@yield('scripts')
<!-- Init JavaScript -->
<script src="{{ url('assets/dist/') }}/js/init.js"></script>
<script src="{{ url('assets/dist/') }}/js/dashboard-data.js"></script>
<script>
    var ApiURL = '{{ url('api/') }}';
</script>


@error('question')
<script>
    $(window).load(function(){

        $.toast({
            heading: '{{ __('System Message !') }}',
            text: 'Please, write a question to save your form.',
            position: 'top-center',
            loaderBg:'#ff0000',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        });

    });
</script>
@enderror

@error('logo')
<script>
    $(window).load(function(){

        $.toast({
            heading: '{{ __('System Message !') }}',
            text: '{{ $message }}',
            position: 'top-center',
            loaderBg:'#ff0000',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        });

    });
</script>
@enderror

@if (session()->has('status'))
    <script>
        $(window).load(function(){

        		$.toast({
        			heading: '{{ __('System Message !') }}',
        			text: '{{ __( session()->get('msg') ) }}',
        			position: 'top-center',
        			loaderBg:'#f8b32d',
        			icon: '{!! session()->get('status') !!}',
        			hideAfter: 3500,
        			stack: 6
        		});

        });
    </script>
@endif
</body>


</html>

