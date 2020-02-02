@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"> {{ __('lang.users') }} </a></li>
  <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

  <form action="{{ route('admin.users.store') }}" method="post" class="form-horizontal " enctype="multipart/form-data">
  
    <div class="card">
      <div class="card-header">
          {{ __('lang.data') }}
      </div>
      <div class="card-block">
          @csrf
          @include('dashboard.users.form')
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> {{ __('lang.save') }}
          </button>
          <button type="button" class="btn btn-sm btn-danger reset-form"><i class="fa fa-ban"></i>
            {{ __('lang.resetInputs') }}
          </button>
      </div>
    </div>
  
  </form>


@endsection
