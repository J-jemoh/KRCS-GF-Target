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
              <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
              <li class="breadcrumb-item active text-white">Settings</li>
          
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	 @include('messages.flash_messages')
    	<div class="card card-info">
    		<div class="card-header">Manage User Uploads(Setting timeliness for User to Upload data.)</div>
    		<div class="card-body">
    			<div class="row">
    				<form></form>
    				
    				<div class="col-6">
    					<form method="post" action="{{route('admin.manage.settings.save')}}">
    					@csrf
    					<label>Month</label>
    					<select name="month" class="form-control" required>
    						<option>Select Month</option>
    						<option value="Jan">Jan</option>
    						<option value="Feb">Feb</option>
    						<option value="March">March</option>
    						<option value="April">April</option>
    						<option value="May">May</option>
    						<option value="June">June</option>
    						<option value="July">July</option>
    						<option value="August">August</option>
    						<option value="September">September</option>
    						<option value="October">October</option>
    						<option value="November">November</option>
    						<option value="December">December</option>
    					</select>
    					<br>
    					<label>Year</label>
    					<select name="year" class="form-control">
    						<option><?php echo date("Y");?></option>
    					</select>
    					<br>
    					<div class="row">
    						<div class="col-sm-6">
    							<label>Start Date</label>
    							<input type="date" name="start_date" class="form-control" required>
    						</div>
    						<div class="col-sm-6">
    							<label>End Date</label>
    							<input type="date" name="end_date" class="form-control" required>
    						</div>
    					</div>
    					<br>
    					<button class="btn btn-danger float-sm-right" type="submit">Save Setings</button>
    					</form>
    				</div>
					
					<div class="col-sm-6 bg-light">
						<table class="table table-condensed table-stripped" id="example1">
							<thead>
								<tr>
									<th>Month</th>
									<th>Year</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($settings as $setting)
								<tr>
									<td>{{$setting->month}}</td>
									<td>{{$setting->year}}</td>
									<td>{{$setting->start_date}}</td>
									<td>{{$setting->end_date}}</td>
									<td>
										<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#setting-{{$setting->id}}"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
								@include('settings.editModal')
								@endforeach
							</tbody>
						</table>
					</div>
    			</div>
    		</div>
    	</div>

    </div>
</section>
@endsection
