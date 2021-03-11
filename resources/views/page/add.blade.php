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
                            {!! Form::open(['url' => 'admin/page/store', 'id' => 'pageForm', 'method' => 'post', 'class' => '']) !!}
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
                                        <div class="form-group has-feedback {!! $errors->first('content', ' has-error') !!}">
                                            {!! Form::label('content','Content', ['class' => 'required']) !!}
                                            {!! Form::textarea('content','',['class' => 'form-control', 'placeholder' => 'Content Here', 'id' => 'page_content']) !!}
                                            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('meta_title', ' has-error') !!}">
                                            {!! Form::label('meta_title','Meta Title', ['class' => 'required']) !!}
                                            {!! Form::text('meta_title','',['class' => 'form-control', 'placeholder' => 'Meta Title']) !!}
                                            {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('meta_description', ' has-error') !!}">
                                            {!! Form::label('meta_description','Meta Description', ['class' => 'required']) !!}
                                            {!! Form::textarea('meta_description','',['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Meta Description', 'id' => 'meta_description']) !!}
                                            {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('meta_keywords', ' has-error') !!}">
                                            {!! Form::label('meta_keywords','Meta Keywords', ['class' => 'required']) !!}
                                            {!! Form::textarea('meta_keywords','',['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Meta Keywords', 'id' => 'meta_keywords']) !!}
                                            {!! $errors->first('meta_keywords', '<p class="help-block">:message</p>') !!}
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
                                                            <a href="{!! url('admin/page') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('status', ' has-error') !!}">
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
    
</div>
<script>
jQuery(document).ready(function(){
    
});
</script>
@endsection