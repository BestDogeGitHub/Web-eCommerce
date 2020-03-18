$(document).ready(function() {
    
  $('.custom-file input').on('change',function(){
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})

  $('#getProductImagesForm').on('submit', function(event) {
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
                  html_to_add += '<img src="' + element.image_ref + '" class="img-thumbnail prodImg">'
                });
              }
              $('#imgContainer').append(html_to_add);
              $('#uploadImg').removeClass('disabledFile');
              $('#product_id').val(product_id);
              $('#spinner').fadeOut();
          },
          error:function (xhr, ajaxOptions, thrownError){
            if(xhr.status == 404) {
                  html = '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Error</h4><p>';
                  html += 'Product not found';
                  html += '</p></div>';
                  $('#imgContainer').html(html); 
            }else if(xhr.status == 500) {
              html = '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Error</h4><p>';
              html += 'Oops, something went wrong.';
              html += '</p></div>';
              $('#imgContainer').html(html); 
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


});