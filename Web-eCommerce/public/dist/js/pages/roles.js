// SCRIPTS FOR ROLES MANAGEMENT

$(document).ready(function() {

    $('#addRoleButton').on('click', function () {     
        console.log('adding');
        if ($('#roleSelect option').length > 0) {
            var role_id = $('#roleSelect').children("option:selected").val();
            var role_name = $('#roleSelect').children("option:selected").html();
            
            // COSTRUZIONE RIGA DELLA TABELLA
            var to_append = "<tr>";
            to_append += "<th scope=\"row\">" + role_id + "</th>";
            to_append += "<td class=\"text-uppercase\">" + role_name + "</td>";
            to_append += "<td><button id=\"but_" + role_id + "\" type=\"button\" class=\"btn btn-danger deleteRoleButton\" ><i class=\"fa fa-times\" aria-hidden=\"true\"></i>&nbsp; Delete</button></td>";
            to_append += "</tr>";
    
            // INSERIMENTO RIGA
            $('#userRolesTable tbody').append(to_append);   
            
            // Tolgo l'opzione dalla select
            $("#roleSelect option[value='" + role_id + "']").remove();
        }
    } );

    $('#sendRoleData').click( function() {
        console.log('sending');
        var dataArr = [];
        $("#userRolesTable tbody tr th").each(function(){
            dataArr.push($(this).html());
        });

        var id = $('#id_user').text();
    
        var jsonString = JSON.stringify(dataArr);
        console.log(jsonString);
        console.log('d: ' + dataArr);

        var data = new FormData();
        data.append("roles", dataArr);

        console.log(data);
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : "POST",
            url : '/auth/roles/edit/' + id,
            data : data,
            cache: false,
            dataType: "json",
            success: function(data) {
                alert(data);// alert the data from the server
                console.log('response data: ' + data);
            },
            error : function() {
                alert("Errore");// alert the data from the server
            }
        });
    });

    $(document).on('click', ".deleteRoleButton", function(event) {     
        var id_button = $(this).attr('id');

        // REPERISCO ID E NOME DEL RUOLO, e TR
        var tr = $('#' + id_button).parent().parent(); 
        var role_id = $('#' + id_button).parent().siblings('th').html();
        var role_name = $('#' + id_button).parent().siblings('td:eq(0)').html();
    
        // Tolgo la riga dalla tabella
        tr.remove();
    
        // Aggiungo l'option alla selectbox
        $('#roleSelect').append($('<option>', { 
            value: role_id,
            text : role_name 
        }));
    } );

    $('#rolesTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );


});
