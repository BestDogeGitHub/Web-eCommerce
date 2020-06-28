$(document).ready(function() {
    
    var table = $("#methodsTable").DataTable();
    var method_id = 0;

    
    /**
     * CREATE
     */
    $('#addMethodForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/paymentMethods",
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
        method_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/paymentMethods/' + method_id + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editMethod').val(html.data.method);
            }
        });

        $('#editMethodModal').modal('show');

    });

    $('#editMethodForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/paymentMethods/" + method_id,
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
                console.log(data);
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
            error: function(xhr) {
                console.log(xhr);
            }
        });

    });

    /**
     * DELETE
     */

    $(document).on('click', '._delete', function(){
        method_id = $(this).attr('id');
        $('#deleteMethodModal').modal('show');
    });

    $('#deleteMethodForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/paymentMethods/" + method_id,
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