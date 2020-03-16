@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Product <b>Credit Cards</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.properties') }}">Properties</a></li>
                    <li class="breadcrumb-item active">Credit Cards</li>
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
						<a href="#addCreditCardModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add New Credit Card</span></a>				
					</div>
                </div>
            </div>

            <table class="table table-striped table-hover" id="creditCardsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Number</th>
                        <th>Expiration</th>
                        <th>User</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($credit_cards as $credit_card)
                    <tr>
                        <td>{{$credit_card->id}}</td>
                        <td>
                         <i class="fa fa-credit-card card-icon" aria-hidden="true"></i><span class="badge badge-warning">{{$credit_card->type}}</span>
                        </td>
                        <td><p class="cardNumber">{{$credit_card->number}}</p></td>
                        <td><p class="cardExp">{{$credit_card->expiration_date}}</p></td>
                        <td>
                        @if(is_null($credit_card->user_id))
                            <span class="badge badge-danger">Card not assigned</span>
                        @else 
                            <a href="{{ route('users.show', $credit_card->user->id) }}" target="_blank">{{$credit_card->user->username}}</a>
                        @endif
                        </td>
                        <td>
                            <a href="#" class="_edit" id="{{ $credit_card->id }}"><i class="fa fa-edit" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>
                            <a href="#" class="_delete" id="{{ $credit_card->id }}"><i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>



    <!-- !!! MODALS !!! -->
    <!-- Add Modal HTML -->
    <div id="addCreditCardModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="addCreditCardForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Credit Card</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        
                        

                        <div class="form-group">
							<label>Company</label>
							<select class="custom-select" name="type">
                                @foreach($companies as $company)
                                <option value="{{ $company }}">{{ $company }}</option>
                                @endforeach
                            </select>
						</div>

                        <div class="form-group">
							<label>Number</label>
							<input type="text" class="form-control" required="required" name="number"/>
						</div>	
                        
                        <div class="form-group">
                        <label>Expiration</label>
                            <div class="input-group col-md-4">
                                <input type="text" class="form-control" placeholder="MM" name="exp_month">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">/</span>
                                </div>
                                <input type="text" class="form-control" placeholder="YY" name="exp_year">
                            </div>
                        </div>

                        <div class="form-group">
							<label>User ID (Optional)</label>
							<input type="text" class="form-control" name="user_id"/>
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

    <div id="editCreditCardModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="editCreditCardForm" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit CreditCard</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

                        <!-- METHOD SPOOFING -->
						<input type="hidden" name="_method" value="PUT" />		
                        
                        

                        <div class="form-group">
							<label>Company</label>
							<select class="custom-select" name="type" id="editComp"> 
                                @foreach($companies as $company)
                                <option value="{{ $company }}">{{ $company }}</option>
                                @endforeach
                            </select>
						</div>

                        <div class="form-group">
							<label>Number</label>
							<input type="text" class="form-control" required="required" name="number" id="editNumber"/>
						</div>	
                        
                        <div class="form-group">
                        <label>Expiration</label>
                            <div class="input-group col-md-4">
                                <input type="text" class="form-control" placeholder="MM" name="exp_month" id="editMonth">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">/</span>
                                </div>
                                <input type="text" class="form-control" placeholder="YY" name="exp_year" id="editYear">
                            </div>
                        </div>

                        <div class="form-group">
							<label>User ID (Optional)</label>
							<input type="text" class="form-control" name="user_id" id="editUser"/>
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
	<div id="deleteCreditCardModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form id="deleteCreditCardForm" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Delete CreditCard</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete this CreditCard?</p>
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


<script src="{{ asset('dist/js/pages/credit_cards.js') }}"></script>
@endsection('content')