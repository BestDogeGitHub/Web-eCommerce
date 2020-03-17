// SCRIPT FOR PRODUCT TYPES
$(document).ready(function() {
    var table = $("#producersTable").DataTable({
    });

    $('.custom-file input').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    /**
     * CREATE
     */
    $('#addProducerForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/producers",
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
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done!</h4><p>';
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
     * DELETE
     */
    var product_id;

    $(document).on('click', '.delete', function(){
        product_id = $(this).attr('id');
        $('#deleteProducerModal').modal('show');
    });

    $('#deleteProducerForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/producers/" + product_id,
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
    
    var producer_id;

    $(document).on('click', '.edit', function(){
        
        producer_id = $(this).attr('id');
        var button = $(this);
        $('#forEditErrors').html(' '); 
        $.ajax({
            url: '/auth/producers/' + producer_id + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editName').val(html.data.name);
                $('#actualImage').attr('src', html.data.image_ref);
                $('#editLink').val(html.data.link);
                $('#editDetails').val(html.data.details);
            }
        });
        

        $('#editProducerModal').modal('show');


    });

    $('#editProducerForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/producers/" + producer_id,
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
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done!</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forEditErrors').html(html); 
                    location.reload();
                    $('#spinner').fadeIn();
                }
            },
            error: function(xhr){
                //$('#forEditErrors').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                //console.log('error');
            }
        });

    });
});


