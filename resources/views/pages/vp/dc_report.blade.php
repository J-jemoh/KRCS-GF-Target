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
              <li class="breadcrumb-item active"><a href="{{route('admin.vp.index')}}" class="text-white">Typology</a></li>
               <li class="breadcrumb-item active"><a href="#" class="text-white">DC</a></li>
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
          <a href="{{route('admin.pmtct.reports.download')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
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
                          <th>HIV status at enrollment</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($HIVstatEnrol as $status)
                      <tr>
                          <td>{{ $status->hiv_status_at_enrollment }}</td>
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
                <p><b>Received Health Education</b></p>
                <div style="width: 100%;">
                  <canvas id="HeducationPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b> Tested for HIV</b></p>
                <div style="width: 100%;">
                  <canvas id="hivExpPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Frequency of HIV Test</b></p>
                <div style="width: 100%;">
                  <canvas id="hivfreqPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>HIV status</b></p>
                <div style="width: 100%;">
                  <canvas id="HIVStatusPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b> Started on ART</b></p>
                <div style="width: 100%;">
                  <canvas id="SartPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Currently on ART</b></p>
                <div style="width: 100%;">
                  <canvas id="CartPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Due for Viral Load</b></p>
                <div style="width: 100%;">
                  <canvas id="VLStatus" height="500"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Received VL Test</b></p>
                <div style="width: 100%;">
                  <canvas id="vlResult" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>VL Results(Copies)</b></p>
                <div style="width: 100%;">
                  <canvas id="vlResultCopiesChart" height="500"></canvas>
              </div>
              </div>
              </div>

              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
 @include('scripts.dc')
@endsection
