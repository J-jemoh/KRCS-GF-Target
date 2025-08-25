  <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Region</th>
                <th>Department</th>
                <th>SR Name</th>
                <th>Key Issues</th>
                <th>Root Cause</th>
                <th>Timeline</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($keyActions as $action)
            @if($action->status_update=='Pending')
            <tr>
            	<td>{{$action->id}}</td>
            	<td>{{$action->region}}</td>
            	<td>{{$action->category}}</td>
              <td>{{$action->sr_name}}</td>
            	<td>{!! Str::limit($action->key_issues, 50)!!}</td>
            	<td>{!! Str::limit($action->root_cause, 50)!!}</td>
            	<td>{{$action->date}}</td>
            	<td>{{$action->status_update}}</td>
            	<td>
            		<div class="btn-group" role="group" aria-label="Basic example">
                                @can('Edit')
                                @role('Super Admin')
                                <a type="button" class="btn btn-info" href="{{route('keyActions.edit',$action->id)}}"><i class="fa fa-edit"></i></a>
                                @endrole
                                @endcan
            
                                <a type="button" class="btn btn-warning" href="{{route('keyActions.show', $action->id)}}"><i class="fa fa-eye"></i></a>
                                @can('Delete')
                                @role('Super Admin')
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                @endrole
                                @endcan
                             
                              </div>
            	</td>
            </tr>
            @endif
              @endforeach
            </tbody>
          </table>