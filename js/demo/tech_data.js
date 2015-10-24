$(document).ready(function()
{
	$("#full_description").show();
	$("#info .descr").css('background','#164d86');
	
	$("#info .options").click(function()
	{
		$(this).css('background','#164d86');
		$("#info .descr").css('background','#444');
		$("#full_description").hide();
		$("#show_options").show();
	});
	
	$("#info .descr").click(function()
	{
		$(this).css('background','#164d86');
		$("#info .options").css('background','#444');
		$("#show_options").hide();
		$("#full_description").show();
	});
	
})
