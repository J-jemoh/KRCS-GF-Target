<!-- Modal -->
<div class="modal fade" id="issue-{{$asset->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form></form>
    	<form method="post" action="{{route('assets.issue')}}">
    		@csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You are about to Issue <b>{{$asset->serial_no}}</b></h5>
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
		  	<label>Region</label>
		    <select class="form-control" name="region" required>
		    <option>NER</option>
		    <option>LER</option>
		    <option>UER</option>
		    <option>WKR</option>
		    <option>NRR</option>
		    <option>COR</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label>SR Name</label>
		    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" required name="sr_name">
		  </div>
		  <div class="form-group">
		    <label>Person Issued to(Name)</label>
		    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" required name="issue_person_name">
		  </div>
		  <div class="form-group">
		    <label>Person Issued to(Contact)</label>
		    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" required name="contact">
		  </div>
		  <div class="form-group">
		    <label>Date Issued</label>
		    <input type="date" class="form-control" aria-describedby="" placeholder="" required name="date_issued">
		  </div>
		  <div class="form-group">
		  	<label>Condition</label>
		    <select class="form-control" name="condition" required>
		    <option>New(Excellent)</option>
		    <option>Good</option>
		    </select>
		  </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close</button>
        <button type="submit" class="btn btn-primary">Yes,Issue</button>
      </div>
  </form>
    </div>
  </div>
</div>