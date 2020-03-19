$(document).ready(function() {

    
    /**
     * GET VALUES
     */
    

    $('#getValuesForm').on('submit', function(){
        $('#spinner').fadeIn();
        event.preventDefault();
        
        var attribute_id = $('#attribute').val();
        $('#values').html(' ');
        
        $.ajax({
            url: '/auth/attributes/' + attribute_id + '/values',
            dataType: 'json',
            success: function(html){
                $("#values").removeClass('disabled');
                $.each(html.data, function(index, item) {
                    
                    var option = '<option class="text-uppercase" value="' + item.id + '">' + item.name + '</option>';
                    
                    $("#values").html($("#values").html() + option);
                });
                $('#spinner').fadeOut();
            }
        });

    });


    /**
     * ADD PROPERTY
     */
    $('#addPropertyForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: window.location.pathname, // STESSO PATH DI PARTENZA MA IN POST
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
                    $('#spinner').fadeIn();
                    location.reload();
                }
            }
        });
    
    });

     /**
     * DELETE
     */

    var value_id;

    $(document).on('click', '._delete', function(){
        value_id = $(this).attr('data-id');
        $('#deletePropertyModal').modal('show');
    });

    $('#deletePropertyForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: window.location.pathname + '/' + value_id,
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