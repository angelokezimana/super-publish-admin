$(document).ready(function () {

    //Initialize data
    function initialize() {
        $("#name").val("");
        $("#permissions").val("").trigger("chosen:updated");

        $('#name + div').addClass('hidden');
        $('.permissions-error').addClass('hidden');

        $('#name').removeClass('is-invalid');
    }

    //Initialize update data
    function initialize_update() {
        $('#name + div').addClass('hidden');
        $('.permissions-error').addClass('hidden');

        $('#name').removeClass('is-invalid');
    }

    //Button Add role
    $(".btn-add-role").on('click', function () {
        $('.alert').addClass('hidden');
        $('.crud-modal-role-form').attr("id", "store-role-form");
        initialize();

        $('.modal-title').text('Créer un rôle');
        $('.crud-modal-role-form').text('Créer');
    });

    //Store role in form
    $(document).on('click', '#store-role-form', function () {

        var name = $("#name").val();
        var permissions = $("#permissions").val();

        $.ajax({
            type: 'POST',
            url: '/roles',
            data: {
                name: name,
                permissions: permissions,
            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //name
                    if (data.errors.name) {
                        $('#name + div').removeClass('hidden');
                        $('#name').addClass('is-invalid');
                        $('#name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.name);
                    }
                    else {
                        $('#name + div').addClass('hidden');
                        $('#name').removeClass('is-invalid');
                    }

                    //permissions
                    if (data.errors.permissions) {
                        $('.permissions-error').removeClass('hidden');
                        $('.permissions-error').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.permissions);
                    }
                    else {
                        $('.permissions-error').addClass('hidden');
                    }
                }
                else {
                    window.location.replace("/roles");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            dataType: 'json'
        });
    });

    //Button Edit role
    $(document).on('click', '.btn-edit-role', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var permissions = $(this).data('permissions');

        permissions = permissions.toString().split(",");

        initialize_update();

        $('.modal-title').html('Modifier le rôle "<strong>' + name + '</strong>"');
        $('.crud-modal-role-form').text('Modifier');

        $('.alert').addClass('hidden');
        $('.crud-modal-role-form').attr("id", "update-role-form");

        $("#role_id").val(id);
        $("#name").val(name);
        $("#permissions").val(permissions).trigger("chosen:updated");
    });

    //Update role in form
    $(document).on('click', '#update-role-form', function () {
        var id = $("#role_id").val();
        var name = $("#name").val();
        var permissions = $("#permissions").val();

        $.ajax({
            type: 'POST',
            url: '/roles/' + id,
            data: {
                _method: 'PUT',
                name: name,
                permissions: permissions,
            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //name
                    if (data.errors.name) {
                        $('#name + div').removeClass('hidden');
                        $('#name').addClass('is-invalid');
                        $('#name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.name);
                    }
                    else {
                        $('#name + div').addClass('hidden');
                        $('#name').removeClass('is-invalid');
                    }

                    //permissions
                    if (data.errors.permissions) {
                        $('.permissions-error').removeClass('hidden');
                        $('.permissions-error').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.permissions);
                    }
                    else {
                        $('.permissions-error').addClass('hidden');
                    }
                }
                else {
                    window.location.replace("/roles");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("jqXHR:" + jqXHR + ". TextStatus:" + textStatus + ". errorThrown:" + errorThrown);
            },
            dataType: 'json'
        });
    });
});
