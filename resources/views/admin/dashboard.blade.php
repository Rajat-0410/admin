@extends('layouts.admin')

@section('page-content')
<?php // print_r($pageData); exit;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dashboard<small></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        
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
                <h3 class="box-title"></h3>
                
                <div class="box-tools pull-right">
<!--                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="min-height: 400px;">
                <h1 class="text-center text-aqua"><img src="{{ asset("images/website/logo.png") }}" class="img-responsive"></h1>
                <h1 class="text-center">Welcome to Homeodocs Panel</h1>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            
        </div>
        
        <!-- Info boxes -->
        <!--<div class="row">-->
<!--            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
                     /.info-box-content 
                </div>
                 /.info-box 
            </div>-->
            <!-- /.col -->
<!--            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                     /.info-box-content 
                </div>
                 /.info-box 
            </div>-->
            <!-- /.col -->

            <!-- fix for small devices only -->
            <!--<div class="clearfix visible-sm-block"></div>-->

<!--            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                    </div>
                     /.info-box-content 
                </div>
                 /.info-box 
            </div>-->
            <!-- /.col -->
<!--            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                     /.info-box-content 
                </div>
                 /.info-box 
            </div>-->
            <!-- /.col -->
        <!--</div>-->
        <!-- /.row -->
        
    </section>
    <!-- /.content -->
</div>

@endsection