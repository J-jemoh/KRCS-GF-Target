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
      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.fsw.consolidated')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
        </div>
         <div class="col-4">
             <a href="{{route('fsw.download-demographics-excel')}}" class="btn btn-info btn-block">Download/Export to Excel</a>
         </div>
      </div>
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Year</th>
            <th>Month</th>
            <th>Region</th>
            <th>KP Type</th>
            <th>UIC</th>
            <th>Received Peer Education</th>
            <th>Clinical Services</th>
            <th>HIV Tested</th>
            <th>HTS Service Point</th>
            <th>HIV Test Frequency</th>
            <th>HIV Status</th>
            <th>Self-Test HIV</th>
            <th>Pre-ART</th>
            <th>ART Started</th>
            <th>Currently on ART</th>
            <th>Current Facility Care</th>
            <th>HIV Care Outcome</th>
            <th>ART Outcome</th>
            <th>Due VL</th>
            <th>VL Done</th>
            <th>VL Result Received</th>
            <th>Att VL Suppression</th>
            <th>TB Screened</th>
            <th>TB Diagnosed</th>
            <th>TB Treatment Started</th>
            <th>HIV Exposure 72hr</th>
            <th>PEP 72</th>
            <th>Completed PEP</th>
            <th>Condom Number Required</th>
            <th>Condoms Distributed Number</th>
            <th>Condom Provision as Per Need</th>
            <th>Lubricant Required Number</th>
            <th>Lubricant Distributed Number</th>
            <th>Lubricant Provision per Need</th>
            <th>NSSP Number</th>
            <th>NSSP Distributed Number</th>
            <th>Received NSSP Need</th>
            <th>HEPC Screened</th>
            <th>HEPC Status</th>
            <th>HEPC Treated</th>
            <th>HEPB Screening</th>
            <th>HEPB Status</th>
            <th>On HEPB Treatment</th>
            <th>HEPB Vaccination</th>
            <th>STI Screened</th>
            <th>STI Diagnosed</th>
            <th>STI Treated</th>
            <th>Drug Abuse Screened</th>
            <th>PrEP Initiated</th>
            <th>On PrEP</th>
            <th>Modern FP Services</th>
            <th>RSSH</th>
            <th>EBI</th>
            <th>Exp Violence</th>
            <th>Post Violence Support</th>
            <th>Program Status</th>
            <th>TCA</th>
        </tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

