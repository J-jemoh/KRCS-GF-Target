      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.ayp.download.hcbf')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
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
                  {{$aypHCBFCounts->srcount}}
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
                <span class="info-box-number">{{$aypHCBFCounts->countycount}}</span>
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
                <span class="info-box-number">{{$aypHCBFCounts->regioncount}}</span>
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
                <span class="info-box-number">{{$aypHCBFCounts->enrolledcount}}</span>
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
                  <canvas id="genderrPieChart"></canvas>
              </div>
              </div>
              <div class="col-sm-4">
                <b>Age distribution</b>
                <div style="width: 100%;">
                  <canvas id="ageePieChart"></canvas>
              </div>
              </div>
              <div class="col-sm-4">
                <b class="text-center">Completed sessions Distribution</b>
                <div style="width: 100%;">
                  <canvas id="CsessionssPieChart"></canvas>
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
                  <canvas id="countyhPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-6">
                <div class="card card-body bg-light">
                <p><b> By SR Distribution</b></p>
                <div style="width: 100%;">
                  <canvas id="SRhdistributionChart"></canvas>
              </div>
              </div>
              </div>
              </div>
              </div>
            </div>

 <!--      <div class="card card-info">
        <div class="card-header">More visualizations</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>Tested for HIV</b></p>
                <div style="width: 100%;">
                  <canvas id="hivTestPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b> Initiated on ART</b></p>
                <div style="width: 100%;">
                  <canvas id="artInitaitedPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Screened for STI</b></p>
                <div style="width: 100%;">
                  <canvas id="stiScreenedPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Treated for STI</b></p>
                <div style="width: 100%;">
                  <canvas id="stiTreated" height="500"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Screened for TB</b></p>
                <div style="width: 100%;">
                  <canvas id="tbScreened" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Treated for TB</b></p>
                <div style="width: 100%;">
                  <canvas id="tbTreated" height="500"></canvas>
              </div>
              </div>
              </div>
              </div>
              </div>
            </div> -->
            @include('scripts.hcbf')