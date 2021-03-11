@extends('layouts.website')

@section('page-content')


<section id="contant" class="contant main-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>

<script>
jQuery(document).ready(function () {
        
});
</script>
@endsection