@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.videos.index') }}">{{ __('lang.videos') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
        
        <div class="card">
            <div class="card-block">


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.title') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $video->translate($showLang)->videos_title }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.desc') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $video->translate($showLang)->videos_desc }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.category') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $video->category->categories_title }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.url') }} :
                    </div>

                    <div class="col-sm-10">
                        <video width="400" controls>
                          <source src="{{ asset('uploads/videos/'.$video->videos_name) }}" type="video/mp4">
                          <source src="mov_bbb.ogg" type="video/ogg">
                          Your browser does not support HTML5 video.
                        </video>
                    </div>
                </div>

                 <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.like') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $video->likes->count() }}
                    </div>
                </div>

                 <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.dislike') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $video->dislikes->count() }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($video->videos_status == 1)
                            <strong class="text-success">{{ __('lang.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('lang.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-warning">
                  {{ __('lang.edit') }}
                </a>

                <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
