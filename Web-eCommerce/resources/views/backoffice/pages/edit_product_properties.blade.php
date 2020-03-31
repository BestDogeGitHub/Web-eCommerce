@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Product <b>Properties</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Catalog</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Product Properties</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        

        <div class="row">
          <div class="col-md-4">
            <!-- PRODUCT DESCRIPTION -->
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-barcode"></i>
                    Description
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <dl>
                    <dt># <dd>{{$product->id}}<dd></dt>
                    <dt>Type<dd>{{$product->productType->name}}</dd></dt>
                    <dt>Payment<dd>{{$product->payment}}</dd></dt>
                    <dt>Sale<dd>{{$product->sale}}<dd></dt>
                    <dt>Stock<dd>{{$product->stock}}<dd></dt>
                    <dt>Buy Counter<dd>{{$product->buy_counter}}<dd></dt>
                    <dt>Available<dd>{{$product->available}}<dd></dt>
                    <dt>Created at <dd>{{ date('d-m-Y', strtotime($product->created_at))}}</dd></dt>
                    <dt>Updated at <dd>{{ date('d-m-Y', strtotime($product->updated_at))}}</dd></dt>
                    <dt>Info<dd>{{$product->info}}</dd></dt>
                  </dl>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
                  
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">



                        <div class="container">
                            <div class="table-wrapper table-responsive">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#addPropertyModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Property</span></a>				
                                        </div>
                                    </div>
                                    <hr/>
                                </div>

                              

                              <!-- TABLE OF PRODUCTS-->
                              <table class="table table-striped table-hover" id="propertiesTable">
                                  <thead>
                                      <tr>
                                          <th>Attribute</th>
                                          <th>Value</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    
                                      @foreach($product->values as $property)
                                        <tr>
                                            <td>{{$property->attribute->name}}</td>
                                            <td>{{$property->name}}</td>
                                            <td>
                                              <div class="btn-group btn-group-sm">
                                                  <a href="#" class="btn btn-danger _delete" data-id="{{ $property->id }}"><i class="fas fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                                              </div>
                                            </td>
                                        </tr>
                                      @endforeach
                                      
                                  </tbody>
                              </table>
                              <small>NOTE: to change an attribute value you must delete old record and insert a new property</small>
                              @if(!count($product->values))
                              <div class="callout callout-info">
                                <h5>No properties found</h5>

                                <p>Insert properties.</p>
                              </div>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>


                  
        <!-- Add Modal HTML -->
        <div id="addPropertyModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                      <form id="getValuesForm" method="post" class="form-horizontal">
                        <div class="modal-header">						
                          <h4 class="modal-title">Add Property</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                          <div class="modal-body">					
                            <div class="form-group">
                              <label>Attribute</label>
                              <select class="custom-select text-uppercase" name="attribute" id="attribute">
                                  @foreach($attributes as $attribute)
                                    <option class="text-uppercase" value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Get Values">
                       </form>
                       <form id="addPropertyForm" method="post" class="form-horizontal">
                        
                            <div class="form-group">
                              <label>Value</label>
                              <select class="custom-select text-uppercase disabled" name="value_id" id="values">
                              </select>
                            </div>
                            <div id="forErrors"></div>					
                            <input type="submit" class="btn btn-success" value="Add"> 
                        
                      </form>
                      </div>
                      <div class="modal-footer">
                          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        </div>
                </div>
              </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deletePropertyModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
                      <form id="deletePropertyForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-header">						
                  <h4 class="modal-title">Delete Property</h4>
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
                          




<script src="{{ asset('dist/js/pages/product_properties.js') }}"></script>
@endsection('content')