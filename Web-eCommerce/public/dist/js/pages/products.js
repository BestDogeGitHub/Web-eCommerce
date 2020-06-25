// SCRIPT FOR PRODUCTS
$(document).ready(function() {
    var table = $("#productsTable").DataTable();


    /**
     * CREATE
     */
    $('#addProductForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/products",
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
                    $('#spinner').fadeIn();
                    location.reload();
                }
            }
        });
    
    });


    /**
     * DELETE
     */
    var product_id;

    $(document).on('click', '._delete', function(){
        product_id = $(this).attr('id');
        $('#deleteProductModal').modal('show');
    });

    $('#deleteProductForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/products/" + product_id,
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

    $(document).on('click', '._edit', function(){
        tinymce.remove("textarea[name='info']");
        product_id_ed = $(this).attr('id');
        var button = $(this);
        $('#form_result').html('');
        $.ajax({
            url: '/auth/products/' + product_id_ed + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                console.log(html, 'data')
                $('#editName').val(html.data.variant_name);
                $('#editPayment').val(html.data.payment);
                $('#editSale').val(html.data.sale);
                $('#editStock').val(html.data.stock);
                $('#editInfo').val(html.data.info);
                setTinyEditor("textarea[name='info']");
                $('#hidden_id').val(html.data.id);
                $('#editAvailable').val(html.data.available);
            }
        });
        

        $('#editProductModal').modal('show');


    });

    $('#editProductForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/products/" + product_id_ed,
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
                    $('#forErrorsEdit').html(html); 
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done!</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forErrorsEdit').html(html); 
                    $('#spinner').fadeIn();
                    location.reload();
                }
            }
        });

    });
});


