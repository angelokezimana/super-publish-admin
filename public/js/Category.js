(function ($) {
    //Initialize data
    function initialize() {
        $("#namecategory").val("");
        $('#namecategory + div').addClass('hidden');
        $('#namecategory').removeClass('is-invalid');

    }

     //Initialize update data
     function initialize_update() {
        $('#namecategory + div').addClass('hidden');      
        $('#namecategory').removeClass('is-invalid');    
    }

    //Button Add Category
    $(".btn-add-category").on('click', function () {
        $('.alert').addClass('hidden');
        $('.crud-modal-category-form').attr("id", "store-category-form");
        initialize();

        $('.modal-title').text('Ajouter une catégorie');
        $('.crud-modal-category-form').text('Créer');
    });

    //Store Category in form
    $(document).on('click', '#store-category-form', function () {
        var namecategory = $("#namecategory").val();

        $.ajax({
            type: 'POST',
            url: '/categories',
            data: {
                namecategory: namecategory,

            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //namecategory
                    if (data.errors.namecategory) {
                        $('#namecategory + div').removeClass('hidden');
                        $('#namecategory').addClass('is-invalid');
                        $('#namecategory + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.namecategory);
                    }
                    else {
                        $('#namecategory + div').addClass('hidden');
                        $('#namecategory').removeClass('is-invalid');
                    }

                } else {
                    window.location.replace('/categories');
                }
                                 
                 },
                
            error: function (jqXHR, textStatus, errorThrown) {
                alert('jqXHR:'+jqXHR +'textStatus:'+textStatus+'errorThrown:'+errorThrown);
            },
            dataType: 'json'
        });
    });


    //Button Edit Category
    $(document).on('click', '.btn-edit-category', function () {
        var id = $(this).data('id');
        var namecategory = $(this).data('namecategory');


        initialize_update();

        $('.modal-title').html('Modifier une cat&eacute;gorie "<strong>' + namecategory + '</strong>"');
        $('.crud-modal-category-form').text('Modifier');

        $('.alert').addClass('hidden');
        $('.crud-modal-category-form').attr("id", "update-category-form");
        $("#category_id").val(id);
        $("#namecategory").val(namecategory);

    });

    //Update Category in form
    $(document).on('click', '#update-category-form', function () {
        var id = $("#category_id").val();
        var namecategory = $("#namecategory").val();
      

        $.ajax({
            type: 'POST',
            url: 'categories/' + id,
            data: {
                _method: 'PUT',

                namecategory: namecategory,

            },
            success: function (data) {
                if (data.errors) {
                    $('.alert-success').addClass('hidden');

                    //namecategory
                    if (data.errors.namecategory) {
                        $('#namecategory + div').removeClass('hidden');
                        $('#namecategory').addClass('is-invalid');
                        $('#namecategory + div').html("<i class=\"fa fa-exclamation-triangle mr-1\"></i>" + data.errors.namecategory);
                    }
                    else {
                        $('#namecategory + div').addClass('hidden');
                        $('#namecategory').removeClass('is-invalid');
                    }

                }
                else {
                    window.location.replace('/categories');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("jqXHR:" + jqXHR + ". TextStatus:" + textStatus + ". errorThrown:" + errorThrown);
            },
            dataType: 'json'
        });
    });
})(jQuery); 
