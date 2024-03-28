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
              <li class="breadcrumb-item active"><a href="#" class="text-white">PF Targets</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
    <div class="container-fluid">
          @include('messages.flash_messages')
      <div class="card card-info">
        <div class="card-header">Performance Framework Targets  </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Coverage Indicator</th>
                <th>Baseline(Dec 2023)</th>
                <th>June24 Target</th>
                <th>P1</th>
                <th>P2</th>
                <th>P3</th>
                <th>P4</th>
                <th>P5</th>
                <th>P6</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($pftargets as $target)
            <tr>
            <td>{{$target->sno}}</td>
            <td>{{$target->coverage_indicator}}</td>
            <td>{{$target->baseline_dec}}</td>
            <td>{{$target->june_target}}</td>
            <td>{{$target->period1}}</td>
            <td>{{$target->period2}}</td>
            <td>{{$target->period3}}</td>
            <td>{{$target->period4}}</td>
            <td>{{$target->period5}}</td>
            <td>{{$target->period6}}</td>
            <td>
            	<div class="btn-group" role="group" aria-label="Basic example">
				  <button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button>
				  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter-{{$target->id}}"><i class="fa fa-edit"></i></button>
				  <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
				</div>
            </td>

        </tr>
        @include('pages.gc7.targetModal')
            @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>

  @endsection
