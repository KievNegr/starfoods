$(document).ready(function()
{
	width = 150 * $('#category li').length;
	$('#category').css('width',width);
	$('#category li').hover(function()
	{
		$('.sub_category').hide();
		$('#category li').css("background","#164d86");
		$(this).css("background","#0c55af");
		$('.sub_category:first-child', this).show();
	},function(){});
	
	$('.sub_category').mouseleave(function()
	{
		$('.sub_category').hide();
		$('#category li').css("background","#164d86");
	});
});