@extends('backoffice.layouts.layout_dash')

@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage <b>Producers</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Producers</li>
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
                                        <a href="#addProducerModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Producer</span></a>				
                                    </div>
                                </div>
                            </div>

                            <!-- TABLE OF PRODUCTS-->
                            <table class="table table-striped table-hover" id="producersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Details</th>
                                        <th>Edit Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($producers as $producer)
                                    <tr>
                                        <td>{{$producer->id}}</td>
                                        <td class="text-uppercase">{{$producer->name}}</td>
                                        <td><img class="img-responsive crud" src="{{ asset($producer->image_ref) }}" ></td>
                                        <td><a href="http://{{$producer->link}}" target="_blank">Visit link</a></td>
                                        <td>{{$producer->details}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-warning edit" id="{{ $producer->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                                <a href="#" class="btn btn-danger delete" id="{{ $producer->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
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
	<div id="addProducerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addProducerForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Producer Type</h4>
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
							<textarea class="form-control" name="details"></textarea>
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
	<!-- Edit Modal HTML -->
	<div id="editProducerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editProducerForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Producer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
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
							<textarea class="form-control" name="details" id="editDetails"></textarea>
                        </div>

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

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
	<div id="deleteProducerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteProducerForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Producer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this Record?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input id="delButton" type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
    </div>       
    
</div>

<script src="{{ asset('dist/js/pages/producers.js') }}"></script>
@endsection('content')