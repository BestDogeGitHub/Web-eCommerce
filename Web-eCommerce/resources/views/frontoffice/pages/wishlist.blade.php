@extends('frontoffice.layouts.layout')

@section('content')


    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
            <h1 class="mb-0 bread black">My Wishlist</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container" style="padding-top: 5%; padding-bottom: 5%;">
    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>Product List</th>
						        <th>&nbsp;</th>
						        <th>Price</th>
						      </tr>
						    </thead>
						    <tbody>
                                @foreach($wishlist as $product)
                                <tr class="text-center">
                                    <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
                                    @php
										if(count($product->productImages))
											$image = $product->productImages->first()->image_ref;
										else $image = "/images/products/no-image.png";
									@endphp
                                    <td class="image-prod"><div class="img">
                                        <img class="img-fluid" src='{{ asset("$image") }}' alt="Product Image">
                                    </div></td>
                                    
                                    <td class="product-name">
                                        <h3>{{$product->productType->name}}</h3>
                                        <p>{{$product->info}}</p>
                                    </td>
                                    
                                    <td class="price">{{$product->payment}}</td>
                                    
                                </tr><!-- END TR-->
                                @endforeach

						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
			</div>
		</section>


</div>
@endsection
