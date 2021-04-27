<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

	<!-- Web Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

	<!-- Components Vendor Styles -->
	<link rel="stylesheet" href="{{ asset('saas/admin/vendor/font-awesome/css/all.min.css')}}">

	<!-- Theme Styles -->
	<link rel="stylesheet" href="{{ asset('saas/admin/css/theme.css')}}">
	<link rel="stylesheet" href="{{ asset('saas/css/toastr.min.css')}}">
	@livewireStyles
{{-- @notify_css --}}
<!-- Custom Charts -->
	<style>
		.js-doughnut-chart {
			width: 70px !important;
			height: 70px !important;
		}
		.avatar{
			width:50px;
		}
		.flex-container {
			display: flex;
			flex-wrap: wrap;
		}
		.flex-container a{
			margin-left: auto
		}
	</style>
@stack('styles')
<!-- Scripts -->
</head>
<body>
<!-- Header (Topbar) -->
<header class="u-header">
	<div class="u-header-left">
		<a class="u-header-logo" href="{{ route('admin.index') }}">
			<img class="u-logo-desktop" src="{{ asset('saas/img/logo.png') }}" width="160" alt="{{ __('Saasify admin') }}">
			<img class="img-fluid u-logo-mobile" src="{{ asset('saas/img/logo.png') }}" width="50" alt="{{ __('Saasify admin') }}">
		</a>
	</div>

	<div class="u-header-middle">
		<a class="js-sidebar-invoker u-sidebar-invoker" href="#!"
		   data-is-close-all-except-this="true"
		   data-target="#sidebar">
			<i class="fa fa-bars u-sidebar-invoker__icon--open"></i>
			<i class="fa fa-times u-sidebar-invoker__icon--close"></i>
		</a>

		<div class="u-header-search"
			 data-search-mobile-invoker="#headerSearchMobileInvoker"
			 data-search-target="#headerSearch">
			<a id="headerSearchMobileInvoker" class="btn btn-link input-group-prepend u-header-search__mobile-invoker" href="#!">
				<i class="fa fa-search"></i>
			</a>

			<div id="headerSearch" class="u-header-search-form">
				<form>
					<div class="input-group">
						<button class="btn-link input-group-prepend u-header-search__btn" type="submit">
							<i class="fa fa-search"></i>
						</button>
						<input class="form-control u-header-search__field" type="search" placeholder="Type to search…">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="u-header-right">


		<!-- Notifications -->
		<div class="mr-4 dropdown">
			<a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
				    <span class="h3">
			    		<i class="far fa-bell"></i>
				    </span>
				<span class="u-indicator u-indicator-top-right u-indicator--xxs bg-info"></span>
			</a>
		</div>
		<!-- End Notifications -->

		<!-- User Profile -->
		<div class="ml-2 dropdown">
			<a class="link-muted d-flex align-items-center" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
				<img class="mr-2 u-avatar--xs img-fluid rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="User Profile">
				<span class="text-dark d-none d-sm-inline-block">
							{{ split_name(Auth::user()->name)[0] }} <small class="ml-1 fa fa-angle-down text-muted"></small>
						</span>
			</a>

			<div class="py-0 mt-3 border-0 dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="width: 260px;">
				<div class="card">
					<div class="card-body">
						<ul class="mb-0 list-unstyled">
							<li class="mb-4">
								<a class="d-flex align-items-center link-dark" href="{{ url('user/profile') }}">
									<span class="mb-0 h3"><i class="mr-3 far fa-user-circle text-muted"></i></span> {{ __('Profile') }}
								</a>
							</li>
							<li>
								<a class="d-flex align-items-center link-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
									<span class="mb-0 h3"><i class="mr-3 far fa-share-square text-muted"></i></span>
									{{ __('Logout') }}
								</a>
								<form method="POST" id="logout-form" action="{{ route('logout') }}">
									@csrf
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End User Profile -->
	</div>
</header>
<!-- End Header (Topbar) -->

<main class="u-main" role="main">
	<!-- Sidebar -->
@include('partials.admin.aside')
<!-- End Sidebar -->

	<div class="u-content">
	@include('partials.account.login_as')
	@yield('content')

	<!-- Footer -->
	@include('partials.admin.footer')
	<!-- End Footer -->
	</div>
</main>
<!-- Global Vendor -->
<script src="{{ asset('saas/admin/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('saas/admin/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('saas/admin/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('saas/admin/vendor/chart.js/dist/Chart.min.js') }}"></script>

<!-- Initialization  -->
<script src="{{ asset('saas/admin/js/sidebar-nav.js') }}"></script>
<script src="{{ asset('saas/admin/js/main.js') }}"></script>
@livewireScripts
{{-- <x-livewire-alert::scripts /> --}}
@stack('scripts')
</body>
</html>