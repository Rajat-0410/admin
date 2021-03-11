@extends('layouts.website')

@section('page-content')
<?php // echo $page_title; exit('here') ?>
<section id="contant" class="contant main-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info">
                    <div class="kode-section-title">
                        <h3>Contact Info</h3>
                    </div>
                    <div class="kode-forminfo">
                        <ul class="kode-form-list">
                            <li>
                                <i class="fa fa-home"></i> 
                                <p><strong>Address:</strong> A88-1, Phase 2, New Palam Vihar, Gurgaon - 122001, Haryana</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> 
                                <p><strong>Phone:</strong>  <a href="tel:9811933736">9811933736</a></p>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o"></i> 
                                <p><strong>Email:</strong> <a href="mailto:kumarnaresh870@gmail.com">kumarnaresh870@gmail.com</a></p>
                            </li>
                            <li>
                                <!-- social icon -->
                                <ul class="social-icons">
                                    <!-- <li>
                                        <a class="facebook" href="https://www.facebook.com/gurgaontennisacademy/">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li> -->
                                    <!-- <li>
                                        <a class="twitter" href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="youtube" href="#">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                    </li> -->
    <!--                                <li>
                                        <a class="pinterest" href="#">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>-->
                                </ul>
                                <!-- end button section -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-us">
                    <h3 class="text-left">If you have a comment or suggestion, please fill out the below form.</h3>
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </button>
                        <p><i class="{{ Session::get('icon-class') }}"></i> {{ Session::get('message') }}</p>
                    </div>
                    @endif
                    {!! Form::open(['url' => 'store-contact-us', 'id' => 'contactUsForm', 'method' => 'post', 'class' => 'comments-form contact-us-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {!! $errors->first('name', ' has-error') !!}">
                                {!! Form::text('name','',['class' => 'form-control', 'placeholder' => 'Your Name']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group has-feedback {!! $errors->first('email', ' has-error') !!}">
                                {!! Form::text('email','',['class' => 'form-control', 'placeholder' => 'Your Email']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group has-feedback {!! $errors->first('phone_number', ' has-error') !!}">
                                {!! Form::text('phone_number','',['class' => 'form-control', 'placeholder' => 'Your Phone']) !!}
                                {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group has-feedback {!! $errors->first('message', ' has-error') !!}">
                                {!! Form::textarea('message','',['class' => 'form-control', 'placeholder' => 'Your Message', 'id' => '', 'rows' => 4 ]) !!}
                                {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group btn-container">
                                {!! Form::submit('Send Now',['class' => 'btn btn-primary btn-med']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .kode-section-title{ margin-bottom: 10px; }
    .social-icons { display: inline-flex; margin-top: 20px; }
    .social-icons .fa{ position: initial; float: none; }
    .social-icons li a{ border-color: #222; }
</style>
<script>
    jQuery(document).ready(function () {

        // Contact Us Form Validation => START
        jQuery("#contactUsForm").validate({
            rules: {
                "name": {
                    required: true
                },
                "email": {
                    required: true,
                    email: true
                },
                "phone_number": {
                    required: true
                },
                "message": {
                    required: true
                }
            },
            messages: {
                "name": {
                    required: "Name field is required"
                },
                "email": {
                    required: "Email field is required",
                    email: "Invalid email"
                },
                "phone_number": {
                    required: "Phone field is required"
                },
                "message": {
                    required: "Message field is required"
                }
            },
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            }
        });
        // Contact Us Form Validation => END

    });
</script>
@endsection
