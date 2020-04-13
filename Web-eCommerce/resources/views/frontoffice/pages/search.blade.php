@extends('frontoffice.layouts.layout')

@section('content')
<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 3)->first()->image_ref) }}"></div>

	<div class="hero-wrap hero-bread loading" id="header_div" >
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span><a href="{{ route('categories_par', 1) }}">Categories </a></span> </p>
                <h1 class="mb-0 bread">
                    Results of search
			    </h1>
            </div>
        </div>
    </div>
</div>

    <section class="ftco-section">
    	<div class="container">

			<h1>Results for Products: <i>{{ $search }}</i></h1>
			<hr/>
			<div class="row">
			@forelse($products as $index=>$prod)
				@include('frontoffice.partials._partial_show_product_type', ['prod' => $prod])
            @empty
                <p>No products found</p>
			@endforelse
			
			<!-- LAST -->
			</div>

			
    	</div>
    </section>
@endsection
