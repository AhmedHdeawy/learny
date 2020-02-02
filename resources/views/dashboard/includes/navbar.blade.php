<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="{{ url('/') }}"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>
        </ul>

        <ul class="nav navbar-nav {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}  hidden-md-down">
            <li class="nav-item">
                <a class="nav-link" href="{{ str_replace( '/'.$localeLang.'/',  '/'.$localeLangInverse.'/', url()->full() ) }}">
                    <i class="fa fa-globe"></i> 
                    {{ __('lang.'.$localeLangInverse.'.inverse') }}
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('dashboard/img/AdminLTELogo.png') }} " class="img-avatar img-thumbnail">
                    <span class="hidden-md-down">{{ auth()->guard('admin')->user()->username }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.admins.edit', auth()->guard('admin')->id()) }}"><i class="fa fa-user"></i> {{ __('lang.profile') }} </a>

                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fa fa-lock"></i> {{ __('lang.logout') }}
                        </button>
                    </form>
                </div>
            </li>
            <li class="nav-item"></li>

        </ul>
    </div>
</header>
