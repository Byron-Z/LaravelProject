$(document).ready (function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$("#success-alert").hide();
	$("#fail-alert").hide();

	$(".dropdown-menu li a").click(function(){
	  $(this).parents(".input-group-btn").find('.btn').html($(this).text() + ' <span class="caret"></span>');
	  $(this).parents(".input-group-btn").find('.btn').val($(this).data('value'));
	  $list = {'Original':0, 'Reproduction':1, 'Translation':2};
	  $('#article-type').val($list[$(this).data('value')]);
	});

	/*$('#preview-function').click(function() {
		if ( $.trim($("#article-title").val()).length !== 0 && $.trim($("#summernote").val()).length !== 0 ) {
        	$('#preview-title').text($('#article-title').val());
        	$.post('/create/preview', {'content': $('#summernote').val()}, function(data, status) {
            	$('#preview-body').html(data)});
        } else {
        	$('#preview-title').text("Article title and content are required!");
        }
    });*/

    $('#summernote').summernote({
        height: 420,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        maximumImageFileSize: 10240,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen', /*'codeview'*/]],
            ['help', ['help']]
          ],
        callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                // upload image to server and create imgNode...
                for (var i = files.length - 1; i >= 0; i--) {
                    sendFile(files[i], $(this));
                }
            }
        }
     });

    function sendFile(file, editor) {
        var form_data = new FormData();
        form_data.append('file', file);
        $.ajax({
            data: form_data,
            type: 'POST',
            url: '/blog/article/ajaxupload',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.summernote('insertImage', url);
            }
        });
    }

    /*$('#summernote').on('summernote.image.upload', function(we, files) {
      // upload image to server and create imgNode...
      console.log('image upload:', we);
    });*/


    $('#preview-function').click(function() {
        if ( $.trim($("#article-title").val()).length !== 0 && $.trim($("#summernote").val()).length !== 0 ) {
            $('#preview-title').text($('#article-title').val());
            $('#preview-body').html($('#summernote').summernote('code'));
        } else {
            $('#preview-title').text("Article title and content are required!");
        }
    });

    $('#tag-add').click(function() {
        $('#tagadding-title').text('Add tag');
        $('#tagadding-body').html('<input type="text" placeholder="Enter a tag name" class="form-control" id="tag-input">');
    });

    $('#add-tag-btn').click(function() {
        $('#tags-selector').append($('<option>', { value : $('#tag-input').val() }).text($('#tag-input').val())); 
        $('#tags-selector').val($('#tag-input').val());
    });

});