<!-- Modal -->
<div class="modal fade" id="statusUpdate-{{$action->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<form method="post" action="{{route('keyActions.statusUpdate',$action->id)}}">
    		@csrf
    		@method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Update the status of this Management action for  {{$action->sr_name}}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<label>Current status</label>
       <select class="form-control" name="staus_update1">
       	<option>{{$action->status_update}}</option>
       </select>
       <br>
       <label>Latest status</label>
       <select class="form-control" name="status_update">
       	<option>Pending</option>
		 <option>Ongoing</option>
		  <option>Closed/solved</option>
       </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Update</button>
      </div>
	</form>
    </div>
  </div>
</div>