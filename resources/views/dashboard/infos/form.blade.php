
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>

<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('infos_status', isset($info) ? $info->infos_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="infos_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="infos_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('infos_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('infos_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[infos_desc]"> {{ __('lang.title') }} </label>
      <div class="col-md-9">
          
          <input 
            type="text" 
            id="{{ $languag->locale }}[infos_title]" 
            name="{{ $languag->locale }}[infos_title]" 
            class="form-control {{ $errors->first($languag->locale .'.infos_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.title') }}" 
            value="{{ old($languag->locale .'infos_title', isset($info) ? $info->translate($languag->locale)->infos_title : '') }}"
          >
          
          @if ($errors->first($languag->locale .'.infos_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.infos_title') }}</div>
          @endif

      </div>
  </div>
   
   <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[infos_desc]"> {{ __('lang.desc') }} </label>
      <div class="col-md-9">
          
          <textarea id="{{ $languag->locale }}-ckeditor" name="{{ $languag->locale }}[infos_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.infos_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.infos_desc') }}"
          >{{ old($languag->locale .'infos_desc', isset($info) ? $info->translate($languag->locale)->infos_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.infos_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.infos_desc') }}</div>
          @endif

      </div>
  </div>

@endforeach


