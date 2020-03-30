<!-- Post -->
<div class="post @if($more) more hide @endif">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('/images/static/user-circle.png') }}" alt="user image">
        <span class="username">
        <a href="{{ route('get_public_profile', $review->user->id) }}">{{ $review->user->name }} {{ $review->user->surname }}</a> > <a href="{{ route('product_detail', $review->product->id) }}"><small>{{ $review->product->productType->name }} - {{ $review->product->variant_name }}</small></a>
        </span>
        <span class="description">{{ date("H:i",strtotime($review->created_at)) }} {{ date("d:m:Y",strtotime($review->created_at)) }}</span>
    </div>
    <!-- /.user-block -->
    <p>
        {{ $review->text }}
    </p>

    <p>
        Valutation<br/>             
        @for($i = 1; $i <= 5; $i++)
            @if($i <= $review->stars) 
            <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
            @else
            <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
            @endif
        @endfor
    </p>
</div>