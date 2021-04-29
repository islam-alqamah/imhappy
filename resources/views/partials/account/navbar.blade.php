<div class="navbar-expand-lg navbar-expand-lg-collapse-block navbar-light">
    <div id="sidebarNav" class="collapse navbar-collapse navbar-vertical">
      <!-- Card -->
      <div class="card mb-5">
        <div class="card-body">
          <!-- Avatar -->
          <div class="d-none d-lg-block text-center mb-5">
            <div class="avatar avatar-xxl avatar-circle mb-3">
              <img class="avatar-img" src="{{ Auth::user()->profile_photo_url }}" alt="Image Description">
              <img class="avatar-status avatar-lg-status" src="{{ asset('saas/svg/verify.svg') }}" alt="Image Description" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified user">
            </div>

            <h4 class="card-title">{{ Auth::user()->name }}</h4>
            <p class="card-text font-size-1">{{ Auth::user()->email }}</p>
          </div>
          <!-- End Avatar -->

          <h6 class="text-cap small">{{ __('Account') }}</h6>

          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('profile.show'), ' active') }}" href="{{ route('profile.show') }}">
                <i class="fas fa-id-card nav-icon"></i>
                {{ __('Personal info') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('account.security'), ' active') }}" href="{{ route('account.security') }}">
                <i class="fas fa-shield-alt nav-icon"></i>
                {{ __('Security') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('account.preference'), ' active') }}" href="{{ route('account.preference') }}">
                <i class="fas fa-sliders-h nav-icon"></i>
                {{ __('Preferences') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('ticket.index'), ' active') }}" href="{{ route('ticket.index') }}">
                <i class="fas fa-ticket-alt nav-icon"></i>
                {{ __('Support') }}
              </a>
            </li>
          </ul>
          <!-- End List -->

          <h6 class="small text-cap">{{ __('Billing') }}<span class="badge badge-soft-navy badge-pill nav-link-badge" style="float:right;text-transform:normal;">{{ currentTeam()->name }}</span></h6>

          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">

              <li class="nav-item">
                <a href="{{ route('account.subscriptions') }}" class="nav-link {{ return_if(on_page('account.subscriptions'), ' active') }}"> 
                  <i class="fas fa-money-check-alt nav-icon"></i>
                  {{ __('Subscriptions') }}
                </a>
              </li>
              @if(currentTeam()->subscribed())
              <li class="nav-item">
                <a class="nav-link {{ return_if(on_page('account.subscriptions.card'), ' active') }}" href="{{ route('account.subscriptions.card') }}">
                  <i class="fas fa-credit-card nav-icon"></i>
                  {{ __('Payment') }}
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('account.subscriptions.invoices') }}" class="nav-link {{ return_if(on_page('account.subscriptions.invoices'), ' active') }}"> 
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  {{ __('Invoices') }}
                </a>
              </li>
              @endif
              @if(!currentTeam()->subscribed())
              <li class="nav-item">
                <a href="{{ route('subscription.plans') }}" class="nav-link {{ return_if(on_page('subscription.plans'), ' active') }}"> 
                  <i class="fas fa-chart-bar nav-icon"></i>
                  {{ __('Plans') }}
                </a>
              </li>
              @endif
          </ul>
          <!-- End List -->
          @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <h6 class="text-cap small"><i class="fas fa-users nav-icon"></i> 
            {{ __('Team Management') }}
          </h6>

          <!-- List -->
          <ul class="nav nav-sub nav-sm nav-tabs nav-list-y-2 mb-4">
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('teams.show'), ' active') }}" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                <i class="fas fa-sliders-h nav-icon"></i>
                {{ __('Team Settings') }}
              </a>
            </li>
            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <li class="nav-item">
              <a class="nav-link {{ return_if(on_page('teams.create'), ' active') }}" href="{{ route('teams.create') }}">
                <i class="fas fa-user-plus nav-icon"></i>
                {{ __('Create New Team') }}
              </a>
            </li>
            @endcan
          </ul>
          @endif
          <!-- End List -->
        </div>
      </div>
      <!-- End Card -->
    </div>
  </div>