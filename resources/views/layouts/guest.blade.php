<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    
    <!-- Loading Bootstrap -->
    <link href="{{ asset('saas/home/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Loading Template CSS -->
    <link href="{{ asset('saas/home/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('saas/home/css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('saas/home/css/pe-icon-7-stroke.css')}}">
    <link href="{{ asset('saas/home/css/style-magnific-popup.css')}}" rel="stylesheet">

    <!-- Awsome Fonts -->
    <link rel="stylesheet" href="{{ asset('saas/home/css/all.min.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Cabin:700" rel="stylesheet">

    <!-- Font Favicon -->
    <link rel="shortcut icon" href="{{ asset('saas/img/favicon.png') }}">
    @livewireStyles
    @stack('styles')
    <style>
        .card-body{
            border-top:none;
        }
        .navbar-fixed-top .navbar-nav .current a{
            color: #5f6468 !important;
        }
    </style>
</head>

<body>

    <!-- ======== End Navbar ======== -->
<!--begin header -->
<header class="header">

    <!--begin navbar-fixed-top -->
    <nav class="navbar navbar-default navbar-fixed-top">
        
        <!--begin container -->
        <div class="container">

            <!--begin navbar -->
            <nav class="navbar navbar-expand-lg">

                <!--begin logo -->
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('saas/img/logo.png') }}" class="navbar-brand-img" alt="knine" style="max-height: 3rem;">
                </a>
                <!--end logo -->

                <!--begin navbar-toggler -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <!--end navbar-toggler -->

                <!--begin navbar-collapse -->
                <div class="navbar-collapse collapse" id="navbarCollapse" style="">
                    
                    <!--begin navbar-nav -->
                    <ul class="ml-auto navbar-nav">
                        @if(Request::is('/'))
                            <li class="link"><a href="#home">{{ __('Home') }}</a></li>

                            <li class="link"><a href="#about">{{ __('About') }}</a></li>

                            <li class="link"><a href="#pricing">{{ __('Pricing') }}</a></li>

                            <li class="link"><a href="#contact">{{ __('Contact') }}</a></li>
                        @endif

            @guest
            {{-- <a href="/login" role="button" class="btn-1">Login</a> --}}
            <li class="discover-link"><a href="{{ url('/register') }}" class="external">{{ __('Register') }}</a></li>
            <li class="discover-link"><a href="{{ url('/login') }}" class="external discover-btn">{{ __('Login') }}</a></li>
            @else
            <div>
                <span class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" style="padding-top: 0;" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <span class="avatar rounded-circle">
                            <img alt="Image placeholder" class="rounded-circle" width="35" src="{{ Auth::user()->profile_photo_url }}">
                        </span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- User Account Link -->
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <span class="dropdown-item-icon">
                            <i class="fas fa-user"></i>
                            </span>
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('account.password') }}">
                            <span class="dropdown-item-icon">
                            <i class="fas fa-unlock-alt"></i>
                            </span>
                            {{ __('Password') }}
                        </a>
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                            <span class="dropdown-item-icon">
                            <i class="fab fa-keycdn"></i>
                            </span>
                            {{ __('API Tokens') }}
                        </a>
                        @endif
                        @role('admin')
                        <a class="dropdown-item" target="__blank" href="{{ route('admin.index') }}">
                            <span class="dropdown-item-icon">
                            <i class="fas fa-tachometer-alt"></i>
                            </span>
                            {{ __('Admin panel') }}
                        </a>
                        @endrole
                        @auth
                            <!-- Team Switcher -->
                            <small class="dropdown-item">
                                {{ __('Switch teams') }}
                            </small>
                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach
                        @endauth
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span class="dropdown-item-icon">
                            <i class="fas fa-power-off"></i>
                            </span>
                            {{ __('Logout') }}
                        </a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>

                        <div class="dropdown-divider"></div>
                    </div>
                </span>
            </div>
            @endguest
            <li class="nav-item dropdown mr-4">
                <div class="hs-unfold">
                  <a class="pr-0 nav-link btn btn-secondary" href="#" role="button" data-toggle="dropdown" style="background-color:transparent; border:0px;"
                      aria-haspopup="true" aria-expanded="false">
                      <div class="media-body d-none d-lg-block">
                        <img src="{{ asset('saas/svg/flags/'.app()->getLocale().'.svg') }}" alt="United States Flag">
                        <span>{{ app()->getLocale()  }}</span>
                      </div>
                  </a>

                  <div id="footerLanguage" class="hs-unfold-content dropdown-menu dropdown-unfold dropdown-menu-bottom mb-2">
                    @foreach (language()->allowed() as $code => $name)
                      <a class="dropdown-item" href="{{ language()->back($code) }}">{{ $name }}</a>
                    @endforeach
                  </div>
                </div>
              </li>
                    </ul>
                    <!--end navbar-nav -->

                </div>
                <!--end navbar-collapse -->

            </nav>
            <!--end navbar -->

        </div>
        <!--end container -->
        
    </nav>
    <!--end navbar-fixed-top -->
    
