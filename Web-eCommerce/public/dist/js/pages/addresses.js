$(document).ready(function() {
    
    var table = $("#addressesTable").DataTable();
    var address_id = 0;

    
    /**
     * CREATE
     */
    $('#addAddressForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/addresses",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data){
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                    $('#forErrors').html(html); 
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done! Refreshing...</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forErrors').html(html); 
                    location.reload();
                    $('#spinner').fadeIn();
                }
            }
        });
    
    });


    
    /**
     * UPDATE
     */
    

    $(document).on('click', '._edit', function(){
        address_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/addresses/' + address_id + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editBuilding').val(html.data.building_number);
                $('#editStreet').val(html.data.street_number);
                $('#editPostcode').val(html.data.postcode);
                $('#editCountrycode').val(html.data.country_code);
                $("#editTown option[value=" + html.town_info.id +"]").prop("selected", true);
            }
        });

        $('#editAddressModal').modal('show');

    });

    $('#editAddressForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/addresses/" + address_id,
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
            }
        });

    });

    /**
     * DELETE
     */

    $(document).on('click', '._delete', function(){
        address_id = $(this).attr('id');
        $('#deleteAddressModal').modal('show');
    });

    $('#deleteAddressForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/addresses/" + address_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                location.reload();
            }
        });

    });


});