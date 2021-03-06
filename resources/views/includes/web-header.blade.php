<?php // echo $get_controller.' - - '.$get_action; exit('here');    ?>
<?php
// Is User Logged In
$isLoggedIn = false;
$isLoggedIn = Auth::check();
// is HomePage
$isHomePage = ($get_controller == 'home' && $get_action == '') ? true : false;
// dd($isHomePage);
?>
<section id="top">
    
    <header>
        <div class="container">
            <div class="header-top">
                <div class="row">
                    <div class="col-md-2">
                        <div class="full text-center">
                            <div class="logo">
                                <a href="{!! url('/') !!}">
                                    <img src="{{ asset("images/website/logo.png") }}" alt="{!! env('APP_NAME') !!}" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="main-menu-section">
                            <div class="menu">
                                <nav class="navbar navbar-inverse">
                                    <div class="navbar-header">
                                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="#">Menu</a>
                                    </div>
                                    <div class="collapse navbar-collapse js-navbar-collapse">
                                        @if(!empty($main_menu))
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <a href="{!! url('/') !!}">Home</a>
                                            </li>
                                            @foreach($main_menu as $mmenu)
                                            <?php
                                                // print("<pre>"); print_r($mmenu); exit('in view');
                                                
                                                $mm_page_url = SITE_URL . '/' . $mmenu['page_slug'];
                                                // sub_menus
                                                $sub_menus = $mmenu['sub_menus'];
                                                $hasSubMenu = (!empty($sub_menus)) ? true:false;
                                                // var_dump($hasSubMenu);
                                            ?>
                                            <li class="<?php if($hasSubMenu){ echo 'dropdown'; } ?>">
                                                <?php if($hasSubMenu){ ?>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <?php echo $mmenu['name']; ?> <span class="caret"></span>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="{!! $mm_page_url !!}"><?php echo $mmenu['name']; ?></a>
                                                <?php } ?>
                                                <?php if($hasSubMenu){ // print("<pre>"); print_r($sub_menus); exit('in view'); ?>
                                                    <ul class="dropdown-menu">
                                                        @foreach($sub_menus as $smenu)
                                                            <?php
                                                                // print("<pre>"); print_r($smenu); exit('in view');
                                                                $sm_page_url = SITE_URL . '/' . $smenu['page_slug'];
                                                            ?>
                                                                <li>
                                                                    <a href="{!! $sm_page_url !!}"><?php echo $smenu['name']; ?></a>
                                                                </li>
                                                        @endforeach
                                                    </ul>
                                                <?php } ?>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                    <!-- /.nav-collapse -->
                                </nav>
<!--                                <div class="search-bar">
                                    <div id="imaginary_container">
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control"  placeholder="Search" >
                                            <span class="input-group-addon">
                                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>  
                                            </span>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="right_top_section">
                            <!-- social icon -->
                            <ul class="social-icons pull-left">
                                <li>
                                    <a class="facebook" href="https://www.facebook.com/gurgaontennisacademy/">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="twitter" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="youtube" href="#">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                </li>-->
<!--                                <li>
                                    <a class="pinterest" href="#">
                                        <i class="fa fa-pinterest-p"></i>
                                    </a>
                                </li>-->
                            </ul>
                            <!-- end social icon -->
                            <!-- button section -->
<!--                            <ul class="login">
                                <li class="login-modal">
                                    <a href="#" class="login"><i class="fa fa-user"></i>Login</a>
                                </li>
                                <li>
                                    <div class="cart-option">
                                        <a href="#"><i class="fa fa-shopping-cart"></i>Register</a>
                                    </div>
                                </li>
                            </ul>-->
                            <!-- end button section -->
                        </div>                        
                    </div>
                </div>
            </div>
            
<!--            <div class="header-bottom">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main-menu-section">
                            <div class="menu">
                                <nav class="navbar navbar-inverse">
                                    <div class="navbar-header">
                                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="#">Menu</a>
                                    </div>
                                    <div class="collapse navbar-collapse js-navbar-collapse">
                                        @if(!empty($main_menu))
                                        <ul class="nav navbar-nav">
                                            @foreach($main_menu as $mmenu)
                                            <?php
                                                // print("<pre>"); print_r($mmenu); exit('in view');
                                                // $mm_page_url = SITE_URL . '/' . $mmenu['page_slug'];
                                            ?>
                                            <li class="active">
                                                <a href="{!! $mm_page_url !!}"><?php // echo $mmenu['name']; ?></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                     /.nav-collapse 
                                </nav>
                                <div class="search-bar">
                                    <div id="imaginary_container">
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control"  placeholder="Search" >
                                            <span class="input-group-addon">
                                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>  
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>-->
            
        </div>
    </header>
    
    <?php if($isHomePage){ ?>
    <div class="full-slider">
        <div id="carousel-example-generic" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- First slide -->
                <div class="item active banner1" data-ride="carousel" data-interval="5000">
                    <div class="carousel-caption">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="slider-contant" data-animation="animated fadeInRight">
                                <!-- <h3>If you Don???t Practice<br>You <span class="color-yellow">Don???t Derserve</span><br>to win!</h3>
                                <p>If you use this site regularly and would like to help keep the site on the Internet,<br>
                                    please consider donating a small sum to help pay..
                                </p> -->
                                <!--<button class="btn btn-primary btn-lg">Read More</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.item -->
                <!-- Second slide -->
                <div class="item banner2" data-ride="carousel" data-interval="5000">
                    <div class="carousel-caption">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="slider-contant" data-animation="animated fadeInRight">
                                <!-- <h3>If you Don???t Practice<br>You <span class="color-yellow">Don???t Derserve</span><br>to win!</h3>
                                <p>You can make a case for several potential winners of<br>the expanded European Championships.</p> -->
                                <!--<button class="btn btn-primary btn-lg">Read More</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.item -->
                <!-- Third slide -->
                <div class="item banner3" data-ride="carousel" data-interval="5000">
                    <div class="carousel-caption">
                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="slider-contant" data-animation="animated fadeInRight">
                                <!-- <h3>If you Don???t Practice<br>You <span class="color-yellow">Don???t Derserve</span><br>to win!</h3>
                                <p>You can make a case for several potential winners of<br>the expanded European Championships.</p> -->
                                <!-- <button class="btn btn-primary btn-lg">Read More</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.item -->
            </div>
            <!-- /.carousel-inner -->
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- /.carousel -->
        <div class="news">
            <div class="container">
                <div class="heading-slider">
                    <!--<p class="headline"><i class="fa fa-star" aria-hidden="true"></i> Top Headlines :</p>-->
                    <!--made by vipul mirajkar thevipulm.appspot.com-->
<!--                    <h1>
                        <a href="" class="typewrite" data-period="2000" data-type='[ "Contrary to popular belief, Lorem Ipsum is not simply random text.", "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."]'>
                            <span class="wrap"></span>
                        </a>
                    </h1	   -->
                    <span class="wrap"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="inner-page-banner">
            <div class="container"></div>
        </div>
        <?php if(isset($page_title) && !empty($page_title)) { ?>
            <div class="inner-information-text">
                <div class="container">
                    <h3>{!! $page_title !!}</h3>
                    <ul class="breadcrumb">
                        <li><a href="{!! url('/') !!}">Home</a></li>
                        <li class="active">{!! $page_title !!}</li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</section>
