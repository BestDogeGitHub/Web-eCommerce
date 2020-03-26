$(document).ready(function() {

    var table = $("#shipmentsTable").DataTable();
    var shipment_id;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });


    //Timepicker
    $('#editDeliveryDate').datetimepicker({
        format: 'YYYY/MM/DD'
      });

    
    /**
     * UPDATE
     */
    

    $(document).on('click', '._edit', function(){
        shipment_id = $(this).attr('data-id');
        
        $.ajax({
            url: '/auth/shipments/' + shipment_id + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editCarrier option').each(function(){
                    $(this).removeAttr('selected');
                });
                $('#editStatus option').each(function(){
                    $(this).removeAttr('selected');
                });
                $('#editTracking').val(html.shipment.tracking_number);
                $("#editStatus option[value=" + html.delivery_status.id +"]").attr("selected", "selected");
                $("#editCarrier option[value=" + html.carrier.id +"]").attr("selected", "selected");
                $('#editDeliveryDate').datetimepicker('date', html.shipment.delivery_date);
                $('#editAddress').val(html.shipment.address_id);
            }
        });

        $('#editShipmentModal').modal('show');

    });

    
    $('#editShipmentForm').on('submit', function(event) {
        event.preventDefault();
        

        $.ajax({
            url: "/auth/shipments/" + shipment_id,
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                console.log('im in');
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                    $('#forEditErrors').html(html); 
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done! Refreshing...</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forEditErrors').html(html);
                    location.reload();
                    $('#spinner').fadeIn();
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                if(xhr.status == 404) {
                      /*html = '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Error</h4><p>';
                      html += 'Product not found';
                      html += '</p></div>';
                      $('#imgContainer').html(html); */
                  Toast.fire({
                    type: 'error',
                    title: '404 Error...'
                  });
                }else if(xhr.status == 500) {
                  Toast.fire({
                    type: 'error',
                    title: 'Oops... something went wrong (500). Server error: contact your wesite administrator'
                  });
                }
            }
        });

    });

});