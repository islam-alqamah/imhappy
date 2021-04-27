<x-guest-layout>
    <section class="home-section" id="home">

      <!--begin container -->
      <div class="container">
            <!--begin row -->
            <div class="row">
              
                <!--begin col-md-6-->
                <div class="col-md-6 padding-top-40">
                  <h1>{{ __('Best way to start your SaaS project.') }}</h1>
  
                          <!--begin benefits -->
                          <ul class="home-benefits">
                            <li><i class="pe-7s-check"></i>{{ __('Ultimate starter kit for multi-tenant & team SaaS project.') }}</li>
                              <li><i class="pe-7s-check"></i>{{ __('Monetise your application with a powerful billing system.') }}</li>
  
                              <li><i class="pe-7s-check"></i>{{ __('Allow each team to have its own billing plan.') }}</li>
  
                              <li><i class="pe-7s-check"></i>{{ __('Saasify support multi languages out of the box.') }}</li>
                              <li><i class="pe-7s-check"></i>{{ __('API Out Of The Box.') }}</li>
                              <li><i class="pe-7s-check"></i>{{ __('Saasify support multi languages out of the box.') }}</li>
                          </ul>
                          <!--end benefits -->
              
                </div>
                <!--end col-md-6-->
           
          <!--begin col-md-6-->
                <div class="col-md-6">
                  <img src="{{ asset('saas/img/saas.png') }}" class="hero-image width-100" alt="pic">
  
                </div>
                <!--end col-md-6-->
  
            </div>
            <!--end row -->
      </div>
      <!--end container -->
  
      </section>
      <!--end home section -->
  
      <!--begin section-white -->
      <section class="section-white section-top-border" id="about">
  
          <!--begin container -->
          <div class="container">
  
              <!--begin row -->
              <div class="row">
  
                  <!--begin col-md-12 -->
                  <div class="text-center col-md-12">
  
                      <h2 class="section-title">{{ __('Features built for scale') }}</h2>
  
                      <p class="section-subtitle">{{ __('All the features you always dream for your SaaS project.') }}</p>
                  </div>
                  <!--end col-md-12 -->
  
                  <!--begin col-md-6 -->
                  <div class="col-md-6">
  
                      <div class="main-services">
  
                          <i class="pe-7s-diamond"></i>
  
                          <div class="main-services-text">
  
                              <h3>{{ __('Payments') }}</h3>
  
                              <p>{{ __('Monetise your application right now with a powerful billing system that uses Stripe.') }}</p>
                              
                          </div>
          
                      </div>
  
                  </div>
                  <!--end col-md-6 -->
  
                  <!--begin col-md-6 -->
                  <div class="col-md-6">
  
                      <div class="main-services featured-box">
  
                          <i class="pe-7s-medal"></i>
  
                          <div class="main-services-text">
  
                              <h3>{{ __('Bootstrap 4.0') }}</h3>
  
                              <p>{{ __('Saasify use jetstream but converted to Bootstrap CSS to provide a modern starting point for your application\'s interface.') }}</p>
                          </div>
          
                      </div>
  
                  </div>
                  <!--end col-md-6 -->
  
                  <!--begin col-md-6 -->
                  <div class="col-md-6">
  
                      <div class="main-services">
  
                          <i class="pe-7s-umbrella"></i>
  
                          <div class="main-services-text">
  
                              <h3>{{ __('Team Billing') }}</h3>
  
                              <p>{{ __('Allow each team to have its own billing plan. Think of it like GitHub Organizations. All without writing a single line of code.') }}</p>
                              
                          </div>
          
                      </div>
  
                  </div>
                  <!--end col-md-6 -->
  
                  <!--begin col-md-6 -->
                  <div class="col-md-6">
  
                      <div class="main-services">
  
                          <i class="pe-7s-lock"></i>
  
                          <div class="main-services-text">
  
                              <h3>{{ __('Two-Factor Authentication') }}</h3>
  
                              <p>{{ __('When a user enables two-factor authentication for their account, they should scan the given QR code using a free authenticator application such as Google Authenticator. ') }}</p>
                              
                          </div>
          
                      </div>
  
                  </div>
                  <!--end col-md-6 -->
  
              </div>
              <!--end row -->
              
          </div>
          <!--end container -->
  
      </section>
      <!--end section-white -->
  
      <!--begin section-grey -->
      <section class="section-grey section-top-border">
  
          <!--begin container -->
          <div class="container">
  
              <!--begin row -->
              <div class="row">
  
                  <!--begin col-md-6-->
                  <div class="col-md-6 padding-top-10 padding-left-20">
  
                      <h2>{{ __('Saasify makes Saas project easy and performance fast.') }}</h2>
  
                      <p>{{ __('Generate and manage API tokens and grant specific abilities to tokens.') }}</p>
  
                      <p>{{ __('All text throughout the entire application is translatable.') }}</p>
  
                      <a href="/register" class="btn-blue small scrool">{{ __('Register a free account') }}</a>
  
                  </div>
                  <!--end col-md-6-->
             
                  <!--begin col-md-6-->
                  <div class="col-md-6 responsive-top-margins wow slideInRight" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: slideInRight;">
                      
                      <!--begin video-popup-wrapper-->
                      <div class="video-popup-wrapper">
  
                          <!--begin popup-gallery-->
                          <div class="popup-gallery">
                              
                              <img src="/saas/img/payment.png" class="width-100 video-popup-image" alt="pic">
                          </div>
                          <!--end popup-gallery-->
  
                      </div>
                      <!--end video-popup-wrapper-->
  
                  </div>
                  <!--end col-md-6-->
  
              </div>
              <!--end row -->
              
          </div>
          <!--end container -->
  
      </section>
      <!--end section-grey -->
      <!--begin pricing section -->
      <livewire:plan-list />
  
      <!--begin fun-facts section -->
      <section class="section-blue medium-paddings">
  
          <!--begin container -->
          <div class="container">
  
              <!--begin row-->
              <div class="row">
              
                  <!--begin col-md-12 -->
                  <div class="text-center col-md-12 padding-top-10 padding-bottom-20">
  
                      <h3 class="section-title white-text">{{ __('Fun Facts About Saasify') }}</h3>
  
                      <p class="section-subtitle white">{{ __('Here are a few facts about our awesome software.') }}</p>
  
                  </div>
                  <!--end col-md-12 -->
  
                  <!--begin fun-facts-box -->
                  <div class="text-center fun-facts-box wow fadeIn" data-wow-delay="0.15s">
                      
                      <i class="pe-7s-diamond"></i>
                      
                      <p class="fun-facts-title"><span class="facts-numbers">{{ __('70+') }}</span><br>{{ __('Saas Powered') }}</p>
                      
                  </div>
                  <!--end fun-facts-box -->
  
                  <!--begin fun-facts-box -->
                  <div class="text-center fun-facts-box wow fadeIn" data-wow-delay="0.3s">
                      
                      <i class="pe-7s-umbrella"></i>
                                                 
                      <p class="fun-facts-title"><span class="facts-numbers">{{ __('50+') }}</span><br>{{ __('Happy Clients') }}</p>
                          
                  </div>
                  <!--end fun-facts-box -->
  
                  <!--begin fun-facts-box -->
                  <div class="text-center fun-facts-box wow fadeIn" data-wow-delay="0.45s">
                      
                      <i class="pe-7s-cup"></i>
                                                 
                      <p class="fun-facts-title"><span class="facts-numbers">{{ __('10') }}</span><br>{{ __('Design Awards') }}</p>
                          
                  </div>
                  <!--end fun-facts-box -->
  
                  <!--begin fun-facts-box -->
                  <div class="text-center fun-facts-box wow fadeIn" data-wow-delay="0.6s">
                      
                      <i class="pe-7s-coffee"></i>
                                                 
                      <p class="fun-facts-title"><span class="facts-numbers">{{ __('1100') }}</span><br>{{ __('Cups Of Coffee') }}</p>
                          
                  </div>
                  <!--end fun-facts-box -->
  
                  <!--begin fun-facts-box -->
                  <div class="text-center fun-facts-box wow fadeIn" data-wow-delay="0.75s">
                      
                          <i class="pe-7s-comment"></i>
                                                  
                      <p class="fun-facts-title"><span class="facts-numbers">{{ __('24/7') }}</span><br>{{ __('Fast Support') }}</p>
                              
                  </div>
                  <!--end fun-facts-box -->
              
              </div>
              <!--end row-->
  
          </div>
          <!--end container -->
  
      </section>
  
      <!--begin section-white -->
      <section class="section-white section-top-border">
  
          <!--begin container -->
          <div class="container">
  
              <!--begin row -->
              <div class="row">
  
                  <!--begin col-md-6-->
                  <div class="col-md-6 responsive-bottom-margins wow slideInLeft" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: slideInLeft;">
  
                  <img src="/saas/img/project.png" class="width-100 box-shadow" height="100%" alt="pic">
  
                  </div>
                  <!--end col-md-6-->
  
                  <!--begin col-md-6 -->
                  <div class="col-md-6 padding-top-20">
  
                      <!--begin features-second -->
                      <div class="features-second">
                          
                          <div class="dropcaps-circle">
                              <i class="pe-7s-map"></i>
                          </div>
  
                          <h4 class="margin-bottom-5">{{ __('Multi-tenancy') }}</h4>
  
                          <p>{{ __('Saas web build with support for Multi-tenancy with single database, keeping tenant specific data separated for fully independent.') }}.</p>
  
                      </div>
                      <!--end features-second-->
  
                      <!--begin features-second-->
                      <div class="features-second">
  
                          <div class="dropcaps-circle">
                              <i class="pe-7s-rocket"></i>
                          </div>
  
                          <h4 class="margin-bottom-5">{{ __('User Impersonation') }}</h4>
  
                          <p>{{ __('Administrator role can login as another user and resolve an issue or troubleshoot a bug.') }} </p>
  
                      </div>
                      <!--end features-second-->
  
                      <!--begin features-second-->
                      <div class="features-second">
  
                          <div class="dropcaps-circle">
                              <i class="pe-7s-tools"></i>
                          </div>
  
                          <h4 class="margin-bottom-5">{{ __('User Roles') }}</h4>
  
                          <p>{{ __('Create role and Grant permissions based on roles, Give user or group access to a page or feature within the application.') }}</p>
  
                      </div>
                      <!--end features-second-->
  
                  </div>
                  <!--end col-md-6-->
             
              </div>
              <!--end row -->
              
          </div>
          <!--end container -->
  
      </section>
      <!--end section-white -->
  
      <!--begin contact -->
      <section class="section-white section-top-border" id="contact">
          
          <!--begin container-->
          <div class="container">
            @livewire('contact-form')
        </div>
        <!--end container--> 
      </section>
      <!--end contact-->
    @push('scripts')
    @endpush
</x-guest-layout>