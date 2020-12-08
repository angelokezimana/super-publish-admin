(function ($) {
    "use strict";

    $(document).on('click', "#id-form", function () {
        var content = $('#summernote').summernote('code');
        var title = $('#title').val();
        var category_id = $('#category_id').val();

        $.ajax({
            type: 'POST',
            url: '/publications',
            data: {
                content: content,
                title: title,
                category_id: category_id
            },
            success: function (data) {
                if (data.errors) {
                    if(data.errors.content) {
                        
                    }
                }
                else {
                    window.location.replace('/publications');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            dataType: 'json'
        });
    });

})(jQuery); 
