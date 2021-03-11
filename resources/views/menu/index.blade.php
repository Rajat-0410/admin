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
                                <a href="{!! url('admin/menu/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Menu</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(!empty($all_records))
                                <tr>
                                    <th>Name</th>
                                    <th>Menu Group</th>
                                    <th>Parent Menu</th>
                                    <th>Slug</th>
                                    <th class="text-center" width="8%">Status</th>
                                    <th>Created At</th>
                                    <th>Action/s</th>
                                </tr>
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id = base64_encode($row->id);
                                        $groupId = $row->group_id;
                                        $parentId = $row->parent_id;
                                        $parentName = (!empty($row->parent_name) ? $row->parent_name:'N/A');
                                        $status = $row->status;
                                        $statusText  = ($status==1) ? 'Active':'Inactive';
                                        $statusClass = ($status==1) ? 'label-success':'label-danger';
                                    ?>
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $menu_types[$groupId] }}</td>
                                        <td>{{ $parentName }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td class="text-center" width="8%">
                                            <a href="javascript:void(0)" class="change-status" id="menu-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="Menu"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                        </td>
                                        <td>{{ date('Y/m/d H:i A',strtotime($row->created_at)) }}</td>
                                        <td>
                                            <a href="{!! url('admin/menu/edit', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-pencil"></i></a>&nbsp;|&nbsp;
                                            <!--<a href="{!! url('admin/menu/delete', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-trash"></i></a>-->
                                            <a href="javascript:void(0)" class="delete-record" id="<?php echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach                               
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
                        location.href = SITE_URL+'/admin/menu/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection