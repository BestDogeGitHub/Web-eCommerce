@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Orders</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>





    <div class="container">
        <div class="table-wrapper table-responsive">

            <table class="table table-striped table-hover" id="ordersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purchase Order Number</th>
                        <th>Payment</th>
                        <th>User</th>
                        <th>See invoice</th>
                        <th>Delivery Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->PO_Number}}</td>
                        <td><span class="badge badge-danger">&euro; {{$order->invoice->payment}}</span></td>
                        <td><a href="{{ route('users.show', $order->user->id) }}" target="_blank">{{$order->user->username}}</a></td>
                        <td>
						    <a href="{{ route('getInvoicePDF', $order->invoice->id) }}" target="_blank"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="Show Invoice"></i></a>
                        </td>
                        <td>
						     {{$order->shipment->deliveryStatus->status}}
                        </td>
                        <td>
						    <a href="#" class="_show" id="{{ $order->id }}"><i class="fa fa-plus-circle" aria-hidden="true" data-toggle="tooltip" title="Show"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->

    <!-- FOR SHOW AND EDIT -->

    <div id="editOrderModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editOrderForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Order Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />				

                        <div class="form-group">
							<label><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;User ID</label>
							<input type="text" class="form-control" required="required" id="editUser" disabled/>
						</div>	

                        <div class="form-group">
							<label>Purchase Order Number</label>
							<input type="text" class="form-control" required="required" name="name" id="editPO" disabled/>
						</div>	

                        <h5>Products</h5>
                        
                        <template>
                            <div class="d-none">
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" id="product_info_template" target="_blank">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"></h5>
                                        <small></small>
                                    </div>
                                    <img class="img-responsive crud"/>
                                    <p class="mb-1"></p>
                                    <small></small>
                                </a>
                            </div>
                        </template>

                        
                        <div class="list-group" id="order_products">

                        </div>
                        <br/>
                        <h5>Shipment details</h5>
                        <div class="card border-primary">
                            <div class="card-header">
                                <h6 id="carrierName"></h6>
                                <img class="img-responsive crud" id="carrierLogo"/>
                                    
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" id="trackNumber"></h5>
                                <p class="card-text" id="deliveryDate"></p>
                                <p class="card-text" id="address"></p>
                                
                            </div>
                            <div class="card-footer">
                                <p class="card-text" id="status"></p>
                            </div>
                        </div>
                        <br/><br/><br/>
                        <div id="price"></div>

                        <div id="forErrors"></div>					
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
						<!-- <input type="submit" class="btn btn-warning" value="Edit"> -->
					</div>
				</form>
			</div>
		</div>
    </div>
    
    <!-- Delete Modal HTML -->
	<div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteUserForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this User?</p>
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
<script src="{{ asset('dist/js/pages/orders.js') }}"></script>
@endsection('content')