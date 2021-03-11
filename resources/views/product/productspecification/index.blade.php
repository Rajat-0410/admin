@extends('layouts.admin')

@section('page-content')
<?php  //print("<pre>"); print_r($all_records); exit('xcvxkvbhcxhjvbhj');?>
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

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <a href="{!! url('admin/productspecification/add',['id' => $productId]) !!}" class="btn btn-primary btn-flat">Add New Specification</a>
                                <a href="{!! url('admin/product') !!}" class="btn btn-info btn-flat">Back</a> 
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(count($all_records) > 0)
                                <tr>
                                    <th>Group</th>
                                    <th>Attribute</th>
                                    <th>Value</th>   
                                    <th class="text-center" width="10%">Status</th>
                                    <th>Is Featured</th>
                                    <!-- <th>Order</th> -->
                                    <th>Last Updated By</th>
                                    <th>Last Updated Date</th>
                                    <th width="100px;">Action/s</th>
                                </tr>
                                <tbody id="sortable">
                                @foreach($all_records as $row)
                                    <?php 
                                        // print("<pre>"); print_r($row); exit; 
                                        $id = base64_encode($row->id);
                                        $status = $row->status;
                                        $statusText  = ($status==1) ? 'Active':'Inactive';
                                        $statusClass = ($status==1) ? 'label-success':'label-danger';

                                        $is_featured = $row->is_featured;
                                        $isfeaturedText  = ($is_featured==1) ? 'Is Featured':'Not Featured';
                                        $isfeaturedClass = ($is_featured==1) ? 'label-success':'label-danger';

                                        // $order_by= $row->order_by;
                                        // $orderbyText  = ($is_featured) ? $order_by:'Is Featured Not Set';
                                        // latest_action_log
                                        $user_id = $row->latest_action_log['user_id'];
                                        $user_name = (isset($row->latest_action_log->user->name) ? $row->latest_action_log->user->name:'-');
                                        
                                        $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                    ?>
                                    <?php if($is_featured) {?>
                                        <tr id="<?php echo $row->id;?>">
                                    <?php } else{?>
                                        <tr>
                                    <?php } ?>
                                        <td>{{ $row->groupname }}</td>
                                        <td>{{ $row->attributename }}</td>
                                        <td>{{ $row->value }}</td>
                                        <td class="text-center" width="10%">
                                            <a href="javascript:void(0)" class="change-status" id="post-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="ProductSpecification"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                        </td>
                                        <td class="text-center" width="10%">
                                            <span class="label <?php echo $isfeaturedClass; ?>"><?php echo $isfeaturedText; ?></span>
                                        </td>
                                        <td>
                                            {{ $user_name }}
                                            <?php if($user_name!='-'){ ?>
                                            <a href="{!! url('admin/action-logs/history/productspecification', ['recordId' => $id, 'productId' => $productId]) !!}" class="btn btn-xs btn-theme text-aqua" data-toggle="tooltip" title="View All Logs"><i class="fa fa-history"></i></a>
                                            <?php } ?>
                                        </td>
                                        <td>{{ $updated_at }}</td>
                                        <td>
                                            <a href="{!! url('admin/productspecification/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-pencil"></i></a>
                                            <?php
                                            $userData = Session::get('user_data');
                                            $roleId = (!empty($userData) ? $userData['role_id']:0);
                                            if($roleId == 1){
                                            ?>
                                            &nbsp;|&nbsp;<a href="javascript:void(0)" class="delete-record" id="<?php echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                            <?php if($is_featured) { ?>
                                            &nbsp;|&nbsp;<a href="javascript:void(0)" id="" title="Drag And Drop" data-toggle="tooltip"><i class="fa fa-arrows handle ui-sortable-handle"></i></a>
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
        // console.log(sortedIDs);
        // alert(sortedIDs);
        var reqUrl = SITE_URL+'/admin/productspecification/arrange';
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
                console.log(response);
                // if(response.status == 1 ){ 
                //     $(".orderArrange").removeClass('hide');
                //     $('#orderArrange').text(response.message);
                // }
            }
        })
    }
    });
$('#sortable').disableSelection();
});


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
                        location.href = SITE_URL+'/admin/productspecification/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection