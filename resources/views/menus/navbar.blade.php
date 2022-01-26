    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark position-sticky fixed-top " style="z-index:9999">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="{{ asset('./images/logo.png') }}"></a>
        <!-- Navbar-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if( Route::is('dashboard')) active @endif">
                    <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }} <span class="sr-only">(current)</span></a>
                </li>
                @canany(['list customer','create customer','list crane','create crane','list technician','create technician'])
                <li class="nav-item dropdown  @if( Route::is('crane.*') || Route::is('customer.*') || Route::is('technician.*')) active @endif">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ __('Company data') }}</a>
                    <ul class="dropdown-menu">
                        @canany(['list customer','create customer'])
                        <li><a class="dropdown-item" href="{{ route('customer.index')}}"> {{ __('Customers') }}   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                @can('list customer')<li><a class="dropdown-item" href="{{ route('customer.index')}}">{{ __('List') }}</a></li>@endcan
                                @can('create customer')<li><a class="dropdown-item" href="{{ route('customer.create')}}">{{ __('Add') }}</a></li>@endcan
                            </ul>
                        </li>
                        <div class="dropdown-divider"></div>
                        @endcanany
                        @canany(['list crane','create crane'])
                        <li><a class="dropdown-item" href="{{ route('crane.index') }}"> {{ __('Cranes') }}   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                @can('list crane')<li><a class="dropdown-item" href="{{ route('crane.index') }}">{{ __('List') }}</a></li>@endcan
                                @can('create crane')<li><a class="dropdown-item" href="{{ route('crane.create') }}">{{ __('Add') }}</a></li>@endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['list technician','create technician'])
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{ route('technician.index') }}"> {{ __('Technicians') }}   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                @can('list technician')<li><a class="dropdown-item" href="{{ route('technician.index') }}">{{ __('List') }}</a></li>@endcan
                                @can('create technician')<li><a class="dropdown-item" href="{{ route('technician.create') }}">{{ __('Add') }}</a></li>@endcan
                            </ul>
                        </li>
                        @endcanany
                        @can('list provider')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('provider.index')}}">{{__('Providers')}}</a>
                        @endcanany
                    </ul>
                </li>
                @endcanany
                @canany(['list worksheet','create worksheet','clocking worksheet'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Worksheet') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('list worksheet')<a class="dropdown-item" href="{{route('worksheet.index')}}">{{__('List')}}</a>@endcan
                        @can('create worksheet')<a class="dropdown-item" href="{{route('worksheet.create')}}">{{__('Add')}}</a>@endcan
                        @can('create worksheet')<a class="dropdown-item" href="{{route('worksheet.template.create')}}">{{__('Template creation')}}</a>@endcan
                        @can('clocking worksheet')<div class="dropdown-divider"></div>@endcan
                        @can('clocking technician')<a class="dropdown-item" href="{{route('clocking.technician')}}">{{__('Technician clocking')}}</a>@endcan
                        @can('clocking correction')<a class="dropdown-item" href="{{route('clocking.correct')}}">{{__('Technician clocking correction')}}</a>@endcan
                    </div>
                </li>
                @endcanany
                @canany(['list catalog','create catalog','list stock','reassort worksheet stock','out worksheet stock'])
                <li class="nav-item dropdown @if( Route::is('store.*')) active @endif">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Stocks') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('list catalog')<a class="dropdown-item" href="{{route('store.index')}}">{{__('Catalog')}}</a>@endcan
                        @can('create catalog')<a class="dropdown-item" href="{{route('store.create')}}">{{__('Add a part to the catalog')}}</a>@endcan
                        @can('list stock')<div class="dropdown-divider"></div>@endcan
                        @can('list stock')<a class="dropdown-item" href="{{route('reassort.index')}}">{{__('Movement of stock')}}</a>@endcan
                        @canany(['out worksheet stock','reassort worksheet stock'])
                        <div class="dropdown-divider"></div>
                        @endcanany
                        @can('out worksheet stock')<a class="dropdown-item" href="{{route('outworksheet.out')}}">{{__('Out on worksheet')}}</a>@endcan
                        @can('reassort worksheet stock')<a class="dropdown-item" href="{{route('outworksheet.in')}}">{{__('In on worksheet')}}</a>@endcan
                    </div>
                </li>
                @endcanany
                <li class="nav-item dropdown @if( Route::is('reporting.*')) active @endif">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Reporting') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('reporting.from',1)}}">{{__('From Partmetadatas')}}</a>
                        <a class="dropdown-item" href="{{route('reporting.from',2)}}">{{__('From Crane History')}}</a>
                        <a class="dropdown-item" href="{{route('reporting.from',3)}}">{{__('From Stock Reassortment')}}</a>
                    </div>
                </li>
            </ul>
            <div class="navbar-nav ml-auto ml-md-0 text-white-50">{{ Auth()->user()->firstname }} {{Auth()->user()->lastname}}</div>

            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @can('password change')<a class="dropdown-item" href="#" id="change_password">{{ __('Change Password') }}</a>@endcan
                        @can('admin')<a class="dropdown-item" href="#">{{ __('Administration') }}</a>@endcan
                            <a class="dropdown-item" href="https://mo-consult.myjetbrains.com/hub/auth/login?response_type=token&client_id=00c92140-2f38-435b-8aa2-d04f6c33f390&redirect_uri=https:%2F%2Fmo-consult.myjetbrains.com%2Fyoutrack%2Foauth&scope=00c92140-2f38-435b-8aa2-d04f6c33f390%20Upsource%20TeamCity%20YouTrack%2520Slack%2520Integration%200-0-0-0-0&state=2e3e4e9a-184d-4b12-b04a-8da173066702" target="_blank">Bug Tracker</a>
                        @canany(['admin','password change'])<div class="dropdown-divider"></div>@endcan
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


