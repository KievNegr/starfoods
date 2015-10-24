<div id="content">
	<?php echo form_open();?>
	<table class="table">
		<tr class="tr_header">
			<td class="td" style="background: rgba(255, 0, 0, 0.5);">
				<h4>Удаление <?php echo $pages['title'];?></h4>
			</td>
		</tr>
		<tr>
			<td class="td">
				<div align="center" style="margin: 10px auto;">
					<h2>Вы действительно хотите удалить "<?php echo $pages['title'];?>"?</h2>
					<input type="submit" name="yes_btn" value="Да" class="yes_btn" />
					<input type="submit" name="no_btn" value="Нет" class="no_btn" />
				</div>
			</td>
		</tr>
	</table>
	</form>
</div>