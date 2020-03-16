$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'fa-folder-open';
      var closedClass = 'fa-folder';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().slideToggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        /*tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });*/
        //fire event to open branch if the li contains a button instead of text
        /*tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });*/
    }
});

$(document).ready(function() {
    
    var table = $("#categoriesTable").DataTable();
    var category_id = 0;

    //$('#catTree').treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});
    $('#catTree').treed({openedClass : 'fa-minus-circle', closedClass : 'fa-plus-circle'});

    
    /**
     * CREATE
     */
    $('#addCategoryForm').on('submit', function(event) {
        event.preventDefault();
        $('#spinner').fadeIn();
        $.ajax({
            url: "/auth/categories",
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
                    $('#spinner').fadeOut();
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
                }
            }
        });
    
    });

    /**
     * UPDATE
     */
    

    $(document).on('click', '._edit', function(){
        category_id = $(this).attr('id');
        var button = $(this);
        $.ajax({
            url: '/auth/categories/' + category_id + '/edit',
            dataType: 'json',
            success: function(html){
                console.log(html);
                $('#editName').val(html.data.name);
                $('#actualImage').attr('src', html.data.image_ref);
                $('#numberProd').text(html.products);
                $("#editParent option[value=" + html.data.parent_id +"]").prop("selected", true);
            }
        });

        $('#editCategoryModal').modal('show');

    });

    $('#editCategoryForm').on('submit', function(event) {
        event.preventDefault();
        $('#spinner').fadeIn();
        $.ajax({
            url: "/auth/categories/" + category_id,
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
                    $('#spinner').fadeOut();
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
                }
            }
        });

    });

    /**
     * DELETE
     */

    $('#deleteItem').on('click', function(){
        $('#confirmDelete').fadeIn();
    });

    $('#delButton').on('click', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/categories/" + category_id,
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