<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('front/img/AAYNET010.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>

    {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    @if($currentLangDir == 'ltr')
        {{-- LTR Styles --}}
        <link rel="stylesheet" href="{{ asset('front/css/style-ltr.css') }}">
    @endif


</head>

<!-- class="rtl" -->
<body>

    {{-- Navbar --}}
    {{-- @include('layouts.navbar') --}}

    
    @yield('content')


    <!-- Start Footer -->

       {{--  <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-2 text-center">
                        <ul class="footer-links">
                            <li class="footer-link"><a href="{{ route('home') }}">{{ __('lang.about') }}</a></li>
                            <li class="footer-link"><a href="{{ route('terms') }}">{{ __('lang.terms') }}</a></li>
                            <li class="footer-link"><a href="{{ route('privacyPolicy') }}">{{ __('lang.privacyPolicy') }}</a></li>
                            <li class="footer-link"><a href="{{ route('contactus') }}">{{ __('lang.contactUs') }}</a></li>
                            <li class="footer-link"><a href="/">{{ __('lang.tour') }}</a></li>
                            <li class="footer-link"><a href="http://bit.ly/2lPKvzR" target="_blank">{{ __('lang.volunteers') }}</a></li>
                            <li class="footer-link"><a href="http://bit.ly/2ljQ6On" target="_blank">{{ __('lang.jobs') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-12 text-center">
                        <div class="">
                            <p> {{ __('lang.footerCopyRight') }} {{ date('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}


    <!-- End Footer -->


    {{-- Scripts --}}
    <script src="{{ asset('front/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>


    <script src="{{ asset('front/js/plugins.js') }}"></script>

</body>
</html>
