$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").on('click', function () {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //title
        $('#title + div').addClass('hidden');
        $('#title').removeClass('is-invalid');
        //photo
        $('#customFile + label + div').addClass('hidden');
        $('#customFile').removeClass('is-invalid');
        //category_id
        $('.category_error').addClass('hidden');
        //content
        $('.content').addClass('hidden');

        var content = CKEDITOR.instances.editor.getData();

        var form = $("#msform");
        var formData = new FormData(form[0]);
        formData.append('content', content);

        $.ajax({
            type: 'POST',
            url: '/check-publications',
            data: formData,
            success: function (data) {
                if (data.errors) {
                    //title
                    if (data.errors.title) {
                        $('#title + div').removeClass('hidden');
                        $('#title').addClass('is-invalid');
                        $('#title + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.title);
                    }
                    else {
                        $('#title + div').addClass('hidden');
                        $('#title').removeClass('is-invalid');
                    }
                    //photo
                    if (data.errors.photo) {
                        $('#customFile + label + div').removeClass('hidden');
                        $('#customFile').addClass('is-invalid');
                        $('#customFile + label + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.photo);
                    }
                    else {
                        $('#customFile + label + div').addClass('hidden');
                        $('#customFile').removeClass('is-invalid');
                    }
                    //category_id
                    if (data.errors.category_id) {
                        $('.category_error').removeClass('hidden');
                        $('.category_error').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.category_id);
                    }
                    else {
                        $('.category_error').addClass('hidden');
                    }
                    //content
                    if (data.errors.content) {
                        $('.content').removeClass('hidden');
                        $('.content').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.content);
                    }
                    else {
                        $('.content').addClass('hidden');
                    }

                } else {

                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({ opacity: 0 }, {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({ 'opacity': opacity });
                        },
                        duration: 600
                    });
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('jqXHR:' + jqXHR + 'textStatus:' + textStatus + 'errorThrown:' + errorThrown);
            },
            contentType: false,
            processData: false,
            dataType: 'json'
        });
    });

    $(".finish-completion").on('click', function () {

        var form = $("#msform");
        var formData = new FormData(form[0]);
        var content = CKEDITOR.instances.editor.getData();

        $.each($("#multiple_files")[0].files, function(i, file) {
            formData.append('multiple_files[]', file);
        });

        formData.append('content', content);

        $.ajax({
            type: 'POST',
            url: '/publications',
            data: formData,
            success: function (data) {
                if (data.errors) {
                    //multiple_files
                    if (data.errors.multiple_files) {
                        $('#multiple_files + div').removeClass('hidden');
                        $('#multiple_files').addClass('is-invalid');
                        $('#multiple_files + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.multiple_files);
                    }
                    else {
                        $('#multiple_files + div').addClass('hidden');
                        $('#multiple_files').removeClass('is-invalid');
                    }

                } else {
                    window.location.replace('/publications');
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('jqXHR:' + jqXHR + 'textStatus:' + textStatus + 'errorThrown:' + errorThrown);
            },
            contentType: false,
            processData: false,
            dataType: 'json'
        });

    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    // $('.radio-group .radio').click(function () {
    //     $(this).parent().find('.radio').removeClass('selected');
    //     $(this).addClass('selected');
    // });

    // $(".submit").click(function () {
    //     return false;
    // })

});
