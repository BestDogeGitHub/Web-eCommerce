@extends('frontoffice.layouts.layout')

@section('content')

	<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 2)->first()->image_ref) }}"></div>

	<div class="hero-wrap hero-bread" id="header_div">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span><a href="{{ route('categories_par', 1) }}">Categories </a></span> <span>Products</span></p>
					<h1 class="mb-0 bread">
						@if(isset($parent)) 
						{{$parent->name}}
						@else
						Products
						@endif
						
					</h1>
				</div>
			</div>
		</div>
	</div>
	
    <section class="ftco-section">
    	<div class="container">



			<div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('categories_par', 'all') }}">All categories</a></li>
                        <li><a href="{{ route('categories_par', '1') }}">Browse</a></li>
                        <li><a href="{{ route('shop') }}" class="active">Products</a></li>
                    </ul>
                </div>
            </div>
			

			
			@foreach($products as $index=>$prod)

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

			@endforeach
			
				<div class="col text-center">
                  	<div class="block-27">
                    	<ul>
              
							<!-- 
							Logica della visualizzazione della paginazione
							
							Se mi trovo nella prima pagina nascondo il link prev
							Se mi trovo nell'ultima nascondo il link succ

							Ciclo fino alla current - 1 per le precedenti
							setto la current come attiva
							Ciclo fino alla lastPage per visualizzare le successive
							--> 

							@if($products->currentPage() != 1)
								<li><a class="pag" href="{{ $products->previousPageUrl() }}">&lt;</a></li>
							@endif

							@for ($i = 1; $i <= $products->currentPage() - 1; $i++)
								<li><span class="page"><a href="{{ url()->current() }}?page={{$i}}">{{ $i }}</a></span></li>
							@endfor
							
							<li class="active"><span>{{ $products->currentPage() }}</span></li>
							
							@for ($i = $products->currentPage() + 1; $i <= $products->lastPage(); $i++)
								<li><span class="page"><a href="{{ url()->current() }}?page={{$i}}">{{ $i }}</a></span></li>
							@endfor

							@if($products->currentPage() != $products->lastPage())
								<li><a class="pag" href="{{ $products->nextPageUrl() }}">&gt;</a></li>
							@endif

                   		</ul>
					</div>
            	</div>
		</div>
    </section>
@endsection
