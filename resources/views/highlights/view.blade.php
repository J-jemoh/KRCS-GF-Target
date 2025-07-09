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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Monthly Highlights</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
          @include('messages.flash_messages')
      <div class="card ">
        <div class="card-header">
           <a href="{{route('monthly.download.pdf',$highlight->id)}}" class="btn btn-danger float-sm-right ml-2">
            <i class="fas fa-file-word"></i> Download PDF Report
        </a>
           <a href="{{route('monthly.download.word',$highlight->id)}}" class="btn btn-success float-sm-right ml-2">
            <i class="fas fa-file-word"></i> Download Word Report
        </a>
       @can('Delete')
       @role('Super Admin')
        <button type="button" class="btn btn-warning float-sm-right ml-2 " data-toggle="modal" data-target="#status-{{$highlight->id}}">
          Update Status
        </button>
        @endrole
        @endcan
        @can('Can Comment')
        <button type="button" class="btn btn-info float-sm-right " data-toggle="modal" data-target="#comment-{{$highlight->id}}">
          Add Comment
        </button>
        @endcan
        @include('highlights.commentModal')
        @include('highlights.statusModal')
         
        </div>
        <div class="card card-body">
	       	<h3 class="text-center"><b>Monthly Regional Highlighhts</b></h3>
	         <h4 class="text-center">Region: <b>{{$highlight->region}}</b></h4>
	         <h4 class="text-center">Month: <b>{{$highlight->created_at->format('F Y')}}</b></h4>

	         <hr style="background-color: 000;border:solid 2px;">
	         <h4><b>Key Highlights</b></h4>
	         <p>{!!$highlight->key_highlights!!}</p>
	         <h4><b>Key Actions</b></h4>
	         <p>{!!$highlight->key_action_points!!}</p>
	         <h4><b>Support required from HQ</b></h4>
	         <p>{!!$highlight->hq_support!!}</p>
	          <h4><b>Plans for next Month</b></h4>
	         <p>{!!$highlight->next_month_plans!!}</p>
	         <h4><b>Supervisor Comments</b></h4>
	         @foreach($highlight->highlightComments as $comment)
	         <p>{{$comment->comment ?? ''}}</p>
	         @endforeach

        </div>
        
      </div>
    </div>
  </section>

  @endsection