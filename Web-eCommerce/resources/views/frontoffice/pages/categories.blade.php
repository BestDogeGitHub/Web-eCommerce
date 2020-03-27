@extends('frontoffice.layouts.layout')

@section('content')
<div class="hero-wrap hero-bread back3">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="{{ route('categories_par', 1) }}">Categories</a></span></p>
            <h1 class="mb-0 bread">
                @if( $parent->id == 1)
                Categories
                @else
                {{ $parent->name }}
                @endif
            </h1>
          </div>
        </div>
      </div>
    </div>

<div class="container" style="padding-top: 5%; padding-bottom: 5%;">

    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">
        @foreach($categories as $index=>$cat)
            @if($loop->iteration == 1) 
            <!-- FIRST -->
            <div class="row">
            @endif

            
                <div class="col-lg-3 ftco-animate">
                    <div class="product square">
                        <a href="{{ route('categories_par', $cat->id) }}" class="img-prod"><img class="img-fluid cat-img" src="{{ $cat->image_ref }}" alt="Category image">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3 class="text-uppercase"><a href="{{ route('categories_par', $cat->id) }}">{{ $cat->name }}</a></h3>
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

        @endforeach
        </div>
    </section>

</div>
@endsection('content')

