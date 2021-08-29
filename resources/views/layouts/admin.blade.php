<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from hencework.com/theme/jetson/full-width-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Mar 2021 16:26:28 GMT -->
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
	<link href="{{ url('assets/dist/vendors') }}/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>


	<link href="{{ url('assets/dist/vendors') }}/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
	<link href="{{ url('assets/dist/vendors') }}/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>



	<link href="{{ url('assets/dist/vendors') }}/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
@yield('styles')
	@if(App::getLocale() == 'ar')
		<link
				rel="stylesheet"
				href="https://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-cSfiDrYfMj9eYCidq//oGXEkMc0vuTxHXizrMOFAaPsLt1zoCUVnSsURN+nef1lj"
				crossorigin="anonymous">
		<!-- compiled and minified theme CSS -->
		<link
				rel="stylesheet"
				href="https://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
				integrity="sha384-YNPmfeOM29goUYCxqyaDVPToebWWQrHk0e3QYEs7Ovg6r5hSRKr73uQ69DkzT1LH"
				crossorigin="anonymous">
		<link href="{{ url('assets/dist/') }}/css/rtl-style.css" rel="stylesheet" type="text/css">
	@else
		<link href="{{ url('assets/dist/') }}/css/style.css" rel="stylesheet" type="text/css">
@endif
	<!-- Custom CSS -->
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
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="mobile-only-brand pull-left">
			<div class="nav-header pull-left">
				<div class="logo-wrap ">
					<a href="{{ url('admin') }}" >
						<img class="brand-img" width="100" src="{{ url('images/logos/logo-h.png') }}" alt="brand"/>
					</a>
				</div>
			</div>
			<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
			<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
			<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
{{--			<form id="search_form" role="search" class="top-nav-search collapse pull-left">--}}
{{--				<div class="input-group">--}}
{{--					<input type="text" name="example-input1-group2" class="form-control" placeholder="{{__('Search')}}">--}}
{{--					<span class="input-group-btn">--}}
{{--						<button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>--}}
{{--						</span>--}}
{{--				</div>--}}
{{--			</form>--}}
		</div>
		<div id="mobile_only_nav" class="mobile-only-nav pull-right">
			<ul class="nav navbar-right top-nav pull-right">
				<li class="dropdown auth-drp">
					<a href="#" class="dropdown-toggle pr-0" style="font-size: 26px;color: #fff" data-toggle="dropdown">
						<i class="fa fa-globe"></i></a>
					<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
						<li>
							<a href="{{ url('languages/en/back') }}"><span>{{ __('English') }}</span></a>
						</li>
						<li>
							<a href="{{ url('languages/ar/back') }}"><span>{{ __('Arabic') }}</span></a>
						</li>
					</ul>
				</li>
				<li class="dropdown auth-drp">
					<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
						<img src="{{ Auth::user()->profile_photo_url }}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
					<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
						<li>
							<a href="{{ url('user/profile') }}"><i class="zmdi zmdi-account"></i><span>{{ __('Profile') }}</span></a>
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
			</ul>
		</div>
	</nav>
	<!-- /Top Menu Items -->

	<!-- Left Sidebar Menu -->
	<div class="fixed-sidebar-left ">
		<ul class="nav navbar-nav side-nav nicescroll-bar">
			<li class="navigation-header">
				<span>Main</span>
				<i class="zmdi zmdi-more"></i>
			</li>
			<li>
				<a class="{{ return_if(on_page('admin.index'), ' active') }}" href="{{ route('admin.index') }}" >
					<div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i>
						<span class="right-nav-text">{{ __('Dashboard') }}</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			@if(in_array('admin-users',json_decode(auth()->user()->user_permissions))
            || auth()->user()->type == 'sys_admin')
			<li>
				<a class="{{ return_if(on_page('admin.users.index'), ' active') }}" href="{{ route('admin.users.index') }}" >
					<div class="pull-left"><i class="zmdi zmdi-accounts-alt mr-20"></i>
						<span class="right-nav-text">{{ __('Users') }}</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			@endif
			@if(in_array('admin-templates',json_decode(auth()->user()->user_permissions))
            || auth()->user()->type == 'sys_admin')
			<li class="navigation-header">
				<span>{{ __('Touchless') }}</span>
				<i class="zmdi zmdi-more"></i>
			</li>
			<li>
				<a class="{{ return_if(on_page('admin.survey.templates'), ' active') }}" href="{{ route('admin.survey.templates') }}" >
					<div class="pull-left"><i class="zmdi zmdi-assignment mr-20"></i>
						<span class="right-nav-text">{{ __('Templates') }}</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			@endif
			@if(in_array('admin-subscriptions',json_decode(auth()->user()->user_permissions))
			|| in_array('admin-plans',json_decode(auth()->user()->user_permissions))
            || auth()->user()->type == 'sys_admin')
			<li class="navigation-header">
				<span>{{ __('Subscription') }}</span>
				<i class="zmdi zmdi-more"></i>
			</li>
			<li>
				<a href="javascript:void(0);"
				   @if(on_page('admin.plans.index') OR on_page('admin.plans.create') OR on_page('admin.plans.edit') OR on_page('admin.subscriptions'))
				   class="active collapsed" aria-expanded="true" @endif data-toggle="collapse" data-target="#ui_dr">
					<div class="pull-left"><i class="zmdi zmdi-smartphone-setup mr-20"></i>
						<span class="right-nav-text">{{ __('Subscription') }}</span></div>
					<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
					<div class="clearfix"></div></a>
				<ul id="ui_dr" class="collapse collapse-level-1 two-col-list
						@if(on_page('admin.plans.index') OR on_page('admin.plans.create') OR on_page('admin.plans.edit') OR on_page('admin.subscriptions'))
							in
						 @endif">

					@if(in_array('admin-plans',json_decode(auth()->user()->user_permissions))
                    || auth()->user()->type == 'sys_admin')
					<li>
						<a class="{{ return_if(on_page('admin.plans.index'), 'active-page') }}" href="{{ route('admin.plans.index') }}">{{ __('Plans') }}</a>
					</li>
					@endif
					@if(in_array('admin-subscriptions',json_decode(auth()->user()->user_permissions))
                        || auth()->user()->type == 'sys_admin')
					<li>
						<a class="{{ return_if(on_page('admin.subscriptions'), 'active-page') }}" href="{{ route('admin.subscriptions') }}">{{ __('subscriptions') }}</a>
					</li>
					@endif
				</ul>
			</li>
					@endif
		</ul>
	</div>
	<!-- /Left Sidebar Menu -->


	<!-- Main Content -->
	<div class="page-wrapper">
		<div class="container-fluid pt-25">

			@yield('content')

		</div>

		<!-- Footer -->
		<footer class="footer container-fluid pl-30 pr-30">
			<div class="row">
				<div class="col-sm-12">
					<p>2021 &copy; I'm Happy Network</p>
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
<script src="{{ url('assets/dist/vendors') }}/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

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


@yield('scripts')

<script>
	var ApiURL = '{{ URL::to('api/') }}';
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
