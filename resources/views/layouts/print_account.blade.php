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


    <link href="{{ url('assets/dist/vendors') }}/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('assets/dist/vendors') }}/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>


    <link href="{{ url('assets/dist/vendors') }}/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/dist/') }}/css/fancy-buttons.css" rel="stylesheet" type="text/css">
@yield('styles')
    <!-- Custom CSS -->
    @if(App::getLocale() == 'ar')
    <link
            rel="stylesheet"
            href="http://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-cSfiDrYfMj9eYCidq//oGXEkMc0vuTxHXizrMOFAaPsLt1zoCUVnSsURN+nef1lj"
            crossorigin="anonymous">
    <!-- compiled and minified theme CSS -->
    <link
            rel="stylesheet"
            href="http://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
            integrity="sha384-YNPmfeOM29goUYCxqyaDVPToebWWQrHk0e3QYEs7Ovg6r5hSRKr73uQ69DkzT1LH"
            crossorigin="anonymous">
    <link href="{{ url('assets/dist/') }}/css/rtl-style.css" rel="stylesheet" type="text/css">
    @else
        <link href="{{ url('assets/dist/') }}/css/style.css" rel="stylesheet" type="text/css">
    @endif
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
</head>

<body>

<div class="wrapper theme-1-active pimary-color-blue">

    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid ">

            <h3>{{ currentTeam()->settings->company_name }} Report</h3>

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

<script src="{{ url('assets/dist/vendors') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ url('assets/dist/vendors') }}/bower_components/multiselect/js/jquery.multi-select.js"></script>


@yield('scripts')
<!-- Init JavaScript -->
<script src="{{ url('assets/dist/') }}/js/init.js"></script>
<script src="{{ url('assets/dist/') }}/js/dashboard-data.js"></script>
<script src="{{ url('assets/dist/') }}/js/form-advance-data.js"></script>

<script>
    var ApiURL = '{{ url('api/') }}';
</script>


<script>
    $('input[name="password"]').each(function(){
        var input_id = $(this).attr('id');
        $(this).after('<center>'+
            '<div class="checkbox checkbox-circle">'+
            '<input id="checkbox7" onclick="'+"ShowPass('"+input_id+"')"+'" type="checkbox">'+
            '<label for="checkbox7"> Show </label></div></center>');
    });
    function ShowPass(elem) {
        var x = document.getElementById(elem);
        console.log(elem);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
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

@error('password')
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

