@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.videos.index') }}"> {{ __('lang.videos') }} </a></li>
  <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

  <form action="{{ route('admin.videos.store') }}" method="post" class="form-horizontal video-form" enctype="multipart/form-data">
  
    <div class="card">
      <div class="card-header">
          {{ __('lang.data') }}
      </div>
      <div class="card-block">
          @csrf
          {{-- @include('dashboard.videos.plupload') --}}
          @include('dashboard.videos.form')

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


@section('script')

  <script type="text/javascript">
    
      $('#uploader').plupload({
        runtimes : 'html5,flash,silverlight,html4',
        url : "{{ route('admin.uploadVideo') }}",
        max_file_size : '1000mb',
        max_file_count: 1,
        // chunk_size: '1mb',
        filters : [
            {title : "Video files", extensions : "3GPP,AVI,MP4,FLV,MOV,MPEG4,MPEGPS,WebM,WMV"},
        ],
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept':'application/json'
        },
        dragdrop: true,
        multi_selection: false,
        file_data_name: "video",
        flash_swf_url : '../../js/Moxie.swf',
        silverlight_xap_url : '../../js/Moxie.xap',
        selected: function(up, f) {

          var existedFiles = $('#uploader').plupload('getFiles');

          var files = f.files;
          if (existedFiles.length > 1) {

            for (var i = 1; i < existedFiles.length; i++) {
              
              $('#uploader').plupload('removeFile', existedFiles[i]);
            }

            $('#uploader').plupload('notify', 'error', "{{ __('lang.maxFileCount') }}")

          }

        },
        uploaded: function(e, args) {
          var filaNameReturned = args.result.response;

          $('input[name="videos_name"]').val(filaNameReturned.replace(/["]+/g, ''));
          
          // Hide Uploader
          $('#uploader').fadeOut('slow',);

          // Show Video Data
          
          $('.video-upload-hint').fadeIn('slow');
          $('.video-upload-data').fadeIn('slow');
          $('.video-form .card-footer').fadeIn('slow');
        },
      });

  </script>

@endsection
