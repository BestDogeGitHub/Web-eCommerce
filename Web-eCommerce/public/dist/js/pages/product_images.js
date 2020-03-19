$(document).ready(function() {

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });

    
  $('.custom-file input').on('change',function(){
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
  });

  $('#getProductImagesForm').on('submit', function(event) {
      $('#spinner').fadeIn();
      event.preventDefault();
      $('#uploadImg').addClass('disabledFile');
      $('#imgContainer').html(' ');
      //$('#spinner').fadeIn();

      product_id = $('#imageID').val();

      $.ajax({
          url: '/auth/products/' + product_id + '/images',
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          dataType: 'json',
          success: function(html){
              var html_to_add = '';

              if(html.images.length == 0){
                html_to_add += '<p>No images found</p>';
              } 
              else {
                html.images.forEach( function(element) {
                  html_to_add += '<div class="filtr-item" data-category="1" data-sort="white sample">';
                  html_to_add += '<a href="#" class="btn btn-danger _delete" data-id="' + element.id + '">x</a><a href="' + element.image_ref + '" data-toggle="lightbox" data-title="' + element.image_ref + '">';
                  html_to_add += '<img src="' + element.image_ref + '" class="img-fluid mb-2 img-thumbnail prodImg" alt="' + element.image_ref + '"/>';
                  html_to_add += '</a></div>';
                  //html_to_add += '<img src="' + element.image_ref + '" class="img-thumbnail prodImg">'
                });
              }
              $('#imgContainer').append(html_to_add);
              $('#uploadImg').removeClass('disabledFile');
              $('#product_id').val(product_id);
              $('#spinner').fadeOut();
          },
          error:function (xhr, ajaxOptions, thrownError){
            if(xhr.status == 404) {
                  /*html = '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Error</h4><p>';
                  html += 'Product not found';
                  html += '</p></div>';
                  $('#imgContainer').html(html); */
              Toast.fire({
                type: 'error',
                title: 'Product not found (404). Insert a valid product ID.'
              });
            }else if(xhr.status == 500) {
              Toast.fire({
                type: 'error',
                title: 'Oops... something went wrong (500). Server error: contact your wesite administrator'
              });
            }
            $('#spinner').fadeOut();
        }
      });

  });


  $('#addImageForm').on('submit', function(event) {
    event.preventDefault();
    var id = $('#product_id').val();

    $.ajax({
      url: '/auth/productImages',
      method: 'POST',
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
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
            location.href = '/auth/products/' + id + '/images';
            $('#spinner').fadeIn();
        }
    }
    });
  });

  if($('#imageID').val()) {
    $('#getProductImagesForm').submit();
  }

  /**
     * DELETE
     */
    var image_id;

    $(document).on('click', '._delete', function(){
        image_id = $(this).attr('data-id');
        $('#deleteImageModal').modal('show');
    });

    $('#deleteImageForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: '/auth/productImages/' + image_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $('#spinner').fadeIn();
                location.reload();
            }
        });

    });


});