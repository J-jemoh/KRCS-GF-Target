<!-- Modal -->
<div class="modal fade" id="comment-{{$highlight->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    	<form method="post" action="{{route('monthly.addComment')}}">
    		@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Add Comment</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="text" name="highlight_id" class="form-control" value="{{$highlight->id}}" hidden>
       <label>Comment</label>
       <textarea name="comment" class="form-control" rows="4" cols="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Add</button>
      </div>
	</form>
    </div>
  </div>
</div>