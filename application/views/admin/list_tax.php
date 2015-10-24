<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="5" class="header_td">
				<h4>Управление Налогами</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td" ><span class="td_text"><strong>Налог</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Ставка</strong></span></td>
			<td class="td" width="200"><span class="td_text"><strong>Тип ставки</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
		</tr>
		<?php 
			$i = 0;
			foreach( $tax as $item ): 
		?>
			<tr>
				<td class="td"><span class="td_text"><?=++$i;?></td>
				<td class="td"><span class="td_text"><?=$item['name'];?></td>
				<td class="td"><span class="td_text"><?=$item['tax_val'];?></td>
				<td class="td"><span class="td_text">
				<?php
					if( $item['type'] == 1 )
					{
						echo '%';
					}
					else
					{
						echo 'фиксированная ставка';
					}
				?>
				</td>
				<td class="td">
					<a href="<?=base_url('admin/edit_tax/'.$item['id_tax']);?>" title="Изменить" class="function_link">
						<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name'];?>" title="Изменить <?=$item['name'];?>" />
					</a>
					<a href="<?=base_url('admin/trash_tax/'.$item['id_tax']);?>" title="Удалить" class="function_link">
						<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name'];?>" title="Удалить <?=$item['name'];?>" />
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/add_tax');?>" class="add_item" id="add_payment">Добавить</a>
			</td>
		</tr>
	</table>
</div>