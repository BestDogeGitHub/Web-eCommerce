// SCRIPT FOR PRODUCTS
$(document).ready(function() {
    var table = $("#productsTable").DataTable();
});

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
                alert(data.success);
                location.reload();
            }
        }
    });

});

var product_id;

$(document).on('click', '.delete', function(){
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


var product_id_ed;

$(document).on('click', '.edit', function(){
    product_id_ed = $(this).attr('id');
    var button = $(this);
    $('#form_result').html('');
    $.ajax({
        url: '/auth/products/' + product_id_ed + '/edit',
        dataType: 'json',
        success: function(html){
            //button.parent().parent().find('td:eq(6)').html());
            $('#editPayment').val(html.data.payment);
            $('#editSale').val(html.data.sale);
            $('#editStock').val(html.data.stock);
            $('#editInfo').val(html.data.info);
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
                alert(data.success);
                location.reload();
            }
        }
    });

});