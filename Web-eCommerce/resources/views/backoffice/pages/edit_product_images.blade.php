@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Product <b>Images</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.catalog') }}">Catalog</a></li>
                    <li class="breadcrumb-item active">Product Images</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <main>
            <div class="container">

            <div class="card">
              <h5 class="card-header">Search Product</h5>
              <div class="card-body">
                <form id="getProductImagesForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                       
                      <div class="form-group">
                        <label>Product ID</label>
                        
                        <input type="text" class="form-control" required="required" placeholder="Enter product id to show its images" name="id" 
                            @isset($product)
                              value="{{$product->id}}" 
                            @endisset
                        id="imageID"/>
                      </div>	
                      <input type="submit" class="btn btn-warning" value="Edit Images">
                </form>
                <hr/>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-info mr-2"></i>
                      Description
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <dl>
                      <dt>Product Name</dt>
                      <dd id="product_name">Select a product</dd>
                      <dt>Info</dt>
                      <dd id="product_info">Select a product</dd>
                    </dl>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <hr/>
                
                
                  <div class="jumbotron container">
                    <div> 

                    <div class="card-body">
                        <div class="filter-container p-0 row" id="imgContainer">
                          
                        </div>

                    </div>

                    </div>
                    
                    <div id="uploadImg" class="disabledFile">
                    <hr class="my-4">
                      <form id="addImageForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image">
                                <label class="custom-file-label" for="addImage">Upload image</label>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" id="product_id"/>
                        <div id="forErrors"></div>	
                        <div class="form-group mb-3">
                          <input type="submit" class="btn btn-success" value="Upload">
                        </div>
                      </form>
                    </div>

                    


                  </div>
                
              </div>
            </div>
                
              <div id="searchProduct" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                    <form id="getProductForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                          @csrf
                    <div class="modal-header">						
                      <h4 class="modal-title">Edit Attribute</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

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
            
            </div>
        </main>

        <!-- Delete Modal HTML -->
      <div id="deleteImageModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
                    <form id="deleteImageForm" method="post" class="form-horizontal" enctype="multipart/form-data">
              <div class="modal-header">						
                <h4 class="modal-title">Delete Image</h4>
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
    




<script src="{{ asset('dist/js/pages/product_images.js') }}"></script>
@endsection('content')