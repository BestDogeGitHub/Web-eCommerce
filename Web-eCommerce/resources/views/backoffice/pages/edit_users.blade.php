@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Users</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>





    <div class="container">
        <div class="table-wrapper table-responsive">

            <table class="table table-striped table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Creation</th>
                        <th>Last Update</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info _show" id="{{ $user->id }}" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                                <a href="#" class="btn btn-warning _edit" id="{{ $user->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                <a href="#" class="btn btn-danger _delete" id="{{ $user->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->

    <!-- FOR SHOW AND EDIT -->

    <div id="editUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editUserForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Dettagli Utente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />				

                        <div class="form-group">
							<label><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;Username</label>
							<input type="text" class="form-control" required="required" id="editUsername" disabled/>
						</div>	

                        <div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required="required" name="name" id="editName"/>
						</div>	

                        <div class="form-group">
							<label>Surname</label>
							<input type="text" class="form-control" required="required" name="surname" id="editSurname"/>
						</div>	

                        <div class="form-group">
							<label><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;&nbsp;E-Mail</label>
							<input type="text" class="form-control" required="required" name="email" id="editEmail"/>
						</div>

                        <div class="form-group">
							<label><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;&nbsp;Phone</label>
							<input type="text" class="form-control" required="required" name="phone" id="editPhone"/>
						</div>

                        <div class="form-group">
                            <label><i class="fa fa-map-pin" aria-hidden="true"></i> &nbsp;&nbsp;Address</label>
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text" id="addressText"></p>
                                    <!-- <a href="#" class="btn btn-primary">Change Address</a> -->
                                </div>
                            </div>
						</div>

                        <div class="form-group">
                            <label><i class="fa fa-users" aria-hidden="true"></i> &nbsp;&nbsp;Roles</label>
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text" id="rolesText"></p>
                                    <!-- <a href="#" class="btn btn-primary">Change Address</a> -->
                                </div>
                            </div>
						</div>


                        <div id="forErrors"></div>					
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-warning" value="Edit">
					</div>
				</form>
			</div>
		</div>
    </div>
    
    <!-- Delete Modal HTML -->
	<div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteUserForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this User?</p>
						<p class="text-warning"><small>!!! This action cannot be undone !!!</small></p>
					</div>
					<div class="modal-footer">
						<input id="delButton" type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
    </div>       


<script src="{{ asset('dist/js/pages/users.js') }}"></script>
@endsection('content')