<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td class="header_td" style="background: red;">
				<h4>Удаление <?=$city['name_city'];?></h4>
			</td>
		</tr>
		<tr>
			<td class="td">
				<div align="center" style="margin: 10px auto;">
					<h2>Вы действительно хотите удалить "<?=$city['name_city'];?>"?</h2>
					<?=form_open();?>
					<input type="submit" name="yes_btn" value="" class="yes_btn" />
					<input type="hidden" name="delete" value="yes" />
					</form>
					<?=form_open();?>
					<input type="submit" name="no_btn" value="" class="no_btn" />
					<input type="hidden" name="delete" value="no" />
					</form>
				</div>
			</td>
		</tr>
	</table>
</div>