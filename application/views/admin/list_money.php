<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="6" class="td">
				<h4>Управление валютой</h4>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td" ><span class="td_text"><strong>Название валюты</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Код валюты</strong></span></td>
			<td class="td" width="50"><span class="td_text"><strong>Курс</strong></span></td>
			<td class="td" width="170"><span class="td_text"><strong>Последние изменения</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
		</tr>
		<?php 
			$i = 0;
			foreach( $money as $item ): 
			if( $item['default_money'] == 1 )
			{
				$default_money = '<small>(Валюта по умолчанию)</small>';
			}
			else
			{
				$default_money = '';
			}
			
			if( $item['view_money'] == 1 )
			{
				$view_money = '<small>(Валюта отображения)</small>';
			}
			else
			{
				$view_money = '';
			}
		?>
			<tr>
				<td class="td"><span class="td_text"><?=++$i;?></span></td>
				<td class="td"><span class="td_text"><?=$item['name_money'].' '.$default_money.' '.$view_money;?></span></td>
				<td class="td"><span class="td_text"><?=$item['key_money'];?></span></td>
				<td class="td"><span class="td_text"><?=$item['exchange_money'];?></span></td>
				<td class="td"><span class="td_text"><?=$item['data'];?></span></td>
				<td class="td">
					<a href="<?=base_url('admin/edit_money/'.$item['id_money']);?>" title="Изменить" class="function_link">
						<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name_money'];?>" title="Изменить <?=$item['name_money'];?>" />
					</a>
					<a href="<?=base_url('admin/trash_money/'.$item['id_money']);?>" title="Удалить" class="function_link">
						<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name_money'];?>" title="Удалить <?=$item['name_money'];?>" />
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/money');?>" class="add_item" id="add_money">Добавить</a>
			</td>
		</tr>
	</table>
</div>