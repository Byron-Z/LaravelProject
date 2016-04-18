$(document).ready (function(){

	$("#success-alert").hide();
	$("#fail-alert").hide();

	$(".dropdown-menu li a").click(function(){
	  $(this).parents(".input-group-btn").find('.btn').html($(this).text() + ' <span class="caret"></span>');
	  $(this).parents(".input-group-btn").find('.btn').val($(this).data('value'));
	});

	$('#preview-function').click(function() {
          $('.modal-title').text($('#article-title').val());
          $.post('create/preview', {'content': $('#article-content').val()}, function(data, status) {
            $('.modal-body').html(data);
          $('.preview-popup').modal();
      });

});