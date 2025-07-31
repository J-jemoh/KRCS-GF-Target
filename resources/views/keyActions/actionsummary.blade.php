@extends('layouts.admin')
@section('content')
 <div class="content-header bg-info">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-white">Home</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Management Actions</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Summary</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
  	<div class="container-fluid">
  		<div class="card">
  			<div class="card-header"><h4><b>My Summaries</b>
  				<button onclick="exportTableToXLSX('actionsTable', 'Key_Actions_Report')" class="btn btn-info float-sm-right ml-4">
			    <i class="fas fa-file-export"></i> Export to Excel
			</button>

			<div class="mb-4 float-sm-right">
			   <!--  <label for="srFilter" class="font-semibold">Filter by SR Name:</label>
			    <input type="text" id="srFilter" placeholder="Enter SR Name..." class="border px-2 py-1 rounded w-1/3"> -->
						<form method="GET" class="d-flex gap-2 mb-3" style="max-width: 600px;">
						    <input type="text" name="sr_name" placeholder="Search SR Name"
						           value="{{ request('sr_name') }}" class="form-control" />
						    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> </button>
						</form>

			</div>


  			</div>
  				<div class="card-body">
  					<table class="table-auto w-full border mb-6 table" id="actionsTable">
					    <thead>
					        <tr class="bg-gray-100">
					            <th class="px-2 py-1 border">Department</th>
					            <th class="px-2 py-1 border">#</th>
					            <th class="px-2 py-1 border">Key Issue</th>
					            <th class="px-2 py-1 border">Action Plan</th>
					            <th class="px-2 py-1 border">SR Name</th>
					            <th class="px-2 py-1 border">Status</th>
					        </tr>
					    </thead>
					    <tbody>
					        @foreach ($keyActions as $department => $actions)
					            @foreach ($actions as $index => $issue)
					                <tr>
					                    @if ($index === 0)
					                        <td class="px-2 py-1 border" rowspan="{{ count($actions) }}">
					                            {{ $department }}
					                        </td>
					                    @endif
					                    <td class="px-2 py-1 border">{{ $index + 1 }}</td>
					                    <td class="px-2 py-1 border">{!! $issue->key_issues !!}</td>
					                    <td class="px-2 py-1 border">{!! $issue->mitigation_action !!}</td>
					                    <td class="px-2 py-1 border">{{ $issue->sr_name }}</td>
					                    <td class="px-2 py-1 border">{{ $issue->status_update }}</td>
					                </tr>
					            @endforeach
					        @endforeach
					    </tbody>
					</table>


  				</div>
  		</div>
  	</div>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  	<script>
		function exportTableToXLSX(tableId) {
		    var table = document.getElementById(tableId);
		    var workbook = XLSX.utils.table_to_book(table, {sheet: "KeyActions"});
		    XLSX.writeFile(workbook, "Key_Actions_Report.xlsx");
		}
		</script>
		<script>
    document.getElementById("srFilter").addEventListener("keyup", function () {
        const input = this.value.toLowerCase();
        const filterValues = input.split(',').map(s => s.trim()).filter(s => s !== '');
        const table = document.getElementById("actionsTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const srCell = rows[i].cells[4]; // SR Name column
            if (srCell) {
                const srText = srCell.textContent.toLowerCase().trim();
                const match = filterValues.some(val => srText.includes(val));
                rows[i].style.display = match || filterValues.length === 0 ? "" : "none";
            }
        }
    });
</script>



  	@endsection