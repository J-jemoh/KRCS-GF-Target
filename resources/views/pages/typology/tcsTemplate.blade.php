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
               <li class="breadcrumb-item active"><a href="{{route('admin.tcs.index')}}" class="text-white">TCS</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">Template</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.fsw.consolidated')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
        </div>
         <div class="col-4">
             <a href="#" class="btn btn-info btn-block">Download/Export to Excel</a>
         </div>
      </div>
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
           <th>SNo</th>
           <th>Month</th>
           <th>Year</th>
		  <th>Region</th>
	      <th>SR</th>
	      <th>County</th>
	      <th>Sub County</th>
	      <th>Health Facility</th>
	      <th>Community Tracing Focal Person</th>
	      <th>CCC Number</th>
	      <th>DOB</th>
	      <th>Age</th>
	      <th>Sex</th>
	      <th>Pregnant_Lactating</th>
	      <th>Missed Appointment Date</th>
	      <th>Date listed as a Defaulter</th>
	      <th>Date of Community Tracing</th>
	      <th>Tracing outcome </th>
	      <th>Date of Community Tracing_2</th>
	      <th>Tracing outcome</th>
	      <th>Date of Community Tracing_3</th>
	      <th>Tracing outcome</th>
	      <th>Linked Facility</th>
	      <th>Date Received at linked facility</th>
	      <th>Remarks</th>
        </tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

