@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($all_records); exit;?>
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
                
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-md-7 col-xs-12 text-right">
                                <div style="display: none;" id="actionLogMessage"></div>
                            </div>
                            <div class="col-md-1 col-xs-12 text-right">
                                <!--<a href="{!! url('admin/slider/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Slider</a>-->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body pad" style="min-height: 340px;">
                        
                        <div class="row">
                            <div class="col-xs-12">
                                
                                <form id="upload-widget" method="post" action="" class="dropzone-upload">
                                    <div class="fallback">
                                      <input name="file" type="file" />
                                    </div>
                                    <div class="dz-message needsclick text-center">
                                        Drop files here OR click here to upload an image.
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <span class="help-block">(<?php echo $allowfiletypetext;?> : <?php echo $filetype;?>)</span>
                            </div>
                        </div>
                        <br>
                        <div class="row img-row" id="mediaCont">
                            @if(count($all_records) > 0)
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id = $row->id;
                                        $title = $row->title;
                                        $image = $row->image;
                                        // latest_action_log
                                        $user_id = $row->latest_action_log['user_id'];
                                        $action = $row->latest_action_log['action'];
                                        $user_name = (isset($row->latest_action_log->user->name) ? $row->latest_action_log->user->name:'-');
                                        // 
                                        $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                    ?>
                                    <?php if(!empty($user_name) ){ ?>
                                    <input type="hidden" id="last_updated_by" value="<?php echo $user_name; ?>">
                                    <?php } ?>
                                    <?php if(!empty($action) ){ ?>
                                    <input type="hidden" id="last_updated_action" value="<?php echo $action; ?>">
                                    <?php } ?>
                                    <?php if(!empty($updated_at) ){ ?>
                                    <input type="hidden" id="last_updated_date" value="<?php echo $updated_at; ?>">
                                    <?php } ?>
                                    <div class="col-md-2 img-col" id="img<?php echo $id; ?>">
                                        <div class="img-container">                                            
                                            <img src="{{ asset("uploads/media-images/thumbnail/$image") }}" class="img-responsive" title="{{ $title }}">
                                        </div>
                                        <div class="img-actions">
                                            <a href="javascript:void(0)" class="view-img"><i class="fa fa-search"></i></a>&nbsp;
                                            <?php
                                            $userData = Session::get('user_data');
                                            $roleId = (!empty($userData) ? $userData['role_id']:0);
                                            if($roleId == 1){
                                            ?>
                                            <a href="javascript:void(0)" class="remove-img" data-id="<?php echo $id; ?>"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                            <div class="col-md-12 text-center">
                                <strong>{{ $no_records_found }}</strong>
                            </div>                        
                            @endif
                        </div>
                        
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
<script>
jQuery(document).ready(function(){
    
    // jQuery
    var uploader = new Dropzone('#upload-widget', {
        url: "/admin/upload-media-image",
        maxFilesize: 6, // MB
        maxFiles: 1,
        acceptedFiles: 'image/*',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // upload success
    uploader.on('success', function( file, resp ){
        // console.log( file ); 
        var response = JSON.parse(resp);
        // console.log( response ); console.log( response.status );
        var status = response.status;
        var message = response.message;
        if(status=='1'){
            var data = response.data;
            // console.log(data);
            var htmlCont = '<div class="col-md-2 img-col" id="img'+data.id+'">'+
                                '<div class="img-container">'+
                                    '<img src="'+SITE_URL+'/uploads/media-images/thumbnail/'+data.image+'" class="img-responsive" title="" id="">'+
                                '</div>'+
                                '<div class="img-actions">'+
                                    '<a href="javascript:void(0)" class="view-img"><i class="fa fa-search"></i></a>&nbsp;'+
                                    '<a href="javascript:void(0)" class="remove-img" data-id="'+data.id+'"><i class="fa fa-trash-o"></i></a>'+
                                '</div>'+
                            '</div>';
            // console.log(htmlCont);
            // $("#mediaCont").empty();
            $("#mediaCont").prepend(htmlCont);
        } else {
            alert(message);
            return false;
        }
    });
    // 
    uploader.on("complete", function(file) {
        uploader.removeFile(file);
    });
    
    // actionLogMessage
    var ele_length = $("#last_updated_by").length;
    if(ele_length > 0){
        var last_updated_by = $("#last_updated_by").val();
        var last_updated_action = $("#last_updated_action").val();
        var last_updated_date = $("#last_updated_date").val();
        var product_name = 'Media';
        var redirectUrl = '<a href="'+SITE_URL+'/admin/action-logs/history/media/0/0" class="btn btn-xs btn-theme text-aqua" data-toggle="tooltip" title="View All Logs"><i class="fa fa-history"></i></a>';
        var message_html = '<strong>'+product_name+'</strong> has been '+last_updated_action+' by <strong>'+last_updated_by+'<strong> at '+last_updated_date+'. '+redirectUrl;
        $("#actionLogMessage").show().html(message_html);
    } else {
        $("#actionLogMessage").hide().html('');
    }
    
    // remove-img
    $("#mediaCont").on("click",".remove-img", function(){
        var ele_id = $(this).attr('data-id');
        var parentId = $(this).closest('.img-col').attr('id');
        if(ele_id != ''){
            var reqUrl = SITE_URL+'/admin/media/delete';
            var reqData = 'img_id='+ele_id;
            // alert(reqUrl+' - '+reqData); // return false;
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
                    // alert(status);
                    if (status == 1) {
                        $('#'+parentId).fadeOut(300, function(){ $(this).remove();});
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
                        location.href = SITE_URL+'/admin/slider/delete/'+ele_id;
                    }
                }
            });
        }
    });
    
});
</script>
@endsection