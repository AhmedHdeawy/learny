@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.videos') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

{{-- Search Section --}}

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.videos.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{ __('lang.title') }}">
            </div>

            <div class="form-group">
                <select class="form-control" id="category_id" name="category_id"
                   placeholder="{{ __('lang.category') }}">
                    <option value="">--</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->categories_title }}
                      </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select id="status" name="status" class="form-control select-search" size="1">
                    <option value="">{{ __('lang.status') }}</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('lang.active') }}</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('lang.stopped') }}</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-dot-circle-o"></i> {{ __('lang.search') }}
                </button>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-danger reset-form">
                  <i class="fa fa-ban"></i> {{ __('lang.reset') }}
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>


{{-- Data Section --}}
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.videos') }}
              <a href="{{ route('admin.videos.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($videos) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.id') }}</th>
                            <th class="text-sm-center">{{ __('lang.lang') }}</th>
                            <th class="text-sm-center">{{ __('lang.category') }}</th>
                            <th class="text-sm-center">{{ __('lang.title') }}</th>
                            <th class="text-sm-center">{{ __('lang.like') }}</th>
                            <th class="text-sm-center">{{ __('lang.dislike') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    
                      @foreach($videos as $video)
                        
                        <tbody>
                            @foreach($video->translations as $videoTranslation)
                                  
                              <tr class="text-sm-center">

                                  <td> 
                                    @if($loop->first)
                                      {{ $video->id }}
                                    @endif
                                  </td>
                                  
                                  <td> {{ $videoTranslation->locale }} </td>

                                  <td> 
                                    @if($loop->first)
                                      {{ $video->category ? $video->category->categories_title : '--' }}
                                    @endif
                                  </td>
                                  
                                  <td> 
                                    {{ $videoTranslation->videos_title }}
                                  </td>

                                  <td> 
                                    @if($loop->first)
                                      {{ $video->likes->count() }}
                                    @endif
                                  </td>

                                  <td> 
                                    @if($loop->first)
                                      {{ $video->dislikes->count() }}
                                    @endif
                                  </td>
                                  
                                  <td> 
                                    @if($loop->first)
                                      @if($videoTranslation->video->videos_status == '0')
                                        <span class="tag tag-danger">{{ __('lang.stopped') }}</span>
                                      @else
                                        <span class="tag tag-success">{{ __('lang.active') }}</span>
                                      @endif

                                    @endif
                                  </td>
                                  
                                  <td>
                                    <a href="{{ route('admin.videos.show', [$video->id, 'showLang'  => $videoTranslation->locale ] ) }}" 
                                        class="btn btn-primary btn-sm">
                                      <i class="icon-eye"></i>
                                    </a>

                                    @if($loop->first)
                                      <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                      </a>
                                      
                                      <form method="post" action="{{ route('admin.videos.destroy', $video->id) }}" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete-form" type="submit">
                                          <i class="icon-trash"></i>
                                      </button>

                                    @endif
                                    
                                    </form>

                                  </td>

                              </tr>
                            @endforeach
                        </tbody>
                      
                      @endforeach
                </table>

                {{ $videos->links() }} 
            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
