@extends('frontoffice.layouts.layout')

@section('content')


    <section class="ftco-section">
    	<div class="container">
    		<div class="row">

				<!-- Immagini che scorrono -->
				<div class="col-lg-6">
					<div id="carouselProductImages" class="carousel slide" data-ride="carousel">

						<div class="carousel-inner">
							@if(!count($product->productImages))
								<div class="carousel-item active img_prod">
									<a href="{{ asset('products/' . $product->id) }}" class="image-popup"><img src="{{ asset('/images/products/no-image.png') }}" class="img-fluid" alt="Image of product"></a>
								</div>
							@endif
							@foreach ($product->productImages as $index=>$image)
								@if ($index == 0 )
									<div class="carousel-item active img_prod">
										<a href="{{ asset('products/' . $product->id) }}" class="image-popup"><img src="{{ asset($image->image_ref) }}" class="img-fluid" alt="Image of product"></a>
									</div>
								@else
									<div class="carousel-item img_prod">
										<a href="{{ asset('products/' . $product->id) }}" class="image-popup"><img src="{{ asset($image->image_ref) }}" class="img-fluid" alt="Image of product"></a>
									</div>
								@endif
							@endforeach
						</div>

						<a class="carousel-control-prev" href="#carouselProductImages" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselProductImages" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<!-- Dettagli prodotto -->
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3 class="text-uppercase" >{{ $product->productType->name }}</h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;">{{ $product->buy_counter }} <span style="color: #bbb;">Sold</span></a>
							</p>
						</div>
						@if($product->sale != 0)
							<p class="price"><span class="mr-2 price-dc">&euro;  {{number_format((float)$prod->payment / (1 - $prod->sale / 100), 2, '.', '') }}</span><span class="price-sale">&euro; {{$product->payment}}</span></p>
							@else
							<p class="price"><span>&euro; {{$product->payment}}</span></p>
							@endif
					<p>Info:  {{ $product->info }} </p>
					<h3>Properties</h3>
					@foreach($product->values as $value)
					<p>{{ $value->attribute->name }} : {{ $value->name }}</p>
					@endforeach
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
									<div class="select-wrap">

									<!--
									
										
											*** EVENTUALE SCELTA IN CHOICE BOX *** 

										<div class="icon"><span class="ion-ios-arrow-down"></span></div>
										<select name="" id="" class="form-control">
											<option value="">Small</option>
											<option value="">Medium</option>
											<option value="">Large</option>
											<option value="">Extra Large</option>
										</select>

											-->
									</div>
		            		</div>
						</div>
				<div class="w-100"></div>
				<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            	</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
	          	<div class="w-100"></div>
	          	<div class="col-md-12">
	          		<p style="color: #000;"> {{ $product->stock }} pieces available</p>
	          	</div>
          	</div>
          	<p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">Related Products</h2>
            <p>Products of the same type</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
			@forelse ($related as $prod)
                @include('frontoffice.partials._partial_show_product', ['product' => $prod])
              @empty
                <p>There are no related products</p>
              @endforelse
    		</div>
    	</div>
    </section>

	

@endsection