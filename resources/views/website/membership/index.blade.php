@extends('layouts.website')

@section('page-content')


<section id="contant" class="contant main-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $page->content !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {!! Form::open(['url' => '/membership/store', 'id' => 'membershipForm', 'method' => 'post', 'class' => '']) !!}
                    <div class="form-group">
                        {!! Form::text('name', '',['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Full Name']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('age', '',['class' => 'form-control', 'id' => 'age', 'placeholder' => 'Enter Age']) !!}
                        {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('parent_guardian', '',['class' => 'form-control', 'id' => 'parent_guardian', 'placeholder' => 'Enter Parent / Guardian Name']) !!}
                        {!! $errors->first('parent_guardian', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('address', '',['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Enter Address']) !!}
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('mobile', '',['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'Enter Mobile Number', 'maxlength'=>'10']) !!}
                        {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('email', '',['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Your Email']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('preferredCentre', ['Club5'=>'Club5','Club Vita'=>'Club Vita','Crest Club'=>'Crest Club'], '', ['class' => 'form-control', 'id' => 'preferredCentre', 'placeholder' => 'Select Preferred Centre']) !!}
                        {!! $errors->first('preferredCentre', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('trainingProgram', ['Progressive'=>'Progressive','Beginners'=>'Beginners','Intermediate'=>'Intermediate','Advance'=>'Advance','Personalised Coaching'=>'Personalised Coaching'], '', ['class' => 'form-control', 'id' => 'trainingProgram', 'placeholder' => 'Select Training Program']) !!}
                        {!! $errors->first('trainingProgram', '<p class="help-block">:message</p>') !!}
                    </div>
                    {!! Form::button('Submit',['class' => 'btn','id' => 'submitForm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

<style>
	/* fancybox css for support and carrer Page */
	.fancybox-inner{
		min-height: 150px;
		background: #fff;
		text-align: left;
	}
	.fancybox-inner > .message > p{
		/*margin-top: 12%;*/
		font-size: 15px;
		padding: 50px;
	}
	/* fancybox css for support and carrer Page */
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('js/website/lightbox/jquery.fancybox_v3.css') }}" />
<script src="{{ asset('js/website/lightbox/jquery.fancybox.pack.js') }}"></script>

<script>
jQuery(document).ready(function () {
        
    jQuery("#membershipForm").validate({
        rules: {
            "name":{
                required: true,
            },
            "email":{
                required: true,
                email: true
            },
            "mobile":{
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            "address":{
                required: true,
                maxlength: 255
            },
            "preferredCentre":{
                required: true,
            },
            "trainingProgram":{
                required: true,
            },
        },
        messages:{
            "name":{
                required: "Please enter name"
            },
            "email":{
                required: "Please enter email",
                email:"Please enter valid email"
            },
            "mobile":{
                required: "Please enter mobile no",
                number:"Please enter valid mobile no",
                maxlength : "Please enter valid mobile no",
                minlength : "Please enter valid mobile no"
            },
            "address":{
                required: "Please enter Address",
                maxlength:"The Address may not be greater than 255 characters"
            },
            "preferredCentre":{
                required: "Please select Preferred Centre",
            },
            "trainingProgram":{
                required: "Please select Training Program",
            },
        },
        errorElement: "div",
        highlight: function(element) {
            $(element).parent().removeClass('no-error');
            $(element).parent().addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).parent().removeClass('has-error');
            $(element).parent().addClass('no-error');
        },
    });
    $( "#submitForm" ).click(function(e) {
        var formObj = $( "#membershipForm" );
        if(formObj.valid()){
            $("#submitForm").prop('disabled', true);
            $("#membershipForm").submit();
        }
    });

		var supportSuccessMessage = '';
		supportSuccessMessage += 'Dear Customer,<br><br>';
		supportSuccessMessage += 'Thank you for reaching Gurgaon Tennis Academy.<br><br>';
		supportSuccessMessage += 'we will connect with you shortly.</a>.';
		
		<?php if(Session::has('message')) { ?>
			// var msg = '<?php echo Session::get('message');?>';
			// bootbox.alert('Thanks, ' + msg);
			$.fancybox.open('<div class="message"><p>'+supportSuccessMessage+'</p></div>');
		<?php } ?>
});
</script>
@endsection