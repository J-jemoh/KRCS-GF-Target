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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Typology</a></li>
               <li class="breadcrumb-item active"><a href="{{route('admin.fsw.index')}}" class="text-white">FSW</a></li>
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
        <div class="col-sm-4">
          <label>select Month</label>
          <select name="month" class="form-control" required name="month">
            @foreach( $monthyear as $month)
            <option value="{{$month->month}}">{{$month->month}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-4">
          <label>select Year</label>
          <select name="year" class="form-control" required>
            <option value="{{$month->year}}">{{$month->year}}</option>
          </select>
      </div>
        <div class="col-4">
          <label>..</label>
          <a href="{{route('admin.fsw.consolidated',['month' => $month->month, 'year' => $month->year])}}" class="btn btn-info btn-block">Download/Export to CSV</a>
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
      <br>
      <div class="card card-info">
        <div class="card-header">Performance tracking for coverage indicators</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4">
              <b>Defined package progress</b>
              <div id="container-speedd" style="width: 300px; height: 200px;"></div>
              <!-- <canvas id="container-speed" width="200" height="200"></canvas> -->
            </div>
             <div class="col-lg-4">
               <b class="text-center">Sex workers initiated on Prep</b>
              <div id="container-prep" style="width: 300px; height: 200px;"></div>
             </div>
              <div class="col-lg-4">
                <b class="text-center">Reached with HIV Testing Services</b>
              <div id="container-hts" style="width: 300px; height: 200px;"></div>
              </div>
             
          </div>
           </div>
          <div class="card card-body bg-light">
            <div class="row">
             <div class="col-12">
                <b>Bar chart indicator progress summary as at {{ date('Y-m-d') }} for achieved and Target assigned</b>
                <canvas id="IndcatorbarChartProgress" height="100"></canvas>
              </div>
            </div>
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
        <div class="card-header">HIV status at enrollment</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>HIV Status at enrollment</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($hivstatus as $status)
                      <tr>
                          <td>{{ $status->hiv_status_enrol }}</td>
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
        <div class="card-header">Indicators</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>Coverage Indicator</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>#of sex workers reached with HIV prevention programs - defined package</td>
                          <td>{{ $definedPackage }}</td>
                      </tr>
                      <tr>
                          <td># of eligible sex workers who initiated oral antiretroviral PrEP during the reporting period</td>
                          <td>{{$prepInitiated }}</td>
                        </tr>
                      <tr>
                          <td># of sex workers that have received an HIV test during the reporting period and know their results</td>
                          <td>{{$hivTested }}</td>
                        </tr>
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;" class="text-center">
                  <canvas id="pieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
      <div class="card card-info">
        <div class="card-header">Other visualizations</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>HIV tested frequency</b></p>
                <div style="width: 100%;">
                  <canvas id="hivFreqPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b> Potential HIV Exposure within 72 hrs</b></p>
                <div style="width: 100%;">
                  <canvas id="hivExpPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Provided with PEP within 72 hours</b></p>
                <div style="width: 100%;">
                  <canvas id="hivPepPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>HIV Status</b></p>
                <div style="width: 100%;">
                  <canvas id="hivStatusBarChart" height="500"></canvas>
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
 @include('scripts.fsw')
@endsection
