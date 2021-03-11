@extends('layouts.admin')

@section('page-content')
<?php // print("<pre>"); print_r($status); exit;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_title; ?> <small>Categories</small></h1>
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
                                <!--<a href="{!! url('admin/user-permission/add') !!}" class="btn btn-primary btn-flat pull-right">Add Permission</a>-->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                    @if(count($all_records) > 0)
                                        <tr>
                                            <th>Name</th>
                                            <th>Publish Date</th>
                                            <th>Action/s</th>
                                        </tr>
                                        @foreach($all_records as $row)
                                            <?php // print_r($row); exit; 
                                                $id = base64_encode($row->id);
                                            ?>
                                            <tr>
                                                <td>{{ $row->role }}</td>
                                                <td>{{ date('Y/m/d H:i A',strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="{!! url('admin/user-permission/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <!--&nbsp;|&nbsp;-->
                                                   <!--  <a href="javascript:void(0)" class="delete-record" id="<?php //echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a> -->
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
<script>
jQuery(document).ready(function(){
    //delete-record
    // $(".delete-record").on("click",function(e){
    //     var ele_id = $(this).attr('id');
    //     if(ele_id != ''){
    //         bootbox.confirm({
    //             message: "Do you really want to delete this record?",
    //             buttons: {
    //                 confirm: {
    //                     label: 'Yes',
    //                     className: 'btn-success'
    //                 },
    //                 cancel: {
    //                     label: 'No',
    //                     className: 'btn-danger'
    //                 }
    //             },
    //             callback: function (result) {
    //                 console.log(ele_id+'-'+result);
    //                 if(result){
    //                     location.href = SITE_URL+'/admin/user-permission/delete/'+ele_id;
    //                 }
    //             }
    //         });
    //     }
    // });
});
</script>
@endsection