<script type="text/javascript">
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
			
			name_delivery = $(this).val();
			$.ajax({
				type:'post',
				url:'<?php echo base_url('admin/check_delivery/');?>',
				data:{'name': name_delivery},
				success: function(data)
				{
					if( data == 1 )
					{
						name = 0;
						$(this).css('border','1px solid #b20303');
						$("#errors").fadeIn(300);
						$("#errors").html('Такой вариант доставки уже существует!');
						$(".submit").prop("disabled", true);
					}
				}
			});
			
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
</script>
<div id="content">
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Добавление варианта доставки</h4>
				<input type="submit" name="delivery_btn" value="Сохранить" class="submit" disabled />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<p>Название доставки:</p>
				<input type="text" name="delivery_name" id="name_delivery" class="text" />			
				<p>Стоимость доставки <small title="Валюта по умолчанию">(<?php echo $view_money['name_money'];?>)</small>:</p>
				<input type="text" name="delivery_price" id="price_delivery" class="text" value="0" />
			</td>
			<td class="td" valign="top">
				<div id="errors"></div>
			</td>
		</tr>
	</table>
	</form>
</div>