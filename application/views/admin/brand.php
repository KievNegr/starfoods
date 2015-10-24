<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="3" class="td">
				<h4>Производители</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="40"><span class="td_text"><strong>ID</strong></span></td>
			<td class="td"><span class="td_text"><strong>Название</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Действия</strong></span></td>
		</tr>
		<?php foreach( $brand as $item ): ?>
		<tr>
			<td class="td"><span class="td_text"><?php echo $item['id_brand']; ?></span></td>
			<td class="td"><span class="td_text"><?php echo $item['name']; ?></span></td>
			<td class="td">
				<a href="<?php echo base_url('admin/brand/'.$item['id_brand']);?>" title="Изменить" class="function_link">
					<img src="<?php echo base_url('images/admin/edit.png');?>" alt="Изменить <?php echo $item['name'];?>" title="Изменить <?php echo $item['name'];?>" />
				</a>
				<a href="<?php echo base_url('admin/trash_brand/'.$item['id_brand']);?>" title="Удалить" class="function_link">
					<img src="<?php echo base_url('images/admin/trash.png');?>" alt="Удалить <?php echo $item['name'];?>" title="Удалить <?php echo $item['name'];?>" />
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>