<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product">
    @php
        if(count($prod->productImages))
        $image = $prod->productImages->first()->image_ref;
        else $image = "/images/products/no-image.png";
    @endphp
    <a href="{{ route('product_detail', $prod->id) }}" class="img-prod"><img class="img-fluid" src='{{ asset("$image") }}' alt="Product Image">
    
        @if($prod->sale != 0)
        <span class="status">{{$prod->sale}}%</span>
        @endif
        <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
        <h3><a href="#">{{$prod->productType->name}} - {{$prod->variant_name}}</a></h3>
        <div class="d-flex">
            <div class="pricing">
                @if($prod->sale != 0)
                <p class="price"><span class="mr-2 price-dc">&euro; {{ $product->getPrintablePrice() }}</span><span class="price-sale">&euro; {{ $product->getRealPrice() }}</span></p>
                @else
                <p class="price"><span>&euro; {{ $product->getPrintablePrice() }}</span></p>
                @endif
                <p >
                @for($i = 1; $i <= 5; $i++)
                    @if($prod->n_reviews && $i <= intval($prod->star_tot_number / $prod->n_reviews)) 
                    <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                    @else
                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                    @endif
                @endfor
                </p>
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
