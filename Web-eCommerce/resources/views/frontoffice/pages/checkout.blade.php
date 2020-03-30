@extends('frontoffice.layouts.layout')

@section('content')

<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 4)->first()->image_ref) }}"></div>

    <div class="hero-wrap hero-bread" id="header_div">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
            </div>
        </div>
    </div>

        <div class="container" style="padding-top: 5%; padding-bottom: 5%;">


            <section class="ftco-section">
                <div class="container">
                    <form action="{{ route('make_order') }}" method="POST" class="billing-form">
                        <div class="row justify-content-center">
                            <div class="col-xl-7 ftco-animate">
                                @csrf
                                   
                                <h3 class="mb-4 billing-heading">Billing Details</h3>

                                <div class="row align-items-end">

                                    <!-- FIRST NAME INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Firt Name *</label>
                                            <label class="input_label">{{ Auth::user()->name }}</label>
                                        </div>
                                    </div>

                                    <!-- LAST NAME INPUT -->    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name *</label>
                                            <label class="input_label">{{ Auth::user()->surname }}</label>
                                        </div>
                                    </div>

                                    <div class="w-100"></div>

                                    <!-- NATION INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Nation *</label>
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="" id="billing_nation" class="form-control" required="required">
                                                    @foreach($nations as $nation)
                                                    <option value="{{ $nation->id }}"
                                                    @if (Auth::user()->address && $nation->id == Auth::user()->address->town->nation->id)
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

                                            <label for="country">Town / City *</label>
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="town_id" class="form-control @error('town_id') is-invalid @enderror" required="required">
                                                    @foreach($towns as $town)
                                                    <option value="{{ $town->id }}" data-nation-id="{{ $town->nation->id }}" 
                                                    @if (Auth::user()->address && $town->id == Auth::user()->address->town->id)
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
                                            <label for="phone">Phone *</label>
                                            <input type="text" class="form-control" placeholder="" required="required" 
                                            @if(!$errors->first('phone'))
                                            value="{{ Auth::user()->phone }}"
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
                                            <label for="streetaddress">Street Number *</label>
                                            <input type="text" name="street_number" class="form-control @error('street_number') is-invalid @enderror" required="required" placeholder="House number and street name" 
                                            @if (Auth::user()->address && !$errors->first('street_number'))
                                                value="{{Auth::user()->address->street_number}}"
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
                                            <label for="postcodezip">Postcode / ZIP *</label>
                                            <input id="postcode" type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" required="required" placeholder=""
                                            @if (Auth::user()->address && !$errors->first('postcode'))
                                                value="{{Auth::user()->address->postcode}}"
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
                                            <label for="building">Building Number *</label>
                                            <input type="text" class="form-control @error('building_number') is-invalid @enderror" name="building_number" required="required" placeholder="Appartment, suite, unit etc..."
                                            @if (Auth::user()->address && !$errors->first('building_number'))
                                                value="{{Auth::user()->address->building_number}}"
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
                                            <label for="building">Country Code *</label>
                                            <input type="text" class="form-control @error('country_code') is-invalid @enderror" name="country_code" required="required" placeholder="US, IT..."
                                            @if (Auth::user()->address && !$errors->first('country_code'))
                                                value="{{Auth::user()->address->country_code}}"
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
                                            value="{{Auth::user()->email}}" 
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

                                    <!-- OTHER INFO INPUT -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone">Other Info</label>
                                            <textarea class="form-control" placeholder="Put additional informations. Es.: Don't ring the bell, call me when the package has arrived."></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- RIGHT PART OF FORM -->

                            <div class="col-xl-5">
                                <div class="row mt-5 pt-3">

                                    <!-- FINACIAL DATA -->
                                    <div class="col-md-12 d-flex mb-5">
                                        <div class="cart-detail cart-total p-3 p-md-4">
                                            <h3 class="billing-heading mb-4">Cart Total</h3>
                                            <p class="d-flex">
                                                <span>Subtotal</span>
                                                <span>&euro; {{ $subtotal }}</span>
                                            </p>
                                            <p class="d-flex">
                                                <span>Delivery</span>
                                                <span>&euro; {{ $delivery }}</span>
                                            </p>
                                            <p class="d-flex">
                                                <span>Discount</span>
                                                <span>&euro; {{ $discount }}</span>
                                            </p>
                                            <hr/>
                                            <p class="d-flex total-price">
                                                <span>Total</span>
                                                <span>&euro; {{number_format((float) $subtotal - $discount + $delivery, 2, '.', '') }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 cart-wrap ftco-animate">
                                        <div class="cart-total mb-3">
                                            <h3>Coupon Code</h3>
                                            <p>Enter your coupon code if you have one</p>
                                            <div class="form-group">
                                                <label for="">Coupon code</label>
                                                <input type="text" id="coupon_code" name="coupon" class="form-control text-left px-3" placeholder="">
                                            </div>
                                            <p><a href="#" class="btn btn-primary py-3 px-4" id="check_coupon">Check Coupon</a></p>
                                            <br/><div id="forErrors"></div>

                                        </div>
                                    </div>



                                    <!-- Payment Method Card -->
                                    <div class="col-md-12">
                                        <div class="cart-detail p-3 p-md-4">
                                            <h3 class="billing-heading mb-4">Payment Method</h3>
                                            
                                            <!-- USE MY CARD -->
                                            
                                            
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="associated" value="1" @if(count(Auth::user()->creditCards)) checked="checked" @endif>
                                                <label class="form-check-label mb-2 text-uppercase">
                                                    <b>Use an associated Credit Card</b>
                                                </label>
                                            </div>
                                            @if(count(Auth::user()->creditCards))
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select id="card_id" name="card_id" class="form-control" required="required">
                                                    @foreach(Auth::user()->creditCards as $card)
                                                    <option value="{{ $card->id }}">{{ $card->company->name }} / {{ $card->getHideNumber() }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <p>No Credit Cards Associated</p>
                                            @endif
                                            <hr/>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="associated" value="0" @if(!count(Auth::user()->creditCards)) checked="checked" @endif>
                                                <label class="form-check-label mb-2 text-uppercase">
                                                   <b>Add new Card</b>
                                                </label>
                                            </div>

                                                <!-- Add new card -->

                                                <div class="col-md-12 mb-2">

                                                    <label>Select Credit Card Company</label><br/>

                                                    <label>
                                                        <input class="radio_p" type="radio" id="short_comp_1" name="short_comp" value="1" 
                                                        @if(old('short_comp') == 1) checked="checked" @endif
                                                        >
                                                        <img src="{{asset('dist/img/credit/visa.png') }}" alt="Visa">
                                                    </label>

                                                    <label>
                                                        <input class="radio_p" type="radio" id="short_comp_2" name="short_comp" value="2"
                                                        @if(old('short_comp') == 2) checked="checked" @endif
                                                        >
                                                        <img src="{{asset('dist/img/credit/mastercard.png') }}" alt="Mastercard">
                                                    </label>

                                                    <label>
                                                        <input class="radio_p" type="radio" id="short_comp_3" name="short_comp" value="3"
                                                        @if(old('short_comp') == 3) checked="checked" @endif
                                                        >
                                                        <img src="{{asset('dist/img/credit/american-express.png') }}" alt="American Express">
                                                    </label>

                                                    <label>
                                                        <input class="radio_p" type="radio" id="short_comp_4" name="short_comp" value="4"
                                                        @if(old('short_comp') == 4) checked="checked" @endif
                                                        >
                                                        <img src="{{asset('dist/img/credit/paypal2.png') }}" alt="Paypal">
                                                    </label>
                                                    <br/>
                                                    
                                                    <label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="short_comp_5" name="short_comp" value="5"
                                                        @if(old('short_comp') == 5) checked="checked" @endif
                                                        >
                                                        <label class="form-check-label">
                                                            Others
                                                        </label>
                                                        </div>
                                                    </label>
                                                    <div class="select-wrap">
                                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                        <select name="company" id="company" class="form-control">
                                                            @foreach($companies as $company)
                                                            <option value="{{ $company->id }}"
                                                            @if(old('short_comp') == 1 && old('company') == $company->id) 
                                                            selected="selected"
                                                            @endif
                                                            >{{ $company->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                
                                                </div>

                                                <!--  NEW CARD INFO INPUT -->
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="card_number">Card Number</label>
                                                        <input type="text" class="form-control" placeholder="352************" name="number" id="card_number" value="{{ old('number') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label>Expiration</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control text-center" maxlength="2" placeholder="MM" name="exp_month" id="editMonth" value="{{ old('exp_month') }}">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">/</span>
                                                            </div>
                                                            <input type="text" class="form-control text-center" maxlength="2" placeholder="YY" name="exp_year" id="editYear" value="{{ old('exp_year') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- DISPLAY ERRORS OF CARD FORM -->

                                                @error('associated')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Select or insert card to place an order. <br/>- {{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('card_id')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Insert a valid card to place an order. <br/>- {{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('short_comp')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Select a company.</strong>
                                                    </span>
                                                @enderror
                                                @error('company')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Error in company select.</strong>
                                                    </span>
                                                @enderror
                                                @error('number')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Insert a valid card number to place an order.</strong>
                                                    </span>
                                                @enderror
                                                @error('exp_month')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Insert a valid card expiration date to place an order.</strong>
                                                    </span>
                                                @enderror
                                                @error('exp_year')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>Insert a valid card expiration date to place an order.</strong>
                                                    </span>
                                                @enderror
                                                @error('coupon')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('customError')
                                                    <br/>
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                

                                            <hr/>            
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="checkbox">
                                                    <label><input type="checkbox" id="conditions" name="conditions" value="1" class="mr-2" required="required"> I have read and accept the terms and conditions</label>
                                                    </div>
                                                    @error('conditions')
                                                    <span class="invalid-feedback du" role="alert">
                                                        <strong>You must accept our terms and conditions to continue. <br/>- {{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <p><button type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- .col-md-8 -->
                        
                    </form>
                </div>
            </section> <!-- .section -->
        </div>

@endsection
