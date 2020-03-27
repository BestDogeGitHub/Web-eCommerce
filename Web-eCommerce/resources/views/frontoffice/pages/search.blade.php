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

			
			@forelse($products as $index=>$prod)
                @if($loop->iteration == 1) 
				<!-- FIRST -->
				<div class="row">
				@endif

					<div class="col-lg-3 ftco-animate">
						<div class="product">
                            <a href="{{ asset('products/' . $prod->id) }}" class="img-prod">
                                <img class="img-fluid" src="{{ asset($prod->image_ref) }}" alt="Product type image">
								<div class="overlay"></div>
							</a>
							<div class="text py-3 pb-4 px-3 text-center">
								<h3><a href="asset('products/' . $prod->id)">{{ $prod->name }}</a></h3>
								<p>
								@for($i = 1; $i <= 5; $i++)
									@if($i <= intval($prod->star_tot_number / $prod->n_reviews)) 
									<a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									@else
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									@endif
								@endfor
							    </p>
							</div>
						</div>
                    </div>
                    
				@if( ($loop->iteration) % 4 == 0 )
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
    </section>
@endsection
