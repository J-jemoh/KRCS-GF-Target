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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Report Summary</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-header"><b>Summary Report for all the regions</b></div>
    		<div class="card-body">
<!--     			<table id="example1" class="table table-bordered table-striped">
                        <thead>
                        	<tr>
                        		<th>#</th>
                        		<th>Region</th>
                        		<th>No of Reports</th>
                        		<th>Achievemnts</th>
                        		<th>Work Plan</th>
                        		<th>Key Risks</th>
                        	</tr>
                        </thead>
                        <tbody>
                        	@foreach($summaries as $summary)
                        	<tr>
                        		<td>#</td>
                        		<td>{{$summary->region}}</td>
                        		<td>{{$summary->total_reports}}</td>
                        		<td>{!! $summary->achievements_summary!!}</td>
                        		<td>{!! $summary->workplan_summary!!}</td>
                        		<td>{!! $summary->key_risks_summary!!}</td>
                        	</tr>
                        	@endforeach
                        </tbody>
                    </table> -->
             @foreach($summaries as $summary)  
              <div class="accordion accordion-flush" id="accordionFlushExample">
			  <div class="accordion-item">
			    <h2 class="accordion-header">
			      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{$summary->region}}" aria-expanded="false" aria-controls="flush-collapseOne">
			        <b>{{$summary->region}} - Total Reports: </b>{{$summary->total_reports}}
			      </button>
			    </h2>
			    <div id="flush-collapseOne-{{$summary->region}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
			      <div class="accordion-body">
			      	<p><b>Summary of achievements</b></p>
			      	<p>{!! $summary->achievements_summary!!}</</p>
			      	<p><b>Work Plan summary</b></p>
			      	<p>{!! $summary->workplan_summary!!}</p>
			      	<b>Key Risks summary</b>
			      	<p>{!! $summary->key_risks_summary!!}</p>
			      </div>
			    </div>
			  </div>

			</div>
			@endforeach
    		</div>
    	</div>
    </div>
</section>
@endsection