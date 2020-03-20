$(document).ready(function(){

    var product_id;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });



    /**
     * GESTIONE CARRELLO
     */

    $('.buy-now').click( function(event){
        event.preventDefault();

        product_id = $(this).attr('data-id');
        

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







    /**
     * GESTIONE PREFERITI
     */

    $('.heart').click( function(event){
        event.preventDefault();

        product_id = $(this).attr('data-id');
        

        var data = new FormData();
        data.append("id", product_id);

        $.ajax({
            url: "/shop/wishlist/",
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
                    title: 'Cart Error: Resource not found (404).'
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

    
    $('.removeFromWishlist').click( function(event){
        event.preventDefault();

        product_id = $(this).attr('data-id');

        $.ajax({
            url: "/shop/wishlist/" + product_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.success)
                {
                    console.log(data.success);
                    $('#wish_prod_' + product_id).fadeOut();
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
                    title: 'Wishlist Error: Resource not found (404).'
                  });
                }else if(xhr.status == 500) {
                  Toast.fire({
                    type: 'error',
                    title: 'Oops... something went wrong (500). Server error: Wishlist'
                  });
                }
            }
        });

        return false;

    });

    
    /**
     * Billing
     */

    

    $('#billing_nation').change( function() {
        $("#billing_town").children('option').hide();
        $("#billing_town").val(' ');
        //console.log($(this).val());
        $("#billing_town").children("option[data-nation-id^=" + $(this).val() + "]").show();
    });



});