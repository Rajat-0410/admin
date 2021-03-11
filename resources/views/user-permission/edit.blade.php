@extends('layouts.admin')

@section('page-content')
<?php
//print("<pre>");
//print_r($permissionArr); 
// echo '<br/>';
//print("<pre>"); print_r($arrModules); 
//exit('sadas'); 
?>
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
                                {!! Form::open(['url' => 'admin/user-permission/store', 'id' => 'permissionForm', 'method' => 'post', 'class' => '']) !!}
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group has-feedback {!! $errors->first('user_role', ' has-error') !!}">
                                            {!! Form::label('user role','User Role') !!}
                                            {!! Form::select('user_role', $roleArr, $userRoleId, ['class' => 'form-control', 'id' => 'user_role']) !!}
                                            {!! $errors->first('user_role', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="">
                                <?php if(count($arrModules) > 0) { ?>
                                    <div class="col-md-12 list-container">
                                        <ul>
                                        <?php foreach($arrModules as $key => $value){ ?>
                                            <?php 
                                                $id = $value['id'];
                                                $name = $value['name'];
                                                $controller = $value['controller'];
                                                $is_action = $value['is_action'];
                                                $is_visible = $value['is_visible'];
                                                $has_sub_menu = (bool)$value['has_sub_menu'];
                                                $checked = false;
                                                if (array_key_exists($id,$permissionArr) || $controller=='dashboard')
                                                {
                                                    $checked = true;
                                                }
                                            ?>
                                            <li class="parent-li" id="parent-{{$id}}" style="<?php if($controller=='dashboard'){ echo 'display: none;';} ?>">
                                                <div class="form-group has-feedback" >
                                                    {!! Form::checkbox('module_id[]',$id,$checked, array('id'=>$id,'class' => 'parent-module')) !!}
                                                    {!! Form::label($id,$name, ['class' => '']) !!}
                                                </div>
                                                <?php if($has_sub_menu){ ?>
                                                <ul class="sub-modules">
                                                    <?php 
                                                        $arrSubModules = $value['sub_modules'];
                                                        if(!empty($arrSubModules)){
                                                            foreach($arrSubModules as $key1 => $value1){
                                                                $sm_id = $value1['id'];
                                                                $sm_name = $value1['name'];
                                                                $sm_controller = $value1['controller'];
                                                                $sm_action = $value1['action'];
                                                                $sm_is_action = (bool)$value1['is_action'];
                                                                $sm_is_visible = $value1['is_visible'];
                                                                $sm_has_sub_menu = (bool)$value1['has_sub_menu'];
                                                                $checked = false;
                                                                if (array_key_exists($sm_id,$permissionArr))
                                                                {
                                                                    $checked = true;
                                                                }
                                                        ?>
                                                            <li id="child-{{$sm_id}}" class="child-li <?php if($sm_action!='index' && $sm_action!=''){ echo 'action'; } ?>">
                                                                {!! Form::checkbox('module_id[]',$sm_id,$checked, array('id'=>$sm_id,'class' => 'child-module')) !!}
                                                                {!! Form::label($sm_id,$sm_name, ['class' => '']) !!}
                                                            </li>
                                                    <?php }
                                                        } ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                <?php } else{ ?>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback" >
                                            <p>Module Not Avilable</p>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Update',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                    <a href="{!! url('admin/user-permission') !!}" class="btn btn-default btn-flat">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./col 
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
</div>
<style>
    .list-container ul{
        list-style: none;
        padding-left: 20px;
    }
    .list-container ul li .form-group{
        margin-bottom: 0;
    }
    .list-container ul .parent-li{
        margin-bottom: 10px;
    }
    .action{
        margin-left: 10px;
    }
</style>
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
    
    // child-module
    $('.child-module').click(function() {
        var is_checked = false;
        var parent_input_id = $(this).closest('li').parent().parent().find("input[type='checkbox']").attr('id');
        // alert(parent_input_id);
        if ($(this).is(':checked')) {
            is_checked = true;
        } else {
            var checkboxLength = $("#parent-"+parent_input_id).find('.sub-modules li').find("input[type='checkbox']:checked").length;
            // alert(checkboxLength);
            if(checkboxLength==0){
                is_checked = false;
            } else {
                is_checked = true;
            }
        }
        $("#"+parent_input_id).prop('checked', is_checked);
        // console.log("child-module => "+is_checked);
    });
    
    // parent-module
    $('.parent-module').click(function() {
        var is_checked = false;
        var parent_id = $(this).parent().parent().attr('id');
        // alert(parent_id);
        if ($(this).is(':checked')) {
            is_checked = true;
        } else {
            is_checked = false;
        }
        $("#"+parent_id).find('.sub-modules li').find("input[type='checkbox']").prop('checked', is_checked);
        // console.log("parent-module => "+is_checked);
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