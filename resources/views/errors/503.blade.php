@extends('layouts.error')

@section('page-content')
<?php // print("<pre>"); print_r($all_records); exit('qwerty');?>
<!-- Content Wrapper. Contains page content -->
<div class="error-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>Oops!</h1>
                        <h2>503 On Maintenance Mode</h2>
                        <div class="error-details">
                            This site is down for maintenance, please check back soon!
                        </div>
<!--                        <div class="error-actions">
                            <a href="http://www.jquery2dotnet.com" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                Take Me Home </a><a href="http://www.jquery2dotnet.com" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>        
    </section>
    <!-- /.content -->
</div>
<style>
    .error-template{
        min-height: 400px;
    }
</style>
<script>
jQuery(document).ready(function(){
    
});
</script>
@endsection