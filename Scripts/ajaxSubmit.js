$(document).ready(function(){
	$('#submit').click(function() {

		$('#waiting').show(500);
              //$('#demoForm').hide(0);
		$('#message').hide(0);

		$.ajax({
			type : 'POST',
			url : 'post.php',
			dataType : 'json',
			data: {
				country_code : $('#country_code').val(),
                                area_code : $('#area_code').val(),
                                number : $('#number').val()
			},
			success : function(data){
				$('#waiting').hide(500);
				$('#message').removeClass().addClass((data.error === true) ? 'error' : 'success')
					.html(data.msg).show(500);
				if (data.error === true)
					$('#demoForm').show(500);
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				$('#waiting').hide(500);
				$('#message').removeClass().addClass('error')
					.text('There was an error.').show(500);
				$('#demoForm').show(500);
			}
		});

		return false;
	});
});