</header>
<!--end header -->
        {{ $slot }}
    
    <!--begin footer -->
    <div class="footer">
            
        <!--begin container -->
        <div class="px-0 container-fluid">
        
            <!--begin row -->
            @if (\Request::is('/'))
            <div class="mx-0 row no-gutters">
            
                <!--begin col-md-4 -->
                <div class="text-center col-md-4 footer-white-box">
                   
                    <i class="pe-7s-map-2"></i>

                    <h5>{{ __('Get In Touch') }}</h5>

                    <p>{{ __('10 Oxford Street, London, UK, E1 1EC') }}</p>
                    
                    <p><a href="mailto:info@knine.ml">{{ __('info@creatydev.com') }}</a></p>
                    
                    <p>{{ __('+1 786 749 7342') }}</p>
                    
                </div>
                <!--end col-md-4 -->
                
                <!--begin col-md-4 -->
                <div class="text-center col-md-4 footer-blue-box">
                   
                    <i class="pe-7s-comment"></i>

                    <h5>{{ __('Social Media') }}</h5>

                    <p>{{ __('See bellow where you can find us.') }}</p>
                                         
                    <!--begin footer_social -->
                    <ul class="footer_social">

                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>

                        <li><a href="#"><i class="fab fa-pinterest"></i></a></li>

                        <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>

                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>

                        <li><a href="#"><i class="fab fa-skype"></i></a></li>

                        <li><a href="#"><i class="fab fa-dribble"></i></a></li>

                    </ul>
                    <!--end footer_social -->
                    
                </div>
                <!--end col-md-4 -->
                
                <!--begin col-md-4 -->
                <div class="text-center col-md-4 footer-grey-box">
                   
                    <i class="pe-7s-link"></i>

                    <h5>{{ __('Useful Links') }}</h5>

                    <a href="#" class="footer-links">{{ __('Terms and Conditions') }}</a>
                    
                </div>
                <!--end col-md-4 -->
                
            </div>
            <!--end row -->
            @endif
            <!--begin row -->
            <div class="row">
            
                <!--begin col-md-12 -->
                <div class="text-center col-md-12 footer-bottom">
                   
                    <p>{{ __('Copyright') }} © {{date('Y')}} <strong>{{ __('Im Happy ') }}</strong>, {{ __('all rights reserved') }}.</p>
                    
                </div>
                <!--end col-md-6 -->
                
            </div>
            <!--end row -->
            
        </div>
        <!--end container -->
                
    </div>
    <!--end footer -->

    @livewireScripts
<script src="{{ asset('saas/home/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('saas/home/js/bootstrap.min.js')}}"></script>
{{-- <script src="{{ asset('saas/home/js/jquery.scrollTo-min.js')}}"></script> --}}
<script src="{{ asset('saas/home/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('saas/home/js/jquery.nav.js')}}"></script>
<script src="{{ asset('saas/home/js/wow.js')}}"></script>
<script src="{{ asset('saas/home/js/plugins.js')}}"></script>
<script src="{{ asset('saas/home/js/custom.js')}}"></script>

  <!--Start of Tawk.to Script-->
  @if (config('saas.demo_mode'))
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5fbb1a42a1d54c18d8ec4a68/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    @endif
    <!--End of Tawk.to Script-->
</body>
</html>