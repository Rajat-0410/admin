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
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <a href="{!! url('admin/gallery-video/add',['id' => $gallery_id]) !!}" class="btn btn-primary btn-flat">Add New</a>
                                <a href="{!! url('admin/gallery-video') !!}" class="btn btn-info btn-flat">Back</a> 
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-6">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-6 text-right">
                                
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(count($all_records) > 0)
                                <tr>
                                    <th>Banner</th>
                                    <th>Mobile Banner</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Height</th>
                                    <th>Width</th>
                                    <th class="text-center" width="10%">Status</th>
                                    <th>Publish Date</th>
                                    <th>Action/s</th>
                                </tr>
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id = base64_encode($row->id);
                                        $type = $row->type;
                                        $title = $row->title;
                                        $height = $row->height;
                                        $width = $row->width;
                                        $image = $row->image;
                                        $mobile_image = $row->mobile_image;
                                        $status = $row->status;
                                        $statusText  = ($status==1) ? 'Active':'Inactive';
                                        $statusClass = ($status==1) ? 'label-success':'label-danger';
                                        // 
                                        $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if(!empty($image)){ ?>
                                            <img src="{{ asset("uploads/media-images/thumbnail/$image") }}">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($mobile_image)){ ?>
                                            <img src="{{ asset("uploads/media-images/thumbnail/$mobile_image") }}">
                                            <?php } ?>
                                        </td>
                                        <td>{{ $type }}</td>
                                        <td>{{ $title }}</td>
                                        <td>{{ $height }}</td>
                                        <td>{{ $width }}</td>
                                        <td class="text-center" width="10%">
                                            <a href="javascript:void(0)" class="change-status" id="manage-event-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="SliderBanner"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                        </td>
                                        <td>{{ $updated_at }}</td>
                                        <td>
                                            <a href="{!! url('admin/manage-slider-banner/category/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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
                        location.href = SITE_URL+'/admin/manage-event/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection