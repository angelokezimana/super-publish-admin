$(document).ready(function () {

    //Initialize data
    function initialize() {
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
        $("#username").val("");
        $("#password").val("");
        $("#password_confirmation").val("");
        $("#role_id").val("");

        $('#first_name + div').addClass('hidden');
        $('#last_name + div').addClass('hidden');
        $('#email + div').addClass('hidden');
        $('#username + div').addClass('hidden');
        $('#password + div').addClass('hidden');
        $('#password_confirmation + div').addClass('hidden');
        $('#role_id + div').addClass('hidden');

        $('#first_name').removeClass('is-invalid');
        $('#last_name').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#username').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
        $('#password_confirmation').removeClass('is-invalid');
        $('#role_id').removeClass('is-invalid');
    }

    //Initialize update data
    function initialize_update() {
        $('#first_name + div').addClass('hidden');
        $('#last_name + div').addClass('hidden');
        $('#email + div').addClass('hidden');
        $('#username + div').addClass('hidden');
        $('#password + div').addClass('hidden');
        $('#password_confirmation + div').addClass('hidden');
        $('#role_id + div').addClass('hidden');

        $('#first_name').removeClass('is-invalid');
        $('#last_name').removeClass('is-invalid');
        $('#email').removeClass('is-invalid');
        $('#username').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
        $('#password_confirmation').removeClass('is-invalid');
        $('#role_id').removeClass('is-invalid');
    }

    //Button Add User
    $(".btn-add-user").on('click', function () {
        $('.alert').addClass('hidden');
        $('.crud-modal-user-form').attr("id", "store-user-form");
        initialize();

        $('.modal-title').text('Créer un utilisateur');
        $('.crud-modal-user-form').text('Créer');
    });

    //Store User in form
    $(document).on('click', '#store-user-form', function () {

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();
        var role_id = $("#role_id").val();

        $.ajax({
            type: 'POST',
            url: '/users',
            data: {
                first_name: first_name,
                last_name: last_name,
                email: email,
                username: username,
                password: password,
                password_confirmation: password_confirmation,
                role_id: role_id,
            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //first_name
                    if (data.errors.first_name) {
                        $('#first_name + div').removeClass('hidden');
                        $('#first_name').addClass('is-invalid');
                        $('#first_name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.first_name);
                    }
                    else {
                        $('#first_name + div').addClass('hidden');
                        $('#first_name').removeClass('is-invalid');
                    }
                    //last_name
                    if (data.errors.last_name) {
                        $('#last_name + div').removeClass('hidden');
                        $('#last_name').addClass('is-invalid');
                        $('#last_name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.last_name);
                    }
                    else {
                        $('#last_name + div').addClass('hidden');
                        $('#last_name').removeClass('is-invalid');
                    }
                    //email
                    if (data.errors.email) {
                        $('#email + div').removeClass('hidden');
                        $('#email').addClass('is-invalid');
                        $('#email + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.email);
                    }
                    else {
                        $('#email + div').addClass('hidden');
                        $('#email').removeClass('is-invalid');
                    }
                    //username
                    if (data.errors.username) {
                        $('#username + div').removeClass('hidden');
                        $('#username').addClass('is-invalid');
                        $('#username + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.username);
                    }
                    else {
                        $('#username + div').addClass('hidden');
                        $('#username').removeClass('is-invalid');
                    }
                    //password
                    if (data.errors.password) {
                        $('#password + div').removeClass('hidden');
                        $('#password').addClass('is-invalid');
                        $('#password + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.password);
                    }
                    else {
                        $('#password + div').addClass('hidden');
                        $('#password').removeClass('is-invalid');
                    }
                }
                else {
                    window.location.replace("/users");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            dataType: 'json'
        });
    });

    //Button Edit User
    $(document).on('click', '.btn-edit-user', function () {
        var id = $(this).data('id');
        var first_name = $(this).data('first_name');
        var last_name = $(this).data('last_name');
        var email = $(this).data('email');
        var username = $(this).data('username');
        var password = $(this).data('password');
        var password_confirmation = $(this).data('password_confirmation');
        var role_id = $(this).data('role_id');

        initialize_update();

        $('.modal-title').html('Modifier l\'utilisateur "<strong>' + first_name + ' '+ last_name +'</strong>"');
        $('.crud-modal-user-form').text('Modifier');

        $('.alert').addClass('hidden');
        $('.crud-modal-user-form').attr("id", "update-user-form");

        $("#user_id").val(id);
        $("#first_name").val(first_name);
        $("#last_name").val(last_name);
        $("#email").val(email);
        $("#username").val(username);
        $("#role_id").val(role_id);
    });

    //Update User in form
    $(document).on('click', '#update-user-form', function () {
        var id = $("#user_id").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var password_confirmation = $("#password_confirmation").val();
        var role_id = $("#role_id").val();

        $.ajax({
            type: 'POST',
            url: '/users/' + id,
            data: {
                _method: 'PUT',
                first_name: first_name,
                last_name: last_name,
                email: email,
                username: username,
                password: password,
                password_confirmation: password_confirmation,
                role_id: role_id,
            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //first_name
                    if (data.errors.first_name) {
                        $('#first_name + div').removeClass('hidden');
                        $('#first_name').addClass('is-invalid');
                        $('#first_name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.first_name);
                    }
                    else {
                        $('#first_name + div').addClass('hidden');
                        $('#first_name').removeClass('is-invalid');
                    }
                    //last_name
                    if (data.errors.last_name) {
                        $('#last_name + div').removeClass('hidden');
                        $('#last_name').addClass('is-invalid');
                        $('#last_name + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.last_name);
                    }
                    else {
                        $('#last_name + div').addClass('hidden');
                        $('#last_name').removeClass('is-invalid');
                    }
                    //email
                    if (data.errors.email) {
                        $('#email + div').removeClass('hidden');
                        $('#email').addClass('is-invalid');
                        $('#email + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.email);
                    }
                    else {
                        $('#email + div').addClass('hidden');
                        $('#email').removeClass('is-invalid');
                    }
                    //username
                    if (data.errors.username) {
                        $('#username + div').removeClass('hidden');
                        $('#username').addClass('is-invalid');
                        $('#username + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.username);
                    }
                    else {
                        $('#username + div').addClass('hidden');
                        $('#username').removeClass('is-invalid');
                    }
                    //password
                    if (data.errors.password) {
                        $('#password + div').removeClass('hidden');
                        $('#password').addClass('is-invalid');
                        $('#password + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.password);
                    }
                    else {
                        $('#password + div').addClass('hidden');
                        $('#password').removeClass('is-invalid');
                    }
                }
                else {
                    window.location.replace("/users");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("jqXHR:" + jqXHR + ". TextStatus:" + textStatus + ". errorThrown:" + errorThrown);
            },
            dataType: 'json'
        });
    });
});
