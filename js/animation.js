$(document).ready(function()
{
	$('html').on('click', '.more-load-button', function()
	{
		$('.pre-load-back').animate({
			'backgroundPosition': '0 0'
		}, 1000);

		$.ajax({
				type: 'get',
				url: 'http://starfoods/load.html',
				/*data: {
					'name': name,
					'last_name': last_name,
					'email': email,
					'phone': phone,
					'pass': pass
				},*/
				beforeSend: send,
				complete: compl,
				success: okLoad
			});
	});

	function send ()
	{
		$('.uil-ring-css').show();
	}

	function compl ()
	{
		$('.uil-ring-css').delay(1000).queue(function(){
			$(this).hide();
			$(this).dequeue();
		});
	}

	function okLoad(data)
	{
		$('.more-load').delay(1200).queue(function(){
			$(this).append(data);
			$(this).dequeue();
		});

		
	}
});