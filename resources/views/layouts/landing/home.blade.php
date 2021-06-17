<!DOCTYPE html>
<html lang="en">
<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!--====== Title ======-->
    <title>I'M Happy</title>

    <!--====== Favicon Icon ======-->
    <link
            rel="shortcut icon"
            href="{{ url('assets/img/newlogo.png') }}"
            type="image/png"
    />

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/landing/css/bootstrap.min.css" />

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="assets/landing/css/font-awesome.min.css" />

    <!--====== flaticon css ======-->
    <link rel="stylesheet" href="assets/landing/css/flaticon.css" />

    <!--====== odometer css ======-->
    <link rel="stylesheet" href="assets/landing/css/odometer.min.css" />

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/landing/css/magnific-popup.css" />

    <!--====== animate css ======-->
    <link rel="stylesheet" href="assets/landing/css/animate.min.css" />

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/landing/css/slick.css" />

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/landing/css/default.css" />

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/landing/css/themify-icons.css" />
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="assets/landing/css/style-rtl.css?v=2" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700&display=swap" rel="stylesheet">
        <style>
            html{
                direction: rtl;

            }
            *:not(i){
                font-family: 'Almarai', sans-serif!important;
            }
            .banner-area::before {
                position: absolute;
                content: '';
                left: 0;
                top: 0;
                height: 100%;
                background-size:cover ;
                width: 100%;
                z-index: -2;
                background: url({{ url('assets/landing/images/Hero_Big_Arabic.png') }}) no-repeat top center;
                background-repeat: no-repeat;
                min-height: 1250px; }
        </style>
        @else
        <link rel="stylesheet" href="assets/landing/css/style.css?v=2" />
        <style>
            html{
                direction: ltr;
            }
            .banner-area::before {
                position: absolute;
                content: '';
                left: 0;
                top: 0;
                height: 100%;
                background-size:cover ;
                width: 100%;
                z-index: -2;
                background: url({{ url('assets/landing/images/Hero_Big_English.png') }}) no-repeat top center;
                background-repeat: no-repeat;
                min-height: 1250px; }
        </style>
    @endif
    <script src="https://unpkg.com/@lottiefiles/lottie-player@0.3.0/dist/lottie-player.js"></script>
</head>

<body>
<!-- PRELOADER -->
<div class="preloader">
    <div class="lds-ellipsis" style="margin: auto ;display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
">
        <lottie-player
                src="https://assets1.lottiefiles.com/packages/lf20_ziglw7bd.json"
                style="width: 200px;"
                autoplay
                loop
        ></lottie-player>
    </div>
</div>
<!-- END PRELOADER -->

<!--====== side menu PART START ======-->

<div class="side-menu__block">
    <div class="side-menu__block-overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
    <!-- /.side-menu__block-overlay -->
    <div class="side-menu__block-inner">
        <div class="side-menu__top justify-content-end">
            <a href="#" class="side-menu__toggler side-menu__close-btn"
            ><img src="assets/landing/images/close.png" alt=""
                /></a>
        </div>
        <!-- /.side-menu__top -->

        <nav class="mobile-nav__container">
            <!-- content is loading via js -->
        </nav>
        <div class="side-menu__sep"></div>
        <!-- /.side-menu__sep -->
        <div class="side-menu__content">
            <p>
                {{__('Understand your customers and their needs, focus on opportunities, make them satisfied — so they keep coming again, and stay with you longer.')}}
            </p>
            <p>
                <a href="mailto:info@imhappy.app">info@imhappy.app</a> <br />
                <a href="tel:+966507735308">+966 507735308</a>
            </p><p>Prince Fawaz of Saudi Arabia – Jeddah</p>
            <div class="side-menu__social">
                <a href="#"><i class="fa fa-facebook-square"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-pinterest-p"></i></a>
            </div>
        </div>
        <!-- /.side-menu__content -->
    </div>
    <!-- /.side-menu__block-inner -->
</div>
<!-- /.side-menu__block -->

<!--====== side menu PART ends ======-->

<!--====== HEADER PART START ======-->

