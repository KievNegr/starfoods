$(document).ready(function()
	{
		name = 0;
		money = 0;
		title = 0
		url = 0;
		description = 0;
		
		$("#name_prod").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
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
				$("#errors").html('Строка "Название товара" не должна быть пустой!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#prod_price").change(function()
		{
			if( $.trim($(this).val()) < 1 )
			{
				money = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Цена" не должна быть пустой!');
				$(".submit").prop("disabled", true);
			}
			else
			{
				if( isNaN($(this).val()) == true )
				{
					money = 0;
					$(this).css('border','1px solid #b20303');
					$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
					$("#errors").fadeIn(300);
					$("#errors").html('Строка "Цена" должна содержать только цифры!');
					$(".submit").prop("disabled", true);
				}
				else
				{
					money = 1;
					$(this).css('border','1px dashed #B0C4DE');
					$("#errors").fadeOut(50);
				}
			}
			
			check();
		});
		
		$("#prod_title").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				title = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				title = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Заголовок" не должна быть пустой!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#prod_url").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				url = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				url = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Rewrite" не должна быть пустой!');
				$(".submit").prop("disabled", true);
			}

			check();
		});
		
		$("#prod_description").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				description = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				description = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 510, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Description" не должна быть пустой!');
				$(".submit").prop("disabled", true);
			}

			check();
		});

		function check()
		{
			if( name == 1 && money == 1 && title == 1 && url == 1 && description == 1)
			{
				$(".submit").prop("disabled", false);
			}
		}
	});