@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">{{ __('lang.admins') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.username') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $admin->username }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $admin->email }}
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning">
                  {{ __('lang.edit') }}
                </a>

                <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
