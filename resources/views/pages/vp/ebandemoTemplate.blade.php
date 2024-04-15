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
                <li class="breadcrumb-item active"><a href="#" class="text-white">EBAN Template</a></li>
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
      <div class="card card-header bg-info">Eban Demo Template</div>
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
		      <th>SNo</th>
		      <th>Month</th>
		      <th>Year</th>
		      <th>Region</th>
		      <th>Counties</th>
		      <th>Sub county</th>
		      <th>Ward</th>
		      <th>Site Name</th>
		      <th>Implementing partner</th>
		      <th>Facilitator I</th>
		      <th>Facilitator II</th>
		      <th>Group: No/Name</th>
		      <th>Start date</th>
		      <th>End date</th>
		      <th>COUPLE CODE</th>
		      <th>Participant Name</th>
		      <th>Age</th>
		      <th>Sex</th>
		      <th>HIV Status</th>
        	</tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

