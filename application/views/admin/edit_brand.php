<script type="text/javascript" src="<?php echo base_url('js/check_brand.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		var err = '<?php echo $error_file;?>';
		if( err.length > 0 )
		{
			$("#errors").html('<?php echo $error_file;?>');
			$("#errors").css({'left': $("#logo_img").offset().left + 510, 'top': $("#logo_img").offset().top - 20});
			$("#errors").fadeIn(500);
		}
	});
</script>
<div id="content">
	<?php echo form_open_multipart(); ?>
	<table class="table">
		<tr class="tr_header">
			<td class="td">
				<h4>Изменение производителя</h4>
				<input type="submit" name="brand_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $notify;?></p>
				<p>Название производителя:</p>
				<input type="text" name="brand_name" id="brand_name" value="<?php echo $get_brand['name'];?>" class="text" />
				<!--<p><img src="<?php echo base_url('images/upload/'.$get_brand['image']);?>" /></p>
				<p>Логотип (max: 300 kb, 1024x768):</p>
				<input type="file" name="userfile" class="text" id="logo_img"/>-->
				<input type="hidden" name="brand_id" value="<?php echo $get_brand['id_brand'];?>" />	
			</td>
		</tr>
	</table>
	</form>
</div>
<div id="errors"></div>