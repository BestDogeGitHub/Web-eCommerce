@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Iva Categories</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">Iva Categories</li>
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
						<a href="#addIvaCategoryModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Category</span></a>				
					</div>
                </div>
            </div>

            <table class="table table-striped table-hover" id="ivaCategoriesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Value in %</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($ivaCategories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category}}</td>
                        <td>{{$category->value}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-warning _edit" id="{{ $category->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                <a href="#" class="btn btn-danger _delete" id="{{ $category->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
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
    <div id="addIvaCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addIvaCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add IvaCategory</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        <div class="form-group">
							<label>Category</label>
							<input type="text" class="form-control" required="required" name="category"/>
						</div>	

                        <div class="form-group">
							<label>Value</label>
							<input type="numeric" class="form-control" required="required" name="value"/>
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

    <div id="editIvaCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editIvaCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit IvaCategory</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        
                        <div class="form-group">
							<label>Category</label>
							<input type="text" class="form-control" required="required" name="category" id="editCategory"/>
						</div>	

                        <div class="form-group">
							<label>Value</label>
							<input type="numeric" class="form-control" required="required" name="value" id="editValue"/>
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
	<div id="deleteIvaCategoryModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteIvaCategoryForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete IvaCategory</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this IvaCategory?</p>
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


<script src="{{ asset('dist/js/pages/iva_categories.js') }}"></script>
@endsection('content')