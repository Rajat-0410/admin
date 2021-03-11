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
                                {!! Form::open(['url' => 'admin/productspecification/store', 'id' => 'productSecificationForm', 'method' => 'post', 'class' => '']) !!}
                                {!! Form::hidden('productId',$productId) !!}
                                {!! Form::hidden('id',$id) !!}
                                <div class="row">
                                    <div class="col-md-12 image-upload-container">
                                        <div class="box box-default right-border left-border" id="imageuploadcontainer0">

                                            <div class="box-header with-border">
                                                <h3 class="box-title">Product Specification</h3>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools" style="display: none;">
                                                    <button type="button" class="btn btn-info btn-sm remove-ele" title="Remove">
                                                    <i class="fa fa-times"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                            </div>

                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group {!! $errors->first('images.0.image', ' has-error') !!}">
                                                            {!! Form::label('group_id','Specification Group') !!}
                                                            {!! Form::select('specification[0][group_id]', $arrSpecAttrGroup, $group_id, ['class' => 'form-control getAttributeOption required', 'id' => 'group_id','data-name' => 'attribute_div0']) !!} 
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            {!! Form::label('attribute','Specification Attribute') !!}
                                                            {!! Form::select('specification[0][attribute]', $arrSpecAttribute, $attribute_id, ['class' => 'form-control showAttributeOption required', 'id' => 'attribute_div0']) !!}                               
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            {!! Form::label('value','Value') !!}
                                                            {!! Form::text('specification[0][value]',$value,['class' => 'form-control attributevalue required', 'id'=>'value', 'placeholder' => 'Value']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            {!! Form::label('is_featured','Is Featured') !!}
                                                            {!! Form::checkbox('specification[0][is_featured] ',null,$is_featured ,['class' => 'is_featured', 'id' => 'is_featured']) !!}
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-1">
                                                        <div class="form-group">
                                                            {!! Form::label('order_by','Order') !!}
                                                             {!! Form::text('specification[0][order_by]','$order_by',['class' => 'form-control order_by', 'id'=>'order_by', 'placeholder' => 'order']) !!}
                                                        </div>
                                                    </div> -->

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('specification[0][status]', $arr_status, $status, ['class' => 'form-control attributestatus', 'id' => 'Status']) !!}                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Update',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                    <a href="{!! url('admin/productspecification',['id' => $productId]) !!}" class="btn btn-default btn-flat">Cancel</a>
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

// Order by input box hide show on click check box =START.
    jQuery(document).ready(function(){
     // Order by input box hide show on click check box =START.
            if($("#is_featured").prop("checked") == true){
                $('#order_by').removeClass('hide').addClass('show');
            }
            else if($("#is_featured").prop("checked") == false){
                $('#order_by').removeClass('show').addClass('hide');
            }
            // On Click
            $("#is_featured").change(function(){
                if($("#is_featured").prop("checked") == true){
                    $('#order_by').removeClass('hide').addClass('show');
                }
                else if($("#is_featured").prop("checked") == false){
                    $('#order_by').removeClass('show').addClass('hide');
                }
            });
    });
// Order by input box hide show on click check box =START.

    $(document).on('change', ".getAttributeOption", function(){
        var attributeOptionId = $(this).attr('data-name');
        // alert(attributeOptionId);
        var value = $(this).val();
        if(value != ''){
            var optionHtml = '<option value="">Select Attribute</option>';
        }else{
             var optionHtml = '<option value="">None</option>';
        }
        
        $('#'+attributeOptionId).html(optionHtml);
        // change-status
        
        // alert(value);
        if(value != ''){
            $(this).find('span').html('<i class="fa fa-spinner fa-pulse"></i>');
            var reqUrl = SITE_URL+'/admin/productspecification/getAttributeOption';
            var reqData = 'groupId='+value;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log( response );
                    var data = response.data;
                    var status = response.status;
                    var status_text = response.status_text;
                    var message = response.message;
                    if (status == 1) {
                        if(data != '') {
                            $.each(data, function(index, element) {
                                optionHtml += '<option value="'+index+'">'+element+'</option>';
                            });
                            $('#'+attributeOptionId).html(optionHtml);
                        }
                        // return true;
                    } else {
                        alert(message);
                        return false;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState == 4) {
                        // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                        alert(textStatus);
                        return false;
                    } else if (XMLHttpRequest.readyState == 0) {
                        // Network error (i.e. connection refused, access denied due to CORS, etc.)
                        alert("Network error: connection refused.");
                        return false;
                    } else {
                        // something weird is happening
                        alert("Something weird is happening");
                        return false;
                    }
                }
            });
        }

       
    });
</script>

<script>
    $(document).on('change', ".getAttributeOption", function(){
        var attributeOptionId = $(this).attr('title');
        // alert(attributeOptionId);
        var optionHtml = '<option>Select Attribute</option>';
        $('#'+attributeOptionId).html(optionHtml);
        // change-status
        var value = $(this).val();
        // alert(value);
        if(value != ''){
            $(this).find('span').html('<i class="fa fa-spinner fa-pulse"></i>');
            var reqUrl = SITE_URL+'/admin/productspecification/getAttributeOption';
            var reqData = 'groupId='+value;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log( response );
                    var data = response.data;
                    var status = response.status;
                    var status_text = response.status_text;
                    var message = response.message;
                    if (status == 1) {
                        if(data != '') {
                            $.each(data, function(index, element) {
                                optionHtml += '<option value="'+index+'">'+element+'</option>';
                            });
                            $('#'+attributeOptionId).html(optionHtml);
                        }
                        // return true;
                    } else {
                        alert(message);
                        return false;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState == 4) {
                        // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                        alert(textStatus);
                        return false;
                    } else if (XMLHttpRequest.readyState == 0) {
                        // Network error (i.e. connection refused, access denied due to CORS, etc.)
                        alert("Network error: connection refused.");
                        return false;
                    } else {
                        // something weird is happening
                        alert("Something weird is happening");
                        return false;
                    }
                }
            });
        }

       
    });
</script>
@endsection