@extends('frontoffice.layouts.layout')

@section('content')



<div class="d-none" id="hidden_link_image" data-link="{{ asset(\App\SiteImage::where('site_image_role_id', 7)->first()->image_ref) }}"></div>

<div class="hero-wrap hero-bread" id="header_div">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('/') }}">Home</a></span> <span>Orders</span></p>
                <h1 class="mb-0 bread">My Orders</h1>
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
                                    <th>PON</th>
                                    <th>Details</th>
                                    <th>Price (&euro;)</th>
                                    <th>Carrier</th>
                                    <th>Status</th>
                                    <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td class="data">
                                            <h3>{{ $order->PO_Number }}</h3>
                                        </td>

                                        <td class="data">
                                            <h35>Details</h3>
                                            <ul> 
                                            @foreach($order->orderDetails as $detail)
                                                <li class="text-left">{{ $detail->product->productType->name }} : {{ $detail->product->variant_name }}</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        
                                        <td class="price data">
                                            <p class="price"><span>{{$order->invoice->payment}}</span></p>
                                        </td>

                                        <td class="data">
                                            <a href="@if($order->shipment->carrier) {{ route('carrier_detail', $order->shipment->carrier->id) }} @else # @endif" ><span>{{$order->shipment->carrier->name ?? 'Unavailable'}}</span></a>
                                        </td>
                                        
                                        <td class="quantity data">
                                            @include('frontoffice.partials._partial_show_order_status', $order)
                                        </td>

                                        <td class="data">
                                            <p class="price"><a href="{{ route('show_invoice', $order->id) }}" target="_blank">Print invoice</a></p>
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
