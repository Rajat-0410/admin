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
                                                    <div class="col-md-3">
                                                        <div class="form-group {!! $errors->first('specification.0.group_id', ' has-error') !!}">
                                                            {!! Form::label('group_id','Specification Group') !!}
                                                            {!! Form::select('specification[0][group_id]', $arrSpecAttrGroup, '', ['class' => 'form-control getAttributeOption required', 'id' => 'group_id', 'data-name' => 'attribute_div0' ]) !!} 
                                                            {!! $errors->first('specification.0.group_id', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group {!! $errors->first('specification.0.attribute', ' has-error') !!}">
                                                            {!! Form::label('attribute','Specification Attribute') !!}
                                                            {!! Form::select('specification[0][attribute]', $arrSpecAttribute, '', ['class' => 'form-control showAttributeOption required', 'id' => 'attribute_div0']) !!}  
                                                            {!! $errors->first('specification.0.attribute', '<p class="help-block">:message</p>') !!}                             
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group {!! $errors->first('specification.0.value', ' has-error') !!}">
                                                            {!! Form::label('value','Value') !!}
                                                            {!! Form::text('specification[0][value]','',['class' => 'form-control attributevalue required', 'id'=>'value', 'placeholder' => 'Value']) !!}
                                                            {!! $errors->first('specification.0.value', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            {!! Form::label('is_featured','Is Featured') !!}
                                                             {!! Form::checkbox('specification[0][is_featured] ',null,null,['class' => 'is_featured', 'id' => 'is_featured_0']) !!}
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-1">
                                                        <div class="form-group">
                                                            {!! Form::label('order_by','Order') !!}
                                                             {!! Form::text('specification[0][order_by]','',['class' => 'form-control hide order_by', 'id'=>'order_by_0', 'placeholder' => 'order']) !!}
                                                        </div>
                                                    </div>
 -->
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            {!! Form::label('status','Status') !!}
                                                            {!! Form::select('specification[0][status]', $arr_status, 1, ['class' => 'form-control attributestatus', 'id' => 'Status']) !!}                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group pull-right">
                                            {!! Form::hidden('inc_val',0,['id' => 'incVal']) !!}
                                            <button type="button" id="addNewProductSpecification" class="btn btn-info">Add New Product Specification</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Add',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                    <a href="{!! url('admin/productspecification',['id' => $productId]) !!}" class="btn btn-default  btn-flat">Cancel</a>
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


<div class="box box-default right-border left-border myClickableElement" id="imageuploadcontainerClone" style="display: none;">

    <div class="box-header with-border">
        <!-- tools box -->
        <div class="pull-right box-tools" style="display: none;">
            <button type="button" class="btn btn-info btn-sm remove-ele" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
        <!-- /. tools -->
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group {!! $errors->first('images.0.image', ' has-error') !!}">
                    {!! Form::label('group_id','Specification Group') !!}
                    {!! Form::select('specification[0][group_id]', $arrSpecAttrGroup, '', ['class' => 'form-control getAttributeOption required', 'data-name' => 'attribute_div']) !!} 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('attribute','Specification Attribute') !!}
                    {!! Form::select('specification[0][attribute]', $arrSpecAttribute, '', ['class' => 'form-control showAttributeOption required', 'id' => 'attribute_div']) !!}                               
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('value','Value') !!}
                    {!! Form::text('specification[0][value]','',['class' => 'form-control attributevalue required', 'placeholder' => 'Value']) !!}
                </div>
            </div>

            <div class="col-md-1">
                <div class="form-group">
                    {!! Form::label('is_featured','Is Featured') !!}
                     {!! Form::checkbox('specification[0][is_featured] ',null,null,['class' => 'is_featured', 'id' => 'is_featured_']) !!}
                </div>
            </div>

           <!--  <div class="col-md-1">
                <div class="form-group">
                    {!! Form::label('order_by','Order') !!}
                     {!! Form::text('specification[0][order_by]','',['class' => 'form-control order_by hide', 'id'=>'order_by[]', 'placeholder' => 'order']) !!}
                </div>
            </div> -->

            <div class="col-md-2">
                <div class="form-group">
                    {!! Form::label('status','Status') !!}
                    {!! Form::select('specification[0][status]', $arr_status, 1, ['class' => 'form-control attributestatus']) !!}                               
                </div>
            </div>
        </div>
    </div>
</div>



<script>
// Order by input box hide show on click check box =START.
    $(document).on('change', ".is_featured", function(){
        var checkboxId = $(this).attr('id');
        // alert(checkboxName);
        var order_byId = checkboxId.replace('is_featured_','order_by_');
        // alert(order_byinput);
        if(this.checked){
            // alert('checked');
            $('#'+order_byId).removeClass('hide').addClass('show');
        }else{
            // alert('unchecked');
            $('#'+order_byId).removeClass('show').addClass('hide');
        }
    });
// Order by input box hide show on click check box =START.
jQuery(document).ready(function(){
    var incVal = 0;
    $("#addNewProductSpecification").click(function(){
        incVal = $("#incVal").val();
        // alert('xcvzxvx');
        incVal = parseInt(incVal) + parseInt(1);
        // alert(incVal);
        var clone = jQuery("#imageuploadcontainerClone").clone(true);
        clone.find('.box-tools').show();
        // clone.find('input').attr('id',"");
        clone.find('.getAttributeOption').attr('data-name','attribute_div'+incVal);
        clone.find('.showAttributeOption').attr('id','attribute_div'+incVal);   

        clone.find('.getAttributeOption').attr('name','specification['+incVal+'][group_id]');
        clone.find('.showAttributeOption').attr('name','specification['+incVal+'][attribute]');
        clone.find('.attributevalue').attr('name','specification['+incVal+'][value]');
        clone.find('.is_featured').attr('name','specification['+incVal+'][is_featured]');
        clone.find('.is_featured').attr('id','is_featured_'+incVal);
        // clone.find('.order_by').attr('name','specification['+incVal+'][order_by]');
        // clone.find('.order_by').attr('id','order_by_'+incVal);
        clone.find('.attributestatus').attr('name','specification['+incVal+'][status]');
        var cloneData = clone.html();
        jQuery(".image-upload-container").last().append('<div class="box box-default right-border left-border" id="imageuploadcontainer'+incVal+'" style="display: block;">'+cloneData+'</div>');
        $("#incVal").val(incVal);
    });
    
    // Remove element    
    $("#productSecificationForm").on("click",".remove-ele", function(){
        var eleId = $(this).closest('.box').attr('id');
        // alert(eleId); return false;
        $("#"+eleId).remove();
    });

});
</script>

<script>
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

@endsection