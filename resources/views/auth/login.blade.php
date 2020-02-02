@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center login-form">
        <div class="col-md-8">
            
            <!--Form with header-->
                    <form action="{{ route('login') }}" method="post">

                        @csrf

                        <div class="card border-success rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-success text-white text-center py-2">
                                    <h3><i class="fa fa-user"></i> {{ __('lang.loginTitle') }} </h3>
                                    <p class="m-0">{{ __('lang.loginHint') }}</p>
                                </div>
                            </div>
                            
                            <div class="card-body p-3">

                                <!--Body-->

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                        </div>
                                        <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('lang.email') }}" >
                                        @if ($errors->first('email'))
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-unlock text-success"></i></div>
                                        </div>
                                        <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="{{ __('lang.password') }}" value="{{ old('password') }}" >
                                        @if ($errors->first('password'))
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                          @endif
                                    </div>
                                </div>

                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                                {{ __('lang.rememberMe') }}
                                    </label>
                                </div>
                                

                                <div class="text-center">
                                    <input type="submit" value="{{ __('lang.login') }}" class="btn btn-success btn-block rounded-0 py-2">
                                </div>

                                <div class="my-3">
                                    <p class="m-0">
                                        {{ __('lang.hasNoUser') }}
                                        <a href="{{ route('register') }}" class="gr-color">{{ __('lang.register') }}</a>
                                    </p>
                                </div>

                            </div>

                        </div>
                    </form>
                    <!--Form with header-->

        </div>
    </div>
</div>
@endsection
