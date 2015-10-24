$(document).ready(function()
{
	i = $('.item').size() - 1;
	height = $('.item').eq(0).height();
	for(n = 0;n < i;n++)
	{
		if( height < $('.item').eq(n).height() )
		{
			height = 	$('.item').eq(n).height();
		}
	}
	
	$('.item').css('height',height);
})
