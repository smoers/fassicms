    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark position-sticky">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="./images/logo.png"></a>
        <!-- Navbar-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">{{ __('Dashboard') }} <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ __('Company data') }}</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"> {{ __('Customers') }}   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="">{{ __('List') }}</a></li>
                                <li><a class="dropdown-item" href="">{{ __('Add') }}</a></li>
                                <li><a class="dropdown-item" href="">{{ __('Modify') }}</a></li>
                                <li><a class="dropdown-item" href="">{{ __('Remove') }}</a></li>
                            </ul>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="#"> {{ __('Cranes') }}   <i class="fa fa-caret-right"></i></a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="">{{ __('List') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('crane.create') }}">{{ __('Add') }}</a></li>
                                <li><a class="dropdown-item" href="">{{ __('Modify') }}</a></li>
                                <li><a class="dropdown-item" href="">{{ __('Remove') }}</a></li>
                            </ul>

                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Worksheets') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Item 1</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Item 2</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Stocks') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Item 1</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Item 2</a>
                    </div>
                </li>

            </ul>
            <div class="navbar-nav ml-auto ml-md-0">{{ Auth()->user()->firstname }} {{Auth()->user()->lastname}}</div>

            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>
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

