@extends('layouts.admin')

@section('page-content')
<?php // print_r($arr_menu_data); exit;?>
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
                            {!! Form::open(['url' => 'admin/profile/store', 'id' => 'userForm', 'method' => 'post', 'class' => '']) !!}
                            <div class="col-md-8">
                                {!! Form::hidden('id',$id) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('email', ' has-error') !!}">
                                            {!! Form::label('email','Email', ['class' => 'required']) !!}
                                            {!! Form::text('email',$email,['class' => 'form-control', 'placeholder' => 'Email', 'readonly']) !!}
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('mobile', ' has-error') !!}">
                                            {!! Form::label('mobile','Mobile', ['class' => 'required']) !!}
                                            {!! Form::text('mobile',$mobile,['class' => 'form-control', 'placeholder' => 'Mobile']) !!}
                                            {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('address', ' has-error') !!}">
                                            {!! Form::label('address','Address', ['class' => 'required']) !!}
                                            {!! Form::text('address',$address,['class' => 'form-control', 'placeholder' => 'Address']) !!}
                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('father_husband_name', ' has-error') !!}">
                                            {!! Form::label('father_husband_name','Father / Husband Name', ['class' => 'required']) !!}
                                            {!! Form::text('father_husband_name',$father_husband_name,['class' => 'form-control', 'placeholder' => 'Father / Husband Name']) !!}
                                            {!! $errors->first('father_husband_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('spouse_name', ' has-error') !!}">
                                            {!! Form::label('spouse_name','Spouse Name', ['class' => 'required']) !!}
                                            {!! Form::text('spouse_name',$spouse_name,['class' => 'form-control', 'placeholder' => 'Spouse Name']) !!}
                                            {!! $errors->first('spouse_name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('spouse_mobile', ' has-error') !!}">
                                            {!! Form::label('spouse_mobile','Spouse Mobile', ['class' => 'required']) !!}
                                            {!! Form::text('spouse_mobile',$spouse_mobile,['class' => 'form-control', 'placeholder' => 'Spouse Mobile']) !!}
                                            {!! $errors->first('spouse_mobile', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12" >
                                        <div class="form-group has-feedback">
                                            {!! Form::label('check','Change Password', ['class' => 'required']) !!}
                                            {!! Form::checkbox('change_password',null,null, array('id'=>'change_password')) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12" >
                                        <div class="form-group has-feedback {!! $errors->first('password', ' has-error') !!}">
                                            {!! Form::label('password','Password', ['class' => 'required']) !!}
                                            {!! Form::input('password','password','',['class' => 'form-control','disabled', 'placeholder' => 'Password', 'id' => 'password']) !!}

                                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                               
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback {!! $errors->first('password_confirmation', ' has-error') !!}">
                                            {!! Form::label('confirom password','Confirm Password', ['class' => 'required']) !!}
                                            {!! Form::input('password','password_confirmation','',['class' => 'form-control', 'disabled', 'placeholder' => 'Confirm password', 'id' => 'password_confirmation']) !!}
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
                                                            {!! Form::submit('Update',['class' => 'btn btn-success btn-med']) !!}&nbsp;&nbsp;
                                                            <a href="{!! url('admin/dashboard') !!}" class="btn btn-default btn-med">Cancel</a>
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

    // input filed enable
    <?php if(!empty($errors->has('password')) || !empty($errors->has('password_confirmation'))) { ?>
        $('#password, #password_confirmation').prop("disabled", false);
    <?php }?>
    // On change input field enable or disable  => Start
    $('#change_password').change(function() {
        if($(this).is(":checked")) {
            // alert('checked');
            // var returnVal = confirm("Are you sure?");
            // $(this).attr("checked", returnVal);
            $('#password, #password_confirmation').prop("disabled", false);
        }else{
            // alert('un checked');
            $('#password, #password_confirmation').prop("disabled", true);
        }
    });
    // On change input field enable or disable  => End

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