$(document).ready(function()
	{
		name = 0;
		
		$("#name_city").change(function()
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
				$("#errors").html('Строка "Название города" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		function check()
		{
			if( name == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
	});