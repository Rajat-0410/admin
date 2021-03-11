@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($all_records); exit;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $news_title }}<small>Gallery</small></h1>
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
                            <div class="col-md-4 col-xs-4">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-md-7 col-xs-4 text-right">
                                <div style="display: none;" id="actionLogMessage"></div>
                            </div>
                            <div class="col-md-1 col-xs-4 text-right">
                                <a href="{!! url('admin/news') !!}" class="btn btn-info btn-flat pull-right">Back</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body pad" style="min-height: 340px;">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-danger alert-dismissible dropzone-alert" id="sliderListingPageDangerAlert" style="display: none;">
                                    <h6><i class="icon fa fa-ban"></i> <span>Alert!</span> <span style="margin-left: 10px;" id="sliderListingPageAlertText"></span></h6>
                                </div>
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
                                <span class="help-block">(Dimension: 1920px * 1080px & <?php echo $allowfiletypetext;?> : <?php echo $filetype;?>)</span>
                            </div>
                        </div>
                        <br>
                        <div class="row img-row" id="mediaCont">
                            @if(count($all_records) > 0)
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id = $row->id;
                                        $image = $row->image;
                                    ?>
                                    <div class="col-md-2 img-col" id="img<?php echo $id; ?>">
                                        <div class="img-container">                                            
                                            <img src="{{ asset("uploads/news-gallery-images/thumbnail/$news_id/$image") }}" class="img-responsive" title="{{ $image }}">
                                        </div>
                                        <div class="img-actions">
                                            <a href="javascript:void(0)" class="view-img" data-toggle="tooltip" title="{{ $image }}"><i class="fa fa-search"></i></a>&nbsp;
                                            <?php
                                            $userData = Session::get('user_data');
                                            $roleId = (!empty($userData) ? $userData['role_id']:0);
                                            if($roleId == 1){
                                            ?>
                                            <a href="javascript:void(0)" class="remove-img" data-id="<?php echo $id; ?>" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
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
    var newsId = '<?php echo $news_id; ?>';
    var encNewsId = '<?php echo base64_encode($news_id); ?>';
    var fileWidth = parseInt(1920);
    var fileHeight = parseInt(1080);
    // jQuery
    var uploader = new Dropzone('#upload-widget', {
        url: "/admin/news-gallery/upload",
        maxFilesize: 6, // MB
        maxFiles: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            // Register for the thumbnail callback.
            // When the thumbnail is created the image dimensions are set.
            this.on("thumbnail", function(file) {
                // Do the dimension checks you want to do
                // console.log("file width => "+file.type+" file.height => "+file.height)
                if (file.width==fileWidth && file.height==fileHeight) {
                    file.acceptDimensions()
                    // console.log("success =>")
                } else {
                    file.rejectDimensions();
                    // console.log("failed =>")
                }
            });
        },
        // Instead of directly accepting / rejecting the file, setup two
        // functions on the file that can be called later to accept / reject
        // the file.
        accept: function(file, done) {
            file.acceptDimensions = done;
            file.rejectDimensions = function() { 
                // done("Invalid dimension.");
                $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('Invalid dimension');
                $("#sliderListingPageDangerAlert").show();
                setTimeout(function(){ $("#sliderListingPageDangerAlert").hide(); }, 5000);
                $("#sliderListingPageAlertText").html("Invalid dimension. (Valid image dimension W:"+fileWidth+"px * H:"+fileHeight+"px)");
            };
            // Of course you could also just put the `done` function in the file
            // and call it either with or without error in the `thumbnail` event
            // callback, but I think that this is cleaner.
        }
    });
    
    // Custom Form Data
    uploader.on('sending', function(file, xhr, formData){
        formData.append('news_id', encNewsId);
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
                                    '<img src="'+SITE_URL+'/uploads/news-gallery-images/thumbnail/'+newsId+'/'+data.image+'" class="img-responsive" title="" id="">'+
                                '</div>'+
                                '<div class="img-actions">'+
                                    '<a href="javascript:void(0)" class="view-img" data-toggle="tooltip" title="'+data.image+'"><i class="fa fa-search"></i></a>&nbsp;'+
                                    '<a href="javascript:void(0)" class="remove-img" data-id="'+data.id+'"><i class="fa fa-trash-o"></i></a>'+
                                '</div>'+
                            '</div>';
            // console.log(htmlCont);
            // $("#mediaCont").empty();
            $("#mediaCont").prepend(htmlCont);
        } else {
            // alert(message);
            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message);
            $("#sliderListingPageDangerAlert").show();
            setTimeout(function(){ $("#sliderListingPageDangerAlert").hide(); }, 5000);
            $("#sliderListingPageAlertText").html(message);
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
        var last_updated_date = $("#last_updated_date").val();
        var slider_name = '';
        var redirectUrl = '<a href="'+SITE_URL+'/admin/action-logs/history/slider-image-gallery/0/'+encNewsId+'" class="btn btn-xs btn-theme text-aqua" data-toggle="tooltip" title="View All Logs"><i class="fa fa-history"></i></a>';
        var message_html = '<strong>'+slider_name+'</strong> has been updated by <strong>'+last_updated_by+'<strong> at '+last_updated_date+'. '+redirectUrl;
        $("#actionLogMessage").show().html(message_html);
    } else {
        $("#actionLogMessage").hide().html('');
    }
    
    // remove-img
    $("#mediaCont").on("click",".remove-img", function(){
        var ele_id = $(this).attr('data-id');
        var parentId = $(this).closest('.img-col').attr('id');
        if(ele_id != ''){
            var reqUrl = SITE_URL+'/admin/news-gallery/delete';
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
    
});
</script>
@endsection