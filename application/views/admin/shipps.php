<div id="content">
	<h1>Управление доставкой</h1>
	<table width="100%">
		<tr>
			<td width="49%" valign="top">
				<table class="table">
					<tr class="tr_header">
						<td colspan="5" class="td">
							<h4>Варианты доставки</h4>
						</td>
					</tr>
					<tr>
						<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
						<td class="td" width="200"><span class="td_text"><strong>Вариант доставки</strong></span></td>
						<td class="td" width="100"><span class="td_text"><strong>Стоимость</strong></span></td>
						<td class="td" width="200"><span class="td_text"><strong>Последние изменения</strong></span></td>
						<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
					</tr>
					<?php 
						$i = 0;
						foreach( $delivery as $item ): 
					?>
					<tr>
						<td class="td"><span class="td_text"><?=++$i;?></span></td>
						<td class="td"><span class="td_text"><?=$item['name_shipping'];?></span></td>
						<td class="td"><span class="td_text"><?=$item['price'].' '.$view_money['key_money'];?></span></td>
						<td class="td"><span class="td_text"><?=$item['data'];?></span></td>
						<td class="td">
							<a href="<?=base_url('admin/edit_delivery/'.$item['id_shipping']);?>" title="Изменить" class="function_link">
								<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name_shipping'];?>" title="Изменить <?=$item['name_shipping'];?>" />
							</a>
							<a href="<?=base_url('admin/trash_delivery/'.$item['id_shipping']);?>" title="Удалить" class="function_link">
								<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name_shipping'];?>" title="Удалить <?=$item['name_shipping'];?>" />
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5" class="header_td" style="height: 50px;">
							<a href="<?=base_url('admin/delivery');?>" class="add_item">Добавить</a>
						</td>
					</tr>
				</table>
			</td>
			<td width="2%"></td>
			<td width="49%" valign="top">
				<table class="table">
					<tr class="tr_header">
						<td colspan="3" class="td">
							<h4>Города доставки</h4>
						</td>
					</tr>
					<tr>
						<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
						<td class="td"><span class="td_text"><strong>Населенный пункт</strong></span></td>
						<td class="td" width="150"><span class="td_text"><strong>Действие</strong></span></td>
					</tr>
					<?php 
						$i = 0;
						foreach( $city as $item ): 
					?>
					<tr>
						<td class="td"><span class="td_text"><?=++$i;?></span></td>
						<td class="td"><span class="td_text"><?=$item['name_city'];?></span></td>
						<td class="td">
							<a href="<?=base_url('admin/edit_city/'.$item['id_city']);?>" title="Изменить" class="function_link">
								<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name_city'];?>" title="Изменить <?=$item['name_city'];?>" />
							</a>
							<a href="<?=base_url('admin/trash_city/'.$item['id_city']);?>" title="Удалить" class="function_link">
								<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name_city'];?>" title="Удалить <?=$item['name_city'];?>" />
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="3" class="header_td" style="height: 50px;">
							<a href="<?=base_url('admin/city');?>" class="add_item">Добавить</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	
</div>