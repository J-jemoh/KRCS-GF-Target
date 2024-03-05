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
              <li class="breadcrumb-item active"><a href="{{route('admin.gc7')}}" class="text-white">Reports</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">GC7-Coverage</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
          @include('messages.flash_messages')
      <div class="card card-danger">
        <div class="card-header">GC7 Program Coverage  </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>County</th>
                <th>DHTS</th>
                <th>TCS</th>
                <th>PMTCT</th>
                <th>AYP</th>
                <th>MSM</th>
                <th>FSW</th>
                <th>TG</th>
                <th>PWID</th>
                <th>HRG</th>
                <th>FF</th>
                <th>TRUCKERS</th>
                <th>DC</th>
                <th>PRISON</th>
                <th>Total Program</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach($coverages as $coverage)
              <tr>
                <td>{{$coverage->id}}</td>
                <td>{{$coverage->county}}</td>
                <td><span class="badge badge-success">{{$coverage->dhts}}</span></td>
                <td><span class="badge badge-info">{{$coverage->tcs}}</span></td>
                <td><span class="badge badge-danger">{{$coverage->pmtct}}</span></td>
                <td><span class="badge badge-warning">{{$coverage->ayp}}</span></td>
                <td><span class="badge badge-secondary">{{$coverage->msm}}</span></td>
                <td><span class="badge badge-success">{{$coverage->fsw}}</span></td>
                <td><span class="badge badge-info">{{$coverage->tg}}</span></td>
                <td><span class="badge badge-danger">{{$coverage->pwid}}</span></td>
                <td><span class="badge badge-warning">{{$coverage->hrg}}</span></td>
                <td><span class="badge badge-secondary">{{$coverage->ff}}</span></td>
                <td><span class="badge badge-success">{{$coverage->truckers}}</span></td>
                <td><span class="badge badge-info">{{$coverage->dc}}</span></td>
                <td><span class="badge badge-primary">{{$coverage->prison}}</span></td>
                <td><span class="badge badge-danger">{{$coverage->total_program}}</span></td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-warning"><i class="fa fa-eye"></i></button>
                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-danger">
        <div class="card-header">Summary by County for all modules</div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>DHTS</th>
                <th>TCS</th>
                <th>PMTCT</th>
                <th>AYP</th>
                <th>MSM</th>
                <th>FSW</th>
                <th>TG</th>
                <th>PWID</th>
                <th>HRG</th>
                <th>FF</th>
                <th>TRUCKERS</th>
                <th>DC</th>
                <th>PRISON</th>
                <th>Total Program</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>No of Counties</td>
                <td>{{$dhts}}</td>
                <td>{{$tcs}}</td>
                <td>{{$pmtct}}</td>
                <td>{{$ayp}}</td>
                <td>{{$msm}}</td>
                <td>{{$fsw}}</td>
                <td>{{$tg}}</td>
                <td>{{$pwid}}</td>
                <td>{{$hrg}}</td>
                <td>{{$ff}}</td>
                <td>{{$truckers}}</td>
                <td>{{$dc}}</td>
                <td>{{$prison}}</td>
                <td>{{$total}}</td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="card card-danger">
        <div class="card-header">Visualization of modules</div>
        <div class="card-body">
          <canvas id="moduleChart" width="500" height="130" ></canvas>
        </div>
      </div>
    </div>
  </section>

  @endsection
   <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('moduleChart').getContext('2d');

            var modules = {!! json_encode($modules) !!};
            var moduleLabels = Object.keys(modules);
            var moduleCounts = Object.values(modules);

            var colors = generateRandomColors(moduleLabels.length);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: moduleLabels,
                    datasets: [{
                        label: 'Module Counts',
                        data: moduleCounts,
                        backgroundColor: colors,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            function generateRandomColors(count) {
                var colors = [];
                for (var i = 0; i < count; i++) {
                    colors.push('rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',0.2)');
                }
                return colors;
            }
        });
    </script>