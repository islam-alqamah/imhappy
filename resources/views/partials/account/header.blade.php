<header id="header" class="header left-aligned-navbar">
    <div class="header-section">

      <div id="logoAndNav" class="container mt-lg-n2">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-lg">
          <div class="navbar-nav-wrap">
            <!-- Logo -->
            <a class="navbar-brand navbar-nav-wrap-brand" href="/" aria-label="Front">
              <img src="{{ asset('saas/img/logo.png') }}" alt="Saasify logo">
            </a>
            <!-- End Logo -->

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content">
              <!-- Search Classic -->
              <div class="hs-unfold d-lg-none d-inline-block position-static">
                <a class="js-hs-unfold-invoker btn btn-xs btn-icon rounded-circle" href="javascript:;"
                   data-hs-unfold-options='{
                    "target": "#searchClassic",
                    "type": "css-animation",
                    "animationIn": "slideInUp"
                   }'>
                  <i class="fas fa-search"></i>
                </a>

                <div id="searchClassic" class="hs-unfold-content dropdown-menu w-100 border-0 rounded-0 px-3 mt-0">
                  <form class="input-group input-group-sm input-group-merge">
                    <input type="text" class="form-control" placeholder="What do you want to learn?" aria-label="What do you want to learn?">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <i class="fas fa-search"></i>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- End Search Classic -->

              <!-- Account -->
              {{-- <div class="Flex-l69ttv-0 NotificationsButton__Container-sc-1n4kzzb-0 fdwnXP">
                <div class="Flex-l69ttv-0 Bell__IconContainer-ny25t8-0 ioYuSX"><svg width="17" height="19" viewBox="0 0 17 19" fill="none" class="Bell__Icon-ny25t8-2 dUdacl"><path d="M8.57 18.356c-1.65 0-3-1.35-3-3h1.25c0 .96.79 1.75 1.75 1.75s1.75-.79 1.75-1.75h1.25c0 1.65-1.35 3-3 3zM14.56 14.356H2.58c-.52 0-1.01-.25-1.32-.67-.3-.42-.39-.97-.22-1.46l2.84-8.53c.67-2 2.53-3.34 4.63-3.34h.12c2.1 0 3.96 1.34 4.62 3.33l2.84 8.53c.16.49.08 1.04-.22 1.46-.3.43-.79.68-1.31.68zM8.51 1.606c-1.56 0-2.94 1-3.44 2.48l-2.84 8.53c-.05.16.01.28.05.34s.14.16.3.16h11.98c.17 0 .26-.1.3-.16.04-.06.1-.18.05-.34l-2.84-8.53a3.625 3.625 0 00-3.44-2.48h-.12z" fill="currentColor"></path>
                </svg></div></div> --}}

              <div class="hs-unfold ml-4">
                @auth
                <a class="js-hs-unfold-invoker rounded-circle" href="javascript:;"
                   data-hs-unfold-options='{
                    "target": "#accountDropdown",
                    "type": "css-animation",
                    "event": "hover",
                    "duration": 50,
                    "delay": 0,
                    "hideOnScroll": "true"
                   }'>
                  <span class="avatar avatar-xs avatar-circle">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                      <img class="avatar-img"  src="{{ optional(Auth::user())->profile_photo_url }}" alt="{{ optional(Auth::user())->name }}" />
                      @else
                        {{ Auth::user()->name }}
                    @endif
                  </span>
                </a>
                <div id="accountDropdown" class="hs-unfold-content dropdown-menu dropdown-menu-sm-right dropdown-menu-no-border-on-mobile p-0" style="min-width: 245px;">
                  <div class="card">

                    <!-- Body -->
                    <div class="card-body py-3">
                      <a class="dropdown-item px-0" href="{{ route('profile.show') }}">
                        <span class="dropdown-item-icon">
                          <i class="fas fa-user"></i>
                        </span>
                        {{ __('Profile') }}
                      </a>
                      <a class="dropdown-item px-0" href="{{ route('account.password') }}">
                        <span class="dropdown-item-icon">
                          <i class="fas fa-unlock-alt"></i>
                        </span>
                        {{ __('Password') }}
                      </a>
                      @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                      <a class="dropdown-item px-0" href="{{ route('api-tokens.index') }}">
                        <span class="dropdown-item-icon">
                          <i class="fab fa-keycdn"></i>
                        </span>
                        {{ __('API Tokens') }}
                      </a>
                      @endif
                      @role('admin')
                      <a class="dropdown-item px-0" target="__blank" href="{{ route('admin.index') }}">
                        <span class="dropdown-item-icon">
                          <i class="fas fa-tachometer-alt"></i>
                        </span>
                        {{ __('Admin panel') }}
                      </a>
                      @endrole
                      @auth
                        <!-- Team Switcher -->
                        <h6 class="dropdown-item px-0">
                          <span class="dropdown-item-icon">
                            <i class="fas fa-users"></i>
                          </span>
                            {{ __('SWITCH TEAMES') }}
                        </h6>
                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" />
                        @endforeach
                      @endauth
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item px-0" href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        <span class="dropdown-item-icon">
                          <i class="fas fa-power-off"></i>
                        </span>
                        {{ __('Logout') }}
                      </a>
                      <form method="POST" id="logout-form" action="{{ route('logout') }}">
                          @csrf
                      </form>
                    </div>
                    <!-- End Body -->
                  </div>
                </div>
                @endauth
              </div>
              
              <!-- End Account -->
            </div>
            <!-- End Secondary Content -->

            <!-- Responsive Toggle Button -->
            <button type="button" class="navbar-toggler navbar-nav-wrap-navbar-toggler btn btn-icon btn-sm rounded-circle"
                    aria-label="Toggle navigation"
                    aria-expanded="false"
                    aria-controls="navBar"
                    data-toggle="collapse"
                    data-target="#navBar">
              <span class="navbar-toggler-default">
                <svg width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M17.4,6.2H0.6C0.3,6.2,0,5.9,0,5.5V4.1c0-0.4,0.3-0.7,0.6-0.7h16.9c0.3,0,0.6,0.3,0.6,0.7v1.4C18,5.9,17.7,6.2,17.4,6.2z M17.4,14.1H0.6c-0.3,0-0.6-0.3-0.6-0.7V12c0-0.4,0.3-0.7,0.6-0.7h16.9c0.3,0,0.6,0.3,0.6,0.7v1.4C18,13.7,17.7,14.1,17.4,14.1z"/>
                </svg>
              </span>
              <span class="navbar-toggler-toggled">
                <svg width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                </svg>
              </span>
            </button>
            <!-- End Responsive Toggle Button -->

            <!-- Navigation -->
            <div id="navBar" class="navbar-nav-wrap-navbar collapse navbar-collapse">
              <ul class="js-scroll-nav navbar-nav">
                <!-- Courses -->
                
                <!-- End Courses -->

                <!-- Search Form -->
                <li class="d-none d-lg-inline-block navbar-nav-item flex-grow-1 mx-2">
                  <form class="input-group input-group-sm input-group-merge w-75">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-search"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="What do you want to learn?" aria-label="What do you want to learn?">
                  </form>
                </li>
                <!-- End Search Form -->
                  <li class="header-nav-item {{ return_if(on_page('home'), ' active') }}">
                    <a class="nav-link header-nav-link" href="/">{{ __('Home') }}</a>
                  </li>
                  @if (Request::is('/'))
                    <li class="header-nav-item">
                      <a class="nav-link header-nav-link" href="#featuresSection">Features</a>
                    </li>
                    <li class="header-nav-item">
                      <a class="nav-link header-nav-link" href="#price">{{ __('Price') }}</a>
                    </li>
                  @endif
                  <li class="header-nav-item {{ return_if(on_page('contact'), ' active') }}">
                    <a class="nav-link header-nav-link" href="/contact">{{ __('Contact') }}</a>
                  </li>
                  @guest
                  <li class="header-nav-item {{ return_if(on_page('login'), ' active') }}">
                    <a class="nav-link header-nav-link" href="/login">{{ __('Login') }}</a>
                  </li>  
                  <li class="navbar-nav-last-item {{ return_if(on_page('register'), ' active') }}">
                    <a class="btn btn-sm btn-primary transition-3d-hover" href="/register">
                      {{ __('Register') }}
                    </a>
                  </li>
                  @endguest
              </ul>
            <!-- End Language -->
            </div>
            <!-- End Navigation -->
          </div>
        </nav>
        <!-- End Nav -->
      </div>
    </div>
  </header>