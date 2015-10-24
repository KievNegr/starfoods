<script type="text/javascript" src="<?=base_url('js/check_pay.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Добавление варианта платежа</h4>
				<input type="submit" name="pay_btn" value="Сохранить" class="submit" disabled />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?=$res;?></p>
				<p>Вид платежа:</p>
				<input type="text" name="pay_name" id="name_pay" class="text" />			
				<p>Наценка %:</p>
				<input type="text" name="pay_markup" id="mark_pay" class="text" value="0" />
			</td>
			<td class="td" valign="top">
				<div id="errors"></div>
			</td>
		</tr>
	</table>
	</form>
</div>