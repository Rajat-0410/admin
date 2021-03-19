<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="full">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{!! url('/') !!}">
                                <img src="{{ asset("images/website/logo.png") }}" alt="{!! env('APP_NAME') !!}" style="height:100px; width:100px;"/>
                            </a>
                        </div>
                        <!--<p>Most of our events have hard and easy route choices as we are always keen to encourage new riders.</p>-->
                        <!-- <ul class="social-icons style-4 pull-left"> -->
                            <!-- <li><a class="facebook" href="https://www.facebook.com/gurgaontennisacademy/"><i class="fa fa-facebook"></i></a></li> -->
                            <!--<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li> -->
                            <!--<li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>-->
                            <!-- <li><a href="https://www.fondostech.in"><img src='/images/fondostech-logo.png' /></a></li> -->
                        <!-- </ul> -->
                        <ul class="style-4 pull-left" style="margin-top: 30px;margin-left: 18px;">
                            <!-- <li><a class="facebook" href="https://www.facebook.com/gurgaontennisacademy/"><i class="fa fa-facebook"></i></a></li> -->
                            <!--<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li> -->
                            <!--<li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>-->
                            <li><a href="http://makeitappin.com" target="_blank"><span style="font-size:18px;">Powered By: </span><img src='/images/website/Makeit-nobg.png' style="height:60px;"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="full">
                    <div class="footer-widget">
                        <h3>About</h3>
                        <ul class="footer-menu">
                            @if(!empty($footer_menu))
                                @foreach($footer_menu as $fmenu)
                                <?php
                                    // print("<pre>"); print_r($fmenu); exit('in view');
                                    $fm_page_url = SITE_URL . '/' . $fmenu->page_slug;
                                ?>
                                <li><a href="{!! $fm_page_url !!}">{!! $fmenu->name !!}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="full">
                    <div class="footer-widget">
                        <h3>Contact us</h3>
                        <ul class="address-list">
                            <li>
                                <i class="fa fa-map-marker"></i> C-41, Mohan Marg, Roop Vihar, Govindpuri, Jaipur, Rajasthan 302019
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:7023613456">+91 - 7023613456</a>
                            </li>
                            <li>
                                <i style="font-size:20px;top:5px;" class="fa fa-envelope"></i> <a href="mailto:support@homeodocs.in">support@homeodocs.in</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4">
                <div class="full">
                    <div class="contact-footer">
                        <iframe src="https://www.google.com/maps/place/Club5/@28.4477929,77.0942956,18z/data=!4m18!1m9!3m8!1s0x0:0x4a017fcb509b4138!2sClub5!5m2!4m1!1i2!8m2!3d28.447769!4d77.095323!3m7!1s0x0:0x4a017fcb509b4138!5m2!4m1!1i2!8m2!3d28.447769!4d77.095323" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        <img src='/images/website/map.png' style='max-width:100%'/>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>Copyright © {!! date('Y') !!} Homeodocs. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<style>
.contact-footer{
    background: transparent;
}
</style>