@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.categories') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

{{-- Search Section --}}

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.categories.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{ __('lang.title') }}">
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
              <i class="fa fa-align-justify"></i> {{ __('lang.categories') }}

              <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($categories) < 1)
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
                            <th class="text-sm-center">{{ __('lang.title') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.show') }}</th>
                            <th class="text-sm-center">{{ __('lang.edit') }}</th>
                        </tr>
                    </thead>
                    
                      @foreach($categories as $category)
                        
                        <tbody>
                            @foreach($category->translations as $categoryTranslation)
                                  
                              <tr class="text-sm-center">

                                  <td> 
                                    @if($loop->first)
                                      {{ $category->id }}
                                    @endif
                                  </td>
                                  
                                  <td> {{ $categoryTranslation->locale }} </td>
                                  
                                  <td> 
                                    {{ $categoryTranslation->categories_title }}
                                  </td>

                                  <td> 
                                    @if($loop->first)
                                      @if($categoryTranslation->category->categories_status == '0')
                                        <span class="tag tag-danger">{{ __('lang.stopped') }}</span>
                                      @else
                                        <span class="tag tag-success">{{ __('lang.active') }}</span>
                                      @endif

                                    @endif
                                  </td>

                                  <td> 
                                      <a href="{{ route('admin.categories.show', [$category->id, 'showLang'  => $categoryTranslation->locale ] ) }}" 
                                          class="btn btn-primary btn-sm">
                                        <i class="icon-eye"></i>
                                      </a>
                                  </td>
                                  
                                  <td>
                                    @if($loop->first)
                                      <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                      </a>
                                    @endif

                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                      
                      @endforeach
                </table>

                {{ $categories->links() }} 
            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
