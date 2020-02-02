@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.settings') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.settings') }}
          </div>

          <div class="card-block">
            
            @if(count($settings) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.name') }}</th>
                            <th class="text-sm-center">{{ __('lang.value') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($settings as $setting)                    
                          <tr class="text-sm-center">

                              <td> {{ __('lang.'.$setting->settings_key) }} </td>
                              
                              <td> {{ $setting->settings_value }} </td>

                              <td>
                                
                                <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-info btn-sm">
                                  {{ __('lang.edit') }} <i class="icon-pencil"></i>
                                </a>

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
