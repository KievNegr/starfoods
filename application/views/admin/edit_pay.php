<script type="text/javascript" src="<?=base_url('js/check_pay.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td class="td">
				<h4>Изменение варианта оплаты "<?php echo $pay['name_pay'];?>"</h4>
				<input type="submit" name="pay_btn" value="Сохранить" class="submit" disabled />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<p>Вид платежа:</p>
				<input type="text" name="edit_pay_name" id="name_pay" class="text" value="<?php echo $pay['name_pay'];?>" />			
				<p>Наценка %:</p>
				<input type="text" name="edit_pay_markup" id="mark_pay" class="text" value="<?php echo $pay['markup'];?>" />
				<br />
				<input type="hidden" name="edit_pay_id" class="text" value="<?php echo $pay['id_pay'];?>" />
			</td>
		</tr>
	</table>
	</form>
</div>
<div id="errors"></div>