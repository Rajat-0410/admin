@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($parent_menus); exit('sadas'); ?>
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
                            {!! Form::open(['url' => 'admin/product/store', 'id' => 'productForm', 'method' => 'post', 'class' => '']) !!}
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('tag_line', ' has-error') !!}">
                                            {!! Form::label('tag_line','Tag Line', ['class' => 'required']) !!}
                                            {!! Form::text('tag_line','',['class' => 'form-control', 'placeholder' => 'Tag Line']) !!}
                                            {!! $errors->first('tag_line', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- <textarea name="data[EarlyClosing][message]" rows="3" class="form-control" onkeyup="countNlimitChar(this)" cols="30" id="EarlyClosingMessage"></textarea> -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('short_overview', ' has-error') !!}">
                                            {!! Form::label('short_overview','Short Overview', ['class' => 'required']) !!}
                                            {!! Form::textarea('short_overview','',['class' => 'form-control','id' => 'short_overview','placeholder' => 'Short Overview','rows' => '5','onkeyup' => 'countNlimitChar(this)', 'onfocus' => 'countNlimitChar(this)']) !!}
                                            {!! $errors->first('short_overview', '<p class="help-block">:message</p>') !!}
                                            <br/>
                                            <span><strong>Note : -</strong></span>  Only 135 character are allowed.<div style="display: inline-block;float: right;"><span class="charNum">0</span> character remained</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('overview', ' has-error') !!}">
                                            {!! Form::label('overview','Overview', ['class' => 'required']) !!}
                                            {!! Form::textarea('overview','',['class' => 'form-control', 'id' => 'page_content','placeholder' => 'Content Here']) !!}
                                            {!! $errors->first('overview', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('meta_title','Meta Title', ['class' => '']) !!}
                                            {!! Form::text('meta_title','',['class' => 'form-control', 'placeholder' => 'Meta Title']) !!}
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('meta_description','Meta Description', ['class' => '']) !!}
                                            {!! Form::textarea('meta_description','',['class' => 'form-control','id' => 'meta_description','placeholder' => 'Meta Description','rows' => '6']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('meta_keywords','Meta Keywords', ['class' => 'required']) !!}
                                            {!! Form::textarea('meta_keywords','',['class' => 'form-control','placeholder' => 'Meta Keywords','rows' => '6']) !!}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-default border-right border-left">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Document</h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool"><i class="fa fa-chevron-down"></i></button>
                                                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body" id="cat">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group btn-container">
                                                            {!! Form::submit('Publish',['class' => 'btn btn-success btn-med']) !!}&nbsp;&nbsp;
                                                            <a href="{!! url('admin/product') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('category_id','Category') !!}
                                                            {!! Form::select('category_id', $arrCategories, 0, ['class' => 'form-control', 'id' => 'post_category']) !!}
                                                        </div>
                                                    </div>
                                                    <!--logo_image-->
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('logo_image','Logo Image') !!}
                                                            <span class="help-block">(For Product Detail Page)</span>
                                                            <span class="help-block">(Dimension: 444px * 70px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?>)</span>
                                                            {!! Form::hidden('logo_image','',['class' => 'form-control', 'id' => 'logo_image']) !!}
                                                            <br>
                                                            <a href="javascript:void(0)" class="feature-image" id="setLogoImage" data-toggle="modal" data-target="#media-logo-image-modal">Set featured image</a>
                                                            <div id="showLogoImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showLogoImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceLogoImage" data-toggle="modal" data-target="#media-logo-image-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeLogoImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--logo_image-->
                                                    <!--product_image-->
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('product_image','Product Image') !!}
                                                            <span class="help-block">(For Product)</span>
                                                            <span class="help-block">(Dimension: 650px * 428px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?> | <?php echo MAX_SIZE_TEXT.' 400kb'; ?>)</span>
                                                            {!! Form::hidden('product_image','',['class' => 'form-control', 'id' => 'product_image']) !!}
                                                            <br>
                                                            <a href="javascript:void(0)" class="feature-image" id="setProductImage" data-toggle="modal" data-target="#media-product-image-modal">Set featured image</a>
                                                            <div id="showProductImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showProductImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceProductImage" data-toggle="modal" data-target="#media-product-image-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeProductImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--product_image-->
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('featured_image','Featured Image') !!}
                                                            <span class="help-block">(For Product Listing Page)</span>
                                                            <span class="help-block">(Dimension: 550px * 640px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?> | <?php echo MAX_SIZE_TEXT.' 150kb'; ?>)</span>
                                                            {!! Form::hidden('featured_image','',['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                            <br>
                                                            <a href="javascript:void()" class="feature-image" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                            <div id="showMediaImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                            </div>
                                                            <a href="javascript:void()" class="btn btn-default hide" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                        </div>
                                                    </div>
                                                    <!--Product Banner Image-->
                                                    <div class="col-md-12 mrgTop10">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('banner_image','Product Banner Image') !!}
                                                            <span class="help-block">(For Product Detail Page)</span>
                                                            <span class="help-block">(Dimension: 1920px * 965px | <?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 500kb'; ?>)</span>
                                                            {!! Form::hidden('banner_image','',['class' => 'form-control', 'id' => 'banner_image']) !!}
                                                            <a href="javascript:void(0)" class="feature-image" id="setPDBannerImage" data-toggle="modal" data-target="#browse-media-banners-modal">Set Banner Image</a>
                                                            <div id="showPDBannerMediaImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showPDBannerMediaImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replacePDBannerImage" data-toggle="modal" data-target="#browse-media-banners-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removePDBannerImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Product Banner Image-->
                                                    <!--Mobile Banner Image-->
                                                    <div class="col-md-12 mrgTop10">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('mobile_banner_image','Mobile Banner Image') !!}
                                                            <span class="help-block">(For Mobile Detail Page)</span>
                                                            <span class="help-block">(Dimension: 1080px * 1050px | <?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 400kb'; ?>)</span>
                                                            {!! Form::hidden('mobile_banner_image','',['class' => 'form-control', 'id' => 'mobile_banner_image']) !!}
                                                            <a href="javascript:void(0)" class="feature-image" id="setMobBannerImage" data-toggle="modal" data-target="#browse-media-mobile-banner-image-modal">Set Banner Image</a>
                                                            <div id="showMobBannerMediaImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showMobBannerMediaImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceMobBannerImage" data-toggle="modal" data-target="#browse-media-mobile-banner-image-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeMobBannerImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Mobile Banner Image-->
                                                    <!--home_slider_image-->
                                                    <div class="col-md-12 mrgTop10">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('home_slider_image','Home Slider Image') !!}
                                                            <span class="help-block">(For Home Page)</span>
                                                            <span class="help-block">(Dimension: 2547px * 1420px | <?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 500kb'; ?>)</span>
                                                            {!! Form::hidden('home_slider_image','',['class' => 'form-control', 'id' => 'home_slider_image']) !!}
                                                            <a href="javascript:void(0)" class="feature-image show" id="setHomeSliderImage" data-toggle="modal" data-target="#browse-media-home-slider-modal">Set Banner Image</a>
                                                            <div id="showHomeSliderImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showHomeSliderImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default hide" id="replaceHomeSliderImage" data-toggle="modal" data-target="#browse-media-home-slider-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger hide" id="removeHomeSliderImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--home_slider_image-->
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('status', $arr_status, 1, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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
    
    <!-- includes.browse-media-logo-image -->
    @include('includes.browse-media-logo-image')
    <!-- /includes.browse-media-logo-image -->
    
    <!-- browse-media-product-image -->
    @include('includes.browse-media-product-image')
    <!-- /browse-media-product-image -->
    
    <!-- includes.browse-media-banners -->
    @include('includes.browse-media-banners')
    <!-- /includes.browse-media-banners -->
    
    <!-- includes.browse-media-mobile-banner-image -->
    @include('includes.browse-media-mobile-banner-image')
    <!-- /includes.browse-media-mobile-banner-image -->
    
    <!-- includes.browse-media-home-slider -->
    @include('includes.browse-media-home-slider')
    <!-- /includes.browse-media-home-slider -->
    
    <!-- includes.browse-media -->
    @include('includes.browse-media-featured-image')
    <!-- /includes.browse-media -->
    
</div>
<script>
// Short description validation.
function countNlimitChar(obj) {
    var len = obj.value.length;
    if (len >= 135) {
      obj.value = obj.value.substring(0, 135);
    } else {
      $('.charNum').text(135 - len);
    }
};

jQuery(document).ready(function(){

});


</script>
@endsection