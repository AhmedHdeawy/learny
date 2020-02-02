@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.admins') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')



<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.admins.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="{{ __('lang.username') }}">
            </div>

            <div class="form-group">
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('lang.email') }}">
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
              <i class="fa fa-align-justify"></i> {{ __('lang.admins') }}

              <a href="{{ route('admin.admins.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($admins) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.name') }}</th>
                            <th class="text-sm-center">{{ __('lang.email') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($admins as $admin)                    
                          <tr class="text-sm-center">

                              <td> {{ $admin->username }} </td>
                              <td> {{ $admin->email }} </td>
                              
                              <td>
                                <a href="{{ route('admin.admins.show', $admin->id) }}" 
                                    class="btn btn-primary btn-sm">
                                  <i class="icon-eye"></i>
                                </a>

                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </a>

                                <form method="post" action="{{ route('admin.admins.destroy', $admin->id) }}" class="d-inline-block">
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
