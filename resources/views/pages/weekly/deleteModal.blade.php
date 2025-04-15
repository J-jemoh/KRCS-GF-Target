<div class="modal fade" id="delete-{{$weekly->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form method="post" action="{{route('department.destroy',$weekly->id)}}">
    		@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Report for {{$weekly->department}} {{$weekly->week}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-body">
        	<p>Are you sure you want to delete this weekly report?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-danger">Yes,Delete</button>
      </div>
  </form>
    </div>
  </div>
</div>