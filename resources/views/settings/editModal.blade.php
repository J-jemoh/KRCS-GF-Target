<div class="modal fade" id="setting-{{$setting->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  	<form></form>
  	  <form method="post" action="{{route('admin.manage.settings.update',$setting->id)}}">
    	@csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b class="text-dark">Do you want to update this record?</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
    					<label class="text-dark">Month</label>
    					<select name="month" class="form-control" required>
    						>
    						<option>{{$setting->month}}</option>
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
    					<label class="text-dark">Year</label>
    					<select name="year" class="form-control">
    						<option><?php echo date("Y");?></option>
    					</select>
    					<div class="row">
    						<div class="col-sm-6">
    							<label class="text-dark">Start Date</label>
    							<input type="date" name="start_date" class="form-control" required value="{{$setting->start_date}}">
    						</div>
    						<div class="col-sm-6">
    							<label class="text-dark">End Date</label>
    							<input type="date" name="end_date" class="form-control" required value="{{$setting->end_date}}">
    						</div>
    					</div>
    					
    					
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
</form>
  </div>
</div>