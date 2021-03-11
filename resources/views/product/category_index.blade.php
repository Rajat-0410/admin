@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print($get_id); exit;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_title; ?> <small>Categories</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                
                @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class') }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <p><i class="{{ Session::get('icon-class') }}"></i> {{ Session::get('message') }}</p>
                </div>
                @endif
                 <!-- Feature oreder arrange then msg show => START-->
                <div class="alert alert-dismissible alert-success hide orderArrange">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <p id="orderArrange"><i class="" ></i></p>
                </div>
                <!-- Feature oreder arrange then msg show => END--> 
                
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">Search</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></button>
                            <!--<button title="Remove" data-toggle="tooltip" data-widget="remove" class="btn btn-info btn-sm"><i class="fa fa-times"></i></button>-->
                        </div><!-- /. tools -->
                    </div>
                    <div class="box-body">
                        {!! Form::open(['url' => 'admin/product/category', 'id' => 'searchCat', 'method' => 'get', 'class' => '']) !!}
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group has-feedback {!! $errors->first('keyword', ' has-error') !!}">
                                        {!! Form::label('keyword','Keyword', ['class' => 'required']) !!}
                                        {!! Form::text('keyword',$keyword,['class' => 'form-control', 'placeholder' => 'keyword']) !!}
                                        {!! $errors->first('keyword', '<p class="help-block">:message</p>') !!}
                                        <p class="help-block"><strong>Search By:</strong> Name OR Slug</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::submit('Search',['class' => 'btn btn-primary btn-med']) !!}&nbsp;&nbsp;
                                <a href="{!! url('admin/product/category') !!}" class="btn btn-default btn-med">Reset</a>
                            </div>
                        {!! Form::close() !!}
                        <!--p<><strong>Note:</strong></p>-->
                    </div>
                </div>
                
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <!--<a href="{!! url('admin/post/category/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Category</a>-->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                    @if(count($all_records) > 0)
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th class="text-center" width="12%">Status</th>
                                            <th>Publish Date</th>
                                            <th>Action/s</th>
                                        </tr>
                                        <tbody id="sortable">
                                        @foreach($all_records as $row)
                                            <?php // print_r($row); exit; 
                                                $id = base64_encode($row->id);
                                                $status = $row->status;
                                                $statusText  = ($status==1) ? 'Active':'Inactive';
                                                $statusClass = ($status==1) ? 'label-success':'label-danger';
                                            ?>
                                            <tr id="<?php echo $row->id;?>">
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->slug }}</td>
                                                <td class="text-center" width="12%">
                                                    <a href="javascript:void(0)" class="change-status" id="post-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="ProductCategory"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                                </td>
                                                <td>{{ date('Y/m/d H:i A',strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="<?php echo SITE_URL.'/admin/product/category?id='.$id; ?>" class="btn btn-xs btn-theme"><i class="fa fa-pencil"></i></a>&nbsp;|&nbsp;
                                                    <!--<a href="{!! url('admin/product/category', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-pencil"></i></a>&nbsp;|&nbsp;-->
                                                    <!--<a href="{!! url('admin/product/category/delete', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-trash"></i></a>-->
                                                    <a href="javascript:void(0)" class="delete-record" id="<?php echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>&nbsp;|&nbsp;
                                                    <a href="javascript:void(0)" id="" title="Drag And Drop" data-toggle="tooltip"><i class="fa fa-arrows handle ui-sortable-handle"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @else 
                                    <tr><td class="text-center" colspan="6"><strong>{{ $no_records_found }}</strong></td></tr>                                
                                    @endif
                                </table>
                                    
                                    @if(!empty($all_records))
                                        {{ $all_records->links() }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="box box-success box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Add New Category</h3>
<!--                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>-->
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <fieldset>
                                            {!! Form::open(['url' => 'admin/product/category/store', 'id' => 'productCatForm', 'method' => 'post', 'class' => '']) !!}
                                            {!! Form::hidden('id',$get_id) !!}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                                        {!! Form::label('name','Name', ['class' => 'required']) !!}
                                                        {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if(!empty($get_id)){ ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback {!! $errors->first('slug', ' has-error') !!}">
                                                        {!! Form::label('slug','Slug', ['class' => 'required']) !!}
                                                        {!! Form::text('slug',$slug,['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                                        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                                        {!! Form::label('parent_id','Parent Category') !!}
                                                        {!! Form::select('parent_id', $arrParentCategory, $parent_id, ['class' => 'form-control', 'id' => 'parent_category']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if(empty($get_id)){ ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                                        {!! Form::label('featured_image','Featured Image') !!}
                                                        <span class="help-block">(Dimension: 550px * 542px | <?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 150kb'; ?>)</span>
                                                        {!! Form::hidden('featured_image','',['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                        <br>
                                                        <input type="hidden" name="check_dimensions" id="checkDimensions" value="true">
                                                        <input type="hidden" name="dimensions_width" id="dimensionsWidth" value="550">
                                                        <input type="hidden" name="dimensions_height" id="dimensionsHeight" value="542">
                                                        <input type="hidden" name="max_size" id="maxSize" value="150">
                                                        <a href="javascript:void(0)" class="feature-image" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                        <div id="showMediaImageCont" class="hide media-img-container">
                                                            <img src="" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                        </div>
                                                        <a href="javascript:void(0)" class="btn btn-default hide" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } else { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                                        {!! Form::label('featured_image','Featured Image') !!}
                                                        <span class="help-block">(Dimension: 550px * 542px | <?php echo $allowfiletypetext;?> : <?php echo $filetype; ?> | <?php echo MAX_SIZE_TEXT.' 150kb'; ?>)</span>
                                                        {!! Form::hidden('featured_image',$featured_image,['class' => 'form-control', 'id' => 'featured_image']) !!}
                                                        <br>
                                                        <input type="hidden" name="check_dimensions" id="checkDimensions" value="true">
                                                        <input type="hidden" name="dimensions_width" id="dimensionsWidth" value="550">
                                                        <input type="hidden" name="dimensions_height" id="dimensionsHeight" value="542">
                                                        <input type="hidden" name="max_size" id="maxSize" value="150">
                                                        <a href="javascript:void(0)" class="feature-image <?php echo (empty($featured_image)) ? 'show':'hide' ?>" id="setFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Set featured image</a>
                                                        <div id="showMediaImageCont" class="<?php echo (!empty($featured_image)) ? 'show':'hide' ?> media-img-container">
                                                            <img src="{{ asset("uploads/media-images/thumbnail/$featured_image") }}" class="img-responsive" width="150" height="150" title="" id="showMediaImage">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <a href="javascript:void(0)" class="btn btn-default <?php echo (!empty($featured_image)) ? 'show':'hide' ?>" id="replaceFeatureImage" data-toggle="modal" data-target="#media-browse-modal">Replace image</a>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="javascript:void(0)" class="btn btn-danger <?php echo (!empty($featured_image)) ? 'show':'hide' ?>" id="removeFeaturedImage">Remove image</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback {!! $errors->first('description', ' has-error') !!}">
                                                        {!! Form::label('description','Description', ['class' => 'required']) !!}
                                                        {!! Form::textarea('description',$description,['class' => 'form-control', 'placeholder' => 'Description', 'rows' => 4]) !!}
                                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group has-feedback {!! $errors->first('status', ' has-error') !!}">
                                                        {!! Form::label('status','Status') !!}
                                                        {!! Form::select('status', $arr_status, $status, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::submit($btn_name,['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                                <a href="{!! url('admin/product/category') !!}" class="btn btn-default btn-flat">Cancel</a>
                                            </div>
                                            {!! Form::close() !!}
                                        </fieldset>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>        
    </section>
    <!-- /.content -->
    
    <!-- includes.browse-media -->
    @include('includes.browse-media')
    <!-- /includes.browse-media -->
    
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
$( "#sortable" ).sortable({
    handle: '.handle',
    stop: function( event, ui ) {
        var sortedIDs = $("#sortable").sortable("toArray");
        console.log(sortedIDs);
        // alert(sortedIDs);
        var reqUrl = SITE_URL+'/admin/product/category/arrange';
        var reqData = 'ids='+sortedIDs;
        $.ajax({
            type: "POST",
            url: reqUrl,
            data: reqData,
            dataType: "json",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(response){
                // console.log(response);
                if(response.status == 1 ){ 
                    $(".orderArrange").removeClass('hide');
                    $('#orderArrange').text(response.message);
                } 
            }
        })
    }
    });
    $('#sortable').disableSelection();
});
</script>
<script>
jQuery(document).ready(function(){
    
    // Product Category Form Validation => START
    jQuery("#productCatForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "name":{
                required: true
            },
            "slug":{
                required: true
            }
        },
        messages:{
            "name":{
                required: "Please enter name"
            },
            "slug":{
                required:"Please enter slug"
            }
        }
    });
    // Page Form Validation => END
          
    //delete-record
    $(".delete-record").on("click",function(e){
        var ele_id = $(this).attr('id');
        if(ele_id != ''){
            bootbox.confirm({
                message: "Do you really want to delete this record?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    // console.log(ele_id+'-'+result);
                    if(result){
                        location.href = SITE_URL+'/admin/product/category/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection