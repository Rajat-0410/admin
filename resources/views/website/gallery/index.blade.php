@extends('layouts.website')

@section('page-content')
<section id="portfolio" class="portfolio-wide" style="padding: 100px 0px 100px;">
    <div class="container">
        <div class="row"> 
            <div class="col-sm-10">
                <a class="back" href='{{ url("/") }}'>Back</a>
                <ul class="portfolio-sorting list-inline pr-100" style="margin-top: 30px;">
                    <li><a href="#" data-group="">Gallery {{ $gallery_name }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row portfolio-items">
            
            @if(!empty($arrTournamentRoundData))
                <?php 
                    $totalCount = count($arrTournamentRoundData);
                    $colType = ($totalCount%2==0) ? 'even':'odd';
                    // echo $totalCount.'--'.$class;
                ?>
                @foreach($arrTournamentRoundData as $key => $arrTournamentRound)
                <?php 
                    $rowNum = $key + 1;
                    // print("<pre>"); print_r($arrTournamentRound); exit('dfsdfsf');
                    $id = $arrTournamentRound->id;
                    $name = $arrTournamentRound->name;
                    $slug = $arrTournamentRound->slug;
                    $featuredImage = $arrTournamentRound->featured_image;
                ?>
                <div  class="<?php echo ($colType=='odd' && $rowNum==$totalCount) ? 'col-sm-12':'col-sm-6'; ?>">
                    <div class="portfolio-item">
                        <a  href='{{ url("view-gallery/$gallery_slug/$slug") }}'>
                            <img src="{{ asset("uploads/media-images/original/$featuredImage") }}" alt="{{ $name }}">
                        </a>
                    </div>
                    <h4 class="<?php echo ($colType=='odd' && $rowNum==$totalCount) ? 'text-center':'text-left'; ?>">{{ $name }}</h4>
                </div>
                @endforeach
            @endif
            
        </div>
    </div>
</section>

<!--web-footer-official-partners.php-->
@include('includes.web-footer-official-partners')
<style>
    .portfolio-item{
        max-height: 362px;
        max-width: 554px;
        margin: 0 auto;
    }
</style>
<script>
jQuery(document).ready(function ($) {
    
});
</script>
@endsection