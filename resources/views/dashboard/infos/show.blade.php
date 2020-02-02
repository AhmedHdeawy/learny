@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.infos.index') }}">{{ __('lang.infos') }}</a></li>
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
                        {{ $info->translate($showLang)->infos_title }}
                    </div>
                </div>


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.desc') }} :
                    </div>
                    <div class="col-sm-10">
                        {!! $info->translate($showLang)->infos_desc !!}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($info->infos_status == 1)
                            <strong class="text-success">{{ __('lang.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('lang.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.infos.edit', $info->id) }}" class="btn btn-warning">
                  {{ __('lang.edit') }}
                </a>

                <a href="{{ route('admin.infos.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
