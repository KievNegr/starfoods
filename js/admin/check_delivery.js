$(document).ready(function()
	{
		name = 0;
		delivery = 0;
		
		$("#name_delivery").change(function()
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
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Название доставки" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#price_delivery").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				delivery = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Стоимость доставки" должна содержать только цифры!');
				$(".submit").prop("disabled", true);
			}
			else
			{
				delivery = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}

			check();
		});
		
		function check()
		{
			if( name == 1 && delivery == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
	});