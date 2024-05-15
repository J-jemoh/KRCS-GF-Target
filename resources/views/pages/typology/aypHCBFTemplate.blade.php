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
                <li class="breadcrumb-item active"><a href="#" class="text-white">HCBF Template</a></li>
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
      <div class="card card-info">
      	<div class="card-body">
      		<table id="example2" class="table table-bordered table-striped">
            <thead>
		    	<tr>
		        <th>SNo</th>
		        <th>Month</th>
		        <th>Year</th>
		        <th>Region</th>
		        <th>County</th>
		        <th>Sub County</th>
		        <th>Ward</th>
		        <th>Venue</th>
		        <th>Implementing Partner</th>
		        <th>Facilitator 1</th>
		        <th>Facilitator 2</th>
		        <th>Start Date</th>
		        <th>End Date</th>
		        <th>Name</th>
		        <th>Age</th>
		        <th>Sex</th>
		        <th>Session 1</th>
		        <th>Session 2</th>
		        <th>Session 3</th>
		        <th>Session 4</th>
		        <th>Session 5</th>
		        <th>Session 6</th>
		        <th>Session 7</th>
		        <th>Make Up Session Date</th>
		        <th>Complete Sessions</th>
		        <th>Provided Condoms</th>
		        <th>Risk Assessment R</th>
		        <th>Risk Assessment C</th>
		        <th>Vmmc R</th>
		        <th>Vmmc C</th>
		        <th>Ovc R</th>
		        <th>Ovc C</th>
		        <th>Prc R</th>
		        <th>Prc C</th>
		        <th>Pss R</th>
		        <th>Pss C</th>
		        <th>Hts R</th>
		        <th>Hts C</th>
		        <th>Sti Screening R</th>
		        <th>Sti Screening C</th>
		        <th>Sti Treatment R</th>
		        <th>Sti Treatment C</th>
		        <th>Legal Aid R</th>
		        <th>Legal Aid C</th>
		        <th>Pep R</th>
		        <th>Pep C</th>
		        <th>Pmtct R</th>
		        <th>Pmtct C</th>
		        <th>Fp R</th>
		        <th>Fp C</th>
		        <th>Others R</th>
		        <th>Others C</th>
		        <th>Comments</th>
		    </tr>
			</thead>
            <tbody></tbody>
          </table>
      	</div>
      	
      </div>
    	

    	
    </div>
</section>
@endsection

