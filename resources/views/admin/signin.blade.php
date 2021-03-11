@extends('layouts.admin')

@section('page-content')

<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Gixxer Cup</b> ADMIN</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
            <p><i class="{{ Session::get('icon-class') }}"></i> {{ Session::get('message') }}</p>
        </div>
        @endif
        
        <p class="login-box-msg">Sign in to start your session</p>
        {!! Form::open(['url' => '/admin/authority', 'id' => 'adminSignin', 'method' => 'post', 'class' => '']) !!}
        
            <!--{!! Form::label('email','Email') !!}-->
            <div class="form-group has-feedback {!! $errors->first('email', ' has-error') !!}">
                {!! Form::text('email','',['class' => 'form-control', 'placeholder' => 'Email']) !!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group has-feedback {!! $errors->first('password', ' has-error') !!}">
                {!! Form::input('password','password','',['class' => 'form-control', 'placeholder' => 'Password']) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!--<div class="checkbox icheck">-->
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('remember_me') !!} Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                    {!! Form::submit('Sign In',['class' => 'btn btn-primary btn-block btn-flat']) !!}
                </div>
                <div class="col-xs-12" style="margin-top: 20px;">
                    {!! link_to('admin/forgot-password','Forgot Password?') !!}
                    <!--<a href="#">I forgot my password</a>-->
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}
        
    </div>
    <!-- /.login-box-body -->
</div>

<script>
jQuery(document).ready(function(){
    jQuery("#adminSignin").validate({
        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "email":{
                required: true,
                email: true
            },
            "password":{
                required: true
            }
        },
        messages:{
            "email":{
                required: "Please enter email",
                email: "Please enter valid email"
            },
            "password":{
                required:"Please enter password"
            }
        }
    });
});
</script>
@endsection