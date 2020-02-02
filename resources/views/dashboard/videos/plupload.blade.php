
<div class="video-upload-container">

  <h5 class="text-primary m-t-h m-b-h">
    {{ __('lang.video') }}
  </h5>

  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="videos_name"> {{ __('lang.video') }} </label>
      <div class="col-md-9">
          <div id="uploader">
              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
          </div>
          
      </div>
  </div>
</div>

<div class="card card-inverse video-upload-hint card-primary text-xs-center">
  <div class="card-block">
      <h5 class="fb-700">
        {{ __('lang.videoUploadHint') }}
      </h5>
  </div>
</div>


<div class="video-upload-data">


<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="category_id"> {{ __('lang.category') }} </label>
    <div class="col-md-9">
        
      <select class="form-control {{ $errors->first('category_id') ? 'is-invalid' : '' }}" id="category_id" name="category_id"
         placeholder="{{ __('lang.category') }}">
          <option value="">--</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ isset($video) && $video->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->categories_title }}
            </option>
          @endforeach
      </select>
        
        @if ($errors->first('category_id'))
          <div class="invalid-feedback text-danger">{{ $errors->first('category_id') }}</div>
        @endif

    </div>
</div>

<input 
      type="hidden" 
      name="videos_name" 
      value=""
    >

<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('videos_status', isset($video) ? $video->videos_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="videos_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="videos_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('videos_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('videos_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[videos_title]"> {{ __('lang.title') }} </label>
      <div class="col-md-9">
          <input 
            type="text" 
            id="{{ $languag->locale }}[videos_title]" 
            name="{{ $languag->locale }}[videos_title]" 
            class="form-control {{ $errors->first($languag->locale .'.videos_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.title') }}" 
            value="{{ old($languag->locale .'videos_title', isset($video) ? $video->translate($languag->locale)->videos_title : '') }}"
          >
          @if ($errors->first($languag->locale .'.videos_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.videos_title') }}</div>
          @endif

      </div>
  </div>

  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[videos_desc]"> {{ __('lang.desc') }} </label>
      <div class="col-md-9">
          <textarea type="text" id="{{ $languag->locale }}[videos_desc]" name="{{ $languag->locale }}[videos_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.videos_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.desc') }}"
          >{{ old($languag->locale .'videos_desc', isset($blog) ? $blog->translate($languag->locale)->videos_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.videos_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.videos_desc') }}</div>
          @endif

      </div>
  </div>

@endforeach

</div>
