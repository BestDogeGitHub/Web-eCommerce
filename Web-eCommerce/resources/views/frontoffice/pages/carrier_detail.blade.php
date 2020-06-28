@extends('frontoffice.layouts.layout')

@section('content')


    <section class="ftco-section">
    	<div class="container">
            <div class="card mb-3 carrier_img_container">
            <div class="card-header">Carrier Details</div>
                <img class="card-img-top max_auto d-block carrier_img" src="{{ asset($carrier->image_ref) }}" alt="Carrier logo">
                <div class="card-body">
                    <h5 class="card-title">{{ $carrier->name }}</h5>
                    <p class="card-text">{!! $carrier->details !!}</p>
                    <a class="card-text" href="http://{{ $carrier->link }}" target="_blank"><u><small class="text-muted">Link to website</small></u></p>
                </div>
            </div>
    	</div>
    </section>

	

@endsection