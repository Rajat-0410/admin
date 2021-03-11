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
                
<!--                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title">Search</h3>
                         tools box 
                        <div class="pull-right box-tools">
                            <button title="" data-toggle="tooltip" data-widget="collapse" class="btn btn-info btn-sm"><i class="fa fa-minus"></i></button>
                            <button title="Remove" data-toggle="tooltip" data-widget="remove" class="btn btn-info btn-sm"><i class="fa fa-times"></i></button>
                        </div> /. tools 
                    </div>
                    <div class="box-body">
                        {!! Form::open(['url' => 'admin/page', 'id' => 'addNewMenu', 'method' => 'get', 'class' => '']) !!}
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group has-feedback {!! $errors->first('keyword', ' has-error') !!}">
                                        {!! Form::label('keyword','Keyword', ['class' => 'required']) !!}
                                        {!! Form::text('keyword',$keyword,['class' => 'form-control', 'placeholder' => 'keyword']) !!}
                                        {!! $errors->first('keyword', '<p class="help-block">:message</p>') !!}
                                        <p class="help-block"><strong>Search By:</strong> Title OR Slug</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                {!! Form::submit('Search',['class' => 'btn btn-primary btn-med']) !!}&nbsp;&nbsp;
                                <a href="{!! url('admin/page') !!}" class="btn btn-default btn-med">Reset</a>
                            </div>
                        {!! Form::close() !!}
                        p<><strong>Note:</strong></p>
                    </div>
                </div>-->
                
                <div class="box box-primary">
                    
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <?php if(!empty($productId) && !empty($record_id)){ ?>
                                    <a href='{!! url("admin/$controller/$productId") !!}' class="btn btn-info btn-flat">Back</a> 
                                <?php } else if(!empty($productId) && empty($record_id)){ ?>
                                    <input action="action" onclick="window.history.go(-1); return false;" type="button" class="btn btn-info btn-flat" value="Back" />
                                <?php } else { ?>
                                    <a href='{!! url("admin/$controller") !!}' class="btn btn-info btn-flat">Back</a> 
                                <?php } ?>
                                
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                                        
                    <div class="box-body table-responsive pad">
                        <table class="table table-bordered">
                            @if(count($all_records) > 0)
<!--                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>-->
                                @foreach($all_records as $row)
                                    <?php // print_r($row); exit; 
                                        $id         = base64_encode($row->id);
                                        $record_id  = $row->record_id;
                                        $user_id    = $row->user_id;
                                        $controller = $row->controller;
                                        $action     = $row->action;
                                        $user_name  = $row->user->name;
                                        $created_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                        // $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('Y/m/d h:i A');
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php if($action=='added'){ ?>
                                                <i class="fa fa-plus"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-pencil"></i>
                                            <?php } ?>
                                        </td>
                                        <td><strong>{{ $record_name }}</strong> has been <strong>{{ $action }}</strong> by <strong>{{ $user_name }}</strong> at <strong>{{ $created_at }}</strong></td>
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
                        location.href = SITE_URL+'/admin/page/delete/'+ele_id;
                    }
                }
            });
        }
    });
        
});
</script>
@endsection