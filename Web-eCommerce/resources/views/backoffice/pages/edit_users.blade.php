@extends('backoffice.layouts.layout_dash')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">



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
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
					<div class="col-sm-12">
						<a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New User</span></a>				
					</div>
                </div>
            </div>

            <!-- TABLE OF PRODUCTS-->
            <table class="table table-striped table-hover" id="productsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
						<th>Name</th>
                        <th>Surname</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
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
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-uppercase">{{$user->address->country_code}} {{$user->address->town->name}} ({{$user->address->town->nation->name}}), CAP: {{$user->address->postcode}}, Street: {{$user->address->street_number}}, Building: {{$user->address->building_number}}</td>
                        <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($user->updated_at)) }}</td>
                        <td>
						    <a href="{{ route('users.show', $user->id) }}" class="show" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                            <a href="#" class="edit" id="{{ $user->id }}"><i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#" class="delete" id="{{ $user->id }}"><i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->

	<!-- Add Modal HTML -->
	<div id="addProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addProductForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
                        <div class="form-group">
							<label>Prdouct Type</label>
							<select class="custom-select text-uppercase" name="productType">
                            </select>
                        </div>
                        <div class="form-group">
							<label>Iva Category</label>
							<select class="custom-select" name="ivaCategory">
                            </select>
						</div>
                        <div class="form-group">
							<label>Payment</label>
							<input type="text" class="form-control" required="required" name="payment"/>
						</div>
						<div class="form-group">
							<label>Sale</label>
							<input type="number" class="form-control" required="required" name="sale"/>
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input type="number" class="form-control" required="required" name="stock"/>
						</div>
						<div class="form-group">
							<label>Info</label>
							<textarea class="form-control" required="required" name="info"></textarea>
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
	<div id="editProductModal" class="modal fade">
	<div class="modal-dialog">
			<div class="modal-content">
                <form id="editProductForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">	
						<!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />				
                        <div class="form-group">
							<label>Prdouct Type</label> <br/>
                            <small>The default product-type value in the selectbox is not the same of original</small>
							<select class="custom-select text-uppercase" name="productType" id="editType">
                            </select>
                        </div>
                        <div class="form-group">
							<label>Iva Category</label>
                            <br/>
                            <small>The default iva-category value in the selectbox is not the same of original</small>
							<select class="custom-select" name="ivaCategory" id="editIva">
                            </select>
						</div>
                        <div class="form-group">
							<label>Payment</label>
							<input type="text" class="form-control" required="required" name="payment" id="editPayment"/>
						</div>
						<div class="form-group">
							<label>Sale</label>
							<input type="number" class="form-control" required="required" name="sale" id="editSale"/>
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input type="number" class="form-control" required="required" name="stock" id="editStock"/>
						</div>
						<div class="form-group">
							<label>Info</label>
							<textarea class="form-control" required="required" name="info" id="editInfo"></textarea>
                        </div>
						<div class="form-group">
							<label>Available</label>
							<input type="number" class="form-control" required="required" name="available" id="editAvailable"/>
                        </div>
						<input type="hidden" id="hidden_id"/>
                        <div id="forErrorsEdit"></div>					
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Edit">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteProductForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
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

<script src="{{ asset('dist/js/pages/products.js') }}"></script>
@endsection('content')