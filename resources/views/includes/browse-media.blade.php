<!--modal-default-->
<div class="modal fade media-browse" id="media-browse-modal" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Browse Images</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#upload" data-toggle="tab" aria-expanded="true">Upload Files</a></li>
                        <li class="active"><a href="#media" data-toggle="tab" aria-expanded="false">Media Files</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="upload">
                            <div class="alert alert-danger alert-dismissible dropzone-alert" id="browseMediaDangerAlert" style="display: none;">
                                <h6><i class="icon fa fa-ban"></i> <span>Alert!</span> <span style="margin-left: 10px;" id="browseMediaAlertText"></span></h6>
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="media">
                            <div class="media-container">
                                <div class="row" id="mediaCont"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary disabled select-btn">Select</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
jQuery(document).ready(function(){
    // Media Group Type
    var groupType='media';
    
    var checkDimensions = false;
    var fileWidth = parseInt(196);
    var fileHeight = parseInt(85);
    var maxSize = 0;
    
    $('#media-browse-modal').on('shown.bs.modal', function() {
        getMediaImages(groupType);
        if($('#checkDimensions').length > 0){ checkDimensions = (($("#checkDimensions").val()=='true') ? true:false); }
        if($('#dimensionsWidth').length > 0){ fileWidth = $("#dimensionsWidth").val(); }
        if($('#dimensionsHeight').length > 0){ fileHeight = $("#dimensionsHeight").val(); }
        if($('#maxSize').length > 0){ maxSize = $("#maxSize").val(); }
        //alert(checkDimensions+'--'+fileWidth+'--'+fileHeight+'--'+maxSize);
    })
    // 
    
    // jQuery
    var uploader = new Dropzone('#upload-widget', {
        url: "/admin/upload-media-image",
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
                // console.log("file width => "+file.width+" file.height => "+file.height)
                if(checkDimensions){
                    // checkDimensions => TRUE
                    if (file.width==fileWidth && file.height==fileHeight) {
                        file.acceptDimensions()
                        // console.log("success =>")
                    } else {
                        file.rejectDimensions();
                        // console.log("failed =>")
                    }
                } else {
                    // checkDimensions => FALSE
                    file.acceptDimensions()
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
                $("#browseMediaDangerAlert").show();
                setTimeout(function(){ $("#browseMediaDangerAlert").hide(); }, 5000);
                $("#browseMediaAlertText").html("Invalid dimension. (Valid image dimension W:"+fileWidth+"px * H:"+fileHeight+"px)");
            };
            // Of course you could also just put the `done` function in the file
            // and call it either with or without error in the `thumbnail` event
            // callback, but I think that this is cleaner.
        }
    });
    
    // Custom Form Data
    uploader.on('sending', function(file, xhr, formData){
        formData.append('group_type', groupType);
        formData.append('max_size', maxSize);
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
                                    '<input type="checkbox" name="media_image" class="select-img" value="'+data.image+'">'+                                   
                                    '<a href="javascript:void(0)" class="remove-img" data-id="'+data.id+'"><i class="fa fa-trash-o"></i></a>'+
                                '</div>'+
                            '</div>';
            // console.log(htmlCont);
            // $("#mediaCont").empty();
            $("#mediaCont").prepend(htmlCont);
        } else {
            // alert(message);
            $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message);
            $("#browseMediaDangerAlert").show();
            setTimeout(function(){ $("#browseMediaDangerAlert").hide(); }, 5000);
            $("#browseMediaAlertText").html(message);
            return false;
        }
    });
    // 
    uploader.on("complete", function(file) {
        uploader.removeFile(file);
    });
    
    $("#mediaCont").on("click",".select-img", function(){
        $('.select-img').not(this).prop('checked', false);
        var isChecked = $(this).is(":checked")
        // console.log(isChecked);
        if(isChecked){
            $('.select-btn').removeClass('disabled');
        } else {
            $('.select-btn').addClass('disabled');
        }
    });
    
    $(".modal-footer").on("click",".select-btn", function(){
        var media_image = $('input[name="media_image"]:checked').val();
        var parentId = $('input[name="media_image"]:checked').parent().parent().attr('id');
        var media_image_src = $('#'+parentId).find('.img-responsive').attr('src');
        if(media_image != ''){
            $('#featured_image').val(media_image);
            $('#setFeatureImage').addClass('hide');
            $('#replaceFeatureImage').removeClass('hide').addClass('show');
            $('#showMediaImageCont').removeClass('hide').addClass('show');
            $('#removeFeaturedImage').removeClass('hide').addClass('show');
            $('#showMediaImage').attr('src',media_image_src);
            $('#media-browse-modal').modal('hide');
        }
    });
    
    // removeFeaturedImage
    $("#removeFeaturedImage").on("click", function(){
        // alert('dsaasasd')
        $('#featured_image').val('');
        $('#setFeatureImage').removeClass('hide').addClass('show');
        $('#replaceFeatureImage').removeClass('show').addClass('hide');
        $('#showMediaImageCont').removeClass('show').addClass('hide');
        $('#removeFeaturedImage').removeClass('show').addClass('hide');
        $('#showMediaImage').attr('src','');
    });
    
});


    // Get Media Images
    function getMediaImages(groupType=''){
        var loadCont = true;
        var group_type = groupType;
        if(loadCont){
            var reqUrl = SITE_URL+'/admin/media/get-media-images';
            var reqData = 'load_cont='+loadCont+'&group_type='+group_type;
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
                                        '<img src="'+SITE_URL+'/uploads/media-images/thumbnail/'+value.image+'" class="img-responsive" title="" id="">'+
                                    '</label></div>'+
                                    '<div class="img-actions">'+
                                        '<input type="checkbox" name="media_image" class="select-img" value="'+value.image+'">'+                                   
                                        '<a href="javascript:void(0)" class="remove-img" data-id="'+value.id+'"><i class="fa fa-trash-o"></i></a>'+
                                    '</div>'+
                                '</div>';
                            });
                            // console.log(htmlCont);
                            $("#mediaCont").empty().html(htmlCont);
                        } else {
                            var message = response.message;
                            $("#mediaCont").empty().html('<div class="col-md-12 text-center"><strong>'+message+'</strong></div>');
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