
<input type="hidden" name="settings_key" value="{{ $setting->settings_key }}">


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="settings_value"> {{ __('lang.'.$setting->settings_key) }} </label>
    <div class="col-md-9">
        
        <input type="text" id="settings_value" name="settings_value" 
          class="form-control {{ $errors->first('settings_value') ? 'is-invalid' : '' }}" 
          placeholder="{{ __('lang.name') }}"
          value="{{ old('settings_value', isset($setting) ? $setting->settings_value : '') }}"
        >
        @if ($errors->first('settings_value'))
          <div class="invalid-feedback text-danger">{{ $errors->first('settings_value') }}</div>
        @endif

    </div>
</div>

