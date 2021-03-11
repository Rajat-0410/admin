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
                            {!! Form::open(['url' => 'admin/post/store', 'id' => 'postForm', 'method' => 'post', 'class' => '']) !!}
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('title', ' has-error') !!}">
                                            {!! Form::label('title','Title', ['class' => 'required']) !!}
                                            {!! Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('short_content', ' has-error') !!}">
                                            {!! Form::label('short_content','Short Content', ['class' => 'required']) !!}
                                            {!! Form::textarea('short_content','',['class' => 'form-control','id' => 'short_content','placeholder' => '','rows' => '2', 'onkeyup' => 'countNlimitChar(this)']) !!}
                                            {!! $errors->first('short_content', '<p class="help-block">:message</p>') !!}
                                            <br/>
                                            <span><strong>Note : -</strong></span>  Only 120 character are allowed.<div style="display: inline-block;float: right;"><span class="charNum">0</span> character remained</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('content', ' has-error') !!}">
                                            {!! Form::label('content','Content', ['class' => 'required']) !!}
                                            {!! Form::textarea('content','',['class' => 'form-control', 'placeholder' => 'Content Here', 'id' => 'page_content']) !!}
                                            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
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
                                                            <a href="{!! url('admin/post') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php //$publish_date = date('Y-m-d h:i:s'); 
                                                            $publish_date = date('Y-m-d'); 
                                                        ?>
                                                        <div class="form-group has-feedback {!! $errors->first('publish_date', ' has-error') !!}">
                                                            {!! Form::label('publish_date','Publish Date', ['class' => 'required']) !!}
                                                            {!! Form::text('publish_date',$publish_date,['class' => 'form-control datepicker', 'id' => 'publish_date','placeholder' => 'Publish Date']) !!}
                                                            {!! $errors->first('publish_date', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hide" id="share_url_div">
                                                        <div class="form-group has-feedback {!! $errors->first('share_url', ' has-error') !!}">
                                                            {!! Form::label('share_url','Share Url', ['class' => 'required']) !!}
                                                            {!! Form::text('share_url','',['class' => 'form-control', 'id' => 'share_url','placeholder' => 'Share Link']) !!}
                                                            {!! $errors->first('share_url', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hide">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('category_id','Category') !!}
                                                            {!! Form::select('category_id', $arrCategories, 0, ['class' => 'form-control postPageCategory', 'id' => 'post_category']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="featured_image_div">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('featured_image','Featured Image') !!}
                                                            <span class="help-block">(Dimension: 2547px * 1420px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?> | <?php echo MAX_SIZE_TEXT.' 500kb'; ?>)</span>
                                                            {!! Form::hidden('featured_image','',['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                            <br>
                                                            <input type="hidden" name="check_dimensions" id="checkDimensions" value="true">
                                                            <input type="hidden" name="dimensions_width" id="dimensionsWidth" value="2547">
                                                            <input type="hidden" name="dimensions_height" id="dimensionsHeight" value="1420">
                                                            <input type="hidden" name="max_size" id="maxSize" value="500">
                                                            <a href="javascript:void()" class="feature-image" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                            <div id="showMediaImageCont" class="hide media-img-container">
                                                                <img src="" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                            </div>
                                                            <a href="javascript:void()" class="btn btn-default hide" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                        </div>
                                                    </div>
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
    
    <!-- includes.browse-media -->
    @include('includes.browse-media')
    <!-- /includes.browse-media -->
    
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
jQuery(document).ready(function(){
    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd',
       "setDate": new Date(),
       "autoclose": true
    });
    
    // short_content
    var object = document.getElementById("short_content");
    countNlimitChar(object);
    
});

function countNlimitChar(obj) {
    var len = obj.value.length;
    var limit = 120;
    if (len >= limit) {
      obj.value = obj.value.substring(0, limit);
    }
    $('.charNum').text(limit - len);
};

</script>
@endsection