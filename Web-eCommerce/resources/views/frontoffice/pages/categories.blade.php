@extends('frontoffice.layouts.layout')

@section('content')
    <div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 3)->first()->image_ref) }}"></div>

	<div class="hero-wrap hero-bread" id="header_div">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="{{ route('categories_par', 1) }}">Categories</a></span></p>
            <h1 class="mb-0 bread">
                @if($parent && $parent->id != 1)
                    {{ $parent->name ?? 'Categories'}}
                @else
                    Browse into categories
                @endif
            </h1>
          </div>
        </div>
      </div>
    </div>

<div class="container" style="padding-top: 5%; padding-bottom: 5%;">

    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">


    		<div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('categories_par', 'all') }}" @if($type == 1) class="active" @endif>All categories</a></li>
                        <li><a href="{{ route('categories_par', '1') }}" @if($type == 2) class="active" @endif>Browse</a></li>
                        <li><a href="{{ route('shop') }}">Products</a></li>
                    </ul>
                </div>
            </div>


        <div class="d-none">    
            <div id="category_template">
                <div class="col-lg-3 ftco-animate">
                    <div class="product square">
                        <a href="#" class="img-prod category_link"><img class="img-fluid cat-img" src="#" alt="Category image">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3 class="text-uppercase"><a href="#" class="category_link"><small><span class="parent_cat">?</span></small> > <b><span class="target_cat">?</span></b></a></h3>
                            <p>
                                ( <b><span class="num_prod_cat"></span></b> Product Types)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        @foreach($categories as $index=>$cat)
            @if($loop->iteration == 1) 
            <!-- FIRST -->
            <div class="row categories_row" data-logic-row="{{$cat->parent->id}}">
            @endif

            
                <div class="col-lg-3 ftco-animate">
                    <div class="product square">
                        <a href="{{ route('categories_par', $cat->id) }}" data-leaf="@if($type == 1) 1 @else 0 @endif" class="img-prod category_link" data-logic-row="{{$cat->parent->id}}" data-parent="{{ $cat->id }}" data-parent-name="{{ $cat->name }}"><img class="img-fluid cat-img" src="{{ $cat->image_ref }}" alt="Category image">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3 class="text-uppercase"><a href="{{ route('categories_par', $cat->id) }}" data-leaf="@if($type == 1) 1 @else 0 @endif" class="category_link" data-logic-row="{{$cat->parent->id}}" data-parent="{{ $cat->id }}" data-parent-name="{{ $cat->name }}"><small>{{ $cat->getParentName() }}</small> > <b>{{ $cat->name }}</b></a></h3>
                            <p>
                                ( <b>{{ $cat->getNumProducts() }}</b> Product Types )
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

        @endforeach
        </div>
    </section>

</div>
@endsection('content')

