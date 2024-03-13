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
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.gbv.index')}}" class="text-white">GBV</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">REPORTS</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">GBV TEMPLATE</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">GBV TEMPLATE</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>SNo</th>
    						<th>Year</th>
    						<th>Quater</th>
			                <th>Region</th>
			                <th>SR Name</th>
			                <th>County</th>
    						<th>Sub County</th>
    						<th>Ward</th>
    						<th>Village</th>
    						<th>Reporting Month</th>
    						<th>Attached Paralegal</th>
    						<th>Beneficiary Name</th>
    						<th>D.O.B</th>
    						<th>Age</th>
    						<th>Sex</th>
    						<th>Typology</th>
    						<th>Disability</th>
                			<th>Disability Type</th>
    						<th>Phone</th>
    						<th>Confidant No</th>
    						<th>Abuse/Violation</th>
    						<th>Abuse Date</th>
    						<th>Perpetrator</th>
    						<th>Attend Legal Aid Clinic</th>
    						<th>Litigation</th>
    						<th>Legal Counsel Offered</th>
    						<th>Referral</th>
    						<th>Case Status</th>
    						<th>Comment</th>
    					</tr>
    				</thead>
            <tbody>
              </tbody>
    			</table>
    		</div>
    	</div>
    </div>
</section>
@endsection