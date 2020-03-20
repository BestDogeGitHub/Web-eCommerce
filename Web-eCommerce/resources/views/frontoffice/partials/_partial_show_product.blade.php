<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product">
    @php
        if(count($prod->productImages))
        $image = $prod->productImages->first()->image_ref;
        else $image = "/images/products/no-image.png";
    @endphp
    <a href="{{ route('products.show', $prod->id) }}" class="img-prod"><img class="img-fluid" src='{{ asset("$image") }}' alt="Product Image">
    
        @if($prod->sale != 0)
        <span class="status">{{$prod->sale}}%</span>
        @endif
        <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
        <h3><a href="#">{{$prod->productType->name}}</a></h3>
        <div class="d-flex">
            <div class="pricing">
        @if($prod->sale != 0)
        <p class="price"><span class="mr-2 price-dc">&euro; {{number_format((float)$prod->payment / (1 - $prod->sale / 100), 2, '.', '') }}</span><span class="price-sale">&euro; {{$prod->payment}}</span></p>
        @else
        <p class="price"><span>&euro; {{$prod->payment}}</span></p>
        @endif
            </div>
        </div>
        <div class="bottom-area d-flex px-3">
            <div class="m-auto d-flex">
            <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                <span><i class="ion-ios-menu"></i></span>
            </a>
            <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" data-id="{{$prod->id}}">
                <span><i class="ion-ios-cart"></i></span>
            </a>
            <a href="#" class="heart d-flex justify-content-center align-items-center" data-id="{{$prod->id}}">
                <span><i class="ion-ios-heart"></i></span>
            </a>
            </div>
        </div>
        </div>
    </div>
</div>
