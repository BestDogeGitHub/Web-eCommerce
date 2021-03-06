@extends('frontoffice.layouts.layout')

@section('content')



<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 5)->first()->image_ref) }}"></div>

	<div class="hero-wrap hero-bread" id="header_div">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>


<div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <section class="ftco-section ftco-cart">
			<div class="container">

				<div class="row">
                @if($cart->count())
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">

                <div class="search-form-container mb-2">  
                  <div class="search-row">
                    <div class="icon-search-my">
                      <i class="fa fa-search"></i>
                    </div>
                    <input class="search_input search_in_table ml-auto table_search" data-table-id="cart_table" data-table-fields="[2]" name="search" type="search" placeholder="Search products" aria-label="Search"> 
                  </div>
                </div>

	    				<table class="table" id="cart_table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						      </tr>
						    </thead>
						    <tbody>
                                @foreach($cart as $prod)
                                <tr class="text-center" id="prod_{{$prod->id}}">
                                    <td class="product-remove"><a class="removeFromCart" href="#" data-id="{{ $prod->id }}"><span class="ion-ios-close"></span></a></td>
                                    
                                    <td class="image-prod">
                                        <div class="img">
                                        <!-- <img src=" $prod->productImages->image_ref "/> -->
                                        @if(!$prod->productImages->count())
                                        <a href="{{ asset('products/details/' . $prod->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset($prod->productType->image_ref) }}" alt="Product image">
                                            <div class="overlay"></div>
                                        </a>
                                        @else
                                        <a href="{{ asset('products/details/' . $prod->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset($prod->productImages->first()->image_ref) }}" alt="Product image">
                                            <div class="overlay"></div>
                                        </a>
                                        @endif    
                                        
                                        </div>
                                    </td>
                                    
                                    <td class="product-name">
                                        <h3>{{ $prod->productType->name }}</h3>
                                        <p>Properties: <br>
                                        @forelse($prod->values as $value)
                                        <span class="badge badge-warning">{{$value->attribute->name}} : {{$value->name}}</span> <br/>
                                        @empty
                                        @endforelse
                                        @forelse($prod->productType->values as $value)
                                        <span class="badge badge-warning">{{$value->attribute->name}} : {{$value->name}}</span> <br/>
                                        @empty
                                        @endforelse
                                        </p>
                                    </td>
                                    
                                    <td class="price">
                                        @if($prod->sale != 0)
                                        <p class="price"><span class="mr-2 price-dc">&euro; {{number_format((float)$prod->payment / (1 - $prod->sale / 100), 2, '.', '') }}</span><br/><span class="price-sale">&euro; {{$prod->payment}}</span></p>
                                        @else
                                        <p class="price"><span>&euro; {{$prod->payment}}</span></p>
                                        @endif
                                    </td>
                                    
                                    <td class="quantity">
										<div class="d-inline product-details ftco-animate">
											<a href="#" class="cart_quant_minus mr-2" data-id="{{$prod->id}}"><i class="ion-ios-remove"></i></a>

                      <label id="cart_quant_val_{{$prod->id}}">{{ $prod->quantity }}</label>
                    
                      
											<a href="#" class="cart_quant_plus ml-2" data-id="{{$prod->id}}"><i class="ion-ios-add"></i></a>
										</div>
                                </td>
                                    
                                </tr><!-- END TR-->
                                @endforeach





						    </tbody>
						  </table>
					  </div>
                </div>
                @else
                <h3>No Products</h3>
                @endif


    		</div>
    		<div class="row justify-content-end">
				<div class="col-lg-6 mt-5 cart-wrap ftco-animate">
					<a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                </div>
                <!--    ESTIMATE SHIPMENT COST
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Estimate shipping and tax</h3>
    					<p>Enter your destination to get a shipping estimate</p>
  						<form action="#" class="info">
	              <div class="form-group">
	              	<label for="">Country</label>
	                <input type="text" class="form-control text-left px-3" placeholder="">
	              </div>
	              <div class="form-group">
	              	<label for="country">State/Province</label>
	                <input type="text" class="form-control text-left px-3" placeholder="">
	              </div>
	              <div class="form-group">
	              	<label for="country">Zip/Postal Code</label>
	                <input type="text" class="form-control text-left px-3" placeholder="">
	              </div>
	            </form>
    				</div>
    				<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
    			</div> -->
    		</div>
			</div>
        </section>
</div>
        
@endsection
