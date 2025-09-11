<div class="modal fade" id="restore{{$highlight->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form action="{{ route('highlights.restore', $highlight->id) }}" method="POST" onsubmit="return confirm('Restore this highlight?');">
		    @csrf
		    @method('PATCH')
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restore this Highlight?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to Restore this highlight?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-success">Yes, Restore</button>
      </div>
  </form>
    </div>
  </div>
</div>