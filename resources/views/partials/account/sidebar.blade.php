<nav class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('saas/img/logo.png') }}" class="navbar-brand-img" alt="knine" style="max-height: 4rem;padding-left: 12px;">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                    data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('/dashboard'), ' active') }}"
                            href="/dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-link-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('profile.show') or on_page('account.security') or on_page('account.preference') or on_page('account.social') , ' active') }}" href="#navbar-components" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-components">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="nav-link-text">{{ __('Account') }}</span>
                        </a>
                        <!-- Subscription Links -->
                        <div class="collapse" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('profile.show'), ' active') }}"
                                        href="{{ route('profile.show') }}">
                                        {{ __('Account') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.security'), ' active') }}"
                                        href="{{ route('account.security') }}">
                                        {{ __('Security') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.preference'), ' active') }}"
                                        href="{{ route('account.preference') }}">
                                        {{ __('Preferences') }}
                                    </a>
                                </li>
                                @if (JoelButcher\Socialstream\Socialstream::show())
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.social'), ' active') }}"
                                        href="{{ route('account.social') }}">
                                        {{ __('Social account') }}
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('account.subscriptions') or on_page('account.subscriptions.card') or on_page('account.subscriptions.invoices') or on_page('subscription.plans'), ' active') }}" href="#navbar-plans" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-forms">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                            <span class="nav-link-text">{{ __('Billing') }}</span>
                        </a>
                        <div class="collapse" id="navbar-plans">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ return_if(on_page('account.subscriptions'), ' active') }}"
                                            href="{{ route('account.subscriptions') }}">
                                            {{ __('Subscriptions') }}
                                        </a>
                                    </li>
                                    @if(currentTeam()->subscribed())
                                    <li class="nav-item">
                                        <a class="nav-link {{ return_if(on_page('account.subscriptions.card'), ' active') }}" href="{{ route('account.subscriptions.card') }}">
                                        {{ __('Payment') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('account.subscriptions.invoices') }}" class="nav-link {{ return_if(on_page('account.subscriptions.invoices'), ' active') }}"> 
                                        {{ __('Invoices') }}
                                        </a>
                                    </li>
                                    @endif
                                    @if(!currentTeam()->subscribed())
                                    <li class="nav-item">
                                        <a href="{{ route('subscription.plans') }}" class="nav-link {{ return_if(on_page('subscription.plans'), ' active') }}"> 
                                        {{ __('Plans') }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                    </li>
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('teams.show') or on_page('teams.create'), ' active') }}" href="#navbar-teams" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-forms">
                        <i class="fas fa-users nav-icon"></i>
                            <span class="nav-link-text">{{ __('Team Management') }}</span>
                        </a>
                    <div class="collapse" id="navbar-teams">
                    <ul class="nav nav-sm flex-column">
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
                    </div>
                    </li>
                    @endif
                    <!-- End List -->
                   
                    <li class="nav-item">
                        <a class="nav-link{{ return_if(on_page('ticket.index') or on_page('ticket.create'), ' active') }}" href="#navbar-tickets" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-forms">
                            <i class="fas fa-ticket-alt"></i>
                            <span class="nav-link-text">{{ __('Ticket') }}</span>
                        </a>
                        <div class="collapse" id="navbar-tickets">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('ticket.index'), ' active') }}"
                                        href="{{ route('ticket.index') }}">
                                        <i class="fas fa-clipboard-check"></i>
                                        {{ __('Support') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('ticket.create'), ' active') }}"
                                        href="{{ route('ticket.create') }}">
                                        <i class="far fa-plus-square"></i>
                                        {{ __('New ticket') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link"
                        href="https://saasify.creatydev.com/docs/1.0/overview"
                        >
                            <i class="ni ni-single-copy-04"></i>
                            <span class="nav-link-text">{{ __('Help') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>