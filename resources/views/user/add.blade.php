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
                            {!! Form::open(['url' => 'admin/user-management/store', 'id' => 'userForm', 'method' => 'post', 'class' => '']) !!}
                            <div class="col-md-8">
                                {!! Form::hidden('change_password',1) !!}
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
                                        <div class="form-group has-feedback {!! $errors->first('email', ' has-error') !!}">
                                            {!! Form::label('email','Email', ['class' => 'required']) !!}
                                            {!! Form::text('email','',['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('password', ' has-error') !!}">
                                            {!! Form::label('password','Password', ['class' => 'required']) !!}
                                            {!! Form::input('password','password','',['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password']) !!}

                                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('password_confirmation', ' has-error') !!}">
                                            {!! Form::label('confirom password','Confirm Password', ['class' => 'required']) !!}
                                            {!! Form::input('password','password_confirmation','',['class' => 'form-control', 'placeholder' => 'confirm password']) !!}
                                            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
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
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body" id="cat">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group btn-container">
                                                            {!! Form::submit('Add',['class' => 'btn btn-success btn-med']) !!}&nbsp;&nbsp;
                                                            <a href="{!! url('admin/user-management') !!}" class="btn btn-default btn-med">Cancel</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback {!! $errors->first('role_id', ' has-error') !!}">
                                                            {!! Form::label('role','Role') !!}
                                                            {!! Form::select('role_id', $roleArr, 0, ['class' => 'form-control', 'id' => 'role_id']) !!}
                                                            {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback ">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('status', $arr_status, 1, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
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
    // Form Validation
    jQuery("#userForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "name":{
                required: true
            },
            "email":{
                required: true,
                email: true
            },
             "password":{
                required: true
            },
             "password_confirmation":{
                required: true,
                equalTo : "#password"
            },
             "role_id":{
                required: true
            }
            
        },
        messages:{
            "name":{
                required: "Please enter name"
            },
            "email":{
                required: "Please enter email",
                email:"please enter valid email"
            },
            "password":{
                required: "Please enter password"
            },
            "password_confirmation":{
                required: "Please enter confirm password"
            },
            "role_id":{
                required: "Please select role"
            }
        }
    }); 
});
</script>
@endsection