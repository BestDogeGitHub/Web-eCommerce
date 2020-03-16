@extends('backoffice.layouts.layout_dash')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Role Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User with roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="rolesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>UserID</th>
                  <th>Username</th>
                  <th>Roles</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                    <ul class="list-group">
                    @foreach($user->roles as $role)
                        <li class="list-group-item text-uppercase">{{ $role->name }}</li>
                    @endforeach
                    </ul>
                    </td>
                    <td><a href="{{route('editUser', ['id'=>$user->id])}}" class = "btn btn-warning">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>UserID</th>
                  <th>Username</th>
                  <th>Roles</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="rolesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>RoleID</th>
                  <th>Name</th>
                  <th>Guard</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td><span class="badge badge-success">{{ $role->name }}</span></td>
                    <td>{{ $role->guard_name }}</td>
                    <td><a href="{{route('editUser', ['id'=>$user->id])}}" class = "btn btn-warning">Edit</a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add role</button>
              </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection('content')