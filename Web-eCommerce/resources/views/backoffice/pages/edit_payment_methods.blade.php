@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Payment Methods</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">Payment Methods</li>
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
                                        <a href="#addMethodModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Payment Method</span></a>				
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover" id="methodsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Method</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($paymentMethods as $method)
                                    <tr>
                                        <td>{{$method->id}}</td>
                                        <td>{{$method->method}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-warning _edit" id="{{ $method->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                                <a href="#" class="btn btn-danger _delete" id="{{ $method->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
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
    <div id="addMethodModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addMethodForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Method</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        <div class="form-group">
							<label>Method</label>
							<input type="text" class="form-control" required="required" name="method"/>
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

    <div id="editMethodModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editMethodForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Method</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        
                        <div class="form-group">
							<label>Method</label>
							<input type="text" class="form-control" required="required" name="method" id="editMethod"/>
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
	<div id="deleteMethodModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteMethodForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Method</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this Method?</p>
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


<script src="{{ asset('dist/js/pages/payment_methods.js') }}"></script>
@endsection('content')