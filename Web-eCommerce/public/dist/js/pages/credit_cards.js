$(document).ready(function() {
    
    var table = $("#creditCardsTable").DataTable();
    var credit_card_id = 0;

    /**
     * CREATE
     */
    $('#addCreditCardForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/creditCards",
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
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done! Refreshing...</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forErrors').html(html); 
                    location.reload();
                    $('#spinner').fadeIn();
                }
            }
        });
    
    });

    /**
     * UPDATE
     */
    

    $(document).on('click', '._edit', function(){
        credit_card_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/creditCards/' + credit_card_id + '/edit',
            dataType: 'json',
            success: function(html){
                //button.parent().parent().find('td:eq(6)').html());
                $('#editNumber').val(html.data.number);
                $('#editMonth').val(html.month);
                $('#editYear').val(html.year);
                $('#editUser').val(html.data.user_id);
                $("#editTown option[value=" + html.data.type +"]").prop("selected", true);
            }
        });

        $('#editCreditCardModal').modal('show');

    });

    $('#editCreditCardForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/creditCards/" + credit_card_id,
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
                    html = '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Done! Refreshing...</h4><p>';
                    html += data.success;
                    html += '</p></div>';
                    $('#forEditErrors').html(html); 
                    location.reload();
                    $('#spinner').fadeIn();
                }
            }
        });

    });

    /**
     * DELETE
     */

    $(document).on('click', '._delete', function(){
        credit_card_id = $(this).attr('id');
        $('#deleteCreditCardModal').modal('show');
    });

    $('#deleteCreditCardForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/creditCards/" + credit_card_id,
            method: "delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                location.reload();
            }
        });

    });


});