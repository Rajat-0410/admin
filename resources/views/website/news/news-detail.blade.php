@extends('layouts.website')

@section('page-content')
<?php // echo "<pre>";print_r($arrNewsDetails);exit('in view');
$newsId = $arrNewsDetails->id;
?>
<section id="portfolio" class="portfolio-wide" style="padding:100px 0px 10px;">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-10">
                <a class="back" href="{{ url('/news') }}">Back</a>
                <ul class="portfolio-sorting list-inline pr-100" style="margin-top: 30px;">
                    <li><a href="#" data-group="">News</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-justify">
                
                <h4><?php echo $arrNewsDetails->title; ?></h4>
                <?php if(count($arrNewsDetails->news_gallery) > 0){ ?>
                <?php $arrNewsGalleryData = $arrNewsDetails->news_gallery; ?>
                <div id="carousel-news" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators indicators-inside">
                    @foreach($arrNewsGalleryData as $key => $arrNewsGallery)
                        <?php $id = $arrNewsGallery->id; ?>
                        <li data-target="#carousel-news" data-slide-to="{{ $key }}" class="<?php if($key==0){ echo 'active'; } ?>"></li>
                    @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($arrNewsGalleryData as $key1 => $arrNewsGallery1)
                            <?php
                            $id = $arrNewsGallery1->id;
                            $image = $arrNewsGallery1->image;
                            ?>
                            <div class="item <?php if($key1==0){ echo 'active'; } ?>">
                                <img src="{{ asset("uploads/news-gallery-images/original/$newsId/$image") }}" alt="" class="img-responsive">
                            </div>
                        @endforeach
                    </div>
<!--                    <a href="#carousel-news" data-slide="prev" class="left carousel-control"><span class="icon-prev"></span></a>
                    <a href="#carousel-news" data-slide="next" class="right carousel-control"><span class="icon-next"></span></a>-->
                </div>
                <?php } ?>
                
                <?php echo $arrNewsDetails->content; ?>
                
            </div>
<!--            <div class="col-md-4 ">
                <h4>Other News</h4>
                <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
                    <div class="panel panel-default">
                        <div id="headingOne" role="tab" class="panel-heading">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Suzuki Motorcycle India records 29% growth in the month of June 2019 - Concludes Q1 on a high note with 20% hike</a></h4>
                        </div>
                        <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
                            <div class="panel-body">New Delhi, July 01, 2019: Thriving on a strong sales performance, Suzuki Motorcycle India Pvt. Ltd. (SMIPL), a subsidiary of two-wheeler manufacturer, Suzuki Motor Corporation, Japan,registers 29% Y-O-Y increase in the month of June 2019. The company sold 67,491 units (Domestic + Exports) this year vis-à-vis 52,217 units, same month last year.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div id="headingTwo" role="tab" class="panel-heading">
                            <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">Suzuki Motorcycle India accelerates with double-digit growth, posting 17.7% sales hike in May 2019</a></h4>
                        </div>
                        <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" class="panel-collapse collapse">
                            <div class="panel-body">New Delhi, June 03, 2019: Enduring its impressive sales performance, Suzuki Motorcycle India (SMIPL), a subsidiary of two-wheeler manufacturer, Suzuki Motor Corporation reported17.7 % increase in sales for the month of May 2019. In the domestic market, the company sold 62,596 units in May vis-a-vis 53,167 units during the corresponding period last year.</div>
                        </div>
                    </div>

                </div>
            </div>-->
        </div>
    </div>
</section>

<!-- Recent News Section Start -->
@if(!empty($arrRecNewsData))
<section class="section-small bg-white">
    <div class="container grid-pad recent-news-cont">
        <div class="row grid-pad">
            <h4>Recent News</h4>
            @foreach($arrRecNewsData as $key => $arrRecNews)
            <?php
            $newsId = $arrRecNews->id;
            $newsTitle = $arrRecNews->title;
            $newsSlug = $arrRecNews->slug;
            $newsFeaturedImage = $arrRecNews->featured_image;
            $newsShortDesc = $arrRecNews->short_description;
            $newsPublishDate = $arrRecNews->publish_date;
            // $eventStartDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event_start_datetime)->format('d M, Y');
            // $limitedContent = substr($content, strpos($content, "<p"), strpos($content, "</p>")+4);
            ?>
            <div class="col-sm-4">
                <a href='{!! url("news-detail/$newsSlug") !!}'>
                    <img src="{{ asset("uploads/media-images/medium-thumbnail/$newsFeaturedImage") }}" alt="{{ $newsTitle }}" class="img-responsive center-block">
                    <h5>{{ $newsTitle }}</h5>
                </a>
                <p><?php echo $newsShortDesc; ?></p>
                <a href='{!! url("news-detail/$newsSlug") !!}' class="btn btn-primary btn-xs">Read more</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Recent News Section End -->

<!--web-footer-official-partners.php-->
@include('includes.web-footer-official-partners')

@endsection