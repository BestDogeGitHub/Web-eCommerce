
$(document).ready(function(){

    tinymce.init({
        selector:'#html_editor_textarea',
        height : "600",
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });


});