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
      <div class="card card-header bg-info">Eban Service Template</div>
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
		      <th>SNo</th>
		      <th>Month</th>
		      <th>Year</th>
		      <th>Region</th>
		      <th>Counties</th>
		      <th>COUPLE CODE</th>
		      <th>S1</th>
          <th>S2</th>
          <th>S3</th>
          <th>S4</th>
          <th>S5</th>
          <th>S6</th>
          <th>S7</th>
          <th>S8</th>
          <th>Make up sessions</th>
          <th>Complete session</th>
          <th>Provide with Condom</th>
          <th>PREP(R)</th>
          <th>PREP(C)</th>
          <th>PEP(R)</th>
          <th>PEP(C)</th>
          <th>PSS(R)</th>
          <th>PSS(C)</th>
          <th>HTS(R)</th>
          <th>HTS(C)</th>
          <th>FP(R)</th>
          <th>FP(C)</th>
          <th>GBV(R)</th>
          <th>GBV(C)</th>
          <th>STI(R)</th>
          <th>STI(C)</th>
          <th>VMMC(R)</th>
          <th>VMMC(C)</th>
          <th>AUDIT(R)</th>
          <th>AUDIT(C)</th>
          <th>CARE(R)</th>
          <th>CARE(C)</th>
          <th>CERVICAL CANCER-S(R)</th>
          <th>CERVICAL CANCER(C)</th>
          <th>PMTCT(R)</th>
          <th>PMTCT(C)</th>
          <th>OTHER(R)</th>
          <th>OTHER(C)</th>
          <th>Comments</th>
        	</tr>
            </thead>
            <tbody></tbody>
          </table>

    	
    </div>
</section>
@endsection

