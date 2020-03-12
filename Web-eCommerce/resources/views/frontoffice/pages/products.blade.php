@extends('frontoffice.layouts.layout')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url({{ asset('images/bg_2.jpg') }});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ asset('/') }}">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread"></h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
                @if($products->count())
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
                     
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th class="text-uppercase">{{ $products->first()->productType->name }} List</th>
						        <th>&nbsp;</th>
						        <th>Sale</th>
						        <th>Stock</th>
						        <th>Available</th>
						      </tr>
						    </thead>
						    <tbody>

                                

                                    @foreach($products as $prod)
                                        <tr class="text-center">
                                        
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
                                            <h3>Properties</h3>
                                            @foreach($prod->values as $value)
                                            <p>{{ $value->attribute->name }} : {{ $value->name }}</p>
                                            @endforeach
                                            
                                        </td>
                                        
                                        <td class="price">{{ $prod->sale }}</td>
                                        
                                        <td class="price">{{ $prod->stock }}</td>
                                        
                                        <td class="total">
                                        @if($prod->available)
                                        <span class="badge badge-success">AVAILABLE</span>
                                        @else
                                        <span class="badge badge-danger">NOT AVAILABLE</span>
                                        @endif

                                        </td>
                                    </tr><!-- END TR-->
                                    @endforeach

                               
						    </tbody>
                          </table>
                          @else
                            <div class="container-fluid">
                            <div class="alert alert-danger" role="alert">
                            There are no products for the selected type
                            </div>
                            </div>
                          
                            
					  </div>
                </div>
                @endif  
    		</div>
			</div>
        </section>
    @endsection('content')