@extends('layouts.admin')

@section('page-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_title; ?><small></small></h1>
    </section>
    <!-- Main content -->
    
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['url' => 'admin/gallery-video/store', 'video_gallery_id' => 'webBannerForm', 'method' => 'post', 'class' => '']) !!}
                            {!! Form::hidden('video_gallery_id',$video_gallery_id) !!}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-default border-right border-left">                                            
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <!--Title-->
                                                    <div class="col-md-12">
                                                        <label class="col-form-label">Title:</label>
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                    <!--video_thumbnail-->
                                                    <div class="col-md-12 mrgTop10">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('banner_image','Video Thumbnail') !!}
                                                            <span class="help-block">(For Product Detail Page)</span>
                                                            <span class="help-block">(<?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 400kb'; ?>)</span>
                                                            {!! Form::hidden('banner_image', '',['class' => 'form-control', 'id' => 'banner_image']) !!}
                                                            <br>
                                                            <a href="javascript:void(0)" class="feature-image show" id="setWebBannerImage" data-toggle="modal" data-target="#website-banner-media-browse-modal">Set thumbnail image</a>
                                                            <div id="showBannerImageCont" class="hide media-img-container">
                                                                <img class="img-responsive" width="150" height="150" title="" id="showWebBannerImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceBannerImage" data-toggle="modal" data-target="#website-banner-media-browse-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeBannerImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--video_thumbnail-->
                                                    <!--video_upload-->
                                                    <div class="col-md-12 mrgTop10">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('video_upload','Video') !!}
                                                            <span class="help-block">(For Mobile Detail Page)</span>
                                                            <span class="help-block">(<?php echo $allowfiletypetext;?> : MP4 | <?php echo MAX_SIZE_TEXT.' 10 MB'; ?>)</span>
                                                            {!! Form::hidden('video_upload', '',['class' => 'form-control', 'id' => 'video_upload']) !!}
                                                            <a href="javascript:void(0)" class="feature-image show" id="setMobBannerImage" data-toggle="modal" data-target="#browse-media-mobile-banner-image-modal">Upload Video</a>
                                                            <div id="showMobBannerMediaImageCont" class="hide media-img-container">
                                                                <video class="img-responsive" width="150" height="150" title="" id="showMobBannerMediaImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceMobBannerImage" data-toggle="modal" data-target="#browse-media-mobile-banner-image-modal">Replace video</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeMobBannerImage">Remove video</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--video_upload-->
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('status', $arr_status, 1, ['class' => 'form-control', 'id' => 'status']) !!}
                                                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group btn-container">
                                                            {!! Form::submit('Publish',['class' => 'btn btn-success ']) !!}&nbsp;&nbsp;
                                                            <a href="{!! url('admin/gallery-video/',['id' => base64_encode($video_gallery_id)]) !!}" class="btn btn-default ">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
    
    <!-- includes.browse-media-banners -->
    @include('includes.browse-media-website-video-thumbnail')
    <!-- /includes.browse-media-banners -->
    
    <!-- includes.browse-media-mobile-banner-image -->
    @include('includes.browse-media-website-video')
    <!-- /includes.browse-media-mobile-banner-image -->

</div>
<script>
jQuery(document).ready(function(){

});
</script>
@endsection