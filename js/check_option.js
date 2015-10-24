$(document).ready(function()
	{
		name = 1;
		
		$("#name_option").change(function()
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
				$("#errors").html('Строка "Название свойства" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$('.check').click(function()
		{
			if( $("input:checkbox:checked").length == 0 )
			{
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Выберите хотя бы одну категорию');
				$(".submit").prop("disabled", true);
			}
			else
			{
				$("#errors").fadeOut(50);
			}
			
			check();
		});
		
		function check()
		{
			checkbox = $("input:checkbox:checked").length;

			if( name == 1 && checkbox >= 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
	});