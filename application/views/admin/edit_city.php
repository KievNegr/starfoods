<script type="text/javascript" src="<?=base_url('js/check_city.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="header_td">
				<h4>Изменение города "<?php echo $city['name_city'];?>"</h4>
				<input type="submit" name="city_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<p>Город:</p>
				<input type="text" name="edit_city_name" id="name_city" class="text" value="<?php echo $city['name_city'];?>" />			
				<br />
				<input type="hidden" name="edit_city_id" value="<?php echo $city['id_city'];?>" />
			</td>
			<td class="td" valign="top">
				<div id="errors"></div>
			</td>
		</tr>
	</table>
	</form>
</div>