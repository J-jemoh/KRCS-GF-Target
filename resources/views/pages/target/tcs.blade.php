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
              <li class="breadcrumb-item active"><a href="{{route('admin.target.all')}}" class="text-white">Targets</a></li>
               <li class="breadcrumb-item active"><a href="{{route('admin.target.reports')}}" class="text-white">Reports</a></li>
                <li class="breadcrumb-item active text-white">TCS</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
     <section class="content">
    <div class="container-fluid">
    	<div class="card card-danger">
    		<div class="card-header"><b>TCS TARGET INDICATOR</b></div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>#</th>
    						<th>Module</th>
    						<th>Quater</th>
    						<th>Year</th>
    						<th>Region</th>
    						<th>SR</th>
    						<th>County</th>
    						<th>Defined(Q1)</th>
    						<th>Defined (Q2)</th>
    						<th>Defined(Target)</th>
    						<th>Defined(Sem)</th>
    						<th>Defined(Performance)</th>
    						<th>HTS(Q1)</th>
    						<th>HTS(Q2)</th>
    						<th>HTS(Target)</th>
    						<th>HTS(Sem)</th>
    						<th>HTS(Performance)</th>
    						<th>Prep(Q1)</th>
    						<th>Prep(Q2)</th>
    						<th>Prep(Target)</th>
    						<th>Prep(Total)</th>
    						<th>Prep(Performance)</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($tcsdata as $target)
    					<tr>
			    		  <td>{{$target->id}}</td>
			              <td>{{$target->module}}</td>
			              <td>{{$target->quater}}</td>
			              <td>{{$target->year}}</td>
			              <td>{{$target->reqion}}</td>
			              <td>{{$target->sr}}</td>
			              <td>{{$target->county}}</td>
			              <td>{{$target->defined_q1}}</td>
			              <td>{{$target->defined_q2}}</td>
			              <td>{{$target->defined_target}}</td>
			              <td>{{$target->defined_sem}}</td>
			              <td>{{round($target->defined_performance,2)}}</td>
			              <td>{{$target->hts_q1}}</td>
			              <td>{{$target->hts_q2}}</td>
			              <td>{{$target->hts_target}}</td>
			              <td>{{$target->hts_sem}}</td>
			              <td>{{round($target->hts_performance,2)}}</td>
			              <td>{{$target->prep_q1}}</td>
			              <td>{{$target->prep_q2}}</td>
			              <td>{{$target->prep_target}}</td>
			              <td>{{$target->prep_total}}</td>
			              <td>{{round($target->prep_performance,2)}}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
</section>
 @endsection