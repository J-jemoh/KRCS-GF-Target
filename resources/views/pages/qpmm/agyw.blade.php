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
              <li class="breadcrumb-item active"><a href="{{route('admin.qpmm')}}" class="text-white">QPMM</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.reports')}}" class="text-white">REPORTS</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">AGYW REPORT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">AGYW REPORTS</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr class="bg-danger">
    						<th colspan="3">General Information</th>
				            <th colspan="4">Year 1 JULY,2021 -JUNE ,2022</th>
				            <th colspan="4">Year 2 JULY,2022 -JUNE ,2023</th>
				            <th colspan="5">Year 3 JULY,2023 -JUNE ,2024</th>
				            <th colspan="4">Program Achievements JULY,2021 -JUNE ,2022</th>
			        	</tr>
    					<tr>
    						<th>SNo</th>
                <th>Region</th>
    						<th>Target Group</th>
    						<th>Indicators</th>
    						<th>Quater 1</th>
    						<th>Quater 2</th>
    						<th>Quater 3</th>
    						<th>Quater 4</th>
    						<th>Quater 5</th>
    						<th>Quater 6</th>
    						<th>Quater 7</th>
    						<th>Quater 8</th>
    						<th>Quater 9</th>
    						<th>Quater 10</th>
    						<th>Quater 11</th>
    						<th>Quater 12</th>
    						<th>Total</th>
    						<th>PA Quater 1</th>
    						<th>PA Quater 2</th>
    						<th>PA Quater 3</th>
    						<th>PA Quater 4</th>
    						<th>PA Quater 5</th>
    						<th>PA Quater 6</th>
    						<th>PA Quater 7</th>
    						<th>PA Quater 8</th>
    						<th>PA Quater 9</th>
    						<th>PA Quater 10</th>
    						<th>PA Quater 11</th>
    						<th>PA Quater 12</th>
    						<th>PATotal</th>
    						<th>%GE</th>
    						
    					</tr>
    				</thead>
    			</table>
    		</div>
    	</div>
    </div>
</section>
@endsection