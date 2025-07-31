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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Management Actions</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
  	<div class="container-fluid">
		@include('messages.flash_messages')
  		<div class="card">
  			<div class="card-header">
  				<b>Viewing {{$action->category}} Management Actions for {{$action->sr_name}} SR</b>
  				
			           <a href="#" class="btn btn-danger float-sm-right ml-2">
			            <i class="fas fa-file-word"></i> Download PDF Report
			        </a>
			           <a href="#" class="btn btn-success float-sm-right ml-2">
			            <i class="fas fa-file-word"></i> Download Word Report
			        </a>
			       @can('Delete')
			       @role('Super Admin')
			        <button type="button" class="btn btn-warning float-sm-right ml-2 " data-toggle="modal" data-target="#status-{{$action->id}}">
			          Update Status
			        </button>
			        @endrole
			        @endcan
			        @can('Update Actions')
			        <button type="button" class="btn btn-info float-sm-right " data-toggle="modal" data-target="#statusUpdate-{{$action->id}}">
			           Status Update
			        </button>
			        @endcan
			       
         @include('keyActions.statusUpdateModal')
          @include('keyActions.statusModal')
     
  			</div>
  			<div class="card-body">
  				<div class="row">
  					<div class="col-4">
  						  <p>Management for period: <b>{{$action->duration}}</b></p>
  					</div>
  					<div class="col-4">
  						  <p class="text-danger">Timeline: <b>{{$action->date}}</b></p>
  					</div>
  					<div class="col-4">
  						  <p class="text-danger">Status: <b>{{$action->status_update}}</b></p>
  					</div>
  				</div>
  				<p><b>Key Issues</b></p>
  				{!!$action->key_issues!!}
  				<p><b>Root Cause Contextual Information</b></p>
  				{!!$action->root_cause!!}
  				<p><b>Recommended Mitigating Action </b></p>
  				{!!$action->mitigation_action!!}
  				<p><b>Suppoting Documents</b></p>
  				<hr style="border: solid 2px; color: #black;">
  				<p><b>Reference documents</b></p>
  				{!!$action->reference_documents!!}
  				<p><b>Attachments Provide by SR (Provide attachements inform of a link to the documents)</b></p>
  				{!!$action->sr_attachmemts!!}
  				<p><b>Attachments Provide by PR</b></p>
  				{!!$action->pr_attachments!!}
  			</div>
  		</div>
  	</div>
  </section>
  @endsection