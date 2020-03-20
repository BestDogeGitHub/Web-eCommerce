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

            @if($index == 0) 
            <!-- FIRST -->
            <div class="row">
            @endif


                <div class="col-md-4">
                    <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end fadeInUp ftco-animated" style="background-image: url( {{ $cat->image_ref }} );">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="{{ asset('shop/categories/' . $cat->id) }}">{{ $cat->name }}</a></h2>
                        </div>		
                    </div>
                </div>

            @if( ($index+1) % 3 == 0 )
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

