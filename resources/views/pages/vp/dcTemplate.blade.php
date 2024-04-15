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
               <li class="breadcrumb-item active"><a href="{{route('admin.vp.index')}}" class="text-white">VP</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">DC Template</a></li>
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
          <a href="#" class="btn btn-info btn-block">Download/Export to CSV</a>
        </div>
         <div class="col-4">
             <a href="#" class="btn btn-info btn-block">Download/Export to Excel</a>
         </div>
      </div>
      <br>
      <div class="card card-header bg-info">DC Template</div>
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
		      <th>SNo</th>
		      <th>Month</th>
		      <th>Year</th>
		      <th>Implementing partner</th>
		      <th>Region</th>
		      <th>County</th>
		      <th>Subcounty</th>
		      <th>Name of peer educator</th>
		      <th>Name of peer</th>
		      <th>Facility</th>
		      <th>Ward</th>
		      <th>Disability</th>
		      <th>Sex</th>
		      <th>Age</th>
		      <th>Phone no</th>
		      <th>First contact date</th>
		      <th>Enrollment Date</th>
		      <th>HIV status at enrollment</th>
		      <th>Received health education</th>
		      <th>Tested for HIV</th>
		      <th>Frequency of HIV test</th>
		      <th>HIV status</th>
		      <th>Started on ART</th>
		      <th>Currently on ART</th>
		      <th>Due for viral load</th>
		      <th>Received viral load test</th>
		      <th>Viral load copies</th>
		      <th>Screened for TB</th>
		      <th>Diagnosed with TB</th>
		      <th>Started TB treatment</th>
		      <th>Screened for STI</th>
		      <th>Diagnosed with STI</th>
		      <th>Treated for STI</th>
		      <th>Initiated on PrEP</th>
		      <th>Currently on PrEP</th>
		      <th>Issued with condoms</th>
		      <th>Attended of PSSG</th>
		      <th>Reached with EBAN-K</th>
		      <th>Experienced violence</th>
		      <th>Received post violence support</th>
		      <th>Status in programme</th>
		      <th>Remarks</th>
        	</tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

