<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="5" class="td">
				<h4>Управление платежами</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td" ><span class="td_text"><strong>Вид платежа</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Наценка, %</strong></span></td>
			<td class="td" width="200"><span class="td_text"><strong>Последние изменения</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
		</tr>
		<?php 
			$i = 0;
			foreach( $pay as $item ): 
		?>
			<tr>
				<td class="td"><span class="td_text"><?=++$i;?></td>
				<td class="td"><span class="td_text"><?=$item['name_pay'];?></td>
				<td class="td"><span class="td_text"><?=$item['markup'];?></td>
				<td class="td"><span class="td_text"><?=$item['data'];?></td>
				<td class="td">
					<a href="<?=base_url('admin/edit_pay/'.$item['id_pay']);?>" title="Изменить" class="function_link">
						<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name_pay'];?>" title="Изменить <?=$item['name_pay'];?>" />
					</a>
					<a href="<?=base_url('admin/trash_pay/'.$item['id_pay']);?>" title="Удалить" class="function_link">
						<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name_pay'];?>" title="Удалить <?=$item['name_pay'];?>" />
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/pay');?>" class="add_item" id="add_payment">Добавить</a>
			</td>
		</tr>
	</table>
</div>