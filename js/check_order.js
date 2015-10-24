$(document).ready(function()
	{
		name = 0;
		phone = 0;
		fax = 0;
		street = 0;
		house = 0;
		
		$("#edit_name").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				if( isNaN($(this).val()) == false )
				{
					name = 0;
					$(this).css('border','1px solid #b20303');
					$("#errors").css({'left': $(this).offset().left + 310, 'top': $(this).offset().top - 20});
					$("#errors").fadeIn(300);
					$("#errors").html('Строка "Покупатель" не должна содержать цифры!');
					$("#save_order").fadeOut(500);
				}
				else
				{
					name = 1;
					$(this).css('border','1px dashed #B0C4DE');
					$("#errors").fadeOut(50);
				}
			}
			else
			{
				name = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 310, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Покупатель" не должна быть пустой!');
				$("#save_order").fadeOut(500);
			}

			check();
		});
		
		$("#edit_phone").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				if( isNaN($(this).val()) == true )
				{
					phone = 0;
					$(this).css('border','1px solid #b20303');
					$("#errors").css({'left': $(this).offset().left + 310, 'top': $(this).offset().top - 20});
					$("#errors").fadeIn(300);
					$("#errors").html('Строка "Телефон покупателя" должна содержать цифры!');
					$("#save_order").fadeOut(500);
				}
				else
				{
					phone = 1;
					$(this).css('border','1px dashed #B0C4DE');
					$("#errors").fadeOut(50);
				}
			}
			else
			{
				phone = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 310, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Телефон покупателя" не должна быть пустой!');
				$("#save_order").fadeOut(500);
			}

			check();
		});
		
		$("#edit_fax").change(function()
		{
			if( isNaN($(this).val()) == true )
			{
				phone = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 310, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Факс покупателя" должна содержать цифры!');
				$("#save_order").fadeOut(500);
			}
			else
			{
				phone = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}

			check();
		});
		
		$("#edit_street").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				street = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				street = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 210, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Улица" не должна быть пустой!');
				$("#save_order").fadeOut(500);
			}

			check();
		});
		
		$("#edit_house").change(function()
		{
			if( $.trim($(this).val()).length > 0 )
			{
				house = 1;
				$(this).css('border','1px dashed #B0C4DE');
				$("#errors").fadeOut(50);
			}
			else
			{
				house = 0;
				$(this).css('border','1px solid #b20303');
				$("#errors").css({'left': $(this).offset().left + 210, 'top': $(this).offset().top - 20});
				$("#errors").fadeIn(300);
				$("#errors").html('Строка "Дом" не должна быть пустой!');
				$("#save_order").fadeOut(500);
			}

			check();
		});

		function check()
		{
			if( name == 1 && phone == 1 && fax == 1 && street == 1 && house == 1)
			{
				$("#save_order").fadeIn(500);
			}
		}
	});