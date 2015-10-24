<script type="text/javascript" src="<?=base_url('js/check_delivery.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Изменение варианта доставки "<?php echo $delivery['name_shipping'];?>"</h4>
				<input type="submit" name="delivery_btn" value="Сохранить" class="submit" disabled />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<p>Название доставки:</p>
				<input type="text" name="edit_delivery_name" id="name_delivery" class="text" value="<?php echo $delivery['name_shipping'];?>" />			
				<p>Стоимость доставки <small title="Валюта по умолчанию">(<?php echo $view_money['name_money'];?>)</small>:</p>
				<input type="text" name="edit_delivery_price" id="price_delivery" class="text" value="<?php echo $delivery['price'];?>" />
				<br />
				<input type="hidden" name="edit_delivery_id" value="<?php echo $delivery['id_shipping'];?>" />
			</td>
			<td class="td" valign="top">
				<div id="errors"></div>
			</td>
		</tr>
	</table>
	</form>
</div>