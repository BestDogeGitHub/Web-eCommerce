@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Website Components</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Components</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card">
              <div class="card-body">


                    <div class="container">
                        <div class="table-wrapper table-responsive">
                            <div class="table-title">
                                <h2>Static components</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#addResourceModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Component</span></a>				
                                </div>
                            </div>
                            <hr/>

                            <table class="table table-striped table-hover" id="nationsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Role</th>
                                        <th>Dettagli</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($components as $component)
                                    <tr>
                                        <td>{{ $component->id }}</td>
                                        <td><img class="img-responsive crud" src="{{ asset($component->image_ref ?? '') }}" ></td>
                                        <td>{{ $component->role->name ?? ''}}</td>
                                        <td>{{ $component->image_details ?? ''}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('components.edit', $component->id) }}" class="btn btn-warning _edit" id="{{ $component->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                                <a href="#" class="btn btn-danger _delete" id="{{ $component->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>



    <!-- !!! MODALS !!! -->
    <!-- FOR SHOW AND EDIT -->
    

	<!-- Add Modal HTML -->
	<div id="addResourceModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
                <form id="addResourceForm" action="{{ route('components.add') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Resource</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
                        <div class="form-group">
							<label>Component Role</label>
							<select class="custom-select text-uppercase" name="image_role_id">
                                @foreach($roles as $role)
                                <option class="text-uppercase" value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <textarea id="html_editor_textarea" name="details"></textarea>
                        <div class="form-group">
							<label>Link</label>
							<input type="text" class="form-control" required="required" name="link"/>
                        </div>
                        <div class="form-group">
                            <label>Component Image</label><br/>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="editImage" name="image">
                                <label class="custom-file-label" for="editImage">Change Image</label>
                            </div>
                        </div>	
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- Delete Modal HTML -->
	<div id="deleteResourceModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteResourceForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Components</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this Components?</p>
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


<script src="{{ asset('dist/js/pages/website.js') }}"></script>
@endsection('content')