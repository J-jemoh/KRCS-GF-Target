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
              <li class="breadcrumb-item active text-white">TYPOLOGY</li>
               <li class="breadcrumb-item active text-white">TCS</li>
               <li class="breadcrumb-item active text-white">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">All TCS reports</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-6">
    					<div class="small-box bg-success">
			              <div class="inner">
			                <h3>All</h3>
			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</section>

 @endsection