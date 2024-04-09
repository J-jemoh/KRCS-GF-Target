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
               <li class="breadcrumb-item active"><a href="{{route('admin.fsw.index')}}" class="text-white">PMTCT</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">TEMPLATE</a></li>
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
		      <th>SR Name</th>
		      <th>County</th>
		      <th>Sub County</th>
		      <th>Care Facility</th>
		      <th>Name</th>
		      <th>Mother CCC No</th>
		      <th>DOB</th>
		      <th>Age</th>
		      <th>Phone</th>
		      <th>Lactating</th>
		      <th>Pregnant</th>
		      <th>No of ANC Visits</th>
		      <th>Delivery at Facility</th>
		      <th>HEI ID</th>
		      <th>HEI DOB</th>
		      <th>Age in Months</th>
		      <th>Sex</th>
		      <th>Date of Enrolment</th>
		      <th>Received Prophylaxis at 6 wks</th>
		      <th>DNA PCR Status at 6-8 wks</th>
		      <th>DNA PCR Status at 6 months</th>
		      <th>DNA PCR Status at 12 months</th>
		      <th>Test Result of AB at 18 months</th>
		      <th>Confirm Test Results</th>
		      <th>Linked Facility</th>
		      <th>HEI CCC Number</th>
		      <th>Final Outcome</th>
		      <th>HEI Remarks</th>
		      <th>Reached by Expert Mother</th>
		      <th>Attended PSSG</th>
		      <th>ART Status</th>
		      <th>Due for VL</th>
		      <th>VL Done</th>
		      <th>Received VL Result</th>
		      <th>VL Copies</th>
		      <th>Screened for STI</th>
		      <th>Diagnosed for STI</th>
		      <th>Treated for STI</th>
		      <th>Cervical Cancer Screening</th>
		      <th>CaCx Results</th>
		      <th>Treated for CaCx</th>
		      <th>Reached with FP Information</th>
		      <th>Screened for Pregnancy Intention</th>
		      <th>Currently on FP</th>
		      <th>Screened for TB</th>
		      <th>TB Diagnosis</th>
		      <th>Referred for TB Treatment</th>
		      <th>Experienced Violence</th>
		      <th>Received Post Violence Support</th>
      		  <th>Remarks Comments</th>
        </tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

