<div id="content">
	<h1>Страница заказов</h1>
	
	<table class="table">
		<tr class="tr_header">
			<td colspan="5" class="header_td">
				<h4>Таблица последних 10 заказов</h4>
			</td>
		</tr>
		<tr>
			<td class="td"><span class="td_text"><strong>Покупатель</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Дата</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Сумма</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Состояние</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Действие</strong></span></td>
		</tr>
		<?php 
			foreach( $orders as $item ): 
			$status = $this->admin_md->get_status_order($item['key_orders']);
			$name_status = $this->admin_md->get_status($status['status']);
		?>
			<td class="td"><span class="td_text"><?=$item['name_user'];?></span></td>
			<td class="td" width="150">
				<span class="td_text">
					<?=$item['data'];?>
				</span>
			</td>
			<td class="td" width="100">
				<span class="td_text">
					<?php
						$summ = $this->admin_md->get_products_order( $item['key_orders'] );
						$price = 0;
						foreach( $summ as $all_price )
						{
							$price = $price + $all_price['price'] * $all_price['qty'];
						}
						echo $price * $view_money['exchange_money'];
					?> <?=$view_money['key_money'];?>
				</span>
			</td>
			<td class="td">
				<?php
					echo '<span class="td_text" style="border-radius: 3px; padding: 2px 3px; background: '.$name_status['color'].'">'.$name_status['name'].'</span>';
				?>
			</td>
			<td class="td" width="100"><a href="<?=base_url('admin/order/'.$item['key_orders']);?>" class="td_text">Подробнее</a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>