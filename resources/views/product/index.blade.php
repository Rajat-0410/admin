@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($all_records); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_title; ?><small></small></h1>
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
                <!-- oreder arrange then msg show => START-->
                <div class="alert alert-dismissible alert-success hide orderArrange">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <p id="orderArrange"><i class="" ></i></p>
                </div>
                <!-- oreder arrange then msg show => END--> 
                
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">Search</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></button>
                        </div><!-- /. tools -->
                    </div>
                    <div class="box-body">
                        {!! Form::open(['url' => 'admin/product', 'id' => 'addBookTestRide', 'method' => 'get', 'class' => '']) !!}
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group has-feedback">
                                        {!! Form::label('category_id','Category') !!}
                                        {!! Form::select('category_id', $arrProductCategory, $category_id, ['class' => 'form-control', 'id' => 'parent_category']) !!}
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group has-feedback {!! $errors->first('keyword', ' has-error') !!}">
                                        {!! Form::label('keyword','Keyword', ['class' => 'required']) !!}
                                        {!! Form::text('keyword',$keyword,['class' => 'form-control', 'placeholder' => 'keyword']) !!}
                                        {!! $errors->first('keyword', '<p class="help-block">:message</p>') !!}
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <p class="help-block"><strong>Search By:</strong> Name OR Category OR Slug</p>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Search',['class' => 'btn btn-primary btn-med']) !!}&nbsp;&nbsp;
                                <a href="{!! url('admin/product') !!}" class="btn btn-default btn-med">Reset</a>
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
                                <?php if(isset($add_action) && $add_action==true){ ?>
                                    <a href="{!! url('admin/product/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Product</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(count($all_records) > 0)
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Slug</th>
                                        <th class="text-center" width="12%">Status</th>
                                        <th>Last Updated By</th>
                                        <th>Last Updated Date</th>
                                        <th class="text-center" width="290">Action/s</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                @foreach($all_records as $row)
                                    <?php 
                                        // print("<pre>"); print_r($row); exit('hererer');
                                        $id = base64_encode($row->id);
                                        $slug = $row->slug;
                                        $category_name = (!empty($row->product_categories->name) ? $row->product_categories->name:'N/A');
                                        $status = $row->status;
                                        $statusText  = ($status==1) ? 'Active':'Inactive';
                                        $statusClass = ($status==1) ? 'label-success':'label-danger';
                                        // latest_action_log
                                        $user_id = $row->latest_action_log['user_id'];
                                        $user_name = (isset($row->latest_action_log->user->name) ? $row->latest_action_log->user->name:'-');
                                        // 'Y/m/d H:i A'
                                        $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                    ?>
                                    <tr id="<?php echo $row->id;?>">
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $category_name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td class="text-center" width="12%">
                                            <a href="javascript:void(0)" class="change-status" id="post-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="Product"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                        </td>
                                        <td>
                                            {{ $user_name }}
                                            <?php if($user_name!='-'){ ?>
                                            <a href="{!! url('admin/action-logs/history/product', ['recordId' => $id]) !!}" class="btn btn-xs btn-theme text-aqua" data-toggle="tooltip" title="View All Logs"><i class="fa fa-history"></i></a>
                                            <?php } ?>
                                        </td>
                                        <td>{{ $updated_at }}</td>
                                        <td>
                                            <!--<a href="{!! url('admin/post/delete', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-trash"></i></a>-->
                                            <?php if(isset($preview) && $preview==true){ ?>
                                                <a href="{!! url('admin/product/preview', ['slug' => $slug]) !!}" class="btn btn-xs btn-theme text-aqua" data-toggle="tooltip" title="Preview" target="_blank"><i class="fa fa-eye"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($edit_action) && $edit_action==true){ ?>
                                                <a href="{!! url('admin/product/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Product Details"><i class="fa fa-pencil"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($product_overview) && $product_overview==true){ ?>
                                                <a href="{!! url('admin/product-overview', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Overview"><i class="fa fa-opera"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($product_360_media) && $product_360_media==true){ ?>
                                                <a href="{!! url('admin/product-360-media', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="360 Media"><i class="fa fa-street-view"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($awards) && $awards==true){ ?>
                                                <a href="{!! url('admin/awards/save-awards-image', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Awards"><i class="fa fa-trophy"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($brochure) && $brochure==true){ ?>
                                                <a href="{!! url('admin/brochure/save-brochure', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Brochure"><i class="fa fa-file-pdf-o"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($variant) && $variant==true){ ?>
                                                <a href="{!! url('admin/variant', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Variant"><i class="fa fa-vimeo"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>  
                                            <?php if(isset($color) && $color==true){ ?>
                                                <a href="{!! url('admin/color', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Colors"><i class="fa fa-paint-brush"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($feature) && $feature==true){ ?>
                                                <a href="{!! url('admin/feature', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Features"><i class="fa fa-font"></i></a>&nbsp;|&nbsp;
                                            <?php } ?> 
                                            <?php if(isset($productspecification) && $productspecification==true){ ?>
                                                <a href="{!! url('admin/productspecification', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Specification"><i class="fa fa-scribd"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($media_review) && $media_review==true){ ?>
                                                <a href="{!! url('admin/media-review', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Media Reviews"><i class="fa fa-medium"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($product_image_gallery) && $product_image_gallery==true){ ?>
                                                <a href="{!! url('admin/product-image-gallery', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Image Gallery"><i class="fa fa-picture-o"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($product_video_gallery) && $product_video_gallery==true){ ?>
                                                <a href="{!! url('admin/product-video-gallery', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Video Gallery"><i class="fa fa-video-camera"></i></a>&nbsp;|&nbsp;
                                            <?php } ?> 
                                            <?php if(isset($product_maintenance_schedules) && $product_maintenance_schedules==true){ ?>
                                                <a href="{!! url('admin/product-maintenance-schedules', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Periodic Maintenance Schedule"><i class="fa fa-handshake-o"></i></a>&nbsp;|&nbsp;
                                            <?php } ?> 
                                            <?php if(isset($product_campaign_image) && $product_campaign_image==true){ ?>
                                                <a href="{!! url('admin/product-campaign-image', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Campaign Images"><i class="fa fa-camera"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <?php if(isset($campaign) && $campaign==true){ ?>
                                                <a href="<?php echo SITE_URL.'/campaign/'.$row->slug; ?>" target="_blank" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="View Campaign"><i class="fa fa-paper-plane"></i></a>&nbsp;|&nbsp;
                                            <?php } ?>
                                            <a href="javascript:void(0)" id="" class="btn btn-xs btn-theme text-green" title="Drag And Drop" data-toggle="tooltip"><i class="fa fa-arrows handle ui-sortable-handle"></i></a>&nbsp;|&nbsp;
                                            <?php
                                            $userData = Session::get('user_data');
                                            $roleId = (!empty($userData) ? $userData['role_id']:0);
                                            if(isset($delete_action) && $delete_action==true && $roleId == 1){
                                            ?>
                                            <a href="javascript:void(0)" class="delete-record text-danger" id="<?php echo $id; ?>" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
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
                    <!-- /.box-body -->
                </div>
            </div>
        </div>        
    </section>
    <!-- /.content -->
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
        var reqUrl = SITE_URL+'/admin/product/arrange';
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
                        location.href = SITE_URL+'/admin/product/delete/'+ele_id;
                    }
                }
            });
        }
    });
    
});
</script>
@endsection