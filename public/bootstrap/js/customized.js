$(document).ready (function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$("#success-alert").hide();
	$("#fail-alert").hide();

    $(".profile-usermenu ul li a").click(function(){
        $(".profile-usermenu ul li.active").removeClass("active");
        $(this).parent().addClass("active");
    });

	$(".dropdown-menu li a").click(function(){
	  $(this).parents(".input-group-btn").find('.btn').html($(this).text() + ' <span class="caret"></span>');
	  $(this).parents(".input-group-btn").find('.btn').val($(this).data('value'));
	  $list = {'Original':0, 'Reproduction':1, 'Translation':2};
	  $('#article-type').val($list[$(this).data('value')]);
	});

	$('#preview-function').click(function() {
		if ( $.trim($("#article-title").val()).length !== 0 && $.trim($("#article-content").val()).length !== 0 ) {
        	$('#preview-title').text($('#article-title').val());
        	$.post('/create/preview', {'content': $('#article-content').val()}, function(data, status) {
            	$('#preview-body').html(data)});
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