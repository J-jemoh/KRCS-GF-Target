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
               <li class="breadcrumb-item active"><a href="{{route('admin.ayp.index')}}" class="text-white">AYP</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">Mentorship Template</a></li>
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
            <th>Counties</th>
            <th>Sub county</th>
            <th>Ward</th>
            <th>Venue</th>
            <th>Implementing partner</th>
            <th>Name Mentor 1</th>
            <th>Name Mentor 2</th>
            <th>Cohort Number</th>
            <th>Mentee Name</th>
            <th>DOB</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Telephone Number</th>
            <th>Village</th>
            <th>Unique Identifier</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Session 1</th>
            <th>Session 2</th>
            <th>Session 3</th>
            <th>Session 4</th>
            <th>Session 5</th>
            <th>Make Up Session</th>
            <th>Completed All Sessions Status</th>
            <th>Services Referred</th>
            <th>Services Accessed</th>
            <th>Attended Outreach</th>
            <th>Attended EBI</th>
            <th>Comments</th>
        </tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

