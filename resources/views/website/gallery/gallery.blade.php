@extends('layouts.website')

@section('page-content')
<section id="portfolio" class="portfolio-wide" style="padding: 100px 0px 100px;">
    

    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="photos">
                        <div class="row portfolio-items gallery-img-cont">
                            <div class=" pn-ProductNav " id="pnProductNav" >
                                <ul class="nav prodsec-tab pn-ProductNav_Contents "  role="tablist" id="pnProductNavContents1">
                                    <li class="active pn-ProductNav_Link">
                                        <a href="#gallery" data-toggle="tab">Images</a>
                                    </li>
                                    <li class="pn-ProductNav_Link">
                                        <a href="#video" data-toggle="tab">Videos</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="gallery">
                                    <div id="image-gallery">
                                      @if(!empty($arrGalleryImageData))
                                          @foreach($arrGalleryImageData as $key => $arrGalleryImage)
                                          <?php 
                                              $id = $arrGalleryImage->id;
                                              $gallery_id = $arrGalleryImage->gallery_id;
                                              $image = $arrGalleryImage->image;
                                          ?>
                                          <div  class="col-sm-3">
                                              <div class="portfolio-item img-wrapper">
                                                  <a class="fancybox" data-fancybox-group="gallery" href='{{ asset("/gallery/images/original/$gallery_id/$image") }}'>
                                                      <img src="{{ asset("/gallery/images/original/$gallery_id/$image") }}" class="img-responsive">
                                                  </a>
                                              </div>
                                          </div>
                                          @endforeach
                                      @endif
                                    </div><!-- End image gallery -->
                                </div>

                                <div class="tab-pane fade" id="video">
                                  <div class="row portfolio-items gallery-img-cont">
								  <?php 
									for($video_num = 1; $video_num <= 8; $video_num++) { ?>
									<div  class="col-sm-3">
										<div class="portfolio-item">
											<a class="video-fancybox" data-fancybox-group="gallery" data-fancybox-type="iframe" href='{{ asset("/gallery/videos/vid_$video_num.mp4") }}'>
												<img src="{{ asset("/gallery/videos/images/vid_img_$video_num.png") }}"  class="img-responsive">
											</a>
										</div>
									</div>
									<?php	} ?>
								  </div>
                                </div>

                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>


<!--web-footer-official-partners.php-->
{{-- @include('includes.web-footer-official-partners') --}}

<link rel="stylesheet" href="{{ asset('css/website/jquery.fancybox.css') }}">
<style>
    .grid-row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.grid-column {
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.grid-column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .grid-column {
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .grid-column {
    flex: 100%;
    max-width: 100%;
  }
}

</style>
<script src="{{ asset('js/website/jquery.fancybox.js') }}"></script>
<script>
jQuery(document).ready(function ($) {
	$('.fancybox').fancybox();
	$('.video-fancybox').fancybox();
});
</script>
@endsection