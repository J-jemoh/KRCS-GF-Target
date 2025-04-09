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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Weekly Updates</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
          @include('messages.flash_messages')
      <div class="card card-danger">
        <div class="card-header"><h4>Department: {{$weekly->department}} <br>
         Week: {{$weekly->week}}<br>
         From: {{$weekly->start_date }} - {{$weekly->end_date}}</h4>
        </div>
        <div class="card-body" style="background-color: #FDFAF6;">
         <div class="row">
         	<div class="col-lg-6">
         		<div class="card">
         		<div class="card-header"><b>Achievements This Week </b></div>
         		<div class="card-body">
         			<p>
         				{!!$weekly->achievements!!}
         			</p>
         		</div>
         	</div>
         	</div>
         	<div class="col-lg-6">
         		<div class="card">
         		<div class="card-header"><b>Work Planned Upcoming Week </b></div>
         		<div class="card-body">
         			<p>
         				{!!$weekly->work_plan!!}
         			</p>
         		</div>
         	</div>
         	</div>
         </div>
         <div class="row">
         	<div class="col-lg-6">
         		<div class="card">
         		<div class="card-header"><b>Key Risks, Issues or Dependencies </b></div>
         		<div class="card-body">
         			<p>
         				{!!$weekly->key_risks!!}
         			</p>
         		</div>
         	</div>
         	</div>
         	<div class="col-lg-6">
         		<div class="card">
         		<div class="card-header"><b>Other Comments (add as you deem fit) </b></div>
         		<div class="card-body">
         			<p>
         				{!!$weekly->comments!!}
         			</p>
         		</div>
         	</div>
         	</div>
         </div>
         <div class="row">
         	<div class="col-12">
         		<div class="card">
         		<div class="card-header"><b>Urgent Arising Matters Requiring SMT Intervention: </b></div>
         		<div class="card-body">
         			<p>
         				{!!$weekly->matters_arising!!}
         			</p>
         		</div>
         	</div>
         	</div>
         </div>
        </div>
      </div>
    </div>
  </section>

  @endsection