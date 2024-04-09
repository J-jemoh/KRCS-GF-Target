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
	          <th>SR Name</th>
	          <th>County</th>
	          <th>Sub County</th>
	          <th>Ward</th>
	          <th>Reporting Month</th>
	          <th>Outreach Date</th>
	          <th>Outreach Venue</th>
	          <th>PE Name</th>
	          <th>Peer Name</th>
	          <th>DOB</th>
	          <th>Age</th>
	          <th>Sex</th>
	          <th>Disabled</th>
	          <th>Disability Type</th>
	          <th>Phone</th>
	          <th>Attended EBI</th>
	          <th>Attended Outreach Within 3 Months</th>
	          <th>Provided Health Education</th>
	          <th>Provided Other SRH Information</th>
	          <th>Counseling on Safe Behaviour</th>
	          <th>Family Planning Information</th>
	          <th>Offered FP services</th>
	          <th>Risk Assesment</th>
	          <th>IEC Material Offered</th>
	          <th>Tested for HIV</th>
	          <th>HIV Results</th>
	          <th>ART Initiated</th>
	          <th>ART HF Linked to</th>
	          <th>CCC Number</th>
	          <th>Linked to CATS</th>
	          <th>STI Screening</th>
	          <th>Treated for STI</th>
	          <th>TB Screened</th>
	          <th>Referred for TB Treatment</th>
	          <th>Screened for SGBV</th>
	          <th>Referred for SGBV Tx</th>
	          <th>Offered Cervical Cancer Screening</th>
	          <th>Referred for Cancer Treatment</th>
	          <th>Offered PEP</th>
	          <th>Offered PrEP</th>
	          <th>Offered Condoms(Y/N)</th>
	          <th>Number of Condoms Offered</th>
	          <th>Post Rape  Care Services</th>
	          <th>Post Abortion Care</th>
	          <th>Treated for Other Ailments</th>
          <th>If Yes, specify</th>
        </tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

