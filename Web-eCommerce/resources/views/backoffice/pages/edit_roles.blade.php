@extends('backoffice.layouts.layout_dash')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Edit Users</a></li>
              <li class="breadcrumb-item active">Edit Roles</li>
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
            
            
                <div class="col-md-6">
                    <!-- PRODUCT DESCRIPTION -->
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-user"></i>
                            User Description
                        </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <dl>
                            <dt># <dd>{{$user->id}}<dd></dt>
                            <dt>Email<dd>{{$user->email}}</dd></dt>
                            <dt>Name<dd>{{$user->name}}</dd></dt>
                            <dt>Surname<dd>{{$user->surname}}<dd></dt>
                            <dt>Created at <dd>{{ date('d-m-Y', strtotime($user->created_at))}}</dd></dt>
                            <dt>Updated at <dd>{{ date('d-m-Y', strtotime($user->updated_at))}}</dd></dt>
                        </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- general form elements -->
                <div class="col-md-6">
                 <div class="card">
                    <div class="card-header bg-primary">
                    <h3 class="card-title">Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.form group -->
                        <table class="table table-sm" id="userRolesTable">
                        <thead>
                            <tr>
                            <th scope="col">ID Role</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($user->roles as $index=>$role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td class="text-uppercase">{{ $role->name }}</td>
                                    <td><button id="but_{{ $role->id }}" type="button" class="btn btn-danger deleteRoleButton"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row"><button type="button" class="btn bg-primary-full" data-toggle="modal" data-target="#modalRoles"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add</button></th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </tfoot>
                        </table>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <span class="d-none" id="id_user">{{$user->id}}</span>
                        <button id="sendRoleData" type="button" class="btn bg-primary-full float-right">Save changes</button>
                    </div>
                </div>
            </div> 
                <!-- /.card -->
            <!-- Modal -->
            <div class="modal fade" id="modalRoles" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="custom-select" id="roleSelect">
                            @foreach($roles as $index=>$role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addRoleButton" type="submit" class="btn btn-success"  data-dismiss="modal">Add</button>
                </div>
                </div>
            </div>
            </div>
            @endisset
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="{{ asset('dist/js/pages/roles.js') }}"></script>
@endsection('content')