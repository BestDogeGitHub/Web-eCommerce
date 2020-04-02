<!doctype html>
<html>
  <head>
    <title>Invoice of Order {{$invoice->order->id}} PDF</title>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/template/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('css/template/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/template/aos.css') }}">


    <link rel="stylesheet" href="{{ asset('css/template/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/template/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template/jquery.timepicker.css') }}">

        
    <link rel="stylesheet" href="{{ asset('css/template/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template/icomoon.css') }}">

    <link rel="stylesheet" href="{{ asset('css/template/style.css') }}">


    <link rel="stylesheet" href="{{ asset('css/custom/pdf.css') }}">
    <script src="{{ asset('js/invoice.js') }}"></script>
  </head>
  <body>
    <div class="container invoice-container">
        <div class="row">
            <div class="col">
            <h1><img src="{{ asset('/images/logo.png') }}" class="logo_invoice"/> Music Store</h1>
            <p>Address: <i>203 Fake St. Mountain View, San Francisco, California, USA</i></p>
            <p>Tel.: <i>+2 392 3929 210</i></p>
            <p>Email: <i>info@musicstore.com</i></p>
            </div>
            <div class="col my-auto invoice_int_dx">
            <h3>Purchase Order Number<br/><u>{{$invoice->order->PO_Number}}</u></h3>
            <p>Invoice # <b>{{$invoice->id}}</b></p>
            </div>
        </div>
        
        <hr/>
        <div class="row">
            <div class="col">
            <h4>Bill To</h4>
            <p>Name: <b>{{$invoice->order->user->name}} {{$invoice->order->user->surname}}</b><br/>
            Tel.: <b>{{$invoice->order->user->phone}}</b><br/>
            Email: <b>{{$invoice->order->user->email}}</b></p>
            </div>
            <div class="col">
            <h4>Ship In</h4>
            <p>Town: <b>{{$invoice->order->shipment->address->town->name}}</b> <i>(POSTCODE {{$invoice->order->shipment->address->postcode}})</i><br/>Nation: <b>{{$invoice->order->shipment->address->town->nation->name}}</b>.<br/>
            Street <b>{{$invoice->order->shipment->address->street_number}}</b>, Building <b>{{$invoice->order->shipment->address->building_number}}</b> ({{$invoice->order->shipment->address->country_code}}).</p>
            </div>
        </div>
        
        <hr/>
        <div class="table-container">
            <table class="table table-striped table-invoices">
            <thead>
            <tr>
                <th class="w-15">Product</th>
                <th class="w-25"><b>Name</b></th>
                <th class="w-15"><b>Unit Cost</b></th>
                <th class="w-15"><b>Q.ty</b></th> 
                <th class="w-15">Iva</th>
                <th class="w-15"><b>Line total</b></th> 
            </tr>
            </thead>
            <tbody>
                @foreach($invoice->order->orderDetails as $detail)
                <tr>
                    <td>
                    <p>Type: <b>{{$detail->product->productType->name}}</b><br/>
                    Prod #: <b>{{$detail->product->id}}</b><br/></p>
                    </td>
                    <td>
                    <p>{{$detail->product->variant_name}}<br/></p>
                    </td>
                    <td>
                    &euro; {{ number_format((float)$detail->product->payment, 2, '.', '')}}
                    </td>
                    <td>
                    {{$detail->quantity}}
                    </td>
                    <td>
                    {{$detail->product->ivaCategory->value}}%
                    </td>
                    <td><b>
                    &euro; {{ number_format((float)$detail->product->payment * $detail->quantity, 2, '.', '') }}
                    </b></td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <hr/>
        <div class="row">
            <div class="col">
            <h4>Invoice Total <i class="total">&euro; {{ number_format((float)$invoice->payment, 2, '.', '') }}</i></h4>
            </div>
            <div class="col">
        </div>
    </div>
    
  </body>
</html>