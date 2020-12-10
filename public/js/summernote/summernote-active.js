(function ($) {
 "use strict";
	$('#summernote1').summernote({
		height: 200,
	});
	$('#summernote2').summernote({
		height: 200,
	});
	$('#summernote3').summernote({
		height: 200,
	});
	$('#summernote4').summernote({
		height: 200,
	});
	$('#summernote5').summernote({
		height: 400,
	});
	$('.summernote6').summernote({
		height: 300,
	});

	$('#summernote').summernote();
 
	// $('#summernote').summernote({
    //     callbacks: {
    //         onImageUpload: function(files) {
    //             for(let i=0; i < files.length; i++) {
    //                 $.upload(files[i]);
    //             }
    //         }
    //     },
    //     height: 400,
	// });
	
	// $.upload = function (file) {
    //     let out = new FormData();
    //     out.append('file', file, file.name);

    //     $.ajax({
    //         method: 'POST',
    //         url: 'upload.php',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         data: out,
    //         success: function (img) {
    //             $('#summernote').summernote('insertImage', img);
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             console.error(textStatus + " " + errorThrown);
    //         }
    //     });
    // };

})(jQuery); 