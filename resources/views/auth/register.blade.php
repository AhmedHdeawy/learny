@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center my-5 register-form">
        <div class="col-md-8">
            
            <!--Form with header-->
                    <form action="{{ route('register') }}" method="post">

                        @csrf

                        <div class="card border-success rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-success text-white text-center py-2">
                                    <h3><i class="fa fa-user"></i> {{ __('lang.registerTitle') }} </h3>
                                    <p class="m-0">{{ __('lang.registerHint') }}</p>
                                </div>
                            </div>
                            
                            <div class="card-body p-3">

                                <!--Body-->

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('lang.name') }}" >
                                        @if ($errors->first('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                        </div>
                                        <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ __('lang.phone') }}" >
                                        @if ($errors->first('phone'))
                                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
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

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-unlock text-success"></i></div>
                                        </div>
                                        <input type="password" class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="{{ __('lang.password_confirmation') }}" value="{{ old('password_confirmation') }}" >
                                        @if ($errors->first('password_confirmation'))
                                            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                          @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        @include('dashboard.includes.uploadImage', 
                                          ['name' =>  'avatar', 'value' =>  isset($user) ? $user->avatar : null, 'path' =>  'uploads/users/']
                                        )

                                        @if ($errors->first('avatar'))
                                          <div class="invalid-feedback text-danger">{{ $errors->first('avatar') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="{{ __('lang.register') }}" class="btn btn-success btn-block rounded-0 py-2">
                                </div>

                                <div class="my-3">
                                    <p class="m-0">
                                        {{ __('lang.hasUser') }}
                                        <a href="{{ route('login') }}" class="gr-color">{{ __('lang.login') }}</a>
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
