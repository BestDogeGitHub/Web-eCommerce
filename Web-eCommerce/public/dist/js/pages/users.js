// SCRIPT FOR USERS


$(document).ready(function() {
    
    var table = $("#usersTable").DataTable();
    var user_id = 0;

    /**
     * DELETE
     */

    $(document).on('click', '._delete', function(){
        product_id = $(this).attr('id');
        $('#deleteUserModal').modal('show');
    });

    $('#deleteUserForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/users/" + product_id,
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
    

    $(document).on('click', '._show', function(){
        user_id = $(this).attr('id');
        //console.log('user id: ' + user_id + ', element: ' + element.html());
        var button = $(this);
        $.ajax({
            url: '/auth/users/' + user_id + '/edit',
            dataType: 'json',
            success: function(obj){
                $('#editUsername').val(obj.data.username);
                $('#editName').val(obj.data.name);
                $('#editSurname').val(obj.data.surname);
                $('#editEmail').val(obj.data.email);
                $('#editPhone').val(obj.data.phone);
                $.ajax({
                    url: '/auth/addresses/' + obj.data.address_id + '/edit',
                    dataType: 'json',
                    success: function(add){
                        var toSet = 'Country Code: <i>' + add.data.country_code + '</i><br/>';
                        toSet += 'Town: <b>' + add.town_info.name + '</b> <i>(' + add.data.postcode + ')</i>, Nation: <b>' + add.nation_info.name + '</b>.<br/>';
                        toSet += 'Street <b>' + add.data.street_number + '</b>, Building <b>' + add.data.building_number + '</b>.';
                        $('#addressText').html(toSet);

                    }
                });
                var rol = '';
                obj.roles.forEach(function(item) {
                    rol += '&nbsp;&nbsp;<span class="badge badge-success">' + item.name + '</span>';
                });
                $('#rolesText').html(rol);
            }
        });
        $('#editUserModal').modal('show');
    } );

    $(document).on('click', '._edit', function(){
        user_id = $(this).attr('id');
        //console.log('user id: ' + user_id + ', element: ' + element.html());
        var button = $(this);
        $.ajax({
            url: '/auth/users/' + user_id + '/edit',
            dataType: 'json',
            success: function(obj){
                $('#editUsername').val(obj.data.username);
                $('#editName').val(obj.data.name);
                $('#editSurname').val(obj.data.surname);
                $('#editEmail').val(obj.data.email);
                $('#editPhone').val(obj.data.phone);
                $.ajax({
                    url: '/auth/addresses/' + obj.data.address_id + '/edit',
                    dataType: 'json',
                    success: function(add){
                        var toSet = 'Country Code: <i>' + add.data.country_code + '</i><br/>';
                        toSet += 'Town: <b>' + add.town_info.name + '</b> <i>(' + add.data.postcode + ')</i>, Nation: <b>' + add.nation_info.name + '</b>.<br/>';
                        toSet += 'Street <b>' + add.data.street_number + '</b>, Building <b>' + add.data.building_number + '</b>.';
                        $('#addressText').html(toSet);

                    }
                });
                var rol = '';
                obj.roles.forEach(function(item) {
                    rol += '&nbsp;&nbsp;<span class="badge badge-success">' + item.name + '</span>';
                });
                $('#rolesText').html(rol);
            }
        });
        $('#editUserModal').modal('show');
    } );

    $('#editUserForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: "/auth/users/" + user_id,
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
                    $('#forErrors').html(html); 
                    location.reload();
                    $('#spinner').fadeIn();
                }
            }
        });

    });


});

    



