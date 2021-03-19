@extends('layouts.admin')

@section('page-content')
<?php // echo'<pre>'; print_r($all_record); exit('view');?>
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
                        <div class="row">
                            <div class="col-xs-8">
                                <h3 class="box-title"><?php echo $page_sub_title; ?></h3>
                            </div>
                            <div class="col-xs-4 text-right">
                                <a href="{!! url('admin/patient') !!}" class="btn btn-primary btn-flat pull-right">Back</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('name','Name', ['class' => 'required']) !!}
                                            {!! Form::text('name',$all_record['arrPatientResp']['name'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('mobile','Mobile', ['class' => 'required']) !!}
                                            {!! Form::text('mobile',$all_record['arrPatientResp']['mobile'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('email','Email', ['class' => 'required']) !!}
                                            {!! Form::text('email',$all_record['arrPatientResp']['email'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('occupation','Occupation', ['class' => 'required']) !!}
                                            {!! Form::text('occupation',$all_record['arrPatientResp']['patient']['occupation'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('gender','Gender', ['class' => 'required']) !!}
                                            {!! Form::text('gender',$all_record['arrPatientResp']['patient']['gender'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('dob','Date of Birth', ['class' => 'required']) !!}
                                            {!! Form::text('dob',$all_record['arrPatientResp']['patient']['dob'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('blood_group','Blood Group', ['class' => 'required']) !!}
                                            {!! Form::text('blood_group',$all_record['arrPatientResp']['patient']['blood_group'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('marital_status','Marital Status', ['class' => 'required']) !!}
                                            {!! Form::text('marital_status',$all_record['arrPatientResp']['patient']['marital_status'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('height','Height', ['class' => 'required']) !!}
                                            {!! Form::text('height',$all_record['arrPatientResp']['patient']['height'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('weight','Weight', ['class' => 'required']) !!}
                                            {!! Form::text('weight',$all_record['arrPatientResp']['patient']['weight'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('smoking','Smoking', ['class' => 'required']) !!}
                                            {!! Form::text('smoking',$all_record['arrPatientResp']['patient']['smoking'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('alcohol','Alcohol', ['class' => 'required']) !!}
                                            {!! Form::text('alcohol',$all_record['arrPatientResp']['patient']['alcohol'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('daily_routine_work','Daily Routine Work', ['class' => 'required']) !!}
                                            {!! Form::text('daily_routine_work',$all_record['arrPatientResp']['patient']['daily_routine_work'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('diet','Diet', ['class' => 'required']) !!}
                                            {!! Form::text('diet',$all_record['arrPatientResp']['patient']['diet'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            {!! Form::label('address','Address', ['class' => 'required']) !!}
                                            {!! Form::text('address',$all_record['arrPatientResp']['address'],['class' => 'form-control', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Medical History<small></small></h1>
    </section>
    <!-- Main content -->
    
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body table-responsive pad">
                                            <table class="table table-bordered">
                                                @if(count($all_record['arrMedicalResp']) > 0)
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Medical Status</th>
                                                        <th>Type</th>
                                                        <th>Time From</th>
                                                        <th>Time To</th>
                                                        <th>Result</th>
                                                        <th>Images</th>
                                                    </tr>
                                                    @foreach($all_record['arrMedicalResp'] as $row)
                                                        <?php 
                                                            $id = $row->id;
                                                            // 'Y/m/d H:i A'
                                                            $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                                            ?>
                                                        <tr>
                                                            <td>{{ $row->title }}</td>
                                                            <td>{{ $row->medical_status }}</td>
                                                            <td>{{ $row->type }}</td>
                                                            <td>{{ $row->time_from }}</td>
                                                            <td>{{ $row->time_to }}</td>
                                                            <td>{{ $row->result }}</td>
                                                            <td>
                                                                <a href="{!! url('admin/patient/medical_record_image_gallery', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="Image Gallery"><i class="fa fa-picture-o"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else 
                                                <tr><td class="text-center" colspan="6"><strong>{{ $no_records_found }}</strong></td></tr>                                
                                                @endif
                                            </table>
                                            
                                            @if(!empty($all_record['arrMedicalResp']))
                                                {{ $all_record['arrMedicalResp']->links() }}
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Consults<small></small></h1>
    </section>
    <!-- Main content -->
    
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body table-responsive pad">
                                            <table class="table table-bordered">
                                                @if(count($all_record['arrConsultResp']) > 0)
                                                    <tr>
                                                        <th>Disease Name</th>
                                                        <th>Disease Type</th>
                                                        <th>Latest Consult</th>
                                                        <th>Details</th>
                                                    </tr>
                                                    @foreach($all_record['arrConsultResp'] as $row)
                                                        <?php 
                                                            $id = base64_encode($row->id);
                                                            // 'Y/m/d H:i A'
                                                            $updated_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at, 'UTC')->setTimezone('Asia/Kolkata')->format('M d, Y h:i A');
                                                            ?>
                                                        <tr>
                                                            <td>{{ $row->disease_name }}</td>
                                                            <td>{{ $row->disease_type }}</td>
                                                            <td>{{ $updated_at }}</td>
                                                            <td>
                                                                <a href="{!! url('admin/consult', ['id' => $id]) !!}" class="btn btn-xs btn-theme text-green" data-toggle="tooltip" title="View Details"><i class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else 
                                                <tr><td class="text-center" colspan="6"><strong>{{ $no_records_found }}</strong></td></tr>                                
                                                @endif
                                            </table>
                                            
                                            @if(!empty($all_record['arrConsultResp']))
                                                {{ $all_record['arrConsultResp']->links() }}
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
    
    <!-- includes.browse-media -->
    @include('includes.browse-media')
    <!-- /includes.browse-media -->
    
</div>
<script>
jQuery(document).ready(function(){
    //    
});
</script>
@endsection