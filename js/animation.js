$(document).ready(function()
{
	$('#hello-field').css('margin-top', $(window).height());
	$(window).scroll(function()
	{
		height = $(this).height() - $(this).scrollTop();
		
		$('#header').css('height', height);

		if( height <= 165 )
		{
			$('.empty-li').stop(true).animate({
				width: '0'
			}, 600);

			$('.li-logo').stop(true).animate({
				width: '14%'
			}, 600);

			$('.menu').stop(true).animate({
				bottom: '37px'
			}, 600);
		}
		else if( height > 165 )
		{
			$('.empty-li').stop(true).animate({
				width: '7%'
			}, 600);

			$('.li-logo').stop(true).animate({
				width: '0'
			}, 600);

			$('.menu').stop(true).animate({
				bottom: '34px'
			}, 600);
		}

		if( height <= 100 )
		{
			$('#header').css('height', '100px');
			$('.logo').stop(true).animate({
				top: '10px'
			}, 600);

			$('#header').css({'background-image': 'none', 'background-color':'#621D10'});
		}
		else
		{
			$('.logo').animate({
				top: '0'
			}, 600);

			$('#header').css({'background-image': 'url(../img/header_background.jpg)', 'background-color':'none'});
		}
	});

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