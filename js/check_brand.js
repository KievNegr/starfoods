$(document).ready(function()
	{
		name = 0;
		img = 1;
		
		$("#brand_name").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				name = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				name = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Не должно состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#logo_img").change(function()
		{
			var ext = new Array( 'jpg', 'jpeg', 'png');
			apply = 0;
			
			for( i = 0; i < ext.length; i++ )
			{
				if( $(this).val().toLowerCase().indexOf(ext[i]) != -1 )
				{
					apply = 1;
					
				}
			}
			
			if( apply == 0 )
			{	
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Поддержуються только JPG и PNG');
				$(".submit").prop("disabled", true);
			}
			else
			{
				$("#errors").fadeOut(300);
				img = 1;
				check();
			}
		});
		
		function check()
		{
			if( name == 1 )//&& img == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
		
	});