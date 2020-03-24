@extends('frontoffice.layouts.layout')

@section('content')

    <div class="hero-wrap hero-bread back3">
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
                                   
                                <h3 class="mb-4 billing-heading">Billing Details</h3>

                                <div class="row align-items-end">

                                    <!-- FIRST NAME INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Firt Name *</label>
                                            <input type="text" class="form-control" required="required" placeholder="" value="{{ Auth::user()->name }}" disabled="disabled">  
                                        </div>
                                    </div>

                                    <!-- LAST NAME INPUT -->    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name *</label>
                                            <input type="text" class="form-control" required="required" placeholder="" value="{{ Auth::user()->surname }}" disabled="disabled">
                                        </div>
                                    </div>

                                    <div class="w-100"></div>

                                    <!-- NATION INPUT -->
                                    <div class="col-md-12">
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

                                    <div class="w-100"></div>
                            

                                    <!-- CITY INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="country">Town / City *</label>
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="" id="billing_town" class="form-control" required="required">
                                                    @foreach($towns as $town)
                                                    <option value="{{ $town->id }}" data-nation-id="{{ $town->nation->id }}" 
                                                    @if (Auth::user()->address && $town->id == Auth::user()->address->town->id)
                                                        selected="selected"
                                                    @endif
                                                    >{{ $town->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PHONE INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone *</label>
                                            <input type="text" class="form-control" placeholder="" required="required" value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="w-100"></div>

                                    <!-- STREET NUMBER INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Street Number *</label>
                                            <input type="text" class="form-control" required="required" placeholder="House number and street name" 
                                            @if (Auth::user()->address)
                                                value="{{Auth::user()->address->street_number}}"
                                            @endif
                                            >
                                        </div>
                                    </div>

                                    <!-- POSTCODE INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postcodezip">Postcode / ZIP *</label>
                                            <input type="text" class="form-control" required="required" placeholder=""
                                            @if (Auth::user()->address)
                                                value="{{Auth::user()->address->postcode}}"
                                            @endif
                                            >
                                        </div>
                                    </div>

                                    <div class="w-100"></div>

                                    <!-- BUILDING INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="building">Building Number *</label>
                                            <input type="text" class="form-control" required="required" placeholder="Appartment, suite, unit etc..."
                                            @if (Auth::user()->address)
                                                value="{{Auth::user()->address->building_number}}"
                                            @endif>
                                        </div>
                                    </div>

                                    <!-- EMAIL INPUT -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="text" class="form-control" placeholder="your.email@example.it" value="{{Auth::user()->email}}" required="required">
                                        </div>
                                    </div>


                                    <div class="w-100"></div>

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


                                    <div class="col-md-12">
                                        <div class="cart-detail p-3 p-md-4">
                                            <h3 class="billing-heading mb-4">Payment Method</h3>
                                            
                                            <label>
                                                <input class="radio_p" type="radio" name="test" value="small">
                                                <img src="{{asset('dist/img/credit/visa.png') }}" alt="Visa">
                                            </label>

                                            <label>
                                                <input class="radio_p" type="radio" name="test" value="big">
                                                <img src="{{asset('dist/img/credit/mastercard.png') }}" alt="Mastercard">
                                            </label>

                                            <label>
                                                <input class="radio_p" type="radio" name="test" value="big">
                                                <img src="{{asset('dist/img/credit/american-express.png') }}" alt="American Express">
                                            </label>

                                            <label>
                                                <input class="radio_p" type="radio" name="test" value="big">
                                                <img src="{{asset('dist/img/credit/paypal2.png') }}" alt="Paypal">
                                            </label>
                                            <br/>
                                            
                                            <label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="test" value="big">
                                                <label class="form-check-label">
                                                    Other Methods
                                                </label>
                                                </div>
                                            </label>
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="" id="billing_town" class="form-control" required="required">
                                                    @foreach($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <hr/>            
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="checkbox">
                                                    <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                                    </div>
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
