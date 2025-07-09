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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Monthly</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Edit</a></li>

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

        <div class="card-header"><b>Edit Regional Monthly Highlight-{{$highlight->id}}</b>
        </div>
        <div class="card-body">
       <form method="post" action="{{route('monthly.update',$highlight->id)}}">
      		@csrf
          @method('put')
          <div class="row">
          	<div class="row">
              <div class="col-sm-4">
                <div class="form-group">
            <label for="exampleFormControlSelect1">Region</label>
            <select class="form-control" id="exampleFormControlSelect1" name="region" required>
            	<option>{{$highlight->region}}</option>
              <option>LER</option>
              <option>UER</option>
              <option>NER</option>
              <option>COR</option>
              <option>NRR</option>
              <option>WKR</option>
            </select>
          </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
				    <label for="exampleFormControlInput1">Start Date</label>
				    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="date" name="sdate" required value="{{$highlight->start_date}}">
				  </div>
              </div>
          	
          	
          	<div class="col-sm-4">
          		<div class="form-group">
				    <label for="exampleFormControlInput1">End Date</label>
				    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="edate" name="edate" required value="{{$highlight->end_date}}">
				  </div>
          	</div>
          	</div>
          	
          </div>
          <div class="row">
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Key Highlights </label>
          		<textarea name="key_highlight" class="form-control" id="notes" rows="5" >{!!$highlight->key_highlights!!}</textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Key Actions </label>
          		<textarea name="key_action" class="form-control" id="notes1" rows="5" >{!!$highlight->key_action_points!!}</textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Support required from HQ </label>
          		<textarea name="hq_support" class="form-control" id="notes2" rows="5">{!!$highlight->hq_support!!}</textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Plans for next month </label>
          		<textarea name="month_plan" class="form-control" id="notes3" rows="5">{!!$highlight->next_month_plans!!}</textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Supervisor Comments </label>
          		<textarea name="s_comments" class="form-control" id="notes4" rows="5" readonly></textarea>
          		</div>
          	</div>
          </div>
          <div class="row">
			    <div class="d-flex justify-content-end gap-2">
			        <button class="btn btn-info" onclick="history.back()"><i class="fa fa-times"></i> Cancel</button>
			        <button class="btn btn-warning" type="submit" name="action" value="draft" ><i class="fa fa-save"></i> Save</button>
              <button class="btn btn-danger" type="submit" name="action" value="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
			    </div>
			</div>
    	</form>
        </div>

      </div>
    </div>
  </section>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const noteIds = ['#notes', '#notes1', '#notes2', '#notes3', '#notes4'];

  noteIds.forEach(id => {
    const element = document.querySelector(id);
    if (element) {
      ClassicEditor
        .create(element)
        .then(editor => {
          console.log(`CKEditor initialized for ${id}`);
        })
        .catch(error => {
          console.error(`Error initializing ClassicEditor for ${id}:`, error);
        });
    }
  });
});
</script>

  @endsection