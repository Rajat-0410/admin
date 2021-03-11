@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($arr_status); exit;?>
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
                            {!! Form::open(['url' => 'admin/gallery/store', 'id' => 'galleryForm', 'method' => 'post', 'files' => true, 'class' => '']) !!}
                            {!! Form::hidden('id',$id) !!}
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
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
                                                            {!! Form::submit('Update',['class' => 'btn btn-success btn-med']) !!}&nbsp;&nbsp;
                                                            <a href="{!! url('admin/gallery') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"  id="featured_image_div">
                                                        <div class="form-group has-feedback">
                                                            {!! Form::label('featured_image','Featured Image') !!}
                                                            <span class="help-block">(Dimension: 972px * 634px | <?php echo $allowfiletypetext;?> : <?php echo $filetype;?> | <?php echo MAX_SIZE_TEXT.' 500kb'; ?>)</span>
                                                            {!! Form::hidden('featured_image',$featured_image,['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                            <br>
                                                            <input type="hidden" name="check_dimensions" id="checkDimensions" value="true">
                                                            <input type="hidden" name="dimensions_width" id="dimensionsWidth" value="972">
                                                            <input type="hidden" name="dimensions_height" id="dimensionsHeight" value="634">
                                                            <input type="hidden" name="max_size" id="maxSize" value="500">
                                                            <a href="javascript:void(0)" class="feature-image <?php echo (empty($featured_image)) ? 'show':'hide' ?>" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                            <div id="showMediaImageCont" class="<?php echo (!empty($featured_image)) ? 'show':'hide' ?> media-img-container">
                                                                <img src="{{ asset("uploads/media-images/thumbnail/$featured_image") }}" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-default <?php echo (!empty($featured_image)) ? 'show':'hide' ?>" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="javascript:void(0)" class="btn btn-danger <?php echo (!empty($featured_image)) ? 'show':'hide' ?>" id="removeFeaturedImage">Remove image</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('slug', ' has-error') !!}">
                                                            {!! Form::label('slug','Slug', ['class' => 'required']) !!}
                                                            {!! Form::text('slug',$slug,['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                                            {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('status', $arr_status, $status, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
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

<script>
jQuery(document).ready(function(){
    
});
</script>
@endsection