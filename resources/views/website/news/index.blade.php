@extends('layouts.website')

@section('page-content')

<section id="portfolio" class="portfolio-wide" style="padding:100px 0px 100px;">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-10">
                <a class="back" href="{!! url('/') !!}">Back</a>
                <ul class="portfolio-sorting list-inline pr-100" style="margin-top: 30px;">
                    <li><a href="#" data-group="">News</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row grid-pad home-news-cont" id="all_news_content">
            @if(!empty($arrNewsData))
                <?php
                    $fbAppId = config('constant.APP_ID.FACEBOOK');
                    $redirect_uri   = SITE_URL;
    //                $host           = $_SERVER['HTTP_HOST'];
    //                $reqUri         = $_SERVER['REQUEST_URI'];
    //                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$host$reqUri";
                    $fbShareBaseUrl = "https://www.facebook.com/dialog/feed?app_id=$fbAppId";
                ?>
                @foreach($arrNewsData as $key => $arrNews)
                    <?php 
                        $newsId = $arrNews->id;
                        $newsTitle = $arrNews->title;
                        $newsSlug = $arrNews->slug;
                        $newsFeaturedImage = $arrNews->featured_image;
                        $newsShortDesc = $arrNews->short_description;
                        $newsContent = $arrNews->content;
                        $newsPublishDate = $arrNews->publish_date;
                        $publish_date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $newsPublishDate)->format('d M, Y');
                        // $limitedContent = substr($content, strpos($content, "<p"), strpos($content, "</p>")+4);
                        $share_url = $redirect_uri.'/news-detail/'.$newsSlug;
                        $fbShareUrl = "$fbShareBaseUrl&link=$share_url&redirect_uri=$redirect_uri";
                        if(!empty($newsFeaturedImage)){
                            $news_image = asset("uploads/media-images/original/$newsFeaturedImage");
                            $source = "&source=$news_image";
                            $fbShareUrl .= $source;
                        }
                    ?>
                    <div class="col-sm-4 news-box">
                        <a href='{!! url("news-detail/$newsSlug") !!}'>
                            <img src="{{ asset("uploads/media-images/medium-thumbnail/$newsFeaturedImage") }}" alt="{{ $newsTitle }}" class="img-responsive center-block">
                            <h5>{{ $newsTitle }}</h5>
                        </a>
                        <p><?php echo $newsShortDesc; ?></p>
                        <div class="row news-links">
                            <div class="col-xs-12 date">
                                <i class="fa fa-calendar-alt"></i> {{ $publish_date }}
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <a href='{!! url("news-detail/$newsSlug") !!}' class="btn btn-primary">Read more</a>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <a href="<?php echo $fbShareUrl; ?>" target="_blank" class="share-icon-cont" title="Share">
                                    <img src="{{ asset("images/website/icon-share.png") }}" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        @if($news_count > 6)
        <div class="row">
            <div class="col-sm-12 load-more-cont">
                <a class="btn btn-primary btn-lg load-more" id="load_more">LOAD MORE</a>
            </div>
        </div>
        @endif
        
    </div>
</section>

<!--web-footer-official-partners.php-->
@include('includes.web-footer-official-partners')

<script>
    jQuery(document).ready(function () {
        // 
        $("#load_more").on("click", function (e) {
            var reqUrl = SITE_URL + '/load-more-news';
            var reqData = 'load_more=true';
            //alert(reqUrl+' - '+reqData); // return false;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "html",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data != '') {
                        $("#all_news_content").empty(data);
                        $("#all_news_content").html(data);
                        if (data)
                        {
                            $('#load_more').hide();
                        }

                    } else {
                        alert(message);
                        return false;
                    }
                }
            });
        });

    });
</script>
@endsection