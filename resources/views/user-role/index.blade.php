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
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">Search</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></button>
                        </div><!-- /. tools -->
                    </div>
                    <div class="box-body">
                        {!! Form::open(['url' => 'admin/user-role', 'id' => 'addBookTestRide', 'method' => 'get', 'class' => '']) !!}
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group has-feedback {!! $errors->first('keyword', ' has-error') !!}">
                                        {!! Form::label('keyword','Keyword', ['class' => 'required']) !!}
                                        {!! Form::text('keyword',$keyword,['class' => 'form-control', 'placeholder' => 'keyword']) !!}
                                        {!! $errors->first('keyword', '<p class="help-block">:message</p>') !!}
                                        <p class="help-block"><strong>Search By:</strong> Name</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::submit('Search',['class' => 'btn btn-primary btn-med']) !!}&nbsp;&nbsp;
                                <a href="{!! url('admin/user-role') !!}" class="btn btn-default btn-med">Reset</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <!--<a href="{!! url('admin/post/category/add') !!}" class="btn btn-primary btn-flat pull-right">Add New Category</a>-->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                    @if(count($all_records) > 0)
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center" width="12%">Status</th>
                                            <th>Publish Date</th>
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
                                                <td>{{ $row->role }}</td>
                                                <td class="text-center" width="12%">
                                                    <a href="javascript:void(0)" class="change-status" id="post-cat-<?php echo base64_decode($id); ?>" data-id="<?php echo $id; ?>" data-status="<?php echo ($status==1) ? '0':'1'; ?>" data-model="UserRole"><span class="label <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></a>
                                                </td>
                                                <td>{{ date('Y/m/d H:i A',strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="<?php echo SITE_URL.'/admin/user-role/?id='.$id; ?>" class="btn btn-xs btn-theme"><i class="fa fa-pencil"></i></a>
                                                    <!--<a href="{!! url('admin/post/category/delete', ['id' => $id]) !!}" class="btn btn-xs btn-theme"><i class="fa fa-trash"></i></a>-->
                                                    <?php
                                                    $userData = Session::get('user_data');
                                                    $roleId = (!empty($userData) ? $userData['role_id']:0);
                                                    if($roleId == 1){
                                                    ?>&nbsp;|&nbsp;<a href="javascript:void(0)" class="delete-record" id="<?php echo $id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
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
                            <div class="col-md-5">
                                <div class="box box-success box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Add New Role</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <fieldset>
                                            {!! Form::open(['url' => 'admin/user-role/store', 'id' => 'userRoleForm', 'method' => 'post', 'class' => '']) !!}
                                            {!! Form::hidden('id',$get_id) !!}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                                        {!! Form::label('name','Name', ['class' => 'required']) !!}
                                                        {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                                                                     
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group has-feedback {!! $errors->first('status', ' has-error') !!}">
                                                        {!! Form::label('status','Status') !!}
                                                        {!! Form::select('status', $arr_status, $status, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::submit($btn_name,['class' => 'btn btn-success btn-flat']) !!}&nbsp;&nbsp;
                                                <a href="{!! url('admin/user-role') !!}" class="btn btn-default btn-flat">Cancel</a>
                                            </div>
                                            {!! Form::close() !!}
                                        </fieldset>
                                    </div>
                                    <!-- /.box-body -->
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

    jQuery("#userRoleForm").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "name":{
                required: true
            }
        },
        messages:{
            "name":{
                required: "Please enter name"
            }
        }
    });


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
                        location.href = SITE_URL+'/admin/user-role/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection