<div class="accordion" id="vidoesName">
    @php $acc = 1; @endphp
    @foreach ($allFiles as $key => $val)
      @if(is_array($val))
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" 
                  data-toggle="collapse" data-target="#Acc{{ $acc }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="Acc{{ $acc }}">
                  {{ $key }}
                </button>
              </h5>
            </div>
              <div id="Acc{{ $acc }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#vidoesName">
                <div class="card-body">
                @foreach ($val as $file)
                  <div class="radio">
                    <label class="radio" for="{{ $file }}">
                        <input type="radio" id="{{ $file }}" 
                            name="videos_name" value="{{ $file }}" {{ isset($video) && $video->videos_name == $file ? 'checked' : '' }}>
                        {{ $file }}
                    </label>
                  </div>
                @endforeach
                </div>
              </div>
          </div>
      @endif
      @php $acc++; @endphp
    @endforeach

  @php $acc2 = 1; @endphp
  @foreach ($allFiles as $key => $val)
    @if(!is_array($val))
      <div class="radio">
        <label class="radio-inline" for="{{ $val }}">
            <input type="radio" id="{{ $val }}" 
                name="videos_name" value="{{ $val }}" {{ isset($video) && $video->videos_name == $val ? 'checked' : '' }}>
            {{ $val }}
        </label>
      </div>
    @endif
    @php $acc2++; @endphp
  @endforeach
{{-- 
    <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" 
              data-target="#AccFiles" aria-expanded="'false'" aria-controls="AccFiles">
              Ranodm
            </button>
          </h5>
        </div>
          <div id="AccFiles" class="collapse" aria-labelledby="headingOne" data-parent="#vidoesName">
            <div class="card-body">
              @php $acc2 = 1; @endphp
              @foreach ($allFiles as $key => $val)
                @if(!is_array($val))
                  <div class="radio">
                    <label class="radio-inline" for="{{ $val }}">
                        <input type="radio" id="{{ $val }}" 
                            name="videos_name" value="{{ $val }}" {{ isset($video) && $video->videos_name == $val ? 'checked' : '' }}>
                        {{ $val }}
                    </label>
                  </div>
                @endif
                @php $acc2++; @endphp
              @endforeach
            </div>
          </div>
    </div> --}}
</div>
