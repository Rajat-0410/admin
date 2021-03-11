<!--modal-default-->
<div class="modal fade browse-media-mobile-banner-image" id="browse-media-mobile-banner-image-modal" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Browse Videos</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <div class="alert alert-danger alert-dismissible dropzone-alert" id="mobileBannerImageDangerAlert" style="display: none;">
                        <h6><i class="icon fa fa-ban"></i> <span>Alert!</span> <span style="margin-left: 10px;" id="mobileBannerImageDangerAlertText"></span></h6>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#mobile-banner-image-upload" data-toggle="tab" aria-expanded="true">Upload Files</a></li>
                        <li class="active"><a href="#mobile-banner-image-media" data-toggle="tab" aria-expanded="false">Media Files</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="mobile-banner-image-upload">
                            <form id="mobile-banner-image-upload-widget" method="post" action="" class="dropzone-upload">
                                <div class="fallback">
                                  <input name="file" type="file" />
                                </div>
                                <div class="dz-message needsclick text-center">
                                    Drop files here OR click here to upload an image.
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="mobile-banner-image-media">
                            <div class="media-container">
                                <div class="row media-cont" id="mobBannerImgMediaCont"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary disabled select-btn-mob-banner-img">Select</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
jQuery(document).ready(function(){
    // Media Type
    var gallery_id = parseInt(<?php echo $video_gallery_id; ?>);
    var groupType='web-video';
    // var fileWidth = parseInt(1080);
    // var fileHeight = parseInt(1050);
    
    $('#browse-media-mobile-banner-image-modal').on('shown.bs.modal', function() {
        getMobBannerMediaImages(gallery_id, groupType);
    })
    
    // jQuery
    var uploader = new Dropzone('#mobile-banner-image-upload-widget', {
        url: "/admin/gallery-video/uploadVideo",
        maxFilesize: 6,
        acceptedFiles: "video/*",
        addRemoveLinks: true,
        dataType: "HTML",
        timeout: 180000,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    // var uploader = new Dropzone('#mobile-banner-image-upload-widget', {
    //     url: "/admin/gallery-video/uploadVideo",
    //     maxFilesize: 6, // MB
    //     maxFiles: 1,
    //     acceptedFiles: 'video/*',
    //     addRemoveLinks: true,
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     init: function() {
    //         // Register for the thumbnail callback.
    //         // When the thumbnail is created the image dimensions are set.
    //         // this.on("thumbnail", function(file) {
    //         //     console.log(gallery_id);
    //         //     file.acceptDimensions()
    //         //     // Do the dimension checks you want to do
    //         //     //console.log("file width => "+file.width+" file.height => "+file.height)
    //         //     // if (file.width==fileWidth && file.height==fileHeight) {
    //         //         // file.acceptDimensions()
    //         //         // console.log("success =>")
    //         //     // } else {
    //         //         // file.rejectDimensions();
    //         //         // console.log("failed =>")
    //         //     // }
    //         // });
    //     },
    //     // Instead of directly accepting / rejecting the file, setup two
    //     // functions on the file that can be called later to accept / reject
    //     // the file.
    //     accept: function(file, done) {
    //         file.acceptDimensions = done;
    //         file.rejectDimensions = function() { 
    //             // done("Invalid dimension.");
    //             $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('Invalid dimension');
    //             $("#mobileBannerImageDangerAlert").show();
    //             setTimeout(function(){ $("#mobileBannerImageDangerAlert").hide(); }, 5000);
    //             // $("#mobileBannerImageDangerAlertText").html("Invalid dimension. (Valid image dimension W:"+fileWidth+"px * H:"+fileHeight+"px)");
    //         };
    //         // Of course you could also just put the `done` function in the file
    //         // and call it either with or without error in the `thumbnail` event
    //         // callback, but I think that this is cleaner.
    //     }
    // });
    
    // Custom Form Data
    uploader.on('sending', function(file, xhr, formData){
        formData.append('gallery_id', gallery_id);
        formData.append('group_type', groupType);
    });
    
    // upload success
    uploader.on('success', function( file, resp ){
        // console.log( file ); 
        var response = JSON.parse(resp);
        // console.log( response ); console.log( response.status );
        var status = response.status;
        var message = response.message;
        if(status=='1'){
            uploader.removeFile(file);
            var data = response.data;
            // console.log(data);
            var htmlCont = '<div class="col-md-2 img-col" id="img'+data.id+'">'+
                                '<div class="img-container">'+
                                    '<video src="'+SITE_URL+'/gallery/videos/original/'+gallery_id+'/'+data.image+'" class="img-responsive" title="" id="">'+
                                '</div>'+
                                '<div class="img-actions">'+
                                    '<input type="checkbox" name="media_image" class="select-img" value="'+data.image+'">'+                                   
                                    '<a href="javascript:void(0)" class="remove-img" data-id="'+data.id+'"><i class="fa fa-trash-o"></i></a>'+
                                '</div>'+
                            '</div>';
            // console.log(htmlCont);
            // $(".media-cont").empty();
            $(".media-cont").prepend(htmlCont);
        } else {
            // alert(message);
            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message);
            $("#mobileBannerImageDangerAlert").show();
            setTimeout(function(){ $("#mobileBannerImageDangerAlert").hide(); }, 5000);
            $("#mobileBannerImageDangerAlertText").html(message);
            return false;
        }
    });
    // 
    uploader.on("complete", function(file) {
        // uploader.removeFile(file);
    });
    
    $(".media-cont").on("click",".select-img", function(){
        $('.select-img').not(this).prop('checked', false);
        var isChecked = $(this).is(":checked")
        // console.log(isChecked);
        if(isChecked){
            $('.select-btn-mob-banner-img').removeClass('disabled');
        } else {
            $('.select-btn-mob-banner-img').addClass('disabled');
        }
    });
    
    $(".modal-footer").on("click",".select-btn-mob-banner-img", function(){
        var media_image = $('input[name="media_image"]:checked').val();
        var parentId = $('input[name="media_image"]:checked').parent().parent().attr('id');
        var media_image_src = $('#'+parentId).find('.img-responsive').attr('src');
        // alert(media_image_src); // return false;
        if(media_image != ''){
            $('#mobile_banner_image').val(media_image);
            $('#setMobBannerImage').addClass('hide');
            $('#replaceMobBannerImage').removeClass('hide').addClass('show');
            $('#showMobBannerMediaImageCont').removeClass('hide').addClass('show');
            $('#removeMobBannerImage').removeClass('hide').addClass('show');
            $('#showMobBannerMediaImage').attr('src',media_image_src);
            $('#browse-media-mobile-banner-image-modal').modal('hide');
        }
    });
        
    // removeFeaturedImage
    $("#removeMobBannerImage").on("click", function(){
        // alert('dsaasasd')
        $('#mobile_banner_image').val('');
        $('#setMobBannerImage').removeClass('hide').addClass('show');
        $('#replaceMobBannerImage').removeClass('show').addClass('hide');
        $('#showMobBannerMediaImageCont').removeClass('show').addClass('hide');
        $('#removeMobBannerImage').removeClass('show').addClass('hide');
        $('#showMobBannerMediaImage').attr('src','');
    });
    
});

    // Get Media Images
    function getMobBannerMediaImages(gallery_id, groupType){
        var loadCont = true;
        if(loadCont){
            var reqUrl = SITE_URL+'/admin/gallery-video/get-media-image';
            var reqData = 'load_cont='+loadCont+'&gallery_id='+gallery_id+'&groupType='+groupType;
            // alert(reqUrl+' - '+reqData); return false;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(response) {
                    var status = response.status;
                    var message = response.message;
                    // alert(status);
                    if (status == 1) {
                        var data = response.data;
                        // console.log(data);
                        var htmlCont = '';
                        if(data != ''){
                            $.each(data, function(key,value) {
                                // console.log('key => '+key+ 'value => '+value.id);
                                htmlCont += '<div class="col-md-2 img-col" id="img'+value.id+'">'+
                                                '<div class="img-container"><label>'+
                                                    '<video src="'+SITE_URL+'/gallery/videos/original/'+gallery_id+'/'+value.image+'" class="img-responsive" title="" id="">'+
                                                '</label></div>'+
                                                '<div class="img-actions">'+
                                                    '<input type="checkbox" name="media_image" class="select-img" value="'+value.image+'">'+                                   
                                                    '<a href="javascript:void(0)" class="remove-img" data-id="'+value.id+'"><i class="fa fa-trash-o"></i></a>'+
                                                '</div>'+
                                            '</div>';
                                        });
                            // console.log(htmlCont);
                            $("#mobBannerImgMediaCont").empty().html(htmlCont);
                        } else {
                            var message = response.message;
                            $("#mobBannerImgMediaCont").empty().html('<div class="col-md-12 text-center"><strong>'+message+'</strong></div>');
                        }
                    } else {
                        var message = response.message;
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
    }

</script>