<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="it">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('css/website/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/themify/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/all.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/website/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/website/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/responsive.css') }}">
    <title>HomeoDocs | Homeopathy Consult Online</title>
</head>
<body class="top-header">
    <!-- LOADER TEMPLATE -->
    <div id="page-loader">
        <div class="loader-icon fa fa-spin colored-border"></div>
    </div>
    <!-- /LOADER TEMPLATE -->
    <div class="logo-bar d-none d-md-block d-lg-block bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo d-none d-lg-block">
                        <!-- Brand -->
                        <a class="navbar-brand js-scroll-trigger" href="/">
                            <img src="{{ asset('images/website/logo.png') }}" alt="Homeodocs" class="img-fluid" width="40%">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 justify-content-end ml-lg-auto d-flex col-12">
                    <div class="top-info-block d-inline-flex">
                        <div class="icon-block">
                            <i class="ti-mobile"></i>
                        </div>
                        <div class="info-block">
                            <h5 class="font-weight-500">+91 - 7023613456</h5>
                            <p>Call Free</p>
                        </div>
                    </div>
                    <div class="top-info-block d-inline-flex">
                        <div class="icon-block">
                            <i class="ti-email"></i>
                        </div>
                        <div class="info-block">
                            <h5 class="font-weight-500">info@homeodocs.com</h5>
                            <p>Email Us</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- NAVBAR
    ================================================= -->
    <div class="main-navigation" id="mainmenu-area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary main-nav navbar-togglable">
                <a class="navbar-brand d-lg-none d-block" href="index.html">
                    <h4>HomeoDocs</h4>
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Links -->
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a href="index.html" class="nav-link js-scroll-trigger">
                                Home
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#feature" class="nav-link js-scroll-trigger">
                                About
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#blog" class="nav-link js-scroll-trigger">
                                News
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#contact-info" class="nav-link js-scroll-trigger">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div> <!-- / .navbar-collapse -->
            </nav>
        </div> <!-- / .container -->
    </div>
        <!-- login modal-->
        <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <article class="card-body">
                            <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
                            <hr>
                            <form id="loginForm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input name="" class="form-control" placeholder="Email Address" id="email" type="email" required>
                                    </div> <!-- input-group.// -->
                                </div> <!-- form-group// -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input class="form-control" placeholder="******" type="password" id="password" required maxlength="15" minlength="4">
                                    </div> <!-- input-group.// -->
                                </div> 
                                <!-- form-group// -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-circled"> Login </button>
                                </div> 
                                <!-- form-group// -->
                                <p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
                            </form>
                        </article>
                        </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

    <!-- HERO
    ================================================== -->
    <section class="banner-area py-7">
        <!-- Content -->
        <div class="container">
            <div class="row  align-items-center">
                <div class="col-md-12 col-lg-7 text-center text-lg-left">
                    <div class="main-banner">
                        <!-- Heading -->
                        <h1 class="display-4 mb-4 font-weight-normal">
                            Talk to Specialist Doctors online
                        </h1>
                        <p class="lead mb-4">
                            HomeoDocs comes forward with a holistic approach to treat patients with personalized Constitutional Homeopathic Treatment that serves to be far better than the conventional treatments. It consists of top and well experienced group of Homeopathic doctors who happen to be experts in their particular line of fields
                        </p>
                        <!-- Button -->
                        <p class="mb-0">
                            <a href="https://play.google.com/store/apps/details?id=com.homeo.homeodocs" target="blank">
                            <img alt="Google Play" src="{{ asset('images/website/google-play-badge.png') }}" width="200" height="80">
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="banner-img-block">
                        <img src="{{ asset('images/website/logo.png') }}" alt="Homeodocs" class="img-fluid" width="70%">
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
    <!-- SECTIONS
    ================================================== -->
    <!-- FEATURES
    ================================================== -->
    <section class="section bg-grey" id="feature">
        <div class="container">
            <div class="row justy-content-center">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <div class="img-icon-block mb-4">
                            <i class="ti-thumb-up"></i>
                        </div>
                        <h4 class="mb-2">Ask your Health Question</h4>
                        <p></p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <div class="img-icon-block mb-4">
                            <i class="ti-cup"></i>
                        </div>
                        <h4 class="mb-2">Get doctor online</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <div class="img-icon-block mb-4">
                            <i class="ti-wallet"></i>
                        </div>
                        <h4 class="mb-2">Pay consultation fee</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <div class="img-icon-block mb-4">
                            <i class="ti-dashboard"></i>
                        </div>
                        <h4 class="mb-2">Get Diagnosis and prescription</h4>
                    </div>
                </div>
            </div>
        </div> <!-- / .container -->
    </section>
    <!-- LATEST BLOG
    ================================================== -->
    <section class="banner-area py-7">
        <!-- Content -->
        <div class="container">
            <div class="row  align-items-center">
                <div class="col-md-12 col-lg-7 text-center text-lg-left">
                    <div class="main-banner">
                        <!-- Heading -->
                        <h5 class="display-4 mb-4 font-weight-normal">
                            Dr. N.C. Panwar 
                        </h5>
                        <h4>
                            CEO (Homeo Docs) 
                        </h4>
                        <h4>
                            Senior Homeopathy Consultant 
                        </h4>
                        <p class="lead mb-4">
                            Dr. N.C. (Nemichand) Panwar is a senior homeopathic practitioner last since more than 20 years in Jaipur India. Dr. N.C. Panwar cure millions cases (Acute & chronic disease) in his professional life.
                        </p>
                        <p>
                            <ul>
                                <li>Qualification:- B.Sc., BHMS (Bachelor in Homeopathy Medicine & Surgery)</li>
                                <li>University Name:- Rajasthan University Jaipur India</li>
                                <li>Registration No.:- 4223 (Govt. of Rajasthan Homeopathy Medical Board)</li>
                                <li>Medical College Name:-Dr. MPK Homeopathy Medical College Hospital & Research Centre Jaipur India</li>
                                <li>Director:- C.L. Panwar Hospital Jaipur Rajasthan </li>
                                <li>CMD:- National Medical Health & Social Welfare Trust Jaipur India</li>
                                <li>Director:- Inetive Enterprises (Pharmacy Div.) Jaipur India</li>
                                <li>Coordinator & Director:- National Institute of Open Schooling (NIOS) Paramedical Vocational Courses, Govt. of India</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="banner-img-block">
                        <img src="{{ asset('images/website/dr pawar.jpeg') }}" alt="Dr Panwar" class="img-fluid" width="80%">
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <!-- SECTIONS
    ================================================== -->
    <section id="contact-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <div class="section-heading">
                        <!-- Heading -->
                        <h2 class="section-title">
                            Contact US
                        </h2>
                        <!-- Subheading -->
                        <p>
                            We'd love to talk about how we can help you.
                        </p>
                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-info-block text-center">
                        <i class="pe-7s-map-marker"></i>
                        <h4>Address</h4>
                        <p class="lead">C-41, Mohan Marg, Roop Vihar, Govindpuri, Jaipur, Rajasthan 302019</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-info-block text-center">
                        <i class="pe-7s-mail"></i>
                        <h4>Email</h4>
                        <p class="lead">info@homeodocs.com</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-info-block text-center">
                        <i class="pe-7s-phone"></i>
                        <h4>Phone Number</h4>
                        <p class="lead">+91-7023613456</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="contact">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8 col-lg-6">
                    <h5>Leave a Message</h5>
                    <!-- Heading -->
                    <h2 class="section-title mb-2 ">
                        Tell us about <span class="font-weight-normal">yourself</span>
                    </h2>
                    <!-- Subheading -->
                    <p class="mb-5 ">
                        Whether you have questions or you would just like to say hello, contact us.
                    </p>
                </div>
            </div> <!-- / .row -->
            <div class="row">
                <div class="col-lg-6">
                   <!-- form message -->
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success contact__msg" style="display: none" role="alert">
                                Your message was sent successfully.
                            </div>
                        </div>
                    </div>
                    <!-- end message -->
                    <!-- Contacts Form -->
                    <form class="contact_form" action="../index.html">
                        <div class="row">
                            <!-- Input -->
                            <div class="col-sm-6 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block text-uppercase">
                                        Your name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" name="name" id="name" required="" placeholder="John Doe" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->
                            <!-- Input -->
                            <div class="col-sm-6 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block text-uppercase">
                                        Your email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group ">
                                        <input class="form-control" name="email" id="email" required="" placeholder="john@gmail.com" type="email">
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->
                            <div class="w-100"></div>
                            <!-- Input -->
                            <div class="col-sm-6 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block text-uppercase">
                                        Subject
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" name="subject" id="subject" required="" placeholder="Eye" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->
                            <!-- Input -->
                            <div class="col-sm-6 mb-6">
                                <div class="form-group">
                                    <label class="h6 small d-block text-uppercase">
                                        Your Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group ">
                                        <input class="form-control" id="phone" name="phone" required="" placeholder="91-800-643-4500" type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->
                        </div>
                        <!-- Input -->
                        <div class="form-group mb-5">
                            <label class="h6 small d-block text-uppercase">
                                How can we help you?
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <textarea class="form-control" rows="4" name="message" id="message" required="" placeholder="Hi there, I would like to ..."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                        <div class="">
                           <input name="submit" type="submit" class="btn btn-primary btn-circled" value="Send Message">
                            <p class="small pt-3">We'll get back to you in 1-2 business days.</p>
                        </div>
                    </form>
                    <!-- End Contacts Form -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- START MAP -->
                    <div id="map" ></div>
                    <!-- END MAP -->
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER
    ================================================== -->
    <footer class="section " id="footer">
        <div class="overlay footer-overlay"></div>
        <!--Content -->
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-4 col-sm-12">
                    <div class="footer-widget">
                        <!-- Brand -->
                        <a href="/" class="footer-brand text-white">
                            Homeodocs
                        </a>
                        <p>
                            <div class="banner-img-block">
                                <img src="{{ asset('images/website/logo.png') }}" alt="Homeodocs" class="img-fluid" width="40%">
                            </div>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 ml-lg-auto col-sm-12">
                    <div class="footer-widget">
                        <h3>Account</h3>
                        <!-- Links -->
                        <ul class="footer-links ">
                            <li>
                                <a href="/term-condition">
                                    Terms and conditions
                                </a>
                            </li>
                            <li>
                                <a href="/privacy-policy">
                                    Privacy policy
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-widget">
                        <h3>For Doctors</h3>
                        <!-- Links -->
                        <ul class="footer-links ">
                            <li>
                                <a href="https://www.doctor.homeodocs.in/">
                                    Join Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer-widget">
                        <h3>About</h3>
                        <!-- Links -->
                        <ul class="footer-links ">
                            <li>
                                <a href="#feature" class="js-scroll-trigger">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="#blog" class="js-scroll-trigger">
                                    News
                                </a>
                            </li>
                            <li>
                                <a href="#contact-info" class="js-scroll-trigger">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer-widget">
                        <h3>Socials</h3>
                        <!-- Links -->
                        <ul class="list-unstyled footer-links">
                            <li><a href="#"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                            <li>
                            <a href="#"><i class="fab fa-twitter"></i>Twitter
                            </a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i>linkedin
                            </a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i>YouTube
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- / .row -->
            <div class="row text-right pt-5">
                <div class="col-lg-12">
                    <!-- Copyright -->
                    <p class="footer-copy ">
                        &copy; Copyright 2020 <span class="current-year"><a href="/">HomeoDocs</a></span> All rights reserved.
                    </p>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </footer>
    <!--  Page Scroll to Top  -->
    <a class="scroll-to-top js-scroll-trigger" href="index.html">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Global JS -->

    <script src="{{ asset('js/website/jquery.min.js') }}"></script>
    <script src="{{ asset('js/website/popper.min.js') }}"></script>
    <script src="{{ asset('js/website/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/website/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/website/slick.min.js') }}"></script>
    <script src="{{ asset('js/website/theme.js') }}"></script>
</html>