@extends('backoffice.layouts.layout_dash')

@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage <b>Product Types</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product Types</li>
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
						<a href="#addProductTypeModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Product Type</span></a>				
					</div>
                </div>
            </div>

            <!-- TABLE OF PRODUCTS-->
            <table class="table table-striped table-hover" id="productsTable">
                <thead>
                    <tr>
                        <th><i class="fa fa-barcode"></i></th>
                        <th>Name</th>
						<th>Image</th>
                        <th>Av.</th>
                        <th>Rate</th>
                        <th>Rev.</th>
                        <th>Producer</th>
                        <th>Creation</th>
                        <th>Update</th>
                        <th>Edit Item</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productTypes as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td class="text-uppercase">{{$product->name}}</td>
                        <td><img class="img-responsive crud" src="{{ asset($product->image_ref) }}" ></td>
                        <td>
                            @if($product->available)
                            <span class="badge badge-pill badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>
                            @else
                            <span class="badge badge-pill badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span>
                            @endif
                        </td>
                        <td>{{$product->star_rate}}</td>
                        <td>{{$product->n_reviews}}</td>
                        <td class="text-uppercase">{{$product->producer->name}}</td>
                        <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($product->updated_at)) }}</td>
                        <td>
						    <a href="{{ route('products', $product->id) }}" class="show" target="_blank"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="Show all products of this type"></i></a>
                            <a href="#" class="edit" id="{{ $product->id }}"><i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#" class="delete" id="{{ $product->id }}"><i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->

	<!-- Add Modal HTML -->
	<div id="addProductTypeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addProductTypeForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Product Type</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        <div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" required="required" name="name"/>
						</div>	
                        
                        <img class="img-responsive crud" src="{{ asset($product->image_ref) }}" >
                        <div class="form-group">
                            <label>Immagine</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="addImage" name="image">
                                <label class="custom-file-label" for="addImage">Choose image</label>
                            </div>
						</div>
                        
                        <!-- CONVENZIONE: AVAILABLE A FALSE AL MOMENTO DELLA CREAZIONE DEL TIPO, NON CI SONO ANCORA PRODOTTI - VEDI CONTROLLER -->

                        <!-- CONVENZIONE: STAR RATE A 3 AL MOMENTO DELLA CREAZIONE DEL TIPO, UNA MEDIA - VEDI CONTROLLER -->

                        <!-- CONVENZIONE: N REVIEWS A 0 AL MOMENTO DELLA CREAZIONE DEL TIPO - VEDI CONTROLLER -->


                        <div class="form-group">
							<label>Producer</label>
							<select class="custom-select text-uppercase" name="producer">
                                @foreach($producers as $producer)
                                <option class="text-uppercase" value="{{ $producer->id }}">{{ $producer->name }}</option>
                                @endforeach
                            </select>
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
	<div id="editProductTypeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editProductTypeForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Product Type</h4>
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
                        
                        <!-- CONVENZIONE: AVAILABLE A FALSE AL MOMENTO DELLA CREAZIONE DEL TIPO, NON CI SONO ANCORA PRODOTTI - VEDI CONTROLLER -->
                        <div class="form-group">
							<label>Available</label>
							<input type="number" class="form-control" required="required" name="available" id="editAvailable"/>
                        </div>

                        <div class="form-group">
							<label>Star Rate</label>
							<input type="numeric" class="form-control" required="required" name="star_rate" id="editStarRate"/>
						</div>	

                        
                        <div class="form-group">
							<label>N Reviews</label>
							<input type="numeric" class="form-control" required="required" name="n_reviews" id="editNReviews"/>

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        <div class="form-group">
							<label>Producer</label>
							<select class="custom-select text-uppercase" name="producer">
                            
                                @foreach($producers as $producer)
                                <option class="text-uppercase" value="{{ $producer->id }}">{{ $producer->name }}</option>
                                @endforeach
                            </select>
                            <small>*The default Producer value in the selectbox is not the same of original, re-select it</small>
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
	<div id="deleteProductTypeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteProductTypeForm" method="post" class="form-horizontal" enctype="multipart/form-data">
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

<script src="{{ asset('dist/js/pages/product_types.js') }}"></script>
@endsection('content')