// COMMON JS => START
jQuery(document).ready(function(){
            
    // Change Status Function
    $(".set-cookie").on("click",function(e){
        // 
        // var ele_id = $(this).attr('id');
        var cookie_value = $(this).attr('data-cookie-value');
        // console.log(cookie_value);
        if(cookie_value != ''){
            var reqUrl = SITE_URL+'/set-cookie';
            var reqData = 'cookie_value='+cookie_value;
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
                    // alert(status_code+'~'+status_desc+'~'+message);
                    if (status == 1) {
                        $("#cookiePolicyCont").hide();
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
// COMMON JS => END