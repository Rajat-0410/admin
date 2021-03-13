<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Homeodocs</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('adminlte-master/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte-master/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('adminlte-master/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte-master/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('adminlte-master/dist/css/skins/_all-skins.min.css') }}">
        <!-- Admin Style CSS -->
        <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
        <!-- dropzone CSS -->
        <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
        <!-- jQuery 3 -->
        <script src="{{ asset('adminlte-master/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Validate JS -->
        <script src="{{ asset('js/validate/jquery.validate.js') }}"></script>
        <!-- bootbox.min JS -->
        <script src="{{ asset('js/bootbox.min.js') }}"></script>
        <!--  dropzone JS -->
        <script src="{{ asset('js/dropzone.js') }}"></script>
        <!-- ckeditor JS -->
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <!-- Mask Money -->
        <script src="{{ asset('js/admin/jquery.maskMoney.js') }}"></script>
        <!-- Common JS -->
        <script src="{{ asset('js/admin/common.js') }}"></script>
        <!-- Moment JS -->
        <script src="{{ asset('js/website/moment.min.js') }}"></script>
        <!-- Favicon -->
        <link rel="icon" href="{{ URL::asset('/images/website/logo.png') }}" type="image/x-icon"/>

        <script type="text/javascript">
            var SITE_URL = '<?php echo getenv('APP_URL'); ?>';
        </script>
    </head>
    <?php
    $bodyClass = ((Auth::check()) ? 'skin-blue sidebar-mini':'hold-transition login-page');
    // var_dump(Auth::check()); echo $bodyClass;
    ?>
    <body class="<?php echo $bodyClass; ?>">
        <div id="web_loader_overlay" class="loader-overlay"></div>
        <div id="web_loader_img" class="loader-img"><img src="{{ asset('images/website/ajax-loading.gif') }}"></div>
        
        <!--Page Header-->  
        @if(Auth::check())
        @include('includes.header')
        @endif
        
        <!-- Page Sidebar -->
        @if(Auth::check())
        @include('includes.sidebar')
        @endif
        
        <!-- Page Content -->
        <?php if(Auth::check()){ echo '<div class="wrapper">'; } ?>
        @yield('page-content')
        <?php echo '</div>'; ?>
        <!-- Page Content -->
        
        <!-- Page Footer -->
        @if(Auth::check())
        @include('includes.footer')
        @endif
        
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('adminlte-master/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('adminlte-master/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte-master/dist/js/adminlte.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('adminlte-master/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
        <!-- jvectormap  -->
        <script src="{{ asset('adminlte-master/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('adminlte-master/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('adminlte-master/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('adminlte-master/bower_components/Chart.js/Chart.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte-master/dist/js/demo.js') }}"></script>
    </body>
</html>