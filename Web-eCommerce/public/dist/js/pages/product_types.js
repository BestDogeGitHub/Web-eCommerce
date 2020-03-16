// SCRIPT FOR PRODUCT TYPES
$(document).ready(function() {
    var table = $("#productsTable").DataTable({
        "order": [[ 0, "desc" ]]
    });

    $('#addImage').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
    /**
     * CREATE
     */
    $('#addProductTypeForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/productTypes",
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
                    setTimeout(location.reload(), 2000);
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
        $('#deleteProductTypeModal').modal('show');
    });

    $('#deleteProductTypeForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/productTypes/" + product_id,
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
    
    var product_id_ed;

    $(document).on('click', '.edit', function(){
        product_id_ed = $(this).attr('id');
        var button = $(this);
        $('#form_result').html('');
        $.ajax({
            url: '/auth/productTypes/' + product_id_ed + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editName').val(html.data.name);
                $('#actualImage').attr('src', html.data.image_ref);
                $('#editAvailable').val(html.data.available);
                $('#editStarRate').val(html.data.star_rate);
                $('#editNReviews').val(html.data.n_reviews);
                $('#hidden_id').val(html.data.id);
            }
        });
        

        $('#editProductTypeModal').modal('show');


    });

    $('#editProductTypeForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/productTypes/" + product_id_ed,
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
                }
            }
        });

    });
});


