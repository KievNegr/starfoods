<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="4" class="td">
				<h4>Управлене свойствами</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td"><span class="td_text"><strong>Название свойства</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Действия</strong></span></td>
		</tr>
		<?php foreach( $options as $item ): ?>
		<tr>
			<td class="td" width="30"><span class="td_text"><?php echo $item['id']; ?></span></td>
			<td class="td"><span class="td_text"><?php echo $item['value']; ?></span></td>
			<td class="td">
				<a href="<?=base_url('admin/edit_option/'.$item['id']);?>" title="Изменить" class="function_link">
					<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['value'];?>" title="Изменить <?=$item['value'];?>" />
				</a>
				<a href="<?=base_url('admin/trash_option/'.$item['id']);?>" title="Удалить" class="function_link">
					<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['value'];?>" title="Удалить <?=$item['value'];?>" />
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>