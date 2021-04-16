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
                            {!! Form::open(['url' => 'admin/disease/store', 'id' => 'diseaseCategoryForm', 'method' => 'post', 'class' => '']) !!}
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