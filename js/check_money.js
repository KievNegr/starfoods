$(document).ready(function()
	{
		name = 1;
		key = 1;
		ex = 1;
		
		$("#name_money").change(function()
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
				$("#errors").html('Строка "Название валюты" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#key_money").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				key = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				key = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Код валюты" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#ex_money").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				ex = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Курс валюты" должна содержать только цифры!');
				$(".submit").prop("disabled", true);
			}
			else
			{
				ex = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}

			check();
		});
		
		function check()
		{
			if( name == 1 && key == 1 && ex == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
	});