$(document).ready(function()
{
	$('#hello-field').css('margin-top', $(window).height());
	$('#header').css('height', $(window).height());

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
		}
		else if( height > 165 )
		{
			$('.empty-li').stop(true).animate({
				width: '7%'
			}, 600);

			$('.li-logo').stop(true).animate({
				width: '0'
			}, 600);
		}

		if( height <= 100 )
		{
			$('#header').css({'height': '100px','position':'fixed','top': 0, 'left': 0});
		}
	});
});