<header id="home" class="header-area header-v1-area">
    <div class="header-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigation">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="#"
                            ><img class="logo-main" src="assets/landing/images/IM_Happy_logo_white.png" alt=""
                                /></a>
                            <!-- logo -->
                            <a class="navbar-brand-2" href="#"
                            ><img src="assets/landing/images/IM_Happy_logo_white.png" alt=""
                                /></a>
                            <!-- logo -->
                            <span class="side-menu__toggler burger-menu"
                            ><i class="fa fa-bars"></i></span
                            ><!-- /.side-menu__toggler -->

                            <div
                                    class="collapse navbar-collapse sub-menu-bar main-nav__main-navigation"
                                    id="navbarSupportedContent">
                                <ul class="navbar-nav main-nav__navigation-box">
                                    <li class="nav-item active">
                                        <a class="nav-link page-scroll  side-menu__close-btn" href="#home">{{__('Home')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link page-scroll  side-menu__close-btn" href="#about">{{__('About')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link page-scroll  side-menu__close-btn" href="#features">{{__('Features')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link page-scroll side-menu__close-btn" href="#pricing">{{__('Pricing')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        @if(app()->getLocale() == 'ar')
                                        <a class="nav-link page-scroll side-menu__close-btn" href="{{ url('languages/en/back') }}">{{__('English')}}</a>
                                        @else
                                            <a class="nav-link page-scroll side-menu__close-btn" href="{{ url('languages/ar/back') }}">{{__('العربية')}}</a>

                                        @endif
                                    </li>
                                    <li class="nav-item d-md-none">
                                        <a class="main-btn" data-toggle="modal" data-target="#login" href="#">{{__('Sign in Here!')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- navbar collapse -->
                            <div class="navbar-btn d-none d-sm-flex">
                                <a class="main-btn" data-toggle="modal" data-target="#login" href="#">{{__('Sign in Here!')}}</a>
                            </div>
                        </nav>
                    </div>
                    <!-- navigation -->
                </div>
            </div>
        </div>
    </div>
</header>

<!--====== HEADER PART ENDS ======-->

<!--====== BANNER PART START ======-->

<section class="banner-area" >
    <div class="container">
        <div class="banner-items">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="banner-content">
                        <h2 >{{__('A seamless solution to')}}</h2>
                        <h2><span>{{__('upgrade')}}</span> {{__('your performance')}}.</h2>
                        <p style="color: #979797;font-weight: normal">
                            {{__('Understand your customers and their needs, focus on opportunities, make them satisfied — so they keep coming again, and stay with you longer.')}}
                        </p>
                        <a class="main-btn" href="#" data-target="#sign-up" data-toggle="modal" >{{__('Sign up now')}}</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">

                </div>
            </div>
        </div>
    </div>
</section>

<!--====== BANNER PART ENDS ======-->

<!--====== FEATURES PART START ======-->

<section id="features" class="features-area pt-35">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="section-title text-center">
                    <span>{{__('We do more for your product')}}</span>
                    <h2 class="section-sub-title"><span><b>{{__('I’m Happy')}} </b></span> {{__('Providing the best features')}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="features-btn">
                    <ul
                            class="nav nav-pills d-flex justify-content-between"
                            id="pills-tab"
                            role="tablist"
                    >
                        <li class="nav-item">
                            <a
                                    class="nav-link active text-center"
                                    id="pills-1-tab"
                                    data-toggle="pill"
                                    href="#pills-1"
                                    role="tab"
                                    aria-controls="pills-1"
                                    aria-selected="true"
                            >
                                <i class="ti-palette"
                                ><img src="assets/landing/images/features-shape.png" alt="shape"
                                    /></i>
                                <span>{{__('Personalize')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                    class="nav-link"
                                    id="pills-2-tab"
                                    data-toggle="pill"
                                    href="#pills-2"
                                    role="tab"
                                    aria-controls="pills-2"
                                    aria-selected="false"
                            >
                                <i class="ti-dashboard"
                                ><img src="assets/landing/images/features-shape.png" alt="shape"
                                    /></i>
                                <span>{{__('Interactive Dashboard')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                    class="nav-link"
                                    id="pills-3-tab"
                                    data-toggle="pill"
                                    href="#pills-3"
                                    role="tab"
                                    aria-controls="pills-3"
                                    aria-selected="false"
                            >
                                <i class="ti-layout"
                                ><img src="assets/landing/images/features-shape.png" alt="shape"
                                    /></i>
                                <span>{{__('Templates')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                    class="nav-link"
                                    id="pills-4-tab"
                                    data-toggle="pill"
                                    href="#pills-4"
                                    role="tab"
                                    aria-controls="pills-4"
                                    aria-selected="false"
                            >
                                <i class="ti-face-smile"
                                ><img src="assets/landing/images/features-shape.png" alt="shape"
                                    /></i>
                                <span>{{__('Instant Feedback')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                    class="nav-link"
                                    id="pills-5-tab"
                                    data-toggle="pill"
                                    href="#pills-5"
                                    role="tab"
                                    aria-controls="pills-5"
                                    aria-selected="false"
                            >
                                <i class="fa fa-qrcode"
                                ><img src="assets/landing/images/features-shape.png" alt="shape"
                                    /></i>
                                <span>{{__('Multi Channels')}}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div
                                class="tab-pane fade show active"
                                id="pills-1"
                                role="tabpanel"
                                aria-labelledby="pills-1-tab"
                        >
                            <i class="ti-palette"></i>
                            <h4 class="title">{{__('Personalize')}}</h4>
                            <p>
                                {{__('Personalize your form, questions, answers, and colors to match your brand and product.')}}
                            </p>
                        </div>
                        <div
                                class="tab-pane fade"
                                id="pills-2"
                                role="tabpanel"
                                aria-labelledby="pills-2-tab"
                        >
                            <i class="ti-dashboard"></i>
                            <h4 class="title">{{__('Interactive Dashboard')}}</h4>
                            <p>
                                {{__('Professional and Interactive Dashboard to view all the data submitted by your valuable customers which leads you to improve your experience.')}}
                            </p>
                        </div>
                        <div
                                class="tab-pane fade"
                                id="pills-3"
                                role="tabpanel"
                                aria-labelledby="pills-3-tab"
                        >
                            <i class="ti-layout"></i>
                            <h4 class="title">{{__('Templates')}}</h4>
                            <p>
                                {{__('Create your own unlimited questions template or you can choose one to save time and satisfy your needs.')}}
                            </p>
                        </div>
                        <div
                                class="tab-pane fade"
                                id="pills-4"
                                role="tabpanel"
                                aria-labelledby="pills-4-tab"
                        >
                            <i class="ti-face-smile"></i>
                            <h4 class="title">{{__('Instant Feedback')}}</h4>
                            <p>
                                {{__('Real time feedback capturing thoughts to track and improve your customer experience over time.')}}
                            </p>
                        </div>
                        <div
                                class="tab-pane fade"
                                id="pills-5"
                                role="tabpanel"
                                aria-labelledby="pills-5-tab"
                        >
                            <i class="fa fa-qrcode"></i>
                            <h4 class="title">{{__('Multi Channels')}}</h4>
                            <p>
                                {{__('Customer feedback will be easier with our channels (QR code or Toucheless) and the instant feedback you can have it on your device.')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== FEATURES PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section id="about" class="about-area pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-thumb  fadeInLeft" data-wow-duration="1500ms">
                    <img src="assets/landing/images/about-thumb.png" alt="" />

                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title">
                        <span>{{__('We do more for your product')}}</span>
                        <h2 class="section-sub-title">
                            {{__('What')}} <span>{{__('I’m Happy')}}</span> {{__('can do for your company')}}:
                        </h2>
                    </div>
                    <p style="font-weight: normal;font-size: 18px">
                        {{__('Understanding the behavior of your client will help you to track their actions to spot the opportunities you do not utilize and then improve them')}}.
                    </p>
                    <ul>
                        <li>
                            <i class="fa fa-check-circle"></i> {{__('Real-time customer satisfaction reporting')}}.
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> {{__('Professional and Interactive Dashboard')}}.
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> {{__('Enhance brand loyalty')}}.
                        </li>
                        <li>
                            <i class="fa fa-check-circle"></i> {{__('Quickly utilize opportunities')}}.
                        </li>
                    </ul>
                    <a class="main-btn mt-50" data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up now')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== ABOUT PART ENDS ======-->


<!--====== BUSINESS PART START ======-->

<section class="business-area pt-110 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="business-content">
                    <div class="section-title">
                        <span>{{__('We do more for your product')}}</span>
                        <h2 class="section-sub-title">
                            {{__('How')}} <span>{{__('I’m Happy')}}</span> {{__('do it')}}:
                        </h2>
                    </div>
                    <div class="row @if(app()->getLocale()=='en') mr-110 @endif">
                        <div class="col-sm-4">
                            <div class="business-item">
                                <i class="ti-clipboard"></i><br />
                                <span
                                >{{__('Collect')}}</span
                                >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="business-item item-2">
                                <i class="ti-pie-chart"></i><br />
                                <span
                                >{{__('Analyze')}}</span
                                >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="business-item item-3">
                                <i class="ti-stats-up"></i><br />
                                <span
                                >{{__('Upgrade')}}</span
                                >
                            </div>
                        </div>
                    </div>
                    <p>{{__('Collect your data from your channles (QR code, Touchless Screens)')}}.</p>
                    <p>{{__('Analyze your data from your seamless dashboard')}}.</p>
                    <p>{{__('Upgrade your plans, scopes, achieve new targets and gain more happy clients')}}.</p>
                    <a class="main-btn" data-target="#sign-up" data-toggle="modal"  href="#">{{__('Sign up now')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="business-thumb @if(app()->getLocale()=='ar') text-left @else text-right  @endif">
        <img src="assets/landing/images/business-thumb.jpg" alt="" />
    </div>
</section>

<!--====== BUSINESS PART ENDS ======-->

<!--====== CUSTOMERS PART START ======-->

<section class="customers-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div
                        class="customers-thumb wow fadeInLeft"
                        data-wow-duration="1500ms"
                >
                    <img src="assets/landing/images/customers-thumb.png" alt="customers" />
                </div>
            </div>
            <div class="col-lg-6 col-md-9">
                <div class="section-title">
                    <span>{{__('We do more for your product')}}</span>
                    <h2 class="section-sub-title">{{__('Discover')}} <span>{{__('I’M Happy')}}</span> {{__('Channels')}}:</h2>
                </div>
                <div class="customers-content">
                    <div class="item">
                        <i style="margin: 20px 10px;color:#ffffff;position: absolute;font-size: 40px;z-index: 99999" class="fa fa-qrcode"></i>
                        <p> <span>{{__('QR Code')}}</span>
                            {{__('Clients will scan a QR-Code generated from you side, and start to give you feedback and send it directly to your device')}}.
                        </p>
                    </div>
                    <div class="item mt-35">
                        <i style="margin: 20px 10px;color:#ffffff;position: absolute;font-size: 40px;z-index: 99999" class="ti-thumb-up"></i>
                        <p><span>{{__('Touchless')}}</span>
                            {{__('Clients will rate your service without touching any device from selected location with our touchless technology')}}.
                        </p>
                        <a class="main-btn mt-50" data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== CUSTOMERS PART ENDS ======-->

<!--====== VIDEO PLAY PART START ======-->

<div
        class="video-play-area bg_cover"
>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-play-item text-center">
                    <a
                            class="video-popup"
                            href="#"
                    ><i class="fa fa-play"></i
                        ></a>
                    <h3 class="section-sub-title">Watch Our Video Presentation</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== VIDEO PLAY PART ENDS ======-->

<!--====== PRICING PART START ======-->

<section id="pricing" class="pricing-one pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center">
                    <span>{{__('Select what suits you')}}</span>
                    <h2 class="section-sub-title">{{__('Choose Your Pricing Plan')}}</h2>
                </div>
                <ul
                        class="list-inline text-center switch-toggler-list"
                        role="tablist"
                        id="switch-toggle-tab"
                >
                    <li class="month active"><a href="#">{{__('Monthly')}}</a></li>
                    <li>
                        <!-- Rounded switch -->
                        <label class="switch on">
                            <span class="slider round"></span>
                        </label>
                    </li>
                    <li class="year"><a href="#">{{__('Annual')}}</a></li>
                </ul>
                <!-- /.list-inline -->
            </div>
        </div>
        <div class="tabed-content">
            <div id="month">
                <style>
                    article {
                        width:100%;
                        max-width:1000px;
                        margin:0 auto;
                        position:relative;
                    }
                    article ul {
                        display:flex;
                        top:0px;
                        z-index:10;
                        padding-bottom:14px;
                    }
                    article li {
                        list-style:none;
                        flex:1;
                    }
                    article li:last-child {
                        border-right:1px solid #DDD;
                    }
                    article  button {
                        width:100%;
                        border: 1px solid #DDD;
                        border-right:0;
                        border-top:0;
                        padding: 10px;
                        background:#FFF;
                        font-size:14px;
                        font-weight:bold;
                        height:60px;
                        color:#999
                    }
                    article li.active button {
                        background:#E9E9E9;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
                        color:#000;
                    }
                    article  table { border:none;border-collapse:collapse; table-layout:fixed; width:100%; }
                    article  th { background:#F5F5F5; display:none; }
                    article td, article th {
                        height:53px;
                        border-right: none;
                        border-left: none;
                    }
                    article td, article th { border:1px solid #DDD; padding:10px; empty-cells:show; }
                    article td, article th {
                        text-align:left;
                    }
                    td+td, th+th {
                        text-align:center;
                        display:none;
                    }
                    td.default {
                        display:table-cell;
                    }
                    .bg-purple {
                        border-top:4px solid #a291f5;
                    }
                    .bg-blue {
                        border-top:4px solid #00A5B7;
                    }
                    .bg-green{
                        border-top:4px solid #007d67;
                    }
                    .bg-yellow{
                        border-top:4px solid #ffdf7e;
                    }
                    .sep {
                        background:#F5F5F5;
                        font-weight:bold;
                    }
                    .txt-l { font-size:28px; font-weight:bold; color: #15E2BE }
                    .txt-top { position:relative; top:-9px; left:-2px; }
                    .tick { font-size:18px; color:#242B3E; }
                    .hide {
                        border:0;
                        background:none;
                    }
                    .contatinho{
                        background:#00A5B7;
                        padding:10px 20px;
                        font-size:12px;
                        display:inline-block;
                        color:#FFF;
                        text-decoration:none;
                        border-radius:3px;
                        text-transform:uppercase;
                        margin:5px 0 10px 0;
                    }

                    @media (min-width: 640px) {
                        article  ul {
                            display:none;
                        }
                        article td, article th {
                            display:table-cell !important;
                            border-right: none;
                            border-left: none;
                        }
                        article td,article th {
                            width: 330px;

                        }
                        td+td, th+th {
                            width: auto;
                        }
                    }
                </style>
                <article>

                    <ul>
                        <li class="bg-purple">
                            <button>{{__('QR Code')}}</button>
                        </li>
                        <li class="bg-blue" >
                            <button>{{__('Touchless')}}</button>
                        </li>
                    </ul>


                    <table>
                        <thead>
                        <tr>
                            <th class="hide"></th>
                            <th class="bg-purple">{{__('Basic')}}</th>
                            <th class="bg-blue">{{__('Advanced')}}</th>
                            <th class="bg-green">{{__('Business')}}</th>
                            <th class="bg-yellow">{{__('Enterprise')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{__('Price')}}</td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">20 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">34 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">59 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">109 </span> </td>
                        </tr>
                        <tr>
                            <td>{{__('Charts & Analytics')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Responses')}}</td>
                            <td><span class="tick">100/{{ __('Month') }}</span></td>
                            <td><span class="tick">500/{{ __('Month') }}</span></td>
                            <td><span class="tick">2500/{{ __('Month') }}</span></td>
                            <td><span class="tick">5000/{{ __('Month') }}</span></td>
                        </tr>
                        <tr>
                            <td>{{__('QR-Code')}}</td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Touchless')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Instant response (telegram)')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td class="hide"></td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </article>
                <!-- /.row -->
            </div>
            <!-- /#month -->
            <div id="year">
                <article>

                    <ul>
                        <li class="bg-purple">
                            <button>{{__('QR Code')}}</button>
                        </li>
                        <li class="bg-blue" >
                            <button>{{__('Touchless')}}</button>
                        </li>
                    </ul>

                    <table>
                        <thead>
                        <tr>
                            <th class="hide"></th>
                            <th class="bg-purple">{{__('Basic')}}</th>
                            <th class="bg-blue">{{__('Advanced')}}</th>
                            <th class="bg-green">{{__('Business')}}</th>
                            <th class="bg-yellow">{{__('Enterprise')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{__('Price')}}</td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">10 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">24 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">49 </span> </td>
                            <td><span class="txt-top">{{__('$')}}</span><span class="txt-l">99 </span> </td>
                        </tr>
                        <tr>
                            <td>{{__('Charts & Analytics')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Responses')}}</td>
                            <td><span class="tick">100/{{ __('Month') }}</span></td>
                            <td><span class="tick">500/{{ __('Month') }}</span></td>
                            <td><span class="tick">2500/{{ __('Month') }}</span></td>
                            <td><span class="tick">5000/{{ __('Month') }}</span></td>
                        </tr>
                        <tr>
                            <td>{{__('QR-Code')}}</td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Touchless')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td>{{__('Instant response (telegram)')}}</td>
                            <td><span class="tick">-</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                            <td><span class="tick">&#10004;</span></td>
                        </tr>
                        <tr>
                            <td class="hide"></td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                            <td>
                                <a class="main-btn " data-toggle="modal" data-target="#sign-up" href="#">{{__('Sign up')}}</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </article>
                <!-- /.row -->
            </div>
            <!-- /#year -->
        </div>
        <!-- /.tabed-content -->
    </div>
</section>

<!--====== PRICING PART ENDS ======-->


<!--====== COUNTER PART START ======-->

<section class="counter-area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div
                        class="counter-item text-center mt-30 wow fadeInUp animated"
                        data-wow-duration="1000ms"
                        data-wow-delay="0ms"
                >
                    <h3 class="title odometer" data-count="500">00</h3>
                    <span>Visitors</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                        class="counter-item text-center mt-30 item-2 wow fadeInUp animated"
                        data-wow-duration="1000ms"
                        data-wow-delay="100ms"
                >
                    <h3 class="title odometer" data-count="96">00</h3>
                    <span>Clients</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                        class="counter-item text-center mt-30 item-3 wow fadeInUp animated"
                        data-wow-duration="1000ms"
                        data-wow-delay="200ms"
                >
                    <h3 class="title odometer" data-count="1697">00</h3>
                    <span>Responses</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div
                        class="counter-item text-center mt-30 item-4 wow fadeInUp animated"
                        data-wow-duration="1000ms"
                        data-wow-delay="300ms"
                >
                    <h3 class="title odometer" data-count="4">00</h3>
                    <span>Countries</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== COUNTER PART ENDS ======-->

<div id="login" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Sign in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                        @if($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif

                    <div class="form-group">
                        <label>{{__('Email')}}</label>
                        <input class="form-control" type="text" name="email" placeholder="Your Email Address ..">
                    </div>
                    <div class="form-group">
                        <label>{{__('Password')}}</label>
                        <input class="form-control" type="password" name="password" placeholder="Password ..">
                    </div>
                    <div class="form-group">
                        <div class="form-check pull-left">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="mr-3 text-muted pull-right" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <br>
                    <br>
                    <div class="form-group text-center">
                        <button type="submit" class="main-btn" >{{__('Sign in')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div id="sign-up" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{__('Sign up')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="mb-15">{{__('Enjoy 15 days free trial')}}</h5>
                <form method="POST" action="{{ route('register') }}">
                    @if($errors->has('reg_email') || $errors->has('password'))
                        <div class="alert alert-danger">
                            @if($errors->has('reg_email'))
                                <li>{{ $errors->first('reg_email') }}</li>
                            @endif
                                @if($errors->has('password'))
                                    <li>{{ $errors->first('password') }}</li>
                                @endif
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>{{__('Name')}}</label>
                        <input class="form-control" required type="text" name="name" placeholder="Your full name ..">
                    </div>
                    <div class="form-group">
                        <label>{{__('Email')}}</label>
                        <input class="form-control" required type="text" name="reg_email" placeholder="Your Email Address ..">
                    </div>
                    <div class="form-group">
                        <label>{{__('Password')}}</label>
                        <input class="form-control" required type="password" name="password" placeholder="Password ..">
                    </div>

                    <div class="form-group">
                        <label>{{__('Confirm Password')}}</label>
                        <input class="form-control" required type="password" name="password_confirmation" placeholder="Confirm Password ..">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="main-btn" >{{__('Sign up now')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--====== FOOTER PART START ======-->

<section class="footer-area">
    <div class="container">
        <div class="row" style="display: none">
            <div class="col-lg-12">
                <div
                        class="footer-download d-block d-lg-flex justify-content-between align-items-center wow fadeInUp"
                        data-wow-duration="1500ms"
                >
                    <div  class="item">
                        <h3 class="title">Download Our App Today</h3>
                        <p>
                            and get started with a free 1 month trial for your business
                        </p>
                    </div>
                    <div class="link">
                        <a class="main-btn" data-target="#sign-up" data-toggle="modal"  href="#">Sign up now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="footer-widget footer-widget-about" style="padding-top: 20px">
                    <a href="#"><img src="assets/landing/images/IM_Happy_logo_white.png" alt="logo" /></a>
                    <p>
                        {{__('Understand your customers and their needs, focus on opportunities, make them satisfied — so they keep coming again, and stay with you longer.')}}

                    </p>
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget footer-widget-list">
                    <div class="list-item d-flex">
                        <div class="item @if(app()->getLocale()=='ar') ml-100 @else mr-100 @endif">
                            <h3 class="title">Explore</h3>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Our Team</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Services</a></li>
                            </ul>
                        </div>
                        <div class="item">
                            <h3 class="title">Contact</h3>
                            <ul>
                                <li>
                      <span><i class="fa fa-phone-square"></i> +966 507735308</span                      >
                                </li>
                                <li>
                      <span><i class="fa fa-envelope"></i> info@imhappy.app</span>
                                </li>
                                <li>
                      <span><i class="fa fa-map-marker"></i> Prince Fawaz of Saudi Arabia – Jeddah</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9">
                <div class="footer-widget footer-widget-newsletter">
                    <h3 class="title">Newsletter</h3>
                    <form action="#">
                        <div class="input-box">
                            <i class="fa fa-envelope"></i>
                            <input type="text" placeholder="Email address" />
                        </div>
                    </form>
                    <p>
                        Sign up for our latest news & articles. We won’t give you spam
                        mails.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copyright text-center">
                    <p>Copyright © 2021 Im Happy , all rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== FOOTER PART ENDS ======-->

<!--====== GO TO TOP PART START ======-->

<div class="go-top-area">
    <div class="go-top-wrap">
        <div class="go-top-btn-wrap">
            <div class="go-top go-top-btn">
                <i class="fa fa-angle-double-up"></i>
                <i class="fa fa-angle-double-up"></i>
            </div>
        </div>
    </div>
</div>

<!--====== GO TO TOP PART ENDS ======-->



<!--====== jquery js ======-->
<script src="assets/landing/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="assets/landing/js/vendor/jquery-3.5.0.js"></script>

<!--====== Bootstrap js ======-->
<script src="assets/landing/js/popper.min.js"></script>
<script src="assets/landing/js/bootstrap.min.js"></script>

<!--====== Slick js ======-->
<script src="assets/landing/js/slick.min.js"></script>

<!--====== wow js ======-->
<script src="assets/landing/js/wow.js"></script>

<!--====== Scrolling Nav js ======-->
<script src="assets/landing/js/scrolling-nav.js"></script>
<script src="assets/landing/js/jquery.easing.min.js"></script>

<!--====== odometer js ======-->
<script src="assets/landing/js/odometer.min.js"></script>
<script src="assets/landing/js/jquery.appear.min.js"></script>

<!--====== Magnific Popup js ======-->
<script src="assets/landing/js/jquery.magnific-popup.min.js"></script>

<!--====== Main js ======-->
<script src="assets/landing/js/main.js"></script>

@if($errors->has('email'))
    <script>
        $('#login').modal({
            show: true
        });
    </script>
@endif
@if($errors->has('reg_email') || $errors->has('password'))
    <script>
        $('#sign-up').modal({
            show: true
        });
    </script>
@endif
</body>
</html>
