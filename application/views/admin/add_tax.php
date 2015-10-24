<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="header_td">
				<h4>Добавление налога</h4>
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?=$res;?></p>
				<?php echo form_open(); ?>
					<p>Налог:</p>
					<input type="text" name="name_tax" class="text" />
					<p>Ставка:</p>
					<input type="text" name="val_tax" class="text" />	
					<p>Тип ставки:</p>
					<select name="type_tax">
						<option value="1">Проценты</option>
						<option value="2">Фиксированная</option>
					</select>
					<br />
					<input type="submit" name="status_btn" value="" class="submit" />
				</form>
			</td>
			<td class="td" valign="top">
				<?php echo validation_errors(); ?>
			</td>
		</tr>
	</table>
</div>