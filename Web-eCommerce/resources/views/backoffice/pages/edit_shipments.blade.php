@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Shipments</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">Attributes</li>
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
                            <table class="table table-striped table-hover" id="shipmentsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TR Number</th>
                                        <th>Delivery Date</th>
                                        <th>Order #</th>
                                        <th>Address</th>
                                        <th>Carrier</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shipments as $shipment)
                                    <tr>
                                        <td>{{$shipment->id}}</td>
                                        <td>{{$shipment->tracking_number}}</td>
                                        <td>{{$shipment->delivery_date}}</td>
                                        <td><a href="{{ route('orders.show', $shipment->order_id) }}" target="_blank">{{$shipment->order_id}}</a></td>
                                        <td>
                                            <p>Town: <b>{{$shipment->address->town->name}}</b> <i>(POSTCODE {{$shipment->address->postcode}})</i><br/>Nation: <b>{{$shipment->address->town->nation->name}}</b>.<br/>
                                            Street <b>{{$shipment->address->street_number}}</b>, Building <b>{{$shipment->address->building_number}}</b> ({{$shipment->address->country_code}}).</p></td>
                                        <td>{{$shipment->carrier->name}}</td>
                                        <td class="text-uppercase">
                                            @if($shipment->delivery_status_id == 5)
                                            <div class="progress progress-sm active">
                                                <div class="progress-bar bg-success progress-bar-striped delivered" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">100% Complete</span>
                                                </div>
                                            </div>
                                            @elseif($shipment->delivery_status_id == 4)
                                            <div class="progress progress-sm active">
                                                <div class="progress-bar bg-danger progress-bar-striped delivered" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">Error</span>
                                                </div>
                                            </div>
                                            @elseif($shipment->delivery_status_id == 3)
                                            <div class="progress progress-sm active">
                                                <div class="progress-bar bg-success progress-bar-striped pick_up" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                            @elseif($shipment->delivery_status_id == 2)
                                            <div class="progress progress-sm active">
                                                <div class="progress-bar bg-success progress-bar-striped transit" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">50% Complete</span>
                                                </div>
                                            </div>
                                            @else
                                            <div class="progress progress-sm active">
                                                <div class="progress-bar bg-warning progress-bar-striped other_ds" role="progressbar"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">Error</span>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            {{$shipment->deliveryStatus->status}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-warning _edit" data-id="{{ $shipment->id }}"><i class="fas fa-pencil-alt" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>



              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
   

       

    
    <div id="editShipmentModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editShipmentForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Shipment</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		

                        <div class="form-group">
                                <label>Delivery Date</label>
                            <div class="input-group date" id="editDeliveryDate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#editDeliveryDate" name="delivery_date"/>
                                <div class="input-group-append" data-target="#editDeliveryDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
							<label>Status</label>
							<select class="custom-select text-uppercase" name="delivery_status_id" id="editStatus">
                            
                                @foreach($statuses as $status)
                                <option class="text-uppercase" value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
							<label>Carrier</label>
							<select class="custom-select text-uppercase" name="carrier_id" id="editCarrier">
                            
                                @foreach($carriers as $carrier)
                                <option class="text-uppercase" value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
							<label>Address #</label>
							<input type="text" class="form-control" required="required" name="address_id" id="editAddress"/>
						</div>	


                        <div id="forEditErrors"></div>					
                    </div>
                    
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Save changes">
					</div>
				</form>
			</div>
		</div>
	</div>

<script src="{{ asset('dist/js/pages/shipments.js') }}"></script>
@endsection('content')