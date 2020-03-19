@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Invoices</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Invoices</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>





    <div class="container">
        <div class="table-wrapper table-responsive">
            <div class="table-title">
                <div class="row">
					<div class="col-sm-12">
						<a href="#addInvoiceModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Invoice</span></a>				
					</div>
                </div>
            </div>

            <table class="table table-striped table-hover" id="invocesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purchase Order Number</th>
                        <th>Edit Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->order->PO_Number}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info _edit" id="{{ $invoice->id }}" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                                <a href="#" class="btn btn-warning _edit" id="{{ $invoice->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                <a href="#" class="btn btn-danger _delete" id="{{ $invoice->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->
    <!-- Add Modal HTML -->
    <div id="addAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addAddressForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Product Type</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        <div class="form-group">
							<label>Building Number</label>
							<input type="numeric" class="form-control" required="required" name="building_number"/>
						</div>	
                        
                        <div class="form-group">
							<label>Street Number</label>
							<input type="numeric" class="form-control" required="required" name="street_number"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Postcode</label>
							<input type="text" class="form-control" required="required" name="postcode"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Country Code</label>
							<input type="text" class="form-control" required="required" name="country_code"/>
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

    <div id="editAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editAddressForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Address</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        
                        <div class="form-group">
							<label>Building Number</label>
							<input type="numeric" class="form-control" required="required" name="building_number" id="editBuilding"/>
						</div>	
                        
                        <div class="form-group">
							<label>Street Number</label>
							<input type="numeric" class="form-control" required="required" name="street_number" id="editStreet"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Postcode</label>
							<input type="text" class="form-control" required="required" name="postcode" id="editPostcode"/>
                        </div>	
                        
                        <div class="form-group">
							<label>Country Code</label>
							<input type="text" class="form-control" required="required" name="country_code" id="editCountrycode"/>
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
	<div id="deleteAddressModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteAddressForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Address</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this Address?</p>
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

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="{{ asset('dist/js/pages/invoices.js') }}"></script>
@endsection('content')