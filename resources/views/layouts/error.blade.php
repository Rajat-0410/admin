<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($meta_title) ? $meta_title : env('APP_NAME'); ?></title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>"/>
        <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="csrf-token" content="{{ csrf_token() }}">        

        <!--[if IE 7 ]>    <html class="ie7"> <![endif]-->

        <!--[if IE 8 ]>    <html class="ie8"> <![endif]-->

        <!--[if IE 9 ]>    <html class="ie9"> <![endif]-->

        <!--[if !IE]><!--><script>if (/*@cc_on!@*/false) {
                document.documentElement.className = 'ie10';
            }</script><!--<![endif]-->

        <link rel="shortcut icon" href="{{ asset("images/website/favicon.png") }}" type="image/x-icon">

        <link rel="icon" href="{{ asset("images/website/favicon.png") }}" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,300i,400,400i,500,500i,600,600i,700,900" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Bootstrap -->

        <link rel="stylesheet" href="{{ asset('css/website/bootstrap.min.css') }}">


        <link rel="stylesheet" href="{{ asset('css/website/responsive.css') }}">

        <link rel="stylesheet" href="{{ asset('css/website/style_v3.css') }}">

        <link rel="stylesheet" href="{{ asset('css/website/custom_v3.css') }}">

        <!--<link rel="stylesheet" href="{{ asset('css/website/jcarousel.responsive.css') }}">-->       

        <!-- jQuery -->

        <script src="{{ asset('js/website/jquery.min.js') }}"></script>

        <script src="{{ asset('js/website/jquery.js') }}"></script>

        <!-- Bootstrap -->

        <script src="{{ asset('js/website/bootstrap.min.js') }}"></script>

        <!-- Validate JS -->

        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <!--<script src="{{ asset('js/validate/jquery.validate.js') }}"></script>-->

        <!-- bootbox.min JS -->

        <script src="{{ asset('js/bootbox.min.js') }}"></script>

        <!-- Common JS -->

        <script src="{{ asset('js/website/common_v4.js') }}"></script>

        

        <script type="text/javascript">

            var SITE_URL = '<?php echo getenv('APP_URL'); ?>';

            var IMAGE_ROOT_PATH = '<?php echo asset("images/website/"); ?>';

        </script>

    </head>

    <body>
        
        <header id="header" class="inner_header">

            <div class="top_header">
                <img src="" alt="" class="zoom">
            </div>
            <div class="wrap">
                <div class="container">
                    <div class="top_section">
                        <div class="logo_box">
                            <a href="/"><img src="{{ asset('images/website/logo.png') }}" style="height:50px;" alt="logo" class="ld-hide"></a>
                            <a href="/"><img src="{{ asset('images/website/logo.png') }}" style="height:50px;" alt="logo" class="md-hide"></a>
                        </div>
                    </div>

                    <div class="nav-button">
                        <button class="hamburger hamburger--boring" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>

                    </div>  
                    <div class="left_section ">

                    </div>

                    <div class="hero">
                        <header id="masthead" role="banner">

                            <nav id="site-nav" role="navigation">

                                <div class="nav-logo_box m-logo-box ">

                                    <a href="/"><img src="{{ asset('images/website/logo.png') }}" style="height:50px;" alt="logo" class="ld-hide"></a>
                                    <a href="/"><img src="{{ asset('images/website/logo.png') }}" style="height:50px;" alt="logo" class="md-hide"></a>
                                </div>

                                <div class="col">
                                    <div class="social_menus">
                                        <ul class="facebook_social">
                                            <li>
                                                <a href="#" target="_balnk">
                                                    <img src="" alt="Facebook">
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" target="_balnk">
                                                    <img src="" alt="Twitter">
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" target="_balnk">
                                                    <img src="" alt="Instagram">
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" target="_balnk">
                                                    <img src="" alt="Youtube">
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" target="_balnk">
                                                    <img src="" alt="Linkedin">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>               
                                </div>

                            </nav>
                        </header>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        @yield('page-content')
        <!-- Page Content -->

        <footer id="footer">
            <div class="container">        
            <div class="row">
            </div>
        </div>
    </footer>
        
        <script src="{{ asset('js/website/jquery.jcarousel.min.js') }}"></script>
        <script src="{{ asset('js/website/plugin.js') }}"></script>

    </body>

</html>