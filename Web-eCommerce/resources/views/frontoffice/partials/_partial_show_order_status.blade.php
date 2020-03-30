@if($order->shipment->delivery_status_id == 5)
<div class="progress progress-sm active">
    <div class="progress-bar bg-success progress-bar-striped delivered" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">100% Complete</span>
    </div>
</div>
@elseif($order->shipment->delivery_status_id == 1)
<div class="progress progress-sm active">
    <div class="progress-bar bg-warning progress-bar-striped pending" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">100% Complete</span>
    </div>
</div>
@elseif($order->shipment->delivery_status_id == 4)
<div class="progress progress-sm active">
    <div class="progress-bar bg-danger progress-bar-striped delivered" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">Error</span>
    </div>
</div>
@elseif($order->shipment->delivery_status_id == 3)
<div class="progress progress-sm active">
    <div class="progress-bar bg-success progress-bar-striped pick_up" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">20% Complete</span>
    </div>
</div>
@elseif($order->shipment->delivery_status_id == 2)
<div class="progress progress-sm active">
    <div class="progress-bar bg-success progress-bar-striped transit" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">50% Complete</span>
    </div>
</div>
@else
<div class="progress progress-sm active">
    <div class="progress-bar bg-warning progress-bar-striped other_ds" role="progressbar"
        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
        <span class="sr-only">Error</span>
    </div>
</div>
@endif

{{$order->shipment->deliveryStatus->status}}