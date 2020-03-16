@extends('backoffice.layouts.layout_dash')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          
        <div class="row">
            @isset($user)
                <!-- general form elements -->
                <div class="col-12">
                 <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">User details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                          <label for="username">Username</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                              </div>  
                              <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                            </div>
                          </div>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name"  value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                          <label for="surname">Surname</label>
                          <input type="text" class="form-control" id="surname" name="surname"  value="{{ $user->surname }}">
                        </div>
                        <div class="form-group">
                        <label for="email">Email address</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                              </div>
                              <input type="email" class="form-control" id="email" name="email"  value="{{ $user->email }}">
                          </div>
                        </div>
                         <!-- phone mask -->
                        <div class="form-group">
                          <label>Phone number</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group">
                          <label>User Roles</label>
                            <ul class="list-group">
                            @foreach($user->roles as $role)
                                <li class="list-group-item text-uppercase">{{ $role->name }}</li>
                            @endforeach
                            <li class="list-group-item"><a class="btn btn-warning" href="{{ route('editUserRoles', ['id' => $user->id]) }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Edit Roles</a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Save changes</button>
                    </div>
                    </form>
                </div>
            </div> 
                <!-- /.card -->

            @endisset
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection('content')