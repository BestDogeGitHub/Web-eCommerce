<div class="col-lg-3 col-md-4 col-sm-6 ftco-animate">
    <div class="product">
        <a href="{{ route('products', $prod->id) }}" class="img-prod"><img class="img-fluid" src="{{ asset($prod->image_ref) }}" alt="Product type image">
            <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="asset('products/' . $prod->id)">{{ $prod->name }}</a></h3>
        </div>
    </div>
</div>