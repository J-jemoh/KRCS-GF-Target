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
              <li class="breadcrumb-item active"><a href="{{route('admin.fsw.index')}}" class="text-white">Typology</a></li>
               <li class="breadcrumb-item active"><a href="#" class="text-white">PMTCT</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">Reports</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.tg.consolidated')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
        </div>
         <div class="col-4">
             <a href="#" class="btn btn-info btn-block">Download/Export to Excel</a>
         </div>
      </div>
      <br>
      <div class="row">
     
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total No of SR'S</span>
                <span class="info-box-number">
                  {{$srCount}}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Counties</span>
                <span class="info-box-number">{{$counties}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Regions</span>
                <span class="info-box-number">{{$region}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enrolled</span>
                <span class="info-box-number">{{$enrolled}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>

      <div class="card card-info">
        <div class="card-header">Visualizations by Age</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>Age Range</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($results as $range => $count)
                      <tr>
                          <td>{{ $range }}</td>
                          <td>{{ $count }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;">
                  <canvas id="agePieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
          <div class="card card-info">
        <div class="card-header">Other Visualization</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>Lactating Mothers</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($lactatingstatus as $status)
                      <tr>
                          <td>{{ $status->lactating }}</td>
                          <td>{{ $status->count }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;">
                  <canvas id="hivStatusPieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>

      <div class="card card-info">
        <div class="card-header">More visualizations</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>Pregnant Mothers Status</b></p>
                <div style="width: 100%;">
                  <canvas id="hivFreqPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b> Reached by Expert Mothers</b></p>
                <div style="width: 100%;">
                  <canvas id="hivExpPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>ART Status</b></p>
                <div style="width: 100%;">
                  <canvas id="hivPepPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>Due for Viral Load</b></p>
                <div style="width: 100%;">
                  <canvas id="VLStatus" height="500"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>Currently on ART</b></p>
                <div style="width: 100%;">
                  <canvas id="ArtcBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>HIV Care Outcome</b></p>
                <div style="width: 100%;">
                  <canvas id="hivCareBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>ART Outcome</b></p>
                <div style="width: 100%;">
                  <canvas id="ArtBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Due for Viral Load</b></p>
                <div style="width: 100%;">
                  <canvas id="dueBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Viral Load Done</b></p>
                <div style="width: 100%;">
                  <canvas id="VlDoneBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Received Viral Load Result</b></p>
                <div style="width: 100%;">
                  <canvas id="VlRBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
 @include('scripts.pmtct')
@endsection
