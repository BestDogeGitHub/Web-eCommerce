
$(document).ready(function() {



    if(!$('#not_fadeout').length) $("#spinner").fadeOut(1000);

    bsCustomFileInput.init();
    //console.log('ci sono')

    

});


function setTinyEditor(selector) {
    if($(selector).length > 0) {
        tinymce.init({
            selector:selector,
            height : "600",
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    }
}