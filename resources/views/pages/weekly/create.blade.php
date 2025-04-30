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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Weekly</a></li>
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

        <div class="card-header"><b>New weekly Report</b>
        </div>
        <div class="card-body">
       <form method="post" action="{{route('department.store')}}">
      		@csrf
          <div class="row">
          	<div class="row">
              <div class="col-sm-6">
                <div class="form-group">
            <label for="exampleFormControlSelect1">Choose Department</label>
            <select class="form-control" id="exampleFormControlSelect1" name="department" required>
              <option>Human Resource</option>
              <option>Legal</option>
              <option>Finance</option>
              <option>Procurement</option>
              <option>ICT</option>
              <option>Logistics</option>
              <option>Security</option>
              <option>Global Fund</option>
            </select>
          </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
            <label for="exampleFormControlSelect1">Choose Region</label>
            <select class="form-control" id="exampleFormControlSelect1" name="region">
              <option>HQ</option>
              <option>LER</option>
              <option>UER</option>
              <option>NER</option>
              <option>COR</option>
              <option>NRR</option>
              <option>WKR</option>
            </select>
          </div>
              </div>
          	
          	</div>
          	<div class="col-sm-4">
          		<div class="form-group">
				    <label for="exampleFormControlSelect1">Choose Week</label>
				    <select class="form-control" id="exampleFormControlSelect1" name="week" required>
				      <option>Week 1</option>
				      <option>Week 2</option>
				      <option>Week 3</option>
				      <option>Week 4</option>
				    </select>
				  </div>
          	</div>
          	<div class="col-sm-4">
          		<div class="form-group">
				    <label for="exampleFormControlInput1">Start Date</label>
				    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="date" name="sdate" required>
				  </div>
          	</div>
          	<div class="col-sm-4">
          		<div class="form-group">
				    <label for="exampleFormControlInput1">End Date</label>
				    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="edate" name="edate" required>
				  </div>
          	</div>
          </div>
          <div class="row">
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Achievements This Week </label>
          		<textarea name="achievments" class="form-control" id="notes" rows="5" ></textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Work Planned Upcoming Week </label>
          		<textarea name="work_plan" class="form-control" id="notes1" rows="5" ></textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Key Risks, Issues or Dependencies </label>
          		<textarea name="key_issues" class="form-control" id="notes2" rows="5"></textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Other Comments (add as you deem fit) </label>
          		<textarea name="comments" class="form-control" id="notes3" rows="5"></textarea>
          		</div>
          	</div>
          	<div class="col-12">
          		<div class="form-group">
          		<label for="exampleFormControlInput1">Urgent Arising Matters Requiring SMT Intervention </label>
          		<textarea name="urgent_matters" class="form-control" id="notes4" rows="5" ></textarea>
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