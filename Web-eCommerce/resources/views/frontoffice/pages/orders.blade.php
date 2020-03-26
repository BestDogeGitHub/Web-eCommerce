@extends('frontoffice.layouts.layout')

@section('content')



        <div class="hero-wrap hero-bread back3">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
            </div>
            </div>
        </div>
        </div>


        <div class="container" style="padding-top: 5%; padding-bottom: 5%;">
            <section class="ftco-section ftco-cart">
                <div class="container">

                    <div class="row">
                    @if($orders->count())
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                    <th>Purchase Order Number</th>
                                    <th>Details</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="text-center">
                                        
                                        <td class="data">
                                            <h3>{{ $order->PO_Number }}</h3>
                                        </td>

                                        <td class="data">
                                            <h3>Details</h3>
                                            <ul> 
                                            @foreach($order->orderDetails as $detail)
                                                <li>{{ $detail->product->productType->name }} : {{ $detail->product->variant_name }}</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        
                                        <td class="price data">
                                            <p class="price"><span>&euro; {{$order->invoice->payment}}</span></p>
                                        </td>
                                        
                                        <td class="quantity data">
                                            <div class="d-inline product-details ftco-animate">
                                                <h3>Status</h3>
                                                <p class="black">{{$order->shipment->deliveryStatus->status}}</p>
                                            </div>
                                        </td>
                                        
                                    </tr><!-- END TR-->
                                    @endforeach





                                </tbody>
                                </table>
                            </div>
                    </div>
                    @else
                    <h3>No Orders</h3>
                    @endif


                </div>
            </section>
        </div>
        
@endsection
