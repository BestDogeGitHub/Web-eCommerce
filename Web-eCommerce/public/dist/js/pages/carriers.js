$(document).ready(function() {
    
    var table = $("#carriersTable").DataTable();
    var carrier_id = 0;

    
    /**
     * CREATE
     */
    $('#addCarrierForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/carriers",
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
        carrier_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/carriers/' + carrier_id + '/edit',
            dataType: 'json',
            success: function(html){
                $('#editName').val(html.data.name);
                $('#actualImage').attr('src', html.data.image_ref);
                $('#editLink').val(html.data.link);
                $('#editDetails').val(html.data.details);
            }
        });

        $('#editCarrierModal').modal('show');

    });

    $('#editCarrierForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/carriers/" + carrier_id,
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
        carrier_id = $(this).attr('id');
        $('#deleteCarrierModal').modal('show');
    });

    $('#deleteCarrierForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/carriers/" + carrier_id,
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