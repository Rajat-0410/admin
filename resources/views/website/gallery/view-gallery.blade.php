@extends('layouts.website')

@section('page-content')
<section id="portfolio" class="portfolio-wide" style="padding: 100px 0px 100px;">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-10">
                <a class="back" href='{{ url("/gallery/$gallery_slug") }}'>Back</a>
                <ul class="portfolio-sorting list-inline pr-100" style="margin-top: 30px;">
                    <li><a href="#" data-group="">Gallery {{ $round_name }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                @if(count($arrTournamentGalleryImageData) > 0 && count($arrTournamentGalleryVideoData) > 0)
                <div class="tabbable boxed parentTabs">
                    <ul class="nav nav-tabs">
                        @if(count($arrTournamentGalleryImageData) > 0)
                        <li class="rs-50 active"><a href="#photos">Photos</a></li>
                        @endif
                        @if(count($arrTournamentGalleryVideoData) > 0)
                        <li class="rs-50"><a href="#videos">Videos</a></li>
                        @endif
                    </ul>
                </div>
                @endif
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="photos">
                        <div class="row portfolio-items gallery-img-cont">
                            @if(!empty($arrTournamentGalleryImageData))
                                @foreach($arrTournamentGalleryImageData as $key => $arrTournamentGalleryImage)
                                <?php 
                                    $id = $arrTournamentGalleryImage->id;
                                    $image = $arrTournamentGalleryImage->image;
                                ?>
                                <div  class="col-sm-4">
                                    <div class="portfolio-item">
                                        <a class="fancybox" data-fancybox-group="gallery" href='{{ asset("uploads/tournament-gallery-image/original/$round_id/$image") }}'>
                                            <img src="{{ asset("uploads/tournament-gallery-image/thumbnail/$round_id/$image") }}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="videos">
                        <div class="row portfolio-items gallery-img-cont">
                            @if(!empty($arrTournamentGalleryVideoData))
                                @foreach($arrTournamentGalleryVideoData as $key => $arrTournamentGalleryVideo)
                                <?php 
                                    $id = $arrTournamentGalleryVideo->id;
                                    $title = $arrTournamentGalleryVideo->title;
                                    $youtube_id = $arrTournamentGalleryVideo->youtube_id;
                                    $youtube_image = "https://img.youtube.com/vi/$youtube_id/hqdefault.jpg";
                                    $youtube_url = "https://www.youtube.com/embed/$youtube_id";
                                ?>
                                <div  class="col-sm-4">
                                    <div class="portfolio-item">
                                        <a class="video-fancybox" data-fancybox-group="gallery" data-fancybox-type="iframe" href='{{ $youtube_url }}'>
                                            <img src="{{ $youtube_image }}">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!--web-footer-official-partners.php-->
@include('includes.web-footer-official-partners')

<link rel="stylesheet" href="{{ asset('css/website/jquery.fancybox.css') }}">
<script src="{{ asset('js/website/jquery.fancybox.js') }}"></script>
<script>
jQuery(document).ready(function ($) {
    
    /*
    *  Simple image gallery. Uses default settings
    */
    $('.fancybox').fancybox();
    
    //  video-fancybox
    $('.video-fancybox').fancybox();
    
    $("ul.nav-tabs a").click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>
@endsection