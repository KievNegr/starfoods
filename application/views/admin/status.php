<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="6" class="td">
				<h4>Управление состояниями заказа</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td" ><span class="td_text"><strong>Название статуса</strong></span></td>
			<td class="td" width="170"><span class="td_text"><strong>Последние изменения</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
		</tr>
		<?php 
			$i = 0;
			foreach( $status as $item ):
		?>
			<tr>
				<td class="td"><span class="td_text"><?=++$i;?></span></td>
				<td class="td"><span class="td_text"><?=$item['name'];?></span></td>
				<td class="td"><span class="td_text"><?=$item['data'];?></span></td>
				<td class="td">
					<a href="<?=base_url('admin/edit_status/'.$item['id_status']);?>" title="Изменить" class="function_link">
						<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name'];?>" title="Изменить <?=$item['name'];?>" />
					</a>
					<a href="<?=base_url('admin/trash_status/'.$item['id_status']);?>" title="Удалить" class="function_link">
						<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name'];?>" title="Удалить <?=$item['name'];?>" />
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/add_status');?>" class="add_item" id="add_money">Добавить</a>
			</td>
		</tr>
	</table>
</div>