@extends('frontoffice.layouts.layout')

@section('content')


    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
				<!-- Immagini che scorrono -->
				<div class="col-lg-6 mb-5 ftco-animate">
					<div id="carouselProductImages" class="carousel slide" data-ride="carousel">

						<div class="carousel-inner">
							@if(!count($product->productImages))
								<div class="carousel-item active img_prod">
									<a href="{{ asset('/images/products/no-image.png') }}" class="image-popup"><img src="{{ asset('/images/products/no-image.png') }}" class="img-fluid" alt="Image of product"></a>
								</div>
							@endif
							@foreach ($product->productImages as $index=>$image)
								@if ($index == 0 )
									<div class="carousel-item active img_prod">
										<a href="{{ asset($image->image_ref) }}" class="image-popup"><img src="{{ asset($image->image_ref) }}" class="img-fluid" alt="Image of product"></a>
									</div>
								@else
									<div class="carousel-item img_prod">
										<a href="{{ asset($image->image_ref) }}" class="image-popup"><img src="{{ asset($image->image_ref) }}" class="img-fluid" alt="Image of product"></a>
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
					<h4><strong>{{ $product->variant_name }}</strong></h4>
    				<div class="rating d-flex">
							<p class="text-left mr-5">
								<a href="#" class="mr-2 detail-rating">
									@for($i = 1; $i <= 5; $i++)
										@if($product->n_reviews && $i <= intval($product->star_tot_number / $product->n_reviews)) 
										<i class="fa fa-star" aria-hidden="true"></i>
										@else
										<i class="fa fa-star-o" aria-hidden="true"></i>
										@endif
									@endfor 
								</a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2 detail-link">{{ $product->buy_counter }} <span class="detail">Sold</span></a>
							</p>
						</div>
						@if($product->sale != 0)
							<p class="price"><span class="mr-2 price-dc">&euro; {{number_format((float)$product->payment, 2, '.', '') }}</span><span class="price-sale">&euro; {{$product->getRealPrice()}}</span></p>
							@else
							<p class="price"><span>&euro; {{$product->payment}}</span></p>
							@endif
					<h4>Properties</h4>
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
	          	<div class="col-md-12">
	          		<p style="color: #000;"> {{ $product->stock }} pieces available</p>
	          	</div>
			  </div>

				@if($product->stock)
					<p><a href="#" class="buy-now btn btn-black py-3 px-5"  data-id="{{$product->id}}">Add to Cart</a></p>
				@else
					<p><a href="#" class="buy-now btn btn-black py-3 px-5 disabled">Not Available</a></p>
				@endif
							  
    			</div>
			</div>
			<div class="row mt-4">
				<nav class="w-100">
					<div class="nav nav-tabs" id="product-tab" role="tablist">
						<a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
						<a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments <span class="badge badge-info ml-2 bg-primary" id="nav_wish_link">{{ count($product->reviews) }}</span></a>
					</div>
				</nav>
					<div class="tab-content p-3" id="nav-tabContent">

						<!-- INFO DIV -->
						<div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
							Info:  {{ $product->info ?? 
									
									'A musical instrument is a device created or adapted to make musical sounds. In principle, any object that produces sound can be considered a musical instrument—it is through purpose that the object becomes a musical instrument. The history of musical instruments dates to the beginnings of human culture. Early musical instruments may have been used for ritual, such as a horn to signal success on the hunt, or a drum in a religious ceremony. Cultures eventually developed composition and performance of melodies for entertainment. Musical instruments evolved in step with changing applications and technologies.

									The date and origin of the first device considered a musical instrument is disputed. The oldest object that some scholars refer to as a musical instrument, a simple flute, dates back as far as 67,000 years. Some consensus dates early flutes to about 37,000 years ago. However, most historians believe that determining a specific time of musical instrument invention is impossible, as many early musical instruments were made from animal skins, bone, wood and other non-durable materials.

									Musical instruments developed independently in many populated regions of the world. However, contact among civilizations caused rapid spread and adaptation of most instruments in places far from their origin. By the Middle Ages, instruments from Mesopotamia were in maritime Southeast Asia, and Europeans played instruments originating from North Africa. Development in the Americas occurred at a slower pace, but cultures of North, Central, and South America shared musical instruments.

									By 1400, musical instrument development slowed in many areas and was dominated by the Occident. During the Classical and Romantic periods of music, lasting from roughly 1750 to 1900, many new musical instruments were developed. While the evolution of traditional musical instruments slowed beginning in the 20th century, new electronic instruments such as electric guitars and synthesizers were invented.

									Musical instrument classification is a discipline in its own right, and many systems of classification have been used over the years. Instruments can be classified by their effective range, their material composition, their size, role, etc. However, the most common academic method, Hornbostel–Sachs, uses the means by which they produce sound. The academic study of musical instruments is called organology.' }}
						</div>
						

						<!-- REVIEWS DIV -->
						<div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 

							@auth
							<div class="post">
								<form action="{{ route('add_review', $product->id) }}" method="POST" class="billing-form">
									@csrf
									<div class="user-block">
										<img class="img-circle img-bordered-sm" src="{{ asset('/images/static/user-circle.png') }}" alt="user image">
										<span class="username">
										<a href="#">{{ Auth::user()->name }} {{ Auth::user()->surname }}</a> > <a href="{{ route('products', $product->id) }}"><small>{{ $product->productType->name }} - {{ $product->variant_name }}</small></a>
										</span>
										<span class="description">{{ date("H:i",strtotime( now() )) }} {{ date("d:m:Y",strtotime( now() )) }}</span>
									</div>
									<!-- /.user-block -->
									<p>
										<div class="form-group">
											<label for="text">Your Review</label>
											<textarea name="text" class="form-control" rows="3" placeholder="Type here your comment..."></textarea>
										</div>										
									</p>
									<input type="hidden" name="stars" value="0" id="stars_value"/>
									<p>
										Valutation<br/>             
										@for($i = 1; $i <= 5; $i++)
											<a data-value="{{$i}}" class="add_star" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
										@endfor
									</p>
									<button type="submit" class="btn btn-primary">Send</button>
								</form>
							</div>
							@endauth
						

							@forelse ($reviews as $index=>$review)
								@if($loop->iteration > 3) 
									@include('frontoffice.partials._partial_show_review', ['review' => $review, 'more' => 1])
								@else 
									@include('frontoffice.partials._partial_show_review', ['review' => $review, 'more' => 0])
								@endif
							@empty
								<p>There are no reviews</p>
							@endforelse

							<!-- SHOW MORE DIV -->
							<div class="row text-center">
								<p><a href="#" id="show_all_rec" data-status="0" class="btn btn-primary py-3 px-4">Show All</a></p>
							</div>

						</div>
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