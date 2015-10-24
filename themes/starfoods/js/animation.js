$(document).ready(function()
{
	$('html').on('click', '.more-load-button', function()
	{
		$('.pre-load-back').animate({
			'backgroundPosition': '0 0'
		}, 1000);

		from = parseInt($('#from').val());

		$.ajax({
				type: 'post',
				url: 'http://starfoods/main/load',
				data: {
					'from': from
				},
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
		$('#from').val(from + 3);

		freeCakeNow = parseInt($('.countCake').attr('count'));
		
		free = parseInt($('#free').val() - 3);
		$('#free').val(free);
		CakeNow = free - 3;

		if(CakeNow < 0 )
		{
			$('.more-load-button').fadeOut();
		}
		else
		{
			$('.countCake').attr('count', CakeNow).html(CakeNow);
		}
	}
});