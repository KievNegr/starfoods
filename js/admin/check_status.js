$(document).ready(function()
	{
		name = 0;
		
		$("#name_status").change(function()
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
				$("#errors").html('Строка "Название состояния" не должна состоять из одних цифр!');
				$(".submit").prop("disabled", true);
			}
			
			name_status = $(this).val();
			$.ajax({
				type:'post',
				url:'<?=base_url('admin/check_status/');?>',
				data:{'name': name_status},
				success: function()
				{
					alert(data);
				}
			});

			check();
		});
		
		function check()
		{
			if( name == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
		
		$("#reset").click(function()
		{
			$("#mycolor").val('');
			$("#mycolor").css('background','#FFF');
		});
	});