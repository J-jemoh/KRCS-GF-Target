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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Create</a></li>

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
     				<b>Create a new Management Action</b>
     			</div>
     			<div class="card-body">
     				<form method="POST" action="{{route('keyActions.store')}}">
     					@csrf

     					<div class="row">
     						<div class="col-sm-12">
     						<div class="form-group">
					            <label for="exampleFormControlSelect1">Select Duration</label>
					            <select class="form-control" id="exampleFormControlSelect1" name="duration" required>
					            	<option>select duration</option>
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
				            <select class="form-control" name="region" required id="region-select">
				              <option value="LER">LER</option>
				              <option value="UER">UER</option>
				              <option value="NER">NER</option>
				              <option value="COR">COR</option>
				              <option value="NRR">NRR</option>
				              <option value="WKR">WKR</option>
				            </select>
				          </div>
	              </div>
	              <div class="col-sm-4">
	                <div class="form-group">
				            <label for="exampleFormControlSelect1">Select Category</label>
				            <select class="form-control" id="exampleFormControlSelect1" name="department" required>
				              <option>M & E</option>
				              <option>Programmatc</option>
				              <option>Financial Management</option>
				              <option>Contractual Conditions</option>
				              <option>Governance</option>
				              <option>Audit</option>
				            </select>
				          </div>
	              </div>
	              <div class="col-sm-4">
	              	<label>Sr Name</label>
	              	 <select class="form-control" name="sr_name" id="sr-name-select" required>
						        <option value="">Select SR Name</option>
						    </select>
	              	<!-- <input type="text" name="sr_name" class="form-control" required> -->
	              </div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Key Issues </label>
			          		<textarea name="key_issues" class="form-control" id="notes" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Root Cause Contextual Information </label>
			          		<textarea name="root_cause" class="form-control" id="notes1" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Recommended Mitigating Action  </label>
			          		<textarea name="mitigation_plans" class="form-control" id="notes2" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		<div class="col-sm-6">
		                  <div class="form-group">
						    <label for="exampleFormControlInput1">Timeline</label>
						    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="date" name="timeline" required>
						  </div>
		              </div>
		            
		              <div class="col-sm-6">
		              	<label>Status</label>
		              	<select class="form-control" name="statusupdate" required>
		              		<option>Please select </option>
		              		<option>Pending</option>
		              		<option>Ongoing</option>
		              		<option>Closed/solved</option>
		              	</select>
		              </div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">SR Response  </label>
			          		<textarea name="sr_response" class="form-control" id="notes6" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Reference documents  </label>
			          		<textarea name="reference_documents" class="form-control" id="notes3" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Attachments Provide by SR (Provide attachements inform of a link to the documents)  </label>
			          		<textarea name="sr_attachments" class="form-control" id="notes4" rows="5" ></textarea>
			          		</div>
	              	</div>
	              	<div class="row">
	              		  <div class="form-group">
			          		<label for="exampleFormControlInput1">Attachments Provide by PR </label>
			          		<textarea name="pr_attachments" class="form-control" id="notes5" rows="5" ></textarea>
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
		document.addEventListener('DOMContentLoaded', function () {
		  const noteIds = ['#notes', '#notes1', '#notes2', '#notes3', '#notes4','#notes5','#notes6'];

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
	<script>
    $(document).ready(function () {
        $('#region-select').on('change', function () {
            var region = $(this).val();
            var srDropdown = $('#sr-name-select');
            var url = "{{ route('get.srs.by.region', ':region') }}"; // route name with placeholder

            srDropdown.empty().append('<option value="">Loading...</option>');

            if (region) {
                // Replace placeholder with actual region
                url = url.replace(':region', region);

                $.get(url, function (data) {
                    srDropdown.empty().append('<option value="">Select SR Name</option>');
                    $.each(data, function (index, value) {
                        srDropdown.append('<option value="' + value + '">' + value + '</option>');
                    });
                }).fail(function () {
                    srDropdown.empty().append('<option value="">Error loading SRs</option>');
                });
            } else {
                srDropdown.empty().append('<option value="">Select SR Name</option>');
            }
        });
    });
</script>

    @endsection
