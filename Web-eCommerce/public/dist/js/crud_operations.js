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
        beforeSend:function(){
            $('#spinner').fadeIn();
        },
        success: function(data){
            $('#spinner').fadeOut();
            location.reload();
        }
    });

});