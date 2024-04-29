

<!-- Modal -->
<div class="modal fade" id="restore-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form></form>
    	<form method="post" action="{{route('admin.user.restore',$user->id)}}">
    		@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to restore this user-<strong class="text-danger">{{$user->name}}</strong></b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Note: By clicking Restore user button, the user will  be able to access the system again?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Restore user</button>
      </div>
      </form>
    </div>
  </div>
</div>