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
				<h4>Добавление новой производителя</h4>
				<input type="submit" name="brand_btn" value="Сохранить" class="submit" disabled />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p>Название производителя:</p>
				<input type="text" name="brand_name" id="brand_name" class="text" />
				<!--<p>Логотип (max: 300 kb, 1024x768):</p>
				<input type="file" name="userfile" class="text" id="logo_img" />-->
			</td>
		</tr>
	</table>
	</form>
</div>
<div id="errors"></div>