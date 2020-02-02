<!-- Start Nav Container -->
<div class="nav-container">
    <!-- Start  Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img class="img-fluid" src="{{ asset('front/img/AAYNET010.png') }}" alt="Aaynet Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m{{ $currentLangDir == 'rtl' ? 'r' : 'l' }}-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('lang.about') }}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ route('terms') }}">{{ __('lang.terms') }}</a>
                    </li>
                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ route('privacyPolicy') }}" tabindex="-1">{{ __('lang.privacyPolicy') }}</a>
                    </li>
                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ route('copyrights') }}" tabindex="-1">{{ __('lang.copyrights') }}</a>
                    </li>
                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ route('trademark') }}" tabindex="-1">{{ __('lang.trademark') }}</a>
                    </li>
                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ route('openSource') }}" tabindex="-1">{{ __('lang.openSource') }}</a>
                    </li>

                    <li class="nav-item mx-md-3">
                        <a class="nav-link" href="{{ str_replace( '/'.$localeLang,  '/'.$localeLangInverse, url()->full() ) }}">
                            <i class="fa fa-globe"></i> 
                            {{ __('lang.'.$localeLangInverse.'.inverse') }}
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- End  Navbar -->
</div>
<!-- End Nav Container -->
