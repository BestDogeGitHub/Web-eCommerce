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
                if(xhr.status == 400) {
                  Toast.fire({
                    type: 'error',
                    title: '(400) Bad Request. Check that cookies are allowed'
                  });
                }else if(xhr.status == 404) {
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
              if(xhr.status == 400) {
                Toast.fire({
                  type: 'error',
                  title: '(400) Bad Request. Check that cookies are allowed'
                });
              }else if(xhr.status == 404) {
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
              if(xhr.status == 400) {
                Toast.fire({
                  type: 'error',
                  title: '(400) Bad Request. Check that cookies are allowed'
                });
              }else if(xhr.status == 404) {
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
              if(xhr.status == 400) {
                Toast.fire({
                  type: 'error',
                  title: '(400) Bad Request. Check that cookies are allowed'
                });
              }else if(xhr.status == 404) {
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
              if(xhr.status == 400) {
                Toast.fire({
                  type: 'error',
                  title: '(400) Bad Request. Check that cookies are allowed'
                });
              }else if(xhr.status == 404) {
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
                  if(xhr.status == 400) {
                    Toast.fire({
                      type: 'error',
                      title: '(400) Bad Request. Check that cookies are allowed'
                    });
                  }else if(xhr.status == 404) {
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


    // If Auth User has credit card associated, select cart in checkout is enabled
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
                  Toast.fire({
                    type: 'error',
                    title: 'Oops... there are some errors'
                });
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

    $('#editProfile').click( function(event){
      event.preventDefault();

      $('#settingsProfile').click();
    });

    $('#check_address').click( function(event) {
      var value = $(this).is(":checked");

      if(value) {
        $('.addr_input').prop('disabled', false);
      }
      else {
        $('.addr_input').prop('disabled', true);
      }

    }); 

    if($('#success_changed').length) {
      Toast.fire({
        type: 'success',
        title: 'Changes are successfully saved'
      });
    }


    $('.add_star').click( function(event) {
      event.preventDefault();

      var val = $(this).attr('data-value'); 
      
      $(this).prevAll().html('<i class="fa fa-star" aria-hidden="true"></i>');
      $(this).html('<i class="fa fa-star" aria-hidden="true"></i>');
      $(this).nextAll().html('<i class="fa fa-star-o" aria-hidden="true"></i>');

      $('#stars_value').val(val);
    
    });


    
    /**
     * Resource Substitution
     * 
     * Homepage
     */
    $('.home_slider h1').addClass('mb-2');
    $('.home_slider h2').addClass('subheading mb-4');
    $('.home_slider a').addClass('btn btn-primary');

    


    /**
     * Image Header Setting
     */
    var image_link = $('#hidden_link_image').attr('data-link');
    $( '#header_div' ).css( "background-image", 'url(' + image_link +')' ).on('load', function() {
      $( '#header_div' ).addClass('loading');
   });
    $( '#header_div' ).removeClass('loading');

    /**
     * Image Deal Of The Day
     */
    var image_link_dd = $('#hidden_link_image_dotd').attr('data-link');
    $( '#deal_of_the_day' ).css( "background-image", 'url(' + image_link_dd +')' );
    $( '#deal_of_the_day' ).removeClass('loading');



    /**
     * CATEGORIES DYNAMICS LOGIC
     */
    $('body').on('click', 'a.category_link', function(event) {
      if(!parseInt($(this).attr('data-leaf'))) 
      { 
          event.preventDefault();

          $('#ftco-loader').addClass('show');

          var parent = parseInt($(this).attr('data-parent'));
          var parent_name = $(this).attr('data-parent-name');
          var logic_row = $(this).closest('.categories_row').eq(0);

          logic_row.nextAll('.categories_row').fadeOut(1000);
          logic_row.nextAll('.categories_row').remove();

          $.ajax({
            url: "/shop/categories/" + parent,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
              console.log(data);

              if(data.categories)
              {

                var new_row = '<div class="row categories_row">';

                $.each(data.categories, function(key, item) {

                  var content = $('#category_template').clone();
                  content.find('div div a img').attr('src', item.image_ref);
                  content.find('.parent_cat').html(parent_name);
                  content.find('.target_cat').html(item.name);
                  if(item.leaf) {
                    content.find('.category_link').attr('href', '/shop/categories/' + item.id);
                  }
                  content.find('.category_link').attr('data-leaf', item.leaf);
                  content.find('.category_link').attr('data-logic-row', parent);
                  content.find('.category_link').attr('data-parent', item.id);
                  content.find('.category_link').attr('data-parent-name', item.name);
                  content.find('.num_prod_cat').html(item.num_products);
                  new_row += content.html();
                  
                });

                new_row += '</div>';
                //console.log(new_row);
                $('.categories_row:last').after(new_row);

                $('#ftco-loader').removeClass('show');

              }

            },
            error:function (xhr, ajaxOptions, thrownError){
                $('#ftco-loader').removeClass('show');
                if(xhr.status == 404) {
                  Toast.fire({
                    type: 'error',
                    title: 'Category not found'
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
                }else{
                  Toast.fire({
                    type: 'error',
                    title: 'Generic error. (' + xhr.status + ')'
                  });
                }
            }
        });
      }


    });



    /**
     * Search in Cart and Wishlist
     */
    $('.table_search').keyup( function () {
      var td, txtValue;
      var id_table = $(this).attr('data-table-id');
      var num_fields = $(this).attr('data-table-fields');
      var table = $('#' + id_table);
      var input = $(this).val().toUpperCase();
      //console.log('Searching ' + input + ', in table ' + id_table + ', ' + table.html() + 'fields ' + num_fields.toString());
      table.find('tbody tr').each( function(index) {
        
        tr_v = $(this);

        $.each(JSON.parse(num_fields), function(key, val) {
          td = tr_v.children("td:eq(" + val + ")");
          if (td) {
            txtValue = td.text();
            if (txtValue.toUpperCase().indexOf(input) > -1) {
              tr_v.removeClass('d-none');
            } else {
              tr_v.addClass('d-none');
            }
          }     
        });

      });


    });



});