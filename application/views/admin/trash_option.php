<div id="content">
	<?php echo form_open();?>
	<table class="table">
		<tr class="tr_header">
			<td class="td" style="background: rgba(255, 0, 0, 0.5);">
				<h4>Удаление свойства <?php echo $option['value'];?></h4>
			</td>
		</tr>
		<tr>
			<td class="td">
				<div align="center" style="margin: 10px auto;">
					<h2>Вы действительно хотите удалить свойство "<?=$option['value'];?>"?</h2>
						<input type="submit" name="yes_btn" value="Да" class="yes_btn" />
						<input type="submit" name="no_btn" value="Нет" class="no_btn" />
					</form>
				</div>
			</td>
		</tr>
	</table>
	</form>
</div>