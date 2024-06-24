@extends('layouts.admin')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Roles </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
      </div><!-- /.col -->
    </div>
    <hr style="border: solid 2px #000;">
  </div>
</div>


<section class="content">
	<div class="container-fluid">
    @include('messages.flash_messages')

   <div class="row">
    <div class="col col-xs-12">
      <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.users.role.create') }}" class="btn btn-primary btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Add Role</span></a>
        </div>

        <div class="card-body">
            <div class="table-wrap">
                <table id="datable_1" class="table table-hover w-100 display pb-30">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th width="20%">Operation</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                            <td>
                                <a href="{{ route('admin.users.role.edit', $role->id) }}" class="btn btn-success btn-xs"><i class="mdi mdi-pencil"></i> Edit</a>
                                <form class="d-inline" method="POST" action="{{route('admin.users.role.destroy', $role->id)}}" onclick="return confirm('Are you sure you want to delete this role?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="mdi mdi-trash-can"></i> Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
      </div>

    </div>
  </div>
</div>
</section>

@endsection