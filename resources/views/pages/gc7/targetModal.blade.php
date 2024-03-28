<div class="modal fade" id="exampleModalCenter-{{$target->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  	<form></form>
    <form method="post" action="{{route('admin.pftarget.update',$target->id)}}">
    	@csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editing <b class="text-danger">{{$target->coverage_indicator}}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
        		<div class="col-4">
        			<label>Baseline Target</label>
        			<input type="text" name="baseline_dec" class="form-control" required value="{{$target->baseline_dec}}">
        		</div>
        		<div class="col-4">
        			<label>June Target2024</label>
        			<input type="text" name="june_target" class="form-control" required value="{{$target->june_target}}">
        		</div>
        		<div class="col-4">
        			<label>Period 1</label>
        			<input type="text" name="period1" class="form-control" required value="{{$target->period1}}">
        		</div>
        		<br>
        		<div class="col-4">
        			<label>Period 2</label>
        			<input type="text" name="period2" class="form-control" required value="{{$target->period2}}">
        		</div>
        		<div class="col-4">
        			<label>Period 3</label>
        			<input type="text" name="period3" class="form-control" required value="{{$target->period3}}">
        		</div>
        		<div class="col-4">
        			<label>Period 4</label>
        			<input type="text" name="period4" class="form-control" required value="{{$target->period4}}">
        		</div>
        		<div class="col-6">
        			<label>Period 5</label>
        			<input type="text" name="period5" class="form-control" required value="{{$target->period5}}">
        		</div>
        		<div class="col-6">
        			<label>Period 6</label>
        			<input type="text" name="period6" class="form-control" required value="{{$target->period6}}">
        		</div>
        	</div>
        	

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
      </div>
    </div>
     </form>
  </div>
</div>