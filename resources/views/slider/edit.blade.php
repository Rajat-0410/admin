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
                            <div class="col-md-12">
                                {!! Form::open(['url' => 'admin/slider/store', 'id' => 'sliderForm', 'method' => 'post', 'files' => true, 'class' => '']) !!}
                                {!! Form::hidden('id',$id) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback {!! $errors->first('slug', ' has-error') !!}">
                                            {!! Form::label('slug','Slug', ['class' => 'required']) !!}
                                            {!! Form::text('slug',$slug,['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                            {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('status','Status') !!}
                                            {!! Form::select('status', $arr_status, $status, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::submit('Update',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                    <a href="{!! url('admin/slider') !!}" class="btn btn-default btn-flat">Cancel</a>
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

<div class="box box-default right-border left-border" id="imageuploadcontainerClone" style="display: none;">
    <div class="box-header with-border">
        <i class="fa fa-picture-o"></i>
        <h3 class="box-title">Slide</h3>
        <!-- tools box -->
        <div class="pull-right box-tools" style="display: none;">
            <button type="button" class="btn btn-info btn-sm remove-ele" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
        <!-- /. tools -->
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {!! $errors->first('images.0.image', ' has-error') !!}">
                    {!! Form::file('images[0][image]', ['class' => '']) !!}
                    <span class="help-block">(<?php echo $allowfiletypetext;?> : <?php echo $filetype;?>)</span>
                    {!! $errors->first('images.0.image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('images[0][title]','',['class' => 'form-control', 'placeholder' => 'Slider Image Title']) !!}                                           
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::text('images[0][url]','',['class' => 'form-control', 'placeholder' => 'Url For Slider Image']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function(){
    var incVal = 0;
    $("#addNewSlide").click(function(){
        incVal = $("#incVal").val();
        incVal = parseInt(incVal) + parseInt(1);
        // alert(incVal);
        // var slide_count = parseInt(incVal) + parseInt(1);
        // $("#imageUploadCont").clone().insertAfter("#addNew");
        // image-upload-container
        var clone = jQuery("#imageuploadcontainerClone").clone(true);
        // clone.find('#imageuploadcontainer0').attr("id","imageuploadcontainer"+incVal+"Id");
        // clone.find('.box-title').text('Slide '+slide_count);
        clone.find('.box-tools').show();
        clone.find('input').attr('value',"");
        clone.find('input:file').attr('name','images['+incVal+'][image]');
        clone.find('input:text').first().attr('name','images['+incVal+'][title]');
        clone.find('input:text').last().attr('name','images['+incVal+'][url]');
        var cloneData = clone.html();
        jQuery(".image-upload-container").last().append('<div class="box box-default right-border left-border" id="imageuploadcontainer'+incVal+'" style="display: block;">'+cloneData+'</div>');
        $("#incVal").val(incVal);
    });
    
    // Remove element    
    $("#sliderForm").on("click",".remove-ele", function(){
        var eleId = $(this).closest('.box').attr('id');
        // alert(eleId); return false;
        $("#"+eleId).remove();
    });
    
    // Change Status Function
    $(".delete-slide").on("click",function(e){
        
        // change-status
        var ele_id = $(this).attr('id');
        var ele_div_id = $(this).closest('.box').attr('id');
        // alert(ele_div_id); return false;
        if(ele_id != ''){
            
            var reqUrl = SITE_URL+'/admin/slider/delete-slide';
            var reqData = 'slide_id='+ele_id;
            // alert(reqUrl+' - '+reqData); return false;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var status = response.status;
                    var message = response.message;
                    // alert(status+'~'+message);
                    if (status == 1) {
                        // true;
                        // $("#"+ele_div_id).remove();
                        $('#'+ele_div_id).fadeOut(300, function(){ $(this).remove();});
                    } else {
                        // false
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
    
});
</script>
@endsection