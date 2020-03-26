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
                    $('#nav_cart_link').text(parseInt($('#nav_cart_link').text()) + 1);
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
                }else if(xhr.status == 409) {
                    Toast.fire({
                      type: 'warning',
                      title: 'Conflict alert (409). Product is already in cart'
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
                    $('#nav_wish_link').text(parseInt($('#nav_wish_link').text()) + 1);
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
                }else if(xhr.status == 409) {
                    Toast.fire({
                      type: 'warning',
                      title: 'Conflict alert (409). Product is already in wishlist'
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
                    $('#nav_wish_link').text(parseInt($('#nav_wish_link').text()) - 1);
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



    /**
     * Quantity cart controller
     */
    $('.cart_quant_plus').click(function(e){
        // Stop acting like a button
        e.preventDefault();

        var id_prod = $(this).attr('data-id');
        

        // Get the field name
        var quantity = parseInt($('#cart_quant_val_' + id_prod).text());
        
        

        // If is not undefined
            
        var new_quantity = quantity + 1;

        $('#cart_quant_val_' + id_prod).text(new_quantity);


        product_id = $(this).attr('data-id');
        

        var data = new FormData();
        data.append("quantity", new_quantity);
        
        $.ajax({
            url: "/shop/cart/" + product_id + "/quantity",
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
                }else if(xhr.status == 409) {
                    Toast.fire({
                      type: 'warning',
                      title: 'Conflict alert (409).'
                    });
                }else if(xhr.status == 500) {
                  Toast.fire({
                    type: 'error',
                    title: 'Oops... something went wrong (500). Server error: contact your wesite administrator'
                  });
                }
            }
        });

        // Increment
    
    });

    $('.cart_quant_minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();

        var id_prod = $(this).attr('data-id');

        // Get the field name
        var quantity = parseInt($('#cart_quant_val_' + id_prod).text());
        
        // If is not undefined
        
        // Increment
        if(quantity>1){

            var new_quantity = quantity - 1;
            $('#cart_quant_val_' + id_prod).text(quantity - 1);

            var data = new FormData();
            data.append("quantity", new_quantity);
            
            $.ajax({
                url: "/shop/cart/" + product_id + "/quantity",
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
                    }else if(xhr.status == 409) {
                        Toast.fire({
                        type: 'warning',
                        title: 'Conflict alert (409).'
                        });
                    }else if(xhr.status == 500) {
                    Toast.fire({
                        type: 'error',
                        title: 'Oops... something went wrong (500). Server error: contact your wesite administrator'
                    });
                    }
                }
            });

        } // END IF
        else {
            Toast.fire({
                type: 'error',
                title: 'It is not possible to decrease the quantity'
            });
        }


    });

    /**
     * Checkout scripts
     */

    // DISABLE CARD INPUTS
    $('input[name=associated]').click( function() {

      var val = false;
      if(parseInt($(this).val())) val = true;
      
      $('#short_comp_1').prop('disabled', val);
      $('#short_comp_2').prop('disabled', val);
      $('#short_comp_3').prop('disabled', val);
      $('#short_comp_4').prop('disabled', val);
      $('#short_comp_5').prop('disabled', val);
      
      $('#company').prop('disabled', val);
      $('#card_number').prop('disabled', val);
      $('#editMonth').prop('disabled', val);
      $('#editYear').prop('disabled', val);

      if($('#card_id').length) {
        $('#card_id').prop('disabled', !val);
      }
      
    });

    $('#company').change(function(){
      $('input[name=short_comp][value=5]').click();
    });

    if($('#card_id').length) {
      $('input[name=associated][value=1]').click();
    }
    else {
      $('input[name=associated][value=0]').click();
    }

    // Coupon Check
    $('#check_coupon').click( function(event) {
      event.preventDefault();

      var code = $('#coupon_code').val();

      var form_data = new FormData();
      form_data.append("code", code);

      $.ajax({
          url: "/shop/coupons/check",
          method: "POST",
          data: form_data,
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
                $('#forErrors').html(html); 
            }
            if(data.coupon)
            {
                html = '<div class="alert alert-coupon" role="alert">';
                html += '<p>The coupon will be applied to the order.<br/><strong>' + data.coupon.sale + ' % discount on all products<strong></p>';
                html += '</div>';
                $('#forErrors').html(html); 
            }
          },
          error:function (xhr, ajaxOptions, thrownError){
              if(xhr.status == 404) {
                Toast.fire({
                  type: 'error',
                  title: 'Coupon not found'
                });
              }else if(xhr.status == 409) {
                  Toast.fire({
                    type: 'warning',
                    title: 'Conflict alert (409).'
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

    $('#show_all_rec').click( function(event) {
      event.preventDefault();

      status = parseInt($(this).attr('data-status'));
      
      if(status == 1) {
        $('.more').fadeOut();
        $(this).attr('data-status', "0");
        $(this).text('Show All');
      } else {
        $('.more').fadeIn();
        $(this).attr('data-status', "1");
        $(this).text('Show Less');
      }

      
      
    });

});