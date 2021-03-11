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
                            <div class="col-md-12">
                                {!! Form::open(['url' => 'admin/permission/store', 'id' => 'permissionForm', 'method' => 'post', 'class' => '']) !!}
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group has-feedback {!! $errors->first('user_role', ' has-error') !!}">
                                            {!! Form::label('user role','User Role') !!}
                                            {!! Form::select('user_role', $roleArr, 0, ['class' => 'form-control', 'id' => 'user_role']) !!}
                                            {!! $errors->first('user_role', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <?php if(count($moduleArr) > 0) { ?>
                                    <?php foreach($moduleArr as $key => $value){ ?>
                                        <?php 
                                         $name = $value->name;
                                         $id = $value->id;
                                        ?>
                                    <div class="row" >
                                        <div class="col-md-10" >
                                            <div class="form-group has-feedback" >
                                                {!! Form::checkbox('module_id[]',$id,null, array('id'=>'change_password')) !!}
                                                {!! Form::label('check',$name, ['class' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php } else{ ?>
                                <div class="row" id="permissions">
                                    <div class="col-md-10" >
                                        <div class="form-group has-feedback" >
                                            <p>Module Not Avilable</p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="form-group">
                                    {!! Form::submit('Submit',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                    <a href="{!! url('admin/user-permission') !!}" class="btn btn-default btn-flat">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
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
    // Form Validation
    jQuery("#permissionForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "user_role":{
                required: true
            }
        },
        messages:{
            "user_role":{
                required: "Please select role"
            }
        }
    });

    // Get User module => Start
    // $("#user_role").change(function(){
    //     var value = $(this).val();
    //     if(value != ''){
    //         var reqUrl = SITE_URL+'/admin/user-permission/getmodule';
    //         var reqData = 'roleId='+value;
    //         $.ajax({
    //             type: "POST",
    //             url: reqUrl,
    //             data: reqData,
    //             // dataType: "json",
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(response) {
    //                 console.log( response );
    //                 // if (status == 1) {
                        
    //                 // } else {
    //                 //     alert(message);
    //                 //     return false;
    //                 // }
    //             },
    //             error: function(XMLHttpRequest, textStatus, errorThrown) {
    //                 if (XMLHttpRequest.readyState == 4) {
    //                     // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
    //                     alert(textStatus);
    //                     return false;
    //                 } else if (XMLHttpRequest.readyState == 0) {
    //                     // Network error (i.e. connection refused, access denied due to CORS, etc.)
    //                     alert("Network error: connection refused.");
    //                     return false;
    //                 } else {
    //                     // something weird is happening
    //                     alert("Something weird is happening");
    //                     return false;
    //                 }
    //             }
    //         });
    //     }
    //     else{
    //         alert("empty value selected.");
    //     }
    // });
    // Get User module => Start


    
});
</script>
@endsection