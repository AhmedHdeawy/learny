@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.contactus') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.contactus') }}
          </div>

          <div class="card-block">
            
            @if(count($contactus) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.name') }}</th>
                            <th class="text-sm-center">{{ __('lang.phone') }}</th>
                            <th class="text-sm-center">{{ __('lang.email') }}</th>
                            <th class="text-sm-center">{{ __('lang.message') }}</th>
                            <th class="text-sm-center">{{ __('lang.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($contactus as $contact)                    
                          <tr class="text-sm-center">

                              <td> {{ $contact->name }} </td>
                              
                              <td> {{ $contact->phone }} </td>
                              
                              <td> {{ $contact->email }} </td>
                              
                              <td> {{ $contact->message }} </td>
                              
                              <td> {{ $contact->created_at->format('Y/m/d - h:i:s') }} </td>
                              
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
