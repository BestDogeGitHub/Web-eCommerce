
$(document).ready(function(){

    var ids = ['11', '12', '13', '14'];

    tinymce.init({
        selector:'#html_editor_textarea',
        height : "600",
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });

    /**
     * DELETE
     */
    var elem_id;

    $(document).on('click', '._delete', function(){
        elem_id = $(this).attr('id');
        $('#deleteResourceModal').modal('show');
    });

    $('#deleteResourceForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "/auth/website/edit/" + elem_id,
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