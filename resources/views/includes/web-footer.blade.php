<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="full">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{!! url('/') !!}">
                                <img src="{{ asset("images/website/logo.png") }}" alt="{!! env('APP_NAME') !!}" />
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
                            <li><a href="http://fondostech.in/"><span style="font-size:18px;">Powered By: </span><img src='/images/website/fondostech-logo.png' style="height:40px;"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="full">
                    <div class="footer-widget">
                        <h3>Menu</h3>
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
                                <i class="fa fa-map-marker"></i> A88-1, Phase 2, New Palam Vihar, Gurgaon - 122001, Haryana
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <a href="tel:9811933736">9811933736</a>
                            </li>
                            <li>
                                <i style="font-size:20px;top:5px;" class="fa fa-envelope"></i> <a href="mailto:kumarnaresh870@gmail.com">kumarnaresh870@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="full">
                    <div class="contact-footer">
                        <!-- <iframe src="https://www.google.com/maps/place/Club5/@28.4477929,77.0942956,18z/data=!4m18!1m9!3m8!1s0x0:0x4a017fcb509b4138!2sClub5!5m2!4m1!1i2!8m2!3d28.447769!4d77.095323!3m7!1s0x0:0x4a017fcb509b4138!5m2!4m1!1i2!8m2!3d28.447769!4d77.095323" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                        <img src='/images/website/map.png' style='max-width:100%'/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>Copyright © {!! date('Y') !!} Gurgaon Tennis Academy. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<style>
.contact-footer{
    background: transparent;
}
</style>