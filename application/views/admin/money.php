<script type="text/javascript" src="<?=base_url('js/check_money.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
		<table class="table">
			<tr class="tr_header">
				<td colspan="2" class="td">
					<h4>Добавление валюты</h4>
					<input type="submit" name="money_btn" value="Сохранить" class="submit" disabled />
				</td>
			</tr>
			<tr>
				<td class="td" style="width: 600px;">
					<p style="color: green;"><?php echo $res;?></p>
					<p>Название валюты:</p>
					<input type="text" name="money_name" class="text" id="name_money" />			
					<p>Код:</p>
					<input type="text" name="money_key" class="text" id="key_money" />
					<p>Курс:</p>
					<input type="text" name="money_ex" class="text" id="ex_money" />
					<p>По умолчанию: <input type="checkbox" name="money_check" /></p>
				</td>
				<td class="td" valign="top">
					<?php echo validation_errors(); ?>
					<div id="errors"></div>
				</td>
			</tr>
		</table>
	</form>
</div>