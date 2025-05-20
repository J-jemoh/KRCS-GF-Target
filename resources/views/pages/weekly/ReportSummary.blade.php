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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Seport Summary</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-header">Summary Report for all the regions</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
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
                    </table>

    		</div>
    	</div>
    </div>
</section>
@endsection