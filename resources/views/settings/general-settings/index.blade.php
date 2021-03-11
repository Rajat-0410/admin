@extends('layouts.admin')

@section('page-content')
<?php 
// print("<pre>"); print_r($arr_general_settings); exit;
$go_youtube_live = 0;
$is_go_youtube_live = false;
if(!empty($arr_general_settings)){
    $go_youtube_live = $arr_general_settings[0]->value;
    $is_go_youtube_live = (bool)$arr_general_settings[0]->value;
}
?>
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
                <div class="alert" id="alertMessage" style="display: none;"></div>
                           
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <!--<a href="{!! url('admin/page/add') !!}" class="btn btn-primary btn-med pull-right">Add New Page</a>-->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                                        
                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-md-1 col-sm-2 col-xs-12 text-center text-danger">
                                <i class="fa fa-lg fa-youtube"></i>
                            </div>
                            <div class="col-md-9 col-sm-4 col-xs-12">
                                <strong>Go YouTube Live</strong>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <label class="switch">
                                    {!! Form::checkbox('go_youtube_live',$go_youtube_live,$is_go_youtube_live,['class' => 'change-setting', 'id' => 'youtube_live', 'data-group' => 'live-stream', 'data-key' =>'youtube']) !!}
                                    <div class="slider round"><span class="on">Yes</span><span class="off">No</span></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>        
    </section>
    <!-- /.content -->
</div>
<style>
.disabled{ cursor: not-allowed; }
.switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #c5c5c5;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(55px);
  -ms-transform: translateX(55px);
  transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.on
{
  display: none;
}

.on, .off
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  font-size: 13px;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

.disabled-slider{
    background-color: #c5c5c5 !important;
}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.text-aqua{ color: #00c0ef !important; }
.row-title{ font-weight: bold; color: #00c0ef; }

</style>
<script>
jQuery(document).ready(function(){
      
    // Change Status Function
    $(".change-setting").on("click",function(e){

        // change-status
        var ele_id = $(this).attr('id');
        var ele_val = ($('#' + ele_id).is(":checked")==true) ? 1:0;
        var ele_group = $(this).attr('data-group');
        var ele_key = $(this).attr('data-key');
        // console.log("go_youtube_live => "+ele_val);
        if(ele_group != '' && ele_key != ''){
            var reqUrl = SITE_URL+'/admin/general-settings/change-settings';
            var reqData = 'group='+ele_group+'&key='+ele_key+'&value='+ele_val;
            // alert(reqUrl+' - '+reqData); // return false;
            $.ajax({
                type: "POST",
                url: reqUrl,
                data: reqData,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
//                    $("#web_loader_overlay").show();
//                    $("#web_loader_img").show();
                },
                complete: function() {
//                    $("#web_loader_overlay").hide();
//                    $("#web_loader_img").hide();
                },
                success: function(response) {
                    var status = response.status;
                    var message = response.message;
                    // alert(status+'~'+message); return false;
                    if (status == 1) {
                        $("#alertMessage").removeClass('alert-danger').addClass('alert-success');
                        $("#alertMessage").fadeIn().html('<p><i class="icon fa fa-check"></i> '+message+'</p>');
                    } else {
                        $("#alertMessage").removeClass('alert-success').addClass('alert-danger');
                        $("#alertMessage").fadeIn().html('<p><i class="icon fa fa-check"></i> '+message+'</p>');
                    }
                    setTimeout(function() { $("#alertMessage").fadeOut() }, 5000);
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