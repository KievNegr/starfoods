$(document).ready(function()
{
	imgLoad = $('.list-img li:first').attr('img-name');

	imgLinkLoad = 'http://starfoods/img/product/' + imgLoad;

	$('.large').css('backgroundImage', 'url(' + imgLinkLoad + ')');

	


	$('html').on('click', '.list-img li', function()
	{
		img = $(this).attr('img-name');

		imgLink = 'http://starfoods/img/product/' + img;

		$('.large').css('backgroundImage', 'url(' + imgLink + ')');

		$('.list-img li').removeClass('active');
		$(this).addClass('active');
	});
});