// COMMON JS => START

jQuery(document).ready(function(){
     
    // tooltip
    $('[data-toggle="tooltip"]').tooltip(); 
    
    // remove media img
    $(".modal").on("click",".remove-img", function(){
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
        
    // Change Status Function
    $(".change-status").on("click",function(e){
        // change-status
        var ele_id = $(this).attr('id');
        var ele_attr_id = $(this).attr('data-id');
        var ele_attr_status = $(this).attr('data-status');
        var ele_attr_model = $(this).attr('data-model');
        // console.log(ele_id); return false;
        if(ele_attr_id != '' && ele_attr_status != '' && ele_attr_model != ''){

            $(this).find('span').html('<i class="fa fa-spinner fa-pulse"></i>');
            var reqUrl = SITE_URL+'/admin/change-status';
            var reqData = 'req_id='+ele_attr_id+'&req_status='+ele_attr_status+'&req_model='+ele_attr_model;
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
                    var status_text = response.status_text;
                    var message = response.message;
                    // alert(status_code+'~'+status_desc+'~'+message);
                    if (status == 1) {
                        var spanText = status_text;
                        // var spanClass = (status_desc=='active') ? 'label-success':'label-danger';
                        $("#"+ele_id).find('span').html(spanText);
                        if(status_text=='Active'){
                            $("#"+ele_id).attr('data-status', '0');
                            $("#"+ele_id).find('span').removeClass('label-danger').addClass('label-success');
                        }else{
                            $("#"+ele_id).attr('data-status', '1');
                            $("#"+ele_id).find('span').removeClass('label-success').addClass('label-danger');
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
        
    // Post Form Validation => START
    jQuery("#postForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "title":{
                required: true
            },
            "slug":{
                required: true
            }
        },
        messages:{
            "title":{
                required: "Please enter title"
            },
            "slug":{
                required:"Please enter slug"
            }
        }
    });
    // Post Form Validation => END
    
    // Page Form Validation => START
    jQuery("#pageForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "title":{
                required: true
            },
            "slug":{
                required: true
            }
        },
        messages:{
            "title":{
                required: "Please enter title"
            },
            "slug":{
                required:"Please enter slug"
            }
        }
    });
    // Page Form Validation => END
    
    var page_content = $("#page_content").length;
    if(page_content > 0){
        // alert(page_content);
        CKEDITOR.replace( 'page_content', {
            height: '20em',
            toolbarGroups: [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                // { name: 'forms', groups: [ 'forms' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'others', groups: [ 'others' ] },
                // { name: 'about', groups: [ 'about' ] }
            ]
            // NOTE: Remember to leave 'toolbar' property with the default value (null).
            // 
            // config.removeButtons = 'Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Form,About';
        });
    }    
        
});
// COMMON JS => END

// state_change_common
function stateChangeCommon(result_year_id) {      
    if(result_year_id != 0){
        var reqUrl = SITE_URL+'/admin/get-rounds';
        var reqData = 'result_year_id='+result_year_id;
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
                $("#web_loader_overlay").show();
                $("#web_loader_img").show();
            },
            complete: function() {
                $("#web_loader_overlay").hide();
                $("#web_loader_img").hide();
            },
            success: function(response) {
                // var response = JSON.parse(resp);
                var status = response.status;                    
                // alert(status); return false;
                if(status == 1){
                    var data = response.data;
                    var selectHtml = '';
                    if(data != ''){
                        $.each(data, function(key,value) {
                            selectHtml += '<option value="'+value.round_id+'">'+value.round_name+'</option>';
                        });
                    }
                    $("#round_id").html(selectHtml);
                } else {
                    alert("Something went wrong");
                }
            }
        });
    }
}