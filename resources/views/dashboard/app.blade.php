<!DOCTYPE html>
<html lang="{{ $localeLang }}" dir="{{ $currentLangDir == 'rtl' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ asset('dashboard/img/logo.png') }}" type="image/png" sizes="16x16">

  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>{{ __('lang.aaynetAdminPanel') }}</title>
  

  <!-- Fonts CSS-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900">
  <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
  

  <!-- Icons CSS-->
  <link rel="stylesheet" href="{{ asset('dashboard/css/simple-line-icons.css') }}">
  
  <!-- Styles CSS-->
  @if($currentLangDir == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/style-en.css') }}">
  @endif

  {{-- Plugins --}}
  <link rel="stylesheet" href="{{ asset('dashboard/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/js/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/css/select2.css') }}">
  
  
  <!-- Custom CSS-->
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
    
  @if($currentLangDir == 'rtl')
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-ar.css') }}">
  @else
    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-en.css') }}">
  @endif

</head>


<body class="navbar-fixed sidebar-nav fixed-nav">

   
    <!-- Main Navbar-->
    @include('dashboard.includes.navbar')
    <!-- End / Main Navbar-->


    <!-- Main Sidebar-->
    @include('dashboard.includes.sidebar')
    <!-- End / Main Sidebar-->

    {{-- Page Content --}}
    <main class="main">
      <!-- Breadcrumb -->
        <ol class="breadcrumb">
          @yield('breadcrumb')
        </ol>
      <!-- End / Breadcrumb -->
        
      {{-- Page Content --}}
        <div class="container-fluid">
          <div class="animated fadeIn">
              @yield('content')
          </div>
        </div>
      {{-- End / Page Content --}}
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <span class="pull-left">
            <a href="{{ route('home') }}">{{ __('lang.websiteName') }}</a> &copy; {{ date('Y') }}
        </span>

        <span class="pull-right">
            بواسطة <a target="_blank" href="http://coreui.io">CoreUI</a>
        </span>
    </footer>
  
    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>
    
    <!-- CoreUI main scripts -->
    <script src="{{ asset('dashboard/js/app.js') }}"></script>

    
    <!-- Plugins and scripts required by this views -->
    <script src="{{ asset('dashboard/js/libs/alertify.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/select2.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    {{-- Customize CKEditor --}}
    <script>

     // CKEDITOR.replace( 'ar-ckeditor',
     //  {
     //     filebrowserBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Files') }}",
     //     filebrowserImageBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Images') }}",
     //     filebrowserUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
     //     filebrowserImageUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
     //  });

     // CKEDITOR.replace( 'en-ckeditor',
     //  {
     //     filebrowserBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Files') }}",
     //     filebrowserImageBrowseUrl: "{{ asset('vendors/ckfinder/ckfinder.html?Type=Images') }}",
     //     filebrowserUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
     //     filebrowserImageUploadUrl: "{{ asset('vendors/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
     //  });
    </script>
  
    <script src="{{ asset('dashboard/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plupload/plupload.full.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/plupload/jquery.ui.plupload/jquery.ui.plupload.min.js') }}"></script>
    @if($currentLangDir == 'rtl')
      <script src="{{ asset('dashboard/js/plupload/i18n/ar.js') }}"></script>
    @endif


    <!-- Custom scripts required by this view -->
    <script src="{{ asset('dashboard/js/views/main.js') }}"></script>


    <script src="{{ asset('dashboard/js/custom.js') }}"></script>

    @yield('script')

</body>
</html>
