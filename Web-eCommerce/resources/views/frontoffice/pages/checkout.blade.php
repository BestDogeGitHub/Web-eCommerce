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
                    <div class="row justify-content-center">
                    <div class="col-xl-7 ftco-animate">
                                    <form action="#" class="billing-form">
                                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firt Name</label>
                                    <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->name }}">  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->surname }}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="country">Nation</label>
                                            <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="billing_nation" class="form-control">
                                            @foreach($nations as $nation)
                                            <option value="{{ $nation->id }}"
                                            @if ($nation->id == Auth::user()->address->town->nation->id && Auth::user()->address != null)
                                                selected="selected"
                                            @endif
                                            >{{ $nation->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="country">Town / City</label>
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="billing_town" class="form-control">
                                                @foreach($towns as $town)
                                                <option value="{{ $town->id }}" data-nation-id="{{ $town->nation->id }}" 
                                                @if ($town->id == Auth::user()->address->town->id && Auth::user()->address != null)
                                                    selected="selected"
                                                @endif
                                                >{{ $town->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="phone">Phone</label>
                                <input type="text" class="form-control" placeholder="" value="{{ Auth::user()->phone }}">
                               
                                </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetaddress">Street Number</label>
                                        <input type="text" class="form-control" placeholder="House number and street name" 
                                        @if (Auth::user()->address != null)
                                            value="{{Auth::user()->address->street_number}}"
                                        @endif
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postcodezip">Postcode / ZIP *</label>
                                <input type="text" class="form-control" placeholder=""
                                @if (Auth::user()->address != null)
                                    value="{{Auth::user()->address->postcode}}"
                                @endif
                                >
                                </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="building">Building Number</label>
                                <input type="text" class="form-control" placeholder="Appartment, suite, unit etc..."
                                @if (Auth::user()->address != null)
                                    value="{{Auth::user()->address->building_number}}"
                                @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                <input type="text" class="form-control" placeholder="your.email@example.it" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Other Info</label>
                                        <textarea class="form-control" placeholder="Put additional informations. Es.: Don't ring the bell, call me when the package has arrived."></textarea>
                                    </div>
                                </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                <div class="radio">
                                <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                <!-- <label><input type="radio" name="optradio"> Ship to different address</label> -->
                                </div>
                            </div>
                            </div>
                            </div>
                        </form><!-- END -->
                                </div>
                                <div class="col-xl-5">
                        <div class="row mt-5 pt-3">
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
                                            <hr>
                                            <p class="d-flex total-price">
                                                <span>Total</span>
                                                <span>&euro; {{number_format((float) $subtotal - $discount + $delivery, 2, '.', '') }}</span>
                                            </p>
                                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Payment Method</h3>
                                                <a href="#"><img src="{{asset('dist/img/credit/visa.png') }}" alt="Visa"></a>
                                                <a href="#"><img src="{{asset('dist/img/credit/mastercard.png') }}" alt="Mastercard"></a>
                                                <a href="#"><img src="{{asset('dist/img/credit/american-express.png') }}" alt="American Express"></a>
                                                <a href="#"><img src="{{asset('dist/img/credit/paypal2.png') }}" alt="Paypal"></a>
                                                <br/>
                                                <hr/>
                                                <label>Other methods</label>
                                                @foreach($paymentMethods as $payment)
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="radio">
                                                        <label><input type="radio" name="optradio" class="mr-2" data-id="{{ $payment->id }}" >{{ $payment->method }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="checkbox">
                                                        <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
                                            </div>
                            </div>
                        </div>
                    </div> <!-- .col-md-8 -->
                    </div>
                </div>
                </section> <!-- .section -->
</div>

@endsection
