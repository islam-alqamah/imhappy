<footer class="bg-navy">
  <div class="container">
    @guest
    <div class="space-top-2 space-bottom-1 space-bottom-lg-2">
      <div class="row justify-content-lg-between">
        <div class="col-lg-3 ml-lg-auto mb-5 mb-lg-0">
          <!-- Logo -->
          <div class="mb-4">
            <a href="/" aria-label="Saasify">
              <h2 style="color:white">{{ __('Saasify') }}</h2>
            </a>
          </div>
          <!-- End Logo -->

          <!-- Nav Link -->
          <ul class="nav nav-sm nav-x-0 nav-white flex-column">
            <li class="nav-item">
              <a class="nav-link media" href="javascript:;">
                <span class="media">
                  <span class="fas fa-location-arrow mt-1 mr-2"></span>
                  <span class="media-body">
                    {{ __('153 Williamson Plaza, Maggieberg') }}
                  </span>
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link media" href="tel:1-062-109-9222">
                <span class="media">
                  <span class="fas fa-phone-alt mt-1 mr-2"></span>
                  <span class="media-body">
                    {{ __('+1 (062) 109-9222') }}
                  </span>
                </span>
              </a>
            </li>
          </ul>
          <!-- End Nav Link -->
        </div>

        <div class="col-6 col-md-3 col-lg mb-5 mb-lg-0">
          <h5 class="text-white">{{ __('Company') }}</h5>

          <!-- Nav Link -->
          <ul class="nav nav-sm nav-x-0 nav-white flex-column">
            <li class="nav-item"><a class="nav-link" href="#">{{ __('About') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Careers') }} <span class="badge badge-primary ml-1">We're hiring</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Blog') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Customers') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Hire us') }}</a></li>
          </ul>
          <!-- End Nav Link -->
        </div>

        <div class="col-6 col-md-3 col-lg mb-5 mb-lg-0">
          <h5 class="text-white">{{ __('Features') }}</h5>

          <!-- Nav Link -->
          <ul class="nav nav-sm nav-x-0 nav-white flex-column">
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Press') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Release notes') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Integrations') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Pricing') }}</a></li>
          </ul>
          <!-- End Nav Link -->
        </div>

        <div class="col-6 col-md-3 col-lg">
          <h5 class="text-white">{{ __('Documentation') }}</h5>

          <!-- Nav Link -->
          <ul class="nav nav-sm nav-x-0 nav-white flex-column">
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Support') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Docs') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Status') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('API Reference') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="#">{{ __('Tech Requirements') }}</a></li>
          </ul>
          <!-- End Nav Link -->
        </div>

        <div class="col-6 col-md-3 col-lg">
          <h5 class="text-white">{{ __('Resources') }}</h5>

          <!-- Nav Link -->
          <ul class="nav nav-sm nav-x-0 nav-white flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="media align-items-center">
                  <i class="fa fa-info-circle mr-2"></i>
                  <span class="media-body">{{ __('Help') }}</span>
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="media align-items-center">
                  <i class="fa fa-user-circle mr-2"></i>
                  <span class="media-body">{{ __('Your Account') }}</span>
                </span>
              </a>
            </li>
          </ul>
          <!-- End Nav Link -->
        </div>
      </div>
    </div>

    <hr class="opacity-xs my-0">
    @endguest
    <div class="space-1">
      <div class="row align-items-md-center mb-7">
        <div class="col-md-6 mb-4 mb-md-0">
          <!-- Nav Link -->
          <ul class="nav nav-sm nav-white nav-x-sm align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="#">{{ __('Privacy & Policy') }}</a>
            </li>
            <li class="nav-item opacity mx-3">&#47;</li>
            <li class="nav-item">
              <a class="nav-link" href="#">{{ __('Terms') }}</a>
            </li>
            <li class="nav-item opacity mx-3">&#47;</li>
            <li class="nav-item">
              <a class="nav-link" href="#">{{ __('Site Map') }}</a>
            </li>
          </ul>
          <!-- End Nav Link -->
        </div>

        <div class="col-md-6 text-md-right">
          <ul class="list-inline mb-0">
            <!-- Social Networks -->
            <li class="list-inline-item">
              <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                <i class="fab fa-google"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-xs btn-icon btn-soft-light" href="#">
                <i class="fab fa-github"></i>
              </a>
            </li>
            <!-- End Social Networks -->

            <!-- Language -->
            <li class="list-inline-item">
              <div class="hs-unfold">
                <a class="js-hs-unfold-invoker dropdown-toggle btn btn-xs btn-soft-light" href="javascript:;"
                   data-hs-unfold-options='{
                    "target": "#footerLanguage",
                    "type": "css-animation",
                    "animationIn": "slideInDown"
                   }'>
                  <img class="dropdown-item-icon" src="{{ asset('saas/svg/flags/'.app()->getLocale().'.svg') }}" alt="United States Flag">
                  <span>{{ app()->getLocale()  }}</span>
                </a>

                <div id="footerLanguage" class="hs-unfold-content dropdown-menu dropdown-unfold dropdown-menu-bottom mb-2">
                  @foreach (language()->allowed() as $code => $name)
                    <a class="dropdown-item" href="{{ language()->back($code) }}">{{ $name }}</a>
                  @endforeach
                </div>
              </div>
            </li>
            <!-- End Language -->
          </ul>
        </div>
      </div>

      <!-- Copyright -->
      <div class="w-md-75 text-lg-center mx-lg-auto">
        <p class="text-white opacity-sm small">&copy; Saasify. {{ date('Y') }} {{ __('All rights reserved.') }}</p>
        <p class="text-white opacity-sm small">{{ __('When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.') }}</p>
      </div>
      <!-- End Copyright -->
    </div>
  </div>
</footer>
 <!-- Go to Top -->
 <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
 data-hs-go-to-options='{
   "offsetTop": 700,
   "position": {
     "init": {
       "right": 15
     },
     "show": {
       "bottom": 15
     },
     "hide": {
       "bottom": -15
     }
   }
 }'>
<i class="fas fa-angle-up"></i>
</a>
<!-- End Go to Top -->
@stack('modals')

@notify_js
@notify_render
<!-- JS Global Compulsory -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('saas/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('saas/vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script src="{{ asset('saas/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script src="{{ asset('saas/vendor/hs-unfold/dist/hs-unfold.min.js') }}"></script>
<script src="{{ asset('saas/vendor/select2/dist/js/select2.full.min.js') }}"></script>
<!-- JS Front -->
<script src="{{ asset('saas/js/hs.core.js') }}"></script>
<script src="{{ asset('saas/js/hs.select2.js') }}"></script>

 @livewireScripts
 <x-livewire-alert::scripts />
<!-- JS Plugins Init. -->
<script>
  $(document).on('ready', function () {
    // initialization of header
    var header = new HSHeader($('#header')).init();

    // initialization of unfold
    var unfold = new HSUnfold('.js-hs-unfold-invoker').init();

    // initialization of select2
    $('.js-custom-select').each(function () {
      var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    // initialization of go to
    $('.js-go-to').each(function () {
      var goTo = new HSGoTo($(this)).init();
    });
  });
</script>
@stack('scripts')
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