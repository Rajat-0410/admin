@extends('layouts.admin')

@section('page-content')
<?php // print_r($arr_menu_data); exit;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_title; ?><small></small></h1>
    </section>
    <!-- Main content -->
    
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['url' => 'admin/menu/store', 'id' => 'addNewMenu', 'method' => 'post', 'class' => '']) !!}
                            {!! Form::hidden('id',$id) !!}
                            <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                {!! Form::label('name','Name', ['class' => 'required']) !!}
                                {!! Form::text('name',$name,['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group has-feedback {!! $errors->first('slug', ' has-error') !!}">
                                {!! Form::label('slug','Slug', ['class' => 'required']) !!}
                                {!! Form::text('slug',$slug,['class' => 'form-control', 'placeholder' => 'Slug']) !!}
                                {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group has-feedback {!! $errors->first('group_id', ' has-error') !!}">
                                {!! Form::label('group_id','Menu Group') !!}
                                {!! Form::select('group_id', $menu_types, $group_id, ['class' => 'form-control', 'id' => 'menuType']) !!}
                                {!! $errors->first('group_id', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group has-feedback {!! $errors->first('parent_id', ' has-error') !!}">
                                {!! Form::label('parent_id','Parent Menu') !!}
                                {!! Form::select('parent_id', $parent_menus, $parent_id, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group has-feedback {!! $errors->first('page_id', ' has-error') !!}">
                                {!! Form::label('page_id','Menu Page') !!}
                                {!! Form::select('page_id', $pages_list, $page_id, ['class' => 'form-control', 'id' => '']) !!}
                                {!! $errors->first('page_id', '<p class="help-block">:message</p>') !!}
                            </div>
                            <?php $arrSatus = array(0=>'In-Active',1=>'Active'); ?>
                            <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                {!! Form::label('status','Status') !!}
                                {!! Form::select('status', $arrSatus, $status, ['class' => 'form-control', 'id' => 'parentmenu']) !!}
                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update',['class' => 'btn btn-success btn-med']) !!}&nbsp;&nbsp;
                                <a href="{!! url('admin/menu') !!}" class="btn btn-default btn-med">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
    
</div>

@endsection