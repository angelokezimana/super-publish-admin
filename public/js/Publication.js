(function ($) {
    "use strict";

    $(document).on('click', "#id-form", function () {
        var content = $('#summernote').summernote('code');
        var title = $('#title');

        $.ajax({
            type: 'POST',
            url: '/publications',
            data: {
                
            },
            success: function (data) {
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            dataType: 'json'
        });
    });

})(jQuery); 
