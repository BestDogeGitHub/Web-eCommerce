@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Product <b>Categories</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.catalog') }}">Catalog</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                                        <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Category</span></a>				
                                    </div>
                                    <br /> <br /> <br /> <br /> 
                                </div>
                            <strong><p>Actual Tree of Categories</p></strong><br/>
                            
                            <ul id="catTree">

                                <li>
                                    All Categories
                                    @if(count($categories->first()->childs))
                                        @include('backoffice.partials._partial_edit_category_child', ['childs' => $categories->first()->childs])
                                    @endif
                                </li>
                            
                            </ul>

                                
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>

    <!-- Add Modal HTML -->
    <div id="addCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data">
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

                        <div class="form-group">
							<label>Parent Category</label>
							<select class="custom-select" name="parent_id">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
						</div>



                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="Image" name="image">
                                <label class="custom-file-label" for="Image">Change Image</label>
                            </div>
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
        <!-- SHOW AND EDIT MODAL -->

        <div id="editCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Category</h4>
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
							<label>Products</label>
							<p id="numberProd"></p>
						</div>

                        <div class="form-group">
							<label>Parent Category</label>
							<select class="custom-select text-uppercase" name="parent_id" id="editParent">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Actual Image</label><br/>
                            <img class="img-responsive category" src="" id="actualImage">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="editImage" name="image">
                                <label class="custom-file-label" for="editImage">Change Image</label>
                            </div>
                        </div>
                        <div class="alert alert-danger confirm" role="alert" id="confirmDelete">
                            <p>Are you sure you want to delete this Category? Also nested categories will be delete</p>
                            <p class="text-warning"><small>!!! This action cannot be undone !!!</small></p>
                            <input id="delButton" type="button" class="btn btn-danger" value="Delete">
                        </div>
                        <div id="forEditErrors"></div>					
                    </div>
                    
					<div class="modal-footer">
                        <input type="button" class="btn btn-danger" id="deleteItem" value="Delete Category">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-warning" value="Save Changes">
					</div>
				</form>
			</div>
		</div>
	</div>

<script src="{{ asset('dist/js/pages/categories.js') }}"></script>
@endsection('content')