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
                                {!! Form::open(['url' => 'admin/slider/store', 'id' => 'sliderForm', 'method' => 'post', 'files' => true, 'class' => '']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback {!! $errors->first('status', ' has-error') !!}">
                                            {!! Form::label('status','Status') !!}
                                            {!! Form::select('status', $arr_status, 1, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                            {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                                            
                                <div class="form-group">
                                    {!! Form::submit('Add',['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
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
        var clone = jQuery("#imageuploadcontainer0").clone();
        // clone.find('#imageuploadcontainer0').attr("id","imageuploadcontainer"+incVal+"Id");
        // clone.find('.box-title').text('Slide '+slide_count);
        clone.find('.box-tools').show();
        clone.find('input').attr('value',"");
        clone.find('input:file').attr('name','images['+incVal+'][image]');
        clone.find('input:text').first().attr('name','images['+incVal+'][title]');
        clone.find('input:text').last().attr('name','images['+incVal+'][url]');
        var cloneData = clone.html();
        jQuery(".image-upload-container").last().append('<div class="box box-default right-border left-border" id="imageuploadcontainer'+incVal+'">'+cloneData+'</div>');
        $("#incVal").val(incVal);
    });
    
    // Remove element    
    $("#sliderForm").on("click",".remove-ele", function(){
        var eleId = $(this).closest('.box').attr('id');
        // alert(eleId); return false;
        $("#"+eleId).remove();
    });
    
});
</script>
@endsection