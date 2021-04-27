<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="ImHappy"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <link href="{{ url('assets/dist/vendors') }}/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

@yield('styles')
    <!-- Custom CSS -->
    <link href="{{ url('assets/dist/') }}/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!-- /Preloader -->
<div class="wrapper" style="background: #fff;width: 100%;min-height: 100vh; padding: 80px 25px">


    <!-- Main Content -->
    <div  >
        <div class="container-fluid ">

            @yield('content')

        </div>


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



@if (session()->has('status'))
    <script>
        $(window).load(function(){

        		$.toast({
        			heading: '{{ __('System Message !') }}',
        			text: '{{ __( session()->get('msg') ) }}',
        			position: 'top-center',
        			loaderBg:'#f8b32d',
        			icon: '{!! session()->get('status') !!}',
        			hideAfter: 4500,
        			stack: 6
        		});

        });
    </script>
@endif
</body>


</html>

