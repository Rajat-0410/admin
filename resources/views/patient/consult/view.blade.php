@extends('layouts.admin')

@section('page-content')
<?php // echo'<pre>'; print_r($all_record); exit('view');?>
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
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <a href="{!! url('admin/patient') !!}" class="btn btn-primary btn-flat pull-right">Back</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name',$all_record['arrUserData']['name'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('mobile','Mobile', ['class' => 'required']) !!}
                                            {!! Form::text('mobile',$all_record['arrUserData']['mobile'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('email','Email', ['class' => 'required']) !!}
                                            {!! Form::text('email',$all_record['arrUserData']['email'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('address','Address', ['class' => 'required']) !!}
                                            {!! Form::text('address',$all_record['arrUserData']['address'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    //    
});
</script>
@endsection