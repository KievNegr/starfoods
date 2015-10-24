<script type="text/javascript" src="<?=base_url('js/check_money.js');?>"></script>
<div id="content">
	<?php echo form_open(); ?>
		<table class="table">
			<tr class="tr_header">
				<td colspan="2" class="td">
					<h4>Изменение валюты "<?php echo $val['name_money'];?>"</h4>
					<input type="submit" name="edit_money_btn" value="Сохранить" class="submit" />
				</td>
			</tr>
			<tr>
				<td class="td" style="width: 600px;">
					<p style="color: green;"><?php echo $res;?></p>
					<p>Название валюты:</p>
					<input type="text" name="edit_money_name" class="text" value="<?php echo $val['name_money'];?>" id="name_money" />			
					<p>Код:</p>
					<input type="text" name="edit_money_key" class="text" value="<?php echo $val['key_money'];?>" id="key_money" />
					<p>Курс:</p>
					<input type="text" name="edit_money_ex" class="text" value="<?php echo $val['exchange_money'];?>" id="ex_money" />
					<br />
					<input type="hidden" name="edit_money_id" value="<?php echo $val['id_money'];?>" />
				</td>
				<td class="td" valign="top">
					<div id="errors"></div>
				</td>
			</tr>
		</table>
	</form>
</div>