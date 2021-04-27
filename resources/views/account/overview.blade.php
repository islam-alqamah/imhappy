<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="text-white h2">{{ __('Overview') }} 
            </h1>
        </div>
    </x-slot>

    <div class="mb-3 card mb-lg-5">
        <!-- Header -->
        <div class="card-header">
          <h5 class="card-header-title">{{ __('Subscriptions overview') }}</h5>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
              @if (currentTeam()->onTrial() && !currentTeam()->subscribed())
                <h6 class="text-cap">{{ __('Your are on trial') }}:</h6>
                <h5>
                      {{ __('Your trial will end on: ') }} <span class="text-danger">{{ currentTeam()->trialEndsAt('main')->toFormattedDateString() }}</span>

                </h5>
                <p>{{ __('Please subscribe to a plan to continue using our app after trial period ends') }}</p>
                <a href="{{ route('subscription.plans') }}" class="mt-3 btn btn-soft-indigo">{{ __('Subscribe') }}</a>
              @endif
          @if (currentTeam()->subscribed('default'))
          <div class="row">
            <div class="mb-4 col-md-7 mb-md-0">
              <div class="mb-4">
                @if(currentTeam()->subscription('default')->cancelled())
                  <p class="mb-2 head"> {{ __('Subscribed: ') }} <span class="h4">{{ currentTeam()->plan->title }}</span> <span class="badge badge-pill badge-warning">Canceled</span></p>
                  <div>
                    <p class="mt-2 mb-2"><span class="lead text-primary">{{$subscription->amount()}}</span> {{ __(' per ') }} {{$subscription->interval() }} </p>
                  </div>
                  <p class="mb-3">{{ __('Your plan will be canceled on ') }} {{Carbon\Carbon::parse($subscription->cancelAt())->format('F d Y')}}. </p>
                  
                  <p>{{ __('Please resume your subscription to continue using our app after trial period ends') }}</p>
                  
                  <form action="{{ route('account.subscriptions.resume') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success " id="card-button"> {{ __('Resume subscription') }} </button>
                  </form>
                @endif
                @if (currentTeam()->subscription('default')->recurring())
                    <h5 class="">
                      '{{ currentTeam()->name }}' {{ __(' is on plan :') }}
                      {{ currentTeam()->plan->title }} ({{$subscription->amount()}} / {{$subscription->interval() }})
                    </h5>
                    <div>
                      <small class="text-cap">{{ __('Total per') }} {{$subscription->interval() }} :</small>
                      <h3 class="text-primary">{{$subscription->amount()}}</h3>
                    </div>
                    
                    @if($coupon = $subscription->coupon())
                    <h5 class="text-success">
                        {{ __('Coupon') }} : {{$coupon->name()}} ( {{$coupon->value()}} OFF )
                    </h5>
                    @endif

                    @if($invoice)
                    <p class="mb-2">
                        {{-- {{ __('Next Payment') }} : {{$invoice->amount()}} <br> --}}
                        {{ __('This plan renews on ') }} {{Carbon\Carbon::parse($invoice->nextPaymentAttempt())->format('d F Y')}}
                    </p>
                    @endif

                    @if($customer)
                    <h4 class="text-success">
                       {{ __('Stripe balance') }}  : {{$customer->balance()}}
                    </h4>
                    @endif
                @endif
              </div>
              @if (currentTeam()->subscription('default')->recurring())
                <a class="mb-0 mr-1 btn btn-sm btn-info mb-md-2" href="{{ route('account.subscriptions.swap') }}">Update plan</a>

                <button type="button" class="mb-0 mr-1 btn btn-sm btn-success mb-md-2" data-toggle="modal" data-target="#applyCoupon">
                  {{ __('Apply coupon') }}
                </button>
              @endif
              <div class="my-2">
                  <a class="btn btn-ghost-info" href="{{currentTeam()->billingPortalUrl(route('account.subscriptions'))}}"> {{ __('Biling portal') }}</a>
              </div>
            </div>

            <div class="col-md-5 text-md-right">
              @if (currentTeam()->subscription('default')->recurring())
              <button type="button" class="mb-0 mr-1 btn btn-sm btn-warning mb-md-2" data-toggle="modal" data-target="#cancelSubscription">
                {{ __('Cancel Subscriptions') }}
              </button>
              @endif
            </div>
          </div>
          @endif
        </div>
        <!-- End Body -->
        @if(currentTeam()->subscribed())
          <div class="text-center">
            <span class="divider divider-text">{{ __('Plan usage') }}</span>
          </div>

          <!-- Body -->
          <div class="card-body">
            <div class="mb-2 row align-items-center flex-grow-1">
              <div class="col">
                <h4 class="card-header-title">{{ __('Storage usage') }}</h4>
              </div>

              <div class="col-auto">
                <strong class="text-dark">{{ __('4.27 GB') }}</strong> {{ __('used of 6 GB') }}
              </div>
            </div>

            <!-- Progress -->
            <div class="mb-3 progress rounded-pill">
              <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar opacity" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- End Progress -->

            <!-- Legend Indicators -->
            <div class="list-inline">
              <div class="list-inline-item">
                <span class="legend-indicator bg-danger"></span>{{ __('Personal usage space') }}
              </div>
              <div class="list-inline-item">
                <span class="legend-indicator bg-primary opacity"></span>{{ __('Shared space') }}
              </div>
              <div class="list-inline-item">
                <span class="legend-indicator"></span>{{ __('Unused space') }}
              </div>
            </div>
          </div>
        @endif
        <!-- End Body -->
      </div>

      <!-- Confirmation Modal -->
      <div class="modal fade" id="cancelSubscription" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cancelSubscription">{{ __('Subscription Cancel') }}</h5>
              <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                </svg>
              </button>
            </div>
            <form action="{{ route('account.subscriptions.cancel') }}" method="POST">
              @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label class="input-label" for="exampleFormControlSelect1">{{ __('Cancelation reason') }} </label>
                  <select id="reason" name="reason" required class="form-control">
                    <option>{{ __('Choose an option') }}</option>
                    @foreach (config('saas.cancelation_reasons') as $reason)
                      <option value="{{ $reason }}">{{ $reason }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="mb-0 mr-1 btn btn-sm btn-white mb-md-2" data-dismiss="modal">Close</button>
              <button type="submit" class="mb-0 mr-1 btn btn-sm btn-danger mb-md-2"> {{ __('Cancel Subscriptions') }} </button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <!-- Apply coupon -->
      <div class="modal fade" id="applyCoupon" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="applyCoupon">{{ __('Apply coupon') }}</h5>
              <button type="button" class="btn btn-xs btn-icon btn-soft-secondary" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" width="10" height="10" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                </svg>
              </button>
            </div>
            <form action="{{ route('account.subscriptions.coupon') }}" method="POST">
              @csrf
              <div class="modal-body">
                  <div class="form-group">
                    <label for="coupon">{{ __('Coupon code') }}</label>
                    <input type="text" required name="coupon" id="coupon" class="form-control @error('coupon') is-invalid @enderror">
                    @error('coupon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="mb-0 mr-1 btn btn-sm btn-white mb-md-2" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="mb-0 mr-1 btn btn-sm btn-danger mb-md-2"> {{ __('Apply coupon') }} </button>
              </div>
            </form>
          </div>
        </div>
      </div>
</x-account-layout>