<!-- Modal -->
<div class="modal fade" id="return-{{$asset->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form></form>
    	<form method="post" action="{{route('assets.return')}}">
    		@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You are about to Return <b>{{$asset->serial_no}}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="form-group">
		    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="id" value="{{$asset->id}}" hidden name="asset_id">
		  </div>
		  <div class="form-group">
		    <label>Returned By(Name)</label>
		    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" required name="return_by">
		  </div>
		  <div class="form-group">
		    <label>Return Date</label>
		    <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="" required name="return_date">
		  </div>
		  <div class="form-group">
		  	<label>Condition</label>
		    <select class="form-control" name="return_condition" required>
		    <option>New(Excellent)</option>
		    <option>Good</option>
		    </select>
		  </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Submit</button>
      </div>
  </form>
    </div>
  </div>
</div>