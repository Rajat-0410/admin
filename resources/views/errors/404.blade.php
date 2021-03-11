@extends('layouts.error')

@section('page-content')
<?php // print("<pre>"); print_r($all_records); exit('qwerty');?>
<!-- Content Wrapper. Contains page content -->
<div class="innerContent">
    <div class="container text-center">
        <h3 class="text-center">The Request page was not found</h3>
        <!--<a href="/" class="btn btn-default">Back To Home</a>-->
        <div class="text-center">
            <img src="{{ asset("images/website/404.png") }}" alt="404">
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function(){
    
});
</script>
@endsection