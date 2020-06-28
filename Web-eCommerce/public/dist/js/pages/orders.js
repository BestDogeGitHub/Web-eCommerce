$(document).ready(function() {
    
    var table = $("#ordersTable").DataTable();
    var order_id = 0;

    /**
     * DELETE
     */

    $(document).on('click', '._delete', function(){
        product_id = $(this).attr('id');
        $('#deleteOrderModal').modal('show');
    });

    $('#deleteOrderForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/orders/" + product_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                location.reload();
            }
        });

    });

    /**
     * UPDATE
     */
    

    $(document).on('click', '._show', function(){
        $('#spinner').fadeIn();
        $('#order_products').html(' ');
        order_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/orders/' + order_id + '/edit',
            dataType: 'json',
            success: function(obj){
                $('#editUser').val(obj.order.user_id);
                $('#editPO').val(obj.order.PO_Number);

                obj.orderDetails.forEach( function(element) {
                    $.ajax({
                        url: '/auth/orderDetails/' + element.id + '/edit',
                        dataType: 'json',
                        success: function(add){
                            var _product = $('#product_info_template').clone();
                            _product.find("small").html('Product ID: ' + add.product.id);
                            _product.attr('href', '/products/' + add.product_type.id);
                            _product.find("div h5").html('Product: <b>' + add.product_type.name + '</b>');
                            _product.find("img").attr('src', add.product_type.image_ref);
                            if(add.product.info != null) _product.find("p").html('Product Info: ' + add.product.info);
                            else _product.find("p").html('Nessuna informazione sul prodotto');
                            _product.find("div small").html('Quantity: ' + add.orderDetail.quantity);
                            //console.log(html_product.html());
                            $('#order_products').append(_product);
                        }
                    });
                });

                // SHIPMENT
                $.ajax({
                    url: '/auth/shipments/' + obj.shipment.id + '/edit',
                    dataType: 'json',
                    success: function(add){
                        if(add.carrier != null) {
                            $('#carrierLogo').attr('src', add.carrier.image_ref);
                            $('#carrierName').text('Carrier: ' + add.carrier.name);
                        }
                        else {
                            $('#carrierLogo').prop('src', false);
                            $('#carrierName').text('No Carrier defined');
                        }
                        $('#trackNumber').text('TR No. ' + add.shipment.tracking_number);
                        $('#deliveryDate').html('Delivery Date <b>' + add.shipment.delivery_date + '</b>');
                        $.ajax({
                            url: '/auth/addresses/' + add.shipment.address_id + '/edit',
                            dataType: 'json',
                            success: function(addr){
                                var toSet = '<i class="fa fa-map-pin card-icon"></i> ' + addr.data.country_code + ' - ';
                                toSet += 'Town: <b>' + addr.town_info.name + '</b> <i>(' + addr.data.postcode + ')</i>, Nation: <b>' + addr.nation_info.name + '</b>.<br/>';
                                toSet += 'Street <b>' + addr.data.street_number + '</b>, Building <b>' + addr.data.building_number + '</b>.';
                                $('#address').html(toSet);
        
                            }
                        });
                        $('#status').html('Status: <span class="badge badge-light">' + add.delivery_status.status + '</span>');
                        $('#price').html('<span class="badge badge-danger">Total &euro; ' + obj.invoice.payment + '</span>');
                        $('#spinner').fadeOut();
                    }
                });
                
            }
        });
        $('#editOrderModal').modal('show');
    } );


});

    



