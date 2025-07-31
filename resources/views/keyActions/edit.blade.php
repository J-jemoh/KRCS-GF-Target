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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Management Action</a></li>
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
     			<div class="card-header">
     				<b>Edit Action for {{$action->category}}</b>
     			</div>
     			<div class="card-body">
     				<form method="POST" action="{{route('keyActions.update', $action->id)}}">
     					@csrf
     					@method('PUT')

     					<div class="row">
     						<div class="col-sm-12">
     						<div class="form-group">
					            <label for="exampleFormControlSelect1">Select Duration</label>
					            <select class="form-control" id="exampleFormControlSelect1" name="duration" required>
					            	<option>{{$action->duration}}</option>
					              <option>July 2024 - June 2025</option>
					              <option>July 2025 - June 2026</option>
					              <option>July 2026 - June 2027</option>
					            </select>
					          </div>
     					</div>
     				</div>
     				<div class="row">
     				<div class="col-sm-4">
	                <div class="form-group">
				            <label for="exampleFormControlSelect1">Region</label>
				            <select class="form-control" id="exampleFormControlSelect1" name="region" required>
				            	<option>{{$action->region}}</option>
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
				            <label for="exampleFormControlSelect1">Select Category</label>
				            <select class="form-control" id="exampleFormControlSelect1" name="department" required>
				            	<option>{{$action->category}}</option>
				              <option>M & E</option>
				              <option>Programmatc</option>
				              <option>Financial Management</option>
				              <option>Contractual Conditions</option>
				              <option>Audit</option>
				            </select>
				          </div>
	              </div>
	              <div class="col-sm-4">
	              	<label>Sr Name</label>
	              	<input type="text" name="sr_name" class="form-control" required value="{{$action->sr_name}}">
	              </div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Key Issues </label>
			          		<textarea name="key_issues" class="form-control" id="notes" rows="5" >{{$action->key_issues}}</textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Root Cause Contextual Information </label>
			          		<textarea name="root_cause" class="form-control" id="notes1" rows="5" >{{$action->root_cause}}</textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Recommended Mitigating Action  </label>
			          		<textarea name="mitigation_plans" class="form-control" id="notes2" rows="5" >{{$action->mitigation_action}}</textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		<div class="col-sm-4">
		                  <div class="form-group">
						    <label for="exampleFormControlInput1">Timeline</label>
						    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="date" name="timeline" required value="{{$action->date}}">
						  </div>
		              </div>
		              <div class="col-sm-4">
		              	<label>SR Respeonse</label>
		              	<input type="text" class="form-control" name="sr_response" required value="{{$action->sr_response}}"> 
		              </div>
		              <div class="col-sm-4">
		              	<label>Status</label>
		              	<select class="form-control" name="statusupdate" required>
		              		<option>{{$action->status_update}}</option>
		              		<option>Please select </option>
		              		<option>Pending</option>
		              		<option>Ongoing</option>
		              		<option>Closed/solved</option>
		              	</select>
		              </div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Reference documents  </label>
			          		<textarea name="reference_documents" class="form-control" id="notes3" rows="5" >{{$action->reference_documents}}</textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Attachments Provide by SR (Provide attachements inform of a link to the documents)  </label>
			          		<textarea name="sr_attachments" class="form-control" id="notes4" rows="5" >{{$action->sr_attachmemts}}</textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Attachments Provide by PR </label>
			          		<textarea name="pr_attachments" class="form-control" id="notes5" rows="5" >{{$action->pr_attachments}}</textarea>
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
		  const noteIds = ['#notes', '#notes1', '#notes2', '#notes3', '#notes4','#notes5'];

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
