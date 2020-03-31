@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Carriers</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">Carriers</li>
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="#addCarrierModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Carrier</span></a>				
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover" id="carriersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($carriers as $carrier)
                                <tr>
                                    <td>{{$carrier->id}}</td>
                                    <td><a href="http:\\{{ $carrier->link }}" target="_blank">{{$carrier->name}}</a></td>
                                    <td><img class="img-responsive crud" src="{{ asset($carrier->image_ref) }}"></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('carrier_detail', $carrier->id) }}" class="btn btn-info _show" id="{{ $carrier->id }}" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                                            <a href="#" class="btn btn-warning _edit" id="{{ $carrier->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#" class="btn btn-danger _delete" id="{{ $carrier->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
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
    <!-- Add Modal HTML -->
    <div id="addCarrierModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addCarrierForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Carrier</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        <div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required="required" name="name"/>
                        </div>	

                        <div class="form-group">
                            <label>Immagine</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="addImage" name="image">
                                <label class="custom-file-label" for="addImage">Choose image</label>
                            </div>
						</div>
                        
                        <div class="form-group">
							<label>Link</label>
							<input type="text" class="form-control" required="required" name="link"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Details</label>
							<textarea class="form-control" required="required" name="details"></textarea>
                        </div>	


                        <div id="forErrors"></div>					
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- FOR SHOW AND EDIT -->

    <div id="editCarrierModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editCarrierForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Carrier</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        
                        <div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required="required" name="name" id="editName"/>
						</div>	

                        <div class="form-group">
                            <label>Actual Image</label><br/>
                            <img class="img-responsive crud" src="" id="actualImage">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="editImage" name="image">
                                <label class="custom-file-label" for="editImage">Change Image</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
							<label>Link</label>
							<input type="text" class="form-control" required="required" name="link" id="editLink"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Details</label>
							<textarea class="form-control" required="required" name="details" id="editDetails"></textarea>
                        </div>

                        <div id="forEditErrors"></div>					
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
	<div id="deleteCarrierModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteCarrierForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Carrier</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this Carrier?</p>
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


<script src="{{ asset('dist/js/pages/carriers.js') }}"></script>
@endsection('content')