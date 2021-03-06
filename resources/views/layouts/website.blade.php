<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <title>{!! env('APP_NAME') !!}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="/favicon.png">
        
        <!-- Bootstrap Core CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/bootstrap.min.css') }}">
        <!--fontawesome.min.css-->
        <link rel="stylesheet" href="{{ asset('css/website/fontawesome-5.9.0/fontawesome.min.css') }}">
        <!-- style CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/style.css') }}">
        <!-- colors CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/colors.css') }}">
        <!-- versions CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/versions.css') }}">
        <!-- responsive CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/responsive.css') }}">
        <!-- Custom CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/custom.css') }}">
        <!-- 3dslider CSS-->
        <link rel="stylesheet" href="{{ asset('css/website/3dslider.css') }}">
        <!--owl.carousel-->
        <link rel="stylesheet" href="{{ asset('owl-carousel-latest/dist/assets/owl.carousel.css') }}">
        <!-- font family -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- end font family -->
        
        <!--jquery-->
        <script src="{{ asset('js/website/jquery-1.12.4.min.js') }}"></script>
        <!-- Bootstrap Core JavaScript--> 
        <script src="{{ asset('js/website/bootstrap.min.js') }}"></script>
        <!--3dslider.js-->
        <script src="{{ asset('js/website/3dslider.js') }}"></script>
        <!--common.js-->
        <script src="{{ asset('js/website/common.js') }}"></script>
        <!-- Validate JS -->
        <script src="{{ asset('js/validate/jquery.validate.js') }}"></script>
        <!-- Favicon -->
        <link rel="icon" href="{{ URL::asset('/images/website/logo.png') }}" type="image/x-icon"/>
        
        <script type="text/javascript">
            var SITE_URL = '<?php echo getenv('APP_URL'); ?>';
        </script>
    </head>
    <body class="game_info" data-spy="scroll" data-target=".header">
        <!-- LOADER -->
        <div id="preloader">
           <img class="preloader" src="{!! url('images/website/loading-img.gif') !!}" alt="">
        </div>
        <!-- END LOADER -->
        
        <!--Page Header-->
        @include('includes.web-header')
        
        <!-- Page Content -->
        @yield('page-content')
        
        <!-- Page Footer -->
        @include('includes.web-footer')
        
        <!--owl.carousel-->
        <script src="{{ asset('owl-carousel-latest/dist/owl.carousel.js') }}"></script>
        <!-- ALL JS FILES -->
        <!--<script src="{{ asset('js/website/all.js') }}"></script>-->
        <!-- ALL PLUGINS -->
        <script src="{{ asset('js/website/custom.js') }}"></script>
        
    </body>
</html>
