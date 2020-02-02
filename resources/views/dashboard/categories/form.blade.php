
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>

<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('categories_status', isset($category) ? $category->categories_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="categories_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="categories_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('categories_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('categories_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[categories_desc]"> {{ __('lang.title') }} </label>
      <div class="col-md-9">
          
          <input 
            type="text" 
            id="{{ $languag->locale }}[categories_title]" 
            name="{{ $languag->locale }}[categories_title]" 
            class="form-control {{ $errors->first($languag->locale .'.categories_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.title') }}" 
            value="{{ old($languag->locale .'categories_title', isset($category) ? $category->translate($languag->locale)->categories_title : '') }}"
          >
          
          @if ($errors->first($languag->locale .'.categories_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.categories_title') }}</div>
          @endif

      </div>
  </div>
   {{-- 
   <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[categories_desc]"> {{ __('lang.desc') }} </label>
      <div class="col-md-9">
          
          <textarea id="{{ $languag->locale }}-ckeditor" name="{{ $languag->locale }}[categories_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.categories_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.categories_desc') }}"
          >{{ old($languag->locale .'categories_desc', isset($category) ? $category->translate($languag->locale)->categories_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.categories_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.categories_desc') }}</div>
          @endif

      </div>
  </div> --}}

@endforeach


