@extends('frontoffice.layouts.layout')

@section('content')



        <div class="hero-wrap hero-bread back3">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Profile</span></p>
                <h1 class="mb-0 bread">My Profile</h1>
            </div>
            </div>
        </div>
        </div>


        <div class="container" style="padding-top: 5%; padding-bottom: 5%;">
            <section class="ftco-section ftco-cart">
                <div class="container">
                    <form action="{{ route('make_order') }}" method="POST" class="billing-form">
                        <div class="col-xl-12 ftco-animate">
                            @csrf
                                
                            <h3 class="mb-4 billing-heading">My Profile</h3>

                            <div class="row align-items-end">

                                <!-- FIRST NAME INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Firt Name</label>
                                        <input type="text" class="form-control" required="required" placeholder="" value="{{ $user->name }}">  
                                    </div>
                                </div>

                                <!-- LAST NAME INPUT -->    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" required="required" placeholder="" value="{{ $user->surname }}">
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <!-- FIRST NAME INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Username</label>
                                        <label class="input_label">{{$user->username}}</label>  
                                    </div>
                                </div>

                                <!-- LAST NAME INPUT -->    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Roles</label>
                                        <label class="input_label">{{ $user->roles->pluck('name')->implode(', ') }}</label>
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <!-- NATION INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Nation</label>
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="billing_nation" class="form-control" required="required">
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
                                            <select name="town_id" class="form-control @error('town_id') is-invalid @enderror" required="required">
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

                                <!-- PHONE INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" placeholder="" required="required" 
                                        @if(!$errors->first('phone'))
                                        value="{{ $user->phone }}"
                                        @endif
                                        @error('phone')
                                        value="{{ old('phone') }}"
                                        @enderror
                                        >
                                    </div>
                                </div>

                                <!-- STREET NUMBER INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetaddress">Street Number</label>
                                        <input type="text" name="street_number" class="form-control @error('street_number') is-invalid @enderror" required="required" placeholder="House number and street name" 
                                        @if ($user->address && !$errors->first('street_number'))
                                            value="{{$user->address->street_number}}"
                                        @endif
                                        @error('street_number')
                                        value="{{ old('street_number') }}"
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

                                <!-- POSTCODE INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postcodezip">Postcode / ZIP</label>
                                        <input id="postcode" type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" required="required" placeholder=""
                                        @if ($user->address && !$errors->first('postcode'))
                                            value="{{$user->address->postcode}}"
                                        @endif
                                        @error('postcode')
                                        value="{{ old('postcode') }}"
                                        @enderror
                                        >
                                    </div>
                                </div>

                                <!-- BUILDING INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="building">Building Number</label>
                                        <input type="text" class="form-control @error('building_number') is-invalid @enderror" name="building_number" required="required" placeholder="Appartment, suite, unit etc..."
                                        @if ($user->address && !$errors->first('building_number'))
                                            value="{{$user->address->building_number}}"
                                        @endif
                                        @error('building_number')
                                        value="{{ old('building_number') }}"
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

                                <!-- COUNTRY CODE INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="building">Country Code</label>
                                        <input type="text" class="form-control @error('country_code') is-invalid @enderror" name="country_code" required="required" placeholder="US, IT..."
                                        @if ($user->address && !$errors->first('country_code'))
                                            value="{{$user->address->country_code}}"
                                        @endif
                                        @error('country_code')
                                        value="{{ old('country_code') }}"
                                        @enderror
                                        >
                                    </div>
                                </div>

                                <!-- EMAIL INPUT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address</label>
                                        <input type="text" class="form-control" name="email" placeholder="your.email@example.it" 
                                        @if (!$errors->first('email'))
                                        value="{{$user->email}}" 
                                        @endif
                                        @error('email')
                                        value="{{ old('email') }}"
                                        @enderror
                                        required="required">
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
                                
                                    <div class="col-md-6">
                                    @error('email')
                                        <span class="invalid-feedback du" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div> 
            </section>
        </div>
        
@endsection
