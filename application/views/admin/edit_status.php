<script type="text/javascript">
$(document).ready(function()
	{
		name = 1;
		
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
			
			nameStatus = $(this).val();

			$.ajax({
				type:'post',
				url:'<?php echo base_url('admin/check_status/');?>',
				data:{'name': nameStatus},
				success: function(data)
				{
					if( data == 1 )
					{
						name = 0;
						$(this).css('border','1px solid #b20303');
						$("#errors").fadeIn(300);
						$("#errors").html('Такое навание уже существует!');
						$(".submit").prop("disabled", true);
					}
				}
			});

			check();

			$('#preview').html(nameStatus);
		});
		
		function check()
		{
			if( name == 1 )
			{
				$(".submit").prop("disabled", false);
			}
		}
		
		setInterval(preview, 1000);

		function preview()
		{
			$('#preview').css({'background-color': $('#mycolor').val(), 'color': $('#text-color').val()});
		}
	});
</script>
<script type="text/javascript" src="<?php echo base_url('js/admin/iColorPicker.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
	<input type="hidden" name="status_id" value="<?php echo $status['id_status']; ?>" />
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Изменение состояния заказа</h4>
				<input type="submit" name="status_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<p>Название состояния заказа:</p>
				<input type="text" name="name" id="name_status" value="<?php echo $status['name'];?>" class="text" />
				<p>Цвет:</p>
				<input type="text" name="color" style="background: <?php echo $status['color'];?>" value="<?php echo $status['color'];?>" class="iColorPicker text" id="mycolor" />
				<p>Текст:</p>
				<input type="text" name="textcolor" class="iColorPicker text" id="text-color" style="background-color: <?php echo $status['textcolor'];?>" value="<?php echo $status['textcolor'];?>" />
				<br />
				<span style="margin: 15px 0 0 0; float: left; border-radius: 3px; padding: 4px 10px; background-color: <?php echo $status['color'];?>; color: <?php echo $status['textcolor'];?>" id="preview"><?php echo $status['name'];?></span>
			</td>
			<td class="td" valign="top">
				<div id="errors"></div>
			</td>
		</tr>
	</table>
	</form>
</div>