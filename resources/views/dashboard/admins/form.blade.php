
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="username"> {{ __('lang.username') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="username" name="username" 
            class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.username') }}"
            value="{{ old('username', isset($admin) ? $admin->username : '') }}"
          >
          
          @if ($errors->first('username'))
            <div class="invalid-feedback text-danger">{{ $errors->first('username') }}</div>
          @endif

      </div>
  </div>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="email"> {{ __('lang.email') }} </label>
      <div class="col-md-9">
          
          <input type="email" id="email" name="email" 
            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.email') }}"
            value="{{ old('email', isset($admin) ? $admin->email : '') }}"
          >
          
          @if ($errors->first('email'))
            <div class="invalid-feedback text-danger">{{ $errors->first('email') }}</div>
          @endif

      </div>
  </div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="password"> {{ __('lang.password') }} </label>
      <div class="col-md-9">
          
          <input type="password" id="password" name="password" 
            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.password') }}"
          >
          
          @if ($errors->first('password'))
            <div class="invalid-feedback text-danger">{{ $errors->first('password') }}</div>
          @endif

      </div>
  </div>

  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="password_confirmation"> {{ __('lang.password_confirmation') }} </label>
      <div class="col-md-9">
          
          <input type="password" id="password_confirmation" name="password_confirmation" 
            class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.password_confirmation') }}"
          >
          
          @if ($errors->first('password_confirmation'))
            <div class="invalid-feedback text-danger">{{ $errors->first('password_confirmation') }}</div>
          @endif

      </div>
  </div>

