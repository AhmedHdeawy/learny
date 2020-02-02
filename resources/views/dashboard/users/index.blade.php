@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.users') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')



<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.users.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="{{ __('lang.phone') }}">
            </div>

            <div class="form-group">
                <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}" placeholder="{{ __('lang.code') }}">
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

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.users') }}

              <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($users) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.phone') }}</th>
                            <th class="text-sm-center">{{ __('lang.email') }}</th>
                            <th class="text-sm-center">{{ __('lang.code') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($users as $user)                    
                          <tr class="text-sm-center">

                              <td> {{ $user->phone }} </td>
                              <td> {{ $user->email }} </td>
                              <td> {{ $user->code }} </td>

                              <td> 
                                @if($user->status == '0')
                                  <span class="tag tag-danger">{{ __('lang.stopped') }}</span>
                                @else
                                  <span class="tag tag-success">{{ __('lang.active') }}</span>
                                @endif      
                              </td>
                              
                              <td>
                              {{--   <a href="{{ route('admin.users.show', $user->id) }}" 
                                    class="btn btn-primary btn-sm">
                                  <i class="icon-eye"></i>
                                </a>
 --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </a>

                                <form method="post" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline-block">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger btn-sm delete-form" type="submit">
                                    <i class="icon-trash"></i>
                                  </button>
                                </form>

                              </td>

                          </tr>
                      @endforeach
                    </tbody>
                </table>

            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
