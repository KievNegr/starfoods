$(document).ready(function()
	{
		name = 0;
		mark = 0;
		
		$("#name_pay").change(function()
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
				$("#errors").html('Строка "Вид платежа" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#mark_pay").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				mark = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Наценка" должна содержать только цифры!');
				$(".submit").prop("disabled", true);
			}
			else
			{
				mark = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}

			check();
		});
		
		function check()
		{
			if( name == 1 && mark == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
	});