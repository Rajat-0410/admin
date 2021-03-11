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
                                <a href="{!! url('admin/slider/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Slider</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(count($all_records) > 0)
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-center" width="12%">Status</th>
                                    <th>Created Date</th>
                                    <th>Action/s</th>
                                </tr>
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id = base64_encode($row->id);
                                        $status = $row->status;
                                        $statusText  = ($status==1) ? 'Active':'Inactive';
                                        $statusClass = ($status==1) ? 'label-success':'label-danger';
                                    ?>
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td class="text-center" width="12%">
                                            <a href="javascript:void(0)" class="change-status" id="post-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="Slider"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                        </td>
                                        <td>{{ date('Y/m/d H:i A',strtotime($row->created_at)) }}</td>
                                        <td>
                                            <a href="{!! url('admin/slider/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>&nbsp;|&nbsp;
                                            <a href="{!! url('admin/slider-images', ['id' => $id]) !!}" class="btn btn-xs btn-theme" title="Upload Images" data-toggle="tooltip"><i class="fa fa-cloud-upload"></i></a>&nbsp;|&nbsp;
                                            <a href="javascript:void(0)" class="delete-record" id="<?php echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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
    
    // jQuery
    $("#uploadMedia").dropzone({ 
        url: "/admin/upload-media-image",
        uploadprogress: true,
        acceptedFiles: 'image/*',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, done) {
            console.log(file);
            console.log(done);
            // var status = response.status;
            // var message = response.message;
            alert('success');
        }
    });
//    var myDropzone = new Dropzone("#uploadMedia", {
//        url: "/admin/upload-media-image",
//        uploadprogress: true,
//        acceptedFiles: 'image/*',
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        }
//    });
    
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