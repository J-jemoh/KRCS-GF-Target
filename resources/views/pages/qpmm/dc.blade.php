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
              <li class="breadcrumb-item active"><a href="#" class="text-white">DC REPORT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">DC REPORTS</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
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
            <tbody>
              @foreach($dc as $qpmm)
              <tr>
                <td>{{$qpmm->sno}}</td>
                <td>{{$qpmm->region}}</td>
                <td>{{$qpmm->target_group}}</td>
                <td>{{Str::limit($qpmm->indicators,30)}}</td>
                <td>{{$qpmm->pt_quater_1}}</td>
                <td>{{$qpmm->pt_quater_2}}</td>
                <td>{{$qpmm->pt_quater_3}}</td>
                <td>{{$qpmm->pt_quater_4}}</td>
                <td>{{$qpmm->pt_quater_5}}</td>
                <td>{{$qpmm->pt_quater_6}}</td>
                <td>{{$qpmm->pt_quater_7}}</td>
                <td>{{$qpmm->pt_quater_8}}</td>
                <td>{{$qpmm->pt_quater_9}}</td>
                <td>{{$qpmm->pt_quater_10}}</td>
                <td>{{$qpmm->pt_quater_11}}</td>
                <td>{{$qpmm->pt_quater_12}}</td>
                <td>{{$qpmm->pt_total}}</td>
                <td>{{$qpmm->pa_quater1}}</td>
                <td>{{$qpmm->pa_quater2}}</td>
                <td>{{$qpmm->pa_quater3}}</td>
                <td>{{$qpmm->pa_quater4}}</td>
                <td>{{$qpmm->pa_quater5}}</td>
                <td>{{$qpmm->pa_quater6}}</td>
                <td>{{$qpmm->pa_quater7}}</td>
                <td>{{$qpmm->pa_quater8}}</td>
                <td>{{$qpmm->pa_quater9}}</td>
                <td>{{$qpmm->pa_quater10}}</td>
                <td>{{$qpmm->pa_quater11}}</td>
                <td>{{$qpmm->pa_quater12}}</td>
                <td>{{$qpmm->pa_total}}</td>
                <td>{{$qpmm->percent}}</td>
              </tr>
              @endforeach
            </tbody>
    			</table>
    		</div>
    	</div>
    </div>
</section>
@endsection