$(document).ready(function()
{
	var i = 0;
	var a = 0;
	for(i = 0;i <=2; i++)
	{
		$('.item:eq('+i+')').fadeIn(500);
	}
	
	a = i;
	
	$('#next').click(function()
	{
		//alert(i);
		if( i < 8 )
		{
			$('.item').fadeOut(100);
			
			for(i;i < a + 3; i++)
			{
				$('.item:eq('+i+')').delay(500).fadeIn(1000);
				
			}
			a = i;
		}
		else
		{
			$('.item').fadeOut(100);
			i = a - 9;
			for(i;i < a - 6; i++)
			{
				$('.item:eq('+i+')').delay(500).fadeIn(1000);
				
			}
			a = i;
		}
		
	});
	
	$('#prev').click(function()
	{
		//alert(i);
		if( i > 3 )
		{
			$('.item').fadeOut(100);
			i = a - 6;
			for(i;i <a-3; i++)
			{
				$('.item:eq('+i+')').delay(500).fadeIn(1000);
				
			}
			a = i;
		}
		else
		{
			$('.item').fadeOut(100);
			i = a + 3;
			for(i;i < a + 6; i++)
			{
				$('.item:eq('+i+')').delay(500).fadeIn(1000);
				
			}
			a = i;
		}
		
	});
});