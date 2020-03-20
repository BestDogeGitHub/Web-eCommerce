$(document).ready(function(){

    var product_id;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    $('.buy-now').click( function(event){
        event.preventDefault();

        product_id = $(this).attr('data-id');
        console.log(product_id);
        

        var data = new FormData();
        data.append("id", product_id);

        $.ajax({
            url: "/shop/cart/",
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.success)
                {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                      });
                    //alert(data.success);
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                if(xhr.status == 404) {
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

        return false;

    });

    $('.removeFromCart').click( function(event){
        event.preventDefault();

        product_id = $(this).attr('data-id');
        console.log(product_id);

        $.ajax({
            url: "/shop/cart/" + product_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.success)
                {
                    console.log(data.success);
                    $('#prod_' + product_id).fadeOut();
                    $('#nav_cart_link').text(parseInt($('#nav_cart_link').text()) - 1);
                }
            }
        });

        return false;

    });

});