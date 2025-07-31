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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Report Summary</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
    	<div class="card">
    		<div class="card-header"><b>Summary Report for all the regions</b>
          <button onclick="exportTableToXLSX('actionsTable', 'Key_Actions_Report')" class="btn btn-info float-sm-right ml-4">
          <i class="fas fa-file-export"></i> Export to Excel
      </button>
          <div class="mb-4 float-sm-right">
         <!--  <label for="srFilter" class="font-semibold">Filter by SR Name:</label>
          <input type="text" id="srFilter" placeholder="Enter SR Name..." class="border px-2 py-1 rounded w-1/3"> -->
            <form method="GET" class="d-flex gap-2 mb-3" style="max-width: 600px;">
                <input type="text" name="region" placeholder="Search Region"
                       value="{{ request('region') }}" class="form-control" />
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> </button>
            </form>

      </div>
        </div>
    		  
        <div class="card-body">
            @php
                $grouped = $keyReports->getCollection()->groupBy('region');
            @endphp

            <table class="table-auto w-full border mb-6 table" id="actionsTable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-2 py-1 border">Region</th>
                        <th class="px-2 py-1 border">Week</th>
                        <th class="px-2 py-1 border">Start Date</th>
                        <th class="px-2 py-1 border">Key Issues</th>
                        <th class="px-2 py-1 border">Achievements</th>
                        <th class="px-2 py-1 border">Work Planned</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $department => $actions)
                        @foreach ($actions as $index => $issue)
                            <tr>
                                @if ($index === 0)
                                    <td class="px-2 py-1 border" rowspan="{{ $actions->count() }}">
                                        {{ $department }}
                                    </td>
                                @endif
                                <td class="px-2 py-1 border">{{ $issue->week }}</td>
                                <td class="px-2 py-1 border">{{ $issue->start_date }}</td>
                                <td class="px-2 py-1 border">{!! $issue->key_risks !!}</td>
                                <td class="px-2 py-1 border">{!! $issue->achievements !!}</td>
                                <td class="px-2 py-1 border">{!! $issue->work_plan !!}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            {{-- Laravel pagination links --}}
            <div class="mt-4">
              {{ $keyReports->links('pagination::bootstrap-5') }}
                <!-- {{ $keyReports->links() }} -->
            </div>
        </div>
    	</div>
    </div>
</section>
<!-- For Bootstrap 5 -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
    function exportTableToXLSX(tableId) {
        var table = document.getElementById(tableId);
        var workbook = XLSX.utils.table_to_book(table, {sheet: "KeyActions"});
        XLSX.writeFile(workbook, "Weekly_Summary_Report.xlsx");
    }
    </script>
@endsection