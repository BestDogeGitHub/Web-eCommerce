@extends('frontoffice.layouts.layout')

@section('content')

<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 3)->first()->image_ref) }}"></div>

	<div class="hero-wrap hero-bread loading" id="header_div" >
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ asset('/') }}">Home</a></span> <span><a href="{{ route('categories_par', $category->id) }}">{{ $category->name }}</a></span></p>
            <h1 class="mb-0 bread">{{ $type }} Products</h1>
          </div>
        </div>
      </div>
    </div>

    <div id="header_div2" class="loading">
      
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">



              <div class="row">
              @forelse ($products as $prod)
                @include('frontoffice.partials._partial_show_product', ['product' => $prod])
              @empty
                <p>There are no products at this moment...</p>
              @endforelse
    			
            </div>

          	
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
                        <li><span>{{ $i }}</span></li>
                        @endfor
                        <li class="active"><span>{{ $products->currentPage() }}</span></li>
                        @for ($i = $products->currentPage() + 1; $i <= $products->lastPage(); $i++)
                        <li><span>{{ $i }}</span></li>
                        @endfor

                        @if($products->currentPage() != $products->lastPage())
                        <li><a class="pag" href="{{ $products->nextPageUrl() }}">&gt;</a></li>
                        @endif

                    </ul>
                  </div>
            </div>

    		</div>
			</div>
        </section>
    @endsection('content')