      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.ayp.download.mhmc')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
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
                  {{$aypMHMCCounts->srcount}}
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
                <span class="info-box-number">{{$aypMHMCCounts->countycount}}</span>
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
                <span class="info-box-number">{{$aypMHMCCounts->regioncount}}</span>
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
                <span class="info-box-number">{{$aypMHMCCounts->enrolledcount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>

      <div class="card card-info">
        <div class="card-header">Visualizations</div>
          <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                <b class="text-center">Gender Distribution</b>
                <div style="width: 100%;">
                  <canvas id="gendermPieChart"></canvas>
              </div>
              </div>
              <div class="col-sm-4">
                 <b class="text-center">Age distribution</b>
                <div style="width: 100%;">
                  <canvas id="agemPieChart"></canvas>
              </div>
              </div>
              <div class="col-sm-4">
                <b class="text-center">Completed sessions Distribution</b>
                <div style="width: 100%;">
                  <canvas id="CsessionmPieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>


      <div class="card card-info">
        <div class="card-header">More visualizations</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="card card-body bg-light">
                <p><b>By County Distribution</b></p>
                <div style="width: 100%;">
                  <canvas id="countymPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-6">
                <div class="card card-body bg-light">
                <p><b> By SR Distribution</b></p>
                <div style="width: 100%;">
                  <canvas id="SRdistributionChart"></canvas>
              </div>
              </div>
              </div>
              </div>
              </div>
            </div>
            @include('scripts.mhmc')