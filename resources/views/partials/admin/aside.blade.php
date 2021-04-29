<aside id="sidebar" class="u-sidebar">
    <div class="u-sidebar-inner">
        <header class="u-sidebar-header">
            <a class="u-sidebar-logo" href="{{ route('admin.index') }}">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" width="124" alt="Saasify Dashboard">
            </a>
        </header>

        <nav class="u-sidebar-nav">
            <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
                <!-- Dashboard -->
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.index'), ' active') }}" href="{{ route('admin.index') }}">
                        <i class="fa fa-cubes u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <!-- End Dashboard -->

                <!-- Users -->
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.users.index') OR on_page('admin.users.create') OR on_page('admin.users.edit') OR on_page('admin.roles.index') OR on_page('admin.roles.create') OR on_page('admin.roles.edit') OR on_page('admin.permissions.create') OR on_page('admin.permissions.index') OR on_page('admin.permissions.edit'), ' active') }}"  href="#!"
                       data-target="#baseUI">
                        <i class="fas fa-users u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Users') }}</span>
                        <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                        <span class="u-sidebar-nav-menu__indicator"></span>
                    </a>

                    <ul id="baseUI" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ route('admin.users.index') }}">
                                <span class="u-sidebar-nav-menu__item-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Users') }}</span>
                            </a>
                        </li>
                        {{-- <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ route('admin.roles.index') }}">
                                <span class="u-sidebar-nav-menu__item-icon">
                                    <i class="fas fa-user-cog"></i>
                                </span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Roles') }}</span>
                            </a>
                        </li> --}}
                        {{-- <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ route('admin.permissions.index') }}">
                                <span class="u-sidebar-nav-menu__item-icon">
                                    <i class="fas fa-user-lock"></i>
                                </span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Permissions') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.plans.index') OR on_page('admin.plans.create') OR on_page('admin.plans.edit'), ' active') }}" href="{{ route('admin.plans.index') }}">
                        <i class="fas fa-chart-bar u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Plans') }}</span>
                    </a>
                </li>

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.coupons.index') OR on_page('admin.coupons.create') OR on_page('admin.coupons.edit'), ' active') }}" href="{{ route('admin.coupons.index') }}">
                        <i class="fas fa-tags u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Coupons') }}</span>
                    </a>
                </li>

                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.backup.index'), ' active') }}" href="{{ route('admin.backup.index') }}">
                        <i class="fas fa-hdd u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Backups') }}</span>
                    </a>
                </li>
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.tickets'), ' active') }}" href="{{ route('admin.tickets') }}">
                        <i class="fas fa-ticket-alt u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Tickets') }}</span>
                    </a>
                </li>
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.maintenance'), ' active') }}" href="{{ route('admin.maintenance') }}">
                        <i class="fas fa-check-circle u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Maintenance mode') }}</span>
                    </a>
                </li>

                <!-- Account Pages -->
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link {{ return_if(on_page('admin.subscription.cancel') || on_page('admin.subscriptions'), ' active') }}" href="#!"
                       data-target="#subMenu2">
                        <i class="fas fa-dollar-sign u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Subscriptions') }}</span>
                        <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                        <span class="u-sidebar-nav-menu__indicator"></span>
                    </a>

                    <ul id="subMenu2" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ route('admin.subscriptions') }}">
                                <span class="u-sidebar-nav-menu__item-icon"><i class="fas fa-dollar-sign"></i></span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Subscriptions') }}</span>
                            </a>
                        </li>
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ route('admin.subscription.cancel') }}">
                                <span class="u-sidebar-nav-menu__item-icon">C</span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Subscriptions canceld') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Account Pages -->

                <!-- Other Pages -->
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="#!"
                       data-target="#subMenu3">
                        <i class="fas fa-toolbox u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">{{ __('Tools') }}</span>
                        <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                        <span class="u-sidebar-nav-menu__indicator"></span>
                    </a>

                    <ul id="subMenu3" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
                        @if (config('saas.demo_mode'))
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" target="__blank" href="https://saasify.creatydev.com/artisan.png">
                                <span class="u-sidebar-nav-menu__item-icon"><i class="fas fa-terminal"></i></span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Artisan Command') }}</span>
                            </a>
                        </li>
                        @else
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ url('admin/~artisan') }}">
                                <span class="u-sidebar-nav-menu__item-icon"><i class="fas fa-terminal"></i></span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Artisan Command') }}</span>
                            </a>
                        </li>
                        @endif
                        <li class="u-sidebar-nav-menu__item">
                            <a class="u-sidebar-nav-menu__link" href="{{ url('/admin/languages') }}">
                                <span class="u-sidebar-nav-menu__item-icon"><i class="fas fa-globe"></i></span>
                                <span class="u-sidebar-nav-menu__item-title">{{ __('Translation') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Other Pages -->

                <hr>

                <!-- Documentation -->
                <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" target="__blank" href="https://saasify.creatydev.com/docs/1.0/overview">
                        <i class="far fa-newspaper u-sidebar-nav-menu__item-icon"></i>
                        <span class="u-sidebar-nav-menu__item-title">Documentation</span>
                    </a>
                </li>
                <!-- End Documentation -->
            </ul>
        </nav>
    </div>
</aside>