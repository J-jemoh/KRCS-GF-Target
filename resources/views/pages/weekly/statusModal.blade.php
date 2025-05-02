<!-- Modal -->
<div class="modal fade" id="status-{{$weekly->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<form method="post" action="{{route('department.updateStatus',$weekly->id)}}">
    		@csrf
    		@method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Change status</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
        	<b class="text-danger">Are you sure you want to change the status of this Report to draft? </b>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Update</button>
      </div>
	</form>
    </div>
  </div>
</div>