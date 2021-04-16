@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($description); exit('view'); ?>
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
                            {!! Form::open(['url' => 'admin/disease-category/store', 'id' => 'diseaseCategoryForm', 'method' => 'post', 'class' => '']) !!}
                            {!! Form::hidden('id',$id) !!}
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('title', ' has-error') !!}">
                                            {!! Form::label('title','Title', ['class' => 'required']) !!}
                                            {!! Form::text('title',$title,['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('price', ' has-error') !!}">
                                            {!! Form::label('price','Price', ['class' => 'required']) !!}
                                            {!! Form::text('price',$price,['class' => 'form-control', 'placeholder' => 'Price']) !!}
                                            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('discount_price', ' has-error') !!}">
                                            {!! Form::label('discount_price','Discount Price', ['class' => 'required']) !!}
                                            {!! Form::text('discount_price',$discount_price,['class' => 'form-control', 'placeholder' => 'Discount Price']) !!}
                                            {!! $errors->first('discount_price', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('description', ' has-error') !!}">
                                            {!! Form::label('description','Description', ['class' => 'required']) !!}
                                            <span class="help-block">(Word Limit: 255 )</span>
                                            {!! Form::textarea('description',$description,['class' => 'form-control', 'placeholder' => 'Description']) !!}
                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
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
                                                            <a href="{!! url('admin/disease-category') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php //$publish_date = date('Y-m-d h:i:s'); 
                                                            $publish_date = date('Y-m-d'); 
                                                        ?>
                                                        <div class="form-group has-feedback {!! $errors->first('publish_date', ' has-error') !!}">
                                                            {!! Form::label('publish_date','Publish Date', ['class' => 'required']) !!}
                                                            {!! Form::text('publish_date',$created_at,['class' => 'form-control datepicker', 'id' => 'publish_date','placeholder' => 'Publish Date', 'disabled']) !!}
                                                            {!! $errors->first('publish_date', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="featured_image_div">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('featured_image','Featured Image') !!}
                                                            <span class="help-block">(Dimension: 2547px * 1420px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?> | <?php echo MAX_SIZE_TEXT.' 500kb'; ?>)</span>
                                                            {!! Form::hidden('featured_image',$image_name,['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                            <br>
                                                            <input type="hidden" name="check_dimensions" id="checkDimensions" value="true">
                                                            <input type="hidden" name="dimensions_width" id="dimensionsWidth" value="2547">
                                                            <input type="hidden" name="dimensions_height" id="dimensionsHeight" value="1420">
                                                            <input type="hidden" name="max_size" id="maxSize" value="500">
                                                            <a href="javascript:void(0)" class="feature-image <?php echo (empty($image_url)) ? 'show':'hide' ?>" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                            <div id="showMediaImageCont" class="<?php echo (!empty($image_url)) ? 'show':'hide' ?> media-img-container">
                                                                <img src="{{ $image_url }}" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default <?php echo (!empty($image_name)) ? 'show':'hide' ?>" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger <?php echo (!empty($image_name)) ? 'show':'hide' ?>" id="removeFeaturedImage">Remove image</a>
                                                                </div>
                                                            </div>
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