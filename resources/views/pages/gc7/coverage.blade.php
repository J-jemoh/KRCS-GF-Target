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
    </div>
  </section>

  @endsection