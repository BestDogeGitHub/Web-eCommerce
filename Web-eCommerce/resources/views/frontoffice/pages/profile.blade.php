@extends('frontoffice.layouts.layout')

@section('content')



<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 8)->first()->image_ref) }}"></div>

    <div class="hero-wrap hero-bread" id="header_div">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Profile</span></p>
                <h1 class="mb-0 bread">@if($public) {{ $user->name }} {{ $user->surname }} @else My @endif Profile</h1>
            </div>
            </div>
        </div>
        </div>


        <div class="container @if($public) public_profile_container @endif" style="padding-top: 5%; padding-bottom: 5%;">
        @if($changed ?? false) <div class="d-none" id="success_changed"></div> @endif


            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <div class="@if(!$public) row @else public_profile_container @endif">
                    <div @if(!$public) class="col-md-4" @endif>

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline ftco-animate">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('/images/static/user-circle.png') }}"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }} {{ $user->surname }}</h3>

                            <p class="text-muted text-center">{{ $user->roles->pluck('name')->implode(', ') }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                @if(!$public)
                                <li class="list-group-item">
                                    <b>Orders</b> <a class="float-right">{{ count($user->orders) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Credit Cards</b> <a class="float-right">{{ count($user->creditCards) }}</a>
                                </li>
                                @endif
                                <li class="list-group-item">
                                    <b>Reviews</b> <a class="float-right">{{ count($user->reviews) }}</a>
                                </li>
                            </ul>

                            @if(!$public)
                                <a href="#" id="editProfile" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary mt-5 ftco-animate">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <strong><i class="fa fa-user mr-1"></i> Username</strong>

                                <p class="text-muted">
                                    {{$user->username}}
                                </p>

                                <hr>

                                <strong><i class="fa fa-envelope mr-1"></i> Email</strong>

                                <p class="text-muted">
                                    {{$user->email}}
                                </p>

                                <hr>

                                <strong><i class="fa fa-phone mr-1"></i> Contact</strong>

                                <p class="text-muted">
                                    {{$user->phone}}
                                </p>

                                <hr>

                                <strong><i class="fa fa-map-pin mr-1"></i> Location</strong>

                                <p class="text-muted">
                                    @if($user->address)
                                        {{$user->address->town->name}}, <i>{{$user->address->town->nation->name}}</i>.<br/>
                                        Street <b>{{$user->address->street_number}}</b>, Building <b>{{$user->address->building_number}}</b> ({{$user->address->country_code}}).
                                    @else
                                    No address
                                    @endif                             
                                </p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <!-- /.col -->
                @if(!$public)
                <div class="col-md-8">
                    <div class="card ftco-animate">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link @if($errors->isEmpty()) active @endif" href="#activity" data-toggle="tab">Reviews</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Orders Status</a></li>
                        <li class="nav-item"><a class="nav-link @if(!$errors->isEmpty()) active @endif" href="#settings" data-toggle="tab" id="settingsProfile">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="@if($errors->isEmpty()) active @endif tab-pane ftco-animate" id="activity">
                            
                                @forelse ($user->reviews as $index=>$review)
                                    @if($index > 3) 
                                        @include('frontoffice.partials._partial_show_review', ['review' => $review, 'more' => 1])
                                    @else 
                                        @include('frontoffice.partials._partial_show_review', ['review' => $review, 'more' => 0])
                                    @endif
                                @empty
                                    <p>There are no reviews</p>
                                @endforelse

                                <!-- SHOW MORE DIV -->
                                <div class="text-center">
                                    <p><a href="#" id="show_all_rec" data-status="0" class="btn btn-primary btn-block py-3 px-4">Show All</a></p>
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                                    

                            @if($user->orders->count())
                            <div class="col-md-12 ftco-animate">
                                <div class="cart-list">
                                    <table class="table">
                                        <thead class="thead-primary">
                                            <tr class="text-center">
                                                <th>Details</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->orders as $order)
                                            <tr class="text-center">

                                                <td>
                                                    @foreach($order->orderDetails as $detail)
                                                        {{ $detail->product->productType->name }} : {{ $detail->product->variant_name }}<br/>
                                                    @endforeach
                                                </td>
                                                
                                                <td class="text-uppercase">
                                                    @include('frontoffice.partials._partial_show_order_status', $order)
                                                </td>

                                                

                                            </tr><!-- END TR-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <h3>No Orders</h3>
                            @endif


                        </div>
                        <!-- /.tab-pane -->

                        <div class="@if(!$errors->isEmpty()) active @endif tab-pane" id="settings">
                            <div class="container">
                                <form action="{{ route('edit_profile') }}" method="POST" class="billing-form">
                                    <div class="col-xl-12 ftco-animate">
                                        @csrf
                                            
                                        <h3 class="mb-4 billing-heading">Edit profile</h3>

                                        <div class="row align-items-end">

                                            <!-- FIRST NAME INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Firt Name</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required="required" placeholder="" value="{{ $user->name }}">  
                                                </div>
                                            </div>

                                            <!-- LAST NAME INPUT -->    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastname">Last Name</label>
                                                    <input type="text" name="surname"  class="form-control @error('surname') is-invalid @enderror" required="required" placeholder="" value="{{ $user->surname }}">
                                                </div>
                                            </div>

                                            <div class="w-100 row col-md-12">
                                                <div class="col-md-6">
                                                @error('name')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            
                                                <div class="col-md-6">
                                                @error('surname')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>

                                            <!-- PHONE INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" name="phone"  class="form-control" placeholder="" required="required" 
                                                    @if(!$errors->first('phone'))
                                                    value="{{ $user->phone }}"
                                                    @endif
                                                    @error('phone')
                                                    value="{{ old('phone') }}"
                                                    @enderror
                                                    >
                                                </div>
                                            </div>

                                            <!-- EMAIL INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailaddress">Email Address</label>
                                                    <label class="input_label">{{$user->email}}</label>
                                                </div>
                                            </div>

                                            <div class="w-100 row col-md-12">
                                                <div class="col-md-6">
                                                @error('phone')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>

                                            <input type="hidden" name="add_address" value="0">

                                            <div class="form-check">
                                                <input type="checkbox" value="1" name="add_address" class="form-check-input @error('add_address') is-invalid @enderror" id="check_address">
                                                <label class="form-check-label" for="check_address">Edit my address</label>
                                            </div>

                                            <div class="col-md-6">
                                            @error('add_address')
                                                <span class="invalid-feedback du" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>

                                            <div class="w-100"></div>

                                            <!-- NATION INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country">Nation</label>
                                                    <div class="select-wrap">
                                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                        <select disabled="disabled" id="billing_nation" class="form-control addr_input" required="required">
                                                            @foreach($nations as $nation)
                                                            <option value="{{ $nation->id }}"
                                                            @if ($user->address && $nation->id == $user->address->town->nation->id)
                                                                selected="selected"
                                                            @endif
                                                            >{{ $nation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    

                                            <!-- CITY INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label for="country">Town / City</label>
                                                    <div class="select-wrap">
                                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                        <select disabled="disabled" id="billing_town" name="town_id" class="form-control addr_input @error('town_id') is-invalid @enderror" required="required">
                                                            @foreach($towns as $town)
                                                            <option value="{{ $town->id }}" data-nation-id="{{ $town->nation->id }}" 
                                                            @if ($user->address && $town->id == $user->address->town->id)
                                                                selected="selected"
                                                            @endif
                                                            >{{ $town->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @error('town_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>

                                            <div class="w-100"></div>

                                            

                                            <!-- STREET NUMBER INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="streetaddress">Street Number</label>
                                                    <input disabled="disabled" type="text" name="street_number" class="form-control addr_input @error('street_number') is-invalid @enderror" required="required" placeholder="House number and street name" 
                                                    @if ($user->address && !$errors->first('street_number'))
                                                        value="{{$user->address->street_number}}"
                                                    @endif
                                                    @error('street_number')
                                                    value="{{ old('street_number') }}"
                                                    @enderror
                                                    >
                                                </div>
                                            </div>

                                            <!-- POSTCODE INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="postcodezip">Postcode / ZIP</label>
                                                    <input disabled="disabled" id="postcode" type="text" name="postcode" class="form-control addr_input @error('postcode') is-invalid @enderror" required="required" placeholder=""
                                                    @if ($user->address && !$errors->first('postcode'))
                                                        value="{{$user->address->postcode}}"
                                                    @endif
                                                    @error('postcode')
                                                    value="{{ old('postcode') }}"
                                                    @enderror
                                                    >
                                                </div>
                                            </div>

                                            <div class="w-100 row col-md-12">
                                                <div class="col-md-6">
                                                @error('phone')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            
                                                <div class="col-md-6">
                                                @error('street_number')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>

                                            <!-- BUILDING INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="building">Building Number</label>
                                                    <input disabled="disabled" type="text" class="form-control addr_input @error('building_number') is-invalid @enderror" name="building_number" required="required" placeholder="Appartment, suite, unit etc..."
                                                    @if ($user->address && !$errors->first('building_number'))
                                                        value="{{$user->address->building_number}}"
                                                    @endif
                                                    @error('building_number')
                                                    value="{{ old('building_number') }}"
                                                    @enderror
                                                    >
                                                </div>
                                            </div>                    
                                            

                                            <!-- COUNTRY CODE INPUT -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="building">Country Code</label>
                                                    <input disabled="disabled" type="text" class="form-control addr_input @error('country_code') is-invalid @enderror" name="country_code" required="required" placeholder="US, IT..."
                                                    @if ($user->address && !$errors->first('country_code'))
                                                        value="{{$user->address->country_code}}"
                                                    @endif
                                                    @error('country_code')
                                                    value="{{ old('country_code') }}"
                                                    @enderror
                                                    >
                                                </div>
                                            </div>

                                            <div class="w-100 row col-md-12">
                                                <div class="col-md-6">
                                                @error('postcode')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            
                                                <div class="col-md-6">
                                                @error('building_number')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="w-100 row col-md-12">
                                                <div class="col-md-6">
                                                @error('country_code')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>

                                                <div class="col-md-12">
                                                @error('customError')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>


                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-12">
                                                    <button type="submit" class="btn btn-danger">Save Changes</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div> 
                        </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->

                @endif
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


        
@endsection
