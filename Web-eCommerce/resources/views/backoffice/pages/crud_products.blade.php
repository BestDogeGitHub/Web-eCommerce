@extends('backoffice.layouts.layout_dash')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>


    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Products</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Product</span></a>				
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="productsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment</th>
						<th>Sale</th>
                        <th>Stock</th>
                        <th>Buys</th>
                        <th>Av.</th>
                        <th>Product Type</th>
                        <th>Iva</th>
                        <th>Creation</th>
                        <th>Last Update</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->payment}}</td>
                        <td>{{$product->sale}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->buy_counter}}</td>
                        <td>
                            @if($product->available)
                            <span class="badge badge-pill badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
                            @else
                            <span class="badge badge-pill badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            @endif
                        </td>
                        <td class="text-uppercase">{{$product->productType->name}}</td>
                        <td>{{$product->ivaCategory->category}}</td>
                        <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($product->updated_at)) }}</td>
                        <td>
                            <a href="#addProductModal" class="edit" data-toggle="modal" id="{{ $product->id }}"><i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#" class="delete" id="{{ $product->id }}"><i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
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
							<label>Prduct Type</label>
							<select class="custom-select text-uppercase" name="productType">
                                @foreach($productTypes as $type)
                                <option class="text-uppercase" value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
							<label>Iva Category</label>
							<select class="custom-select" name="ivaCategory">
                                @foreach($ivas as $iva)
                                <option value="{{ $iva->id }}">{{ $iva->category }}</option>
                                @endforeach
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
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
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
@endsection('content')