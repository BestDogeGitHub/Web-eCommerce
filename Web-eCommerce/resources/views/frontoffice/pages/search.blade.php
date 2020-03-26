@extends('frontoffice.layouts.layout')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('images/bg_2.jpg') }} ');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span><a href="{{ route('categories_par', 1) }}">Categories </a></span> </p>
            <h1 class="mb-0 bread">
				Results for Products: {{ $search }}
			</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section">
    	<div class="container">

			<!--	CATEGORIES FILTER
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="#" class="active">All</a></li>
    					<li><a href="#">Vegetables</a></li>
    					<li><a href="#">Fruits</a></li>
    					<li><a href="#">Juice</a></li>
    					<li><a href="#">Dried</a></li>
    				</ul>
    			</div>
    		</div> -->
			

			
			@forelse($products as $index=>$prod)

				@if($index == 0) 
				<!-- FIRST -->
				<div class="row">
				@endif

					<div class="col-lg-3 ftco-animate">
						<div class="product">
							<a href="{{ asset('products/' . $prod->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset($prod->image_ref) }}" alt="Product type image">
								<div class="overlay"></div>
							</a>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3><a href="asset('products/' . $prod->id)">{{ $prod->name }}</a></h3>
								<p >
								@for($i = 1; $i <= 5; $i++)
									@if($i <= $prod->star_rate) 
									<a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									@else
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									@endif
								@endfor
							</p>
							</div>
						</div>
					</div>

				@if( ($index+1) % 4 == 0 )
				</div><!-- NEW LINE --><div class="row">
				@endif

				@if($loop->last)
				<!-- LAST -->
				</div>
                @endif
            
            @empty
                <p>No products found</p>
            @endforelse

			
        </div>
    	</div>
    </section>
@endsection
