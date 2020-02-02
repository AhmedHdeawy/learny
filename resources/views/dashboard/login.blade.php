<!DOCTYPE html>
<html lang="{{ $localeLang }}" dir="{{ $currentLangDir == 'rtl' ? 'rtl' : 'ltr' }}">

<head>  

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>{{ __('lang.aaynetAdminPanel') }}</title>
  
  <!-- Bootstrap CSS-->
  {{-- <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}"> --}}
  
  <!-- Fonts CSS-->
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
  
  <!-- Icons CSS-->
  <link rel="stylesheet" href="{{ asset('dashboard/css/simple-line-icons.css') }}">
  
  <!-- Styles CSS-->
  @if($currentLangDir == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-en.css') }}">
  @endif

  <!-- Custom CSS-->
  @if($currentLangDir == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-en.css') }}">
  @endif

</head>


<body>

    <div class="container login-dash-page">
        <div class="row">
            <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
                <div class="card-group ">
                    <div class="card p-a-2">
                        <div class="card-block">
                            <h1>{{ __('lang.login') }}</h1>
                            <p class="text-muted">{{ __('lang.loginDetails') }}</p>

                            <p>
                                @if ($errors->has('email'))
                                        <span class="invalid-feedback text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </p>

                            <form method="POST" action="{{ route('admin.postLogin') }}">
                                @csrf

                                <div class="input-group m-b-1">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input type="text" 
                                        class="form-control en {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        name="email" 
                                        value="{{ old('email') }}" required autofocus
                                        placeholder="{{ __('lang.email') }}"
                                    >

                                </div>
                                
                                <div class="input-group m-b-2">
                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                    <input type="password" 
                                        class="form-control en {{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                        name="password" 
                                        placeholder="{{ __('lang.password') }}"
                                    >
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary p-x-2">
                                            <i class="icon-login"></i>
                                            {{ __('lang.login') }}
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="card card-inverse card-primary p-y-3" style="width:44%">
                        <div class="card-block text-xs-center">
                            <div>
                                <h2>{{ __('lang.aaynetAdminPanel') }}</h2>
                                <p>{{ __('lang.aaynetAdminPanelDetails') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>
    
    <!-- CoreUI main scripts -->
    <script src="{{ asset('dashboard/js/app.js') }}"></script>
    
    <!-- Plugins and scripts required by this views -->
    <!-- Custom scripts required by this view -->
    <script src="{{ asset('dashboard/js/views/main.js') }}"></script>

    <script>
        function verticalAlignMiddle()
        {
            var bodyHeight = $(window).height();
            var formHeight = $('.vamiddle').height();
            var marginTop = (bodyHeight / 2) - (formHeight / 2);
            if (marginTop > 0)
            {
                $('.vamiddle').css('margin-top', marginTop);
            }
        }
        $(document).ready(function()
        {
            verticalAlignMiddle();
        });
        $(window).bind('resize', verticalAlignMiddle);
    </script>

</body>
</html>


