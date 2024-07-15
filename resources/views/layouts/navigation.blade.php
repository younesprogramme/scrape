<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand mr-5" href="#" title="{{ config('app.name', 'Laravel') }}">
            <img src="{{ asset('img/logo-v12.jpg') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-lg-5">
                <li class="nav-item ms-lg-3 me-lg-2">
                    {{-- <a class="nav-link {{ request()->routeIs('dealer_search') ? 'active' : '' }}" href="{{ route('dealer_search') }}">
                        {{ __('Dealers') }}
                    </a> --}}
                    <a class="nav-link active" href="">
                        {{ __('Scrape') }}
                    </a>
                </li>
                @can('manage-users')
                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link dropdown-toggle {{ request()->routeIs('user.*') || request()->routeIs('dealer_support_.*') ? 'active' : '' }}" href="#" id="navbarDropdownUsers" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Users') }}
                        </a> --}}
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsers">
                            {{-- <li><a class="dropdown-item" href="{{ route('user.index') }}"><i class="fas fa-users"></i> {{ __('Users') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.history_index') }}"><i class="fas fa-history"></i> {{ __('History') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('show.cancellation') }}"><i class="fas fa-power-off"></i> {{ __('Cancellation report') }}</a></li>
                           <!-- <li><a class="dropdown-item" href="{{ route('user.commission') }}"><i class="fas fa-search-dollar"></i> {{ __('Commission') }}</a></li> !-->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('dealer_support_dashboard') }}"><i class="fas fa-chart-pie"></i> {{ __('Dashboard') }}</a></li> --}}
                        </ul>
                    </li>
                @endcan
                @can('export-dealers')
                    <li class="nav-item ms-lg-3 me-lg-2">
                        <a class="nav-link {{ request()->routeIs('export_*') ? 'active' : '' }}" href="{{ route('export_dealers') }}">
                            {{ __('Export') }}
                        </a>
                    </li>
                @endcan
                @can('view-e-sign')
                    <li class="nav-item ms-lg-3 me-lg-2">
                        <a class="nav-link {{ request()->routeIs('e_sign_*') ? 'active' : '' }}" href="{{ route('e_sign_list') }}">
                            {{ __('E-sign') }}
                        </a>
                    </li>
                @endcan
                @can('manage-redis')
                    <li class="nav-item ms-lg-3 me-lg-2">
                        <a class="nav-link {{ request()->routeIs('admin_redis_*') ? 'active' : '' }}" href="{{ route('admin_redis_all') }}">
                            {{ __('Redis') }}
                        </a>
                    </li>
                @endcan
                @can('manage-fbmp-params')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('parameters.*') ? 'active' : '' }}" href="#" id="navbarDropdownParameters" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Config
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownParameters">
                            <li><a class="dropdown-item" href="{{ route('parameters.index') }}"><i class="fab fa-facebook"></i> {{ __('Fbmp Params') }}</a></li>
                            @can('manage-params')
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('parameters.index', ['all' => 1]) }}"><i class="fas fa-puzzle-piece"></i> {{ __('All params') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- {{ Auth::user()->name }} --}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                        {{-- <li><a class="dropdown-item" href="{{ route('my_account_show') }}">{{ __('My account') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('user_permissions') }}">{{ __('Permissions') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a></li> --}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
