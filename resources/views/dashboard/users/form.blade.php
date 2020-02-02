
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="phone"> {{ __('lang.phone') }} </label>
    <div class="col-md-9">
        <input type="text" id="phone" name="phone" 
          class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" 
          placeholder="20116493764"
          value="{{ old('phone', isset($user) ? $user->phone : '') }}"
        >
        
        @if ($errors->first('phone'))
          <div class="invalid-feedback text-danger">{{ $errors->first('phone') }}</div>
        @endif

    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="email"> {{ __('lang.email') }} </label>
    <div class="col-md-9">
        <input type="email" id="email" name="email" 
          class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" 
          placeholder="user@example.com"
          value="{{ old('email', isset($user) ? $user->email : '') }}"
        >
        
        @if ($errors->first('email'))
          <div class="invalid-feedback text-danger">{{ $errors->first('email') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('status', isset($user) ? $user->status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('status') }}</div>
      @endif

  </div>
</div>
