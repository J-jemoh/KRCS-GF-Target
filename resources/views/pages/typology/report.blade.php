@extends('layouts.admin')
@section('content')
 <div class="content-header bg-info">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-white">Home</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Typology</a></li>
               <li class="breadcrumb-item active"><a href="{{route('admin.fsw.index')}}" class="text-white">FSW</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">CONSOLIDATED</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Month</th>
                <th>Year</th>
                <th>Region</th>
                <th>County</th>
                <th>SR Name</th>
                <th>KP Name</th>
                <th>Hotspot</th>
                <th>Hotspot Typology</th>
                <th>Other Hospot</th>
                <th>Sub County</th>
                <th>Ward</th>
                <th>KP Phone</th>
                <th>KP Type</th>
                <th>UIC</th>
                <th>Age</th>
                <th>YOB</th>
                <th>Sex</th>
                <th>First Contact Date</th>
                <th>Enrollment Date</th>
                <th>HIV status at Enrollment</th>
                <th>Peer Educator</th>
                <th>Peer Educator Code</th>
              </tr>
            </thead>
            <tbody>
              @foreach($demographics as $demo)
              <tr>
                <td>{{$demo->id}}</td>
                <td>{{$demo->month}}</td>
                <td>{{$demo->year}}</td>
                <td>{{$demo->region}}</td>
                <td>{{$demo->county}}</td>
                <td>{{$demo->sr_name}}</td>
                <td>{{$demo->kp_name}}</td>
                <td>{{$demo->hotspot}}</td>
                <td>{{$demo->hotspot_typology}}</td>
                <td>{{$demo->other_hotspot}}</td>
                <td>{{$demo->subcounty}}</td>
                <td>{{$demo->ward}}</td>
                <td>{{$demo->kp_phone}}</td>
                <td>{{$demo->kp_type}}</td>
                <td>{{$demo->uic}}</td>
                <td>{{$demo->age}}</td>
                <td>{{$demo->yob}}</td>
                <td>{{$demo->sex}}</td>
                <td>{{$demo->first_contact_date}}</td>
                <td>{{$demo->enrol_date}}</td>
                <td>{{$demo->hiv_status_enrol}}</td>
                <td>{{$demo->peer_educator}}</td>
                <td>{{$demo->peer_educator_code}}</td>
              </tr>
              @endforeach
            </tbody>
    	
    </div>
</section>
@endsection