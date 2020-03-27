@extends('backoffice.layouts.layout_dash')

@section('content')



        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage <b>Products</b></h1>
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

        <div class="card">
              <div class="card-body">


                    <div class="container">
                        <div class="table-wrapper table-responsive">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Product</span></a>				
                                    </div>
                                </div>
                                <hr/>
                            </div>

                            <!-- TABLE OF PRODUCTS-->
                            <table class="table table-striped table-hover" id="productsTable">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-barcode"></i></th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Payment</th>
                                        <th>Sale</th>
                                        <th>Stock</th>
                                        <th>Buys</th>
                                        <th>Av.</th>
                                        <th>Iva</th>
                                        <th>Properties</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td class="text-uppercase">{{$product->variant_name}}</td>
                                        <td class="text-uppercase">{{$product->productType->name}}</td>
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
                                        <td>{{$product->ivaCategory->category}}</td>
                                        <td><a href="{{ route('getProductProperties', $product->id) }}">Edit Properties</a></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info _show" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                                                <a href="#" class="btn btn-warning _edit" id="{{ $product->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                                <a href="#" class="btn btn-danger _delete" id="{{ $product->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
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
							<label>Variant Name</label>
							<input type="text" class="form-control" required="required" name="name"/>
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
                                @foreach($productTypes as $type)
                                <option class="text-uppercase" value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
							<label>Iva Category</label>
                            <br/>
                            <small>The default iva-category value in the selectbox is not the same of original</small>
							<select class="custom-select" name="ivaCategory" id="editIva">
                                @foreach($ivas as $iva)
                                <option value="{{ $iva->id }}">{{ $iva->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
							<label>Variant Name</label>
							<input type="text" class="form-control" required="required" name="name" id="editName"/>
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