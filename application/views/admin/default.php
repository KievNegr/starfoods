<div id="content">
	<h1>Заказы</h1>
	<table class="table">
		<tr class="tr_header">
			<td class="td"><span class="td_text"><strong>ID</strong></span></td>
			<td class="td"><span class="td_text"><strong>Покупатель</strong></span></td>
			<td class="td"><span class="td_text"><strong>Дата</strong></span></td>
			<td class="td"><span class="td_text"><strong>Сумма</strong></span></td>
			<td class="td"><span class="td_text"><strong>Состояние</strong></span></td>
		</tr>
		<?php 
			foreach( $orders as $item ): 
			$status = $this->admin_md->get_status_order($item['key_orders']);
			$name_status = $this->admin_md->get_status($status['status']);
		?>
			<td class="td"><a href="<?php echo base_url('admin/order/'.$item['key_orders']);?>"><?php echo $item['id_user'];?></a></td>
			<td class="td"><span class="td_text"><?php echo $item['name_user'];?></span></td>
			<td class="td">
				<span class="td_text">
					<?php echo $item['data'];?>
				</span>
			</td>
			<td class="td">
				<span class="td_text">
					<?php
						$summ = $this->admin_md->get_products_order( $item['key_orders'] );
						$price = 0;
						foreach( $summ as $all_price )
						{
							$price = $price + $all_price['price'] * $all_price['qty'];
						}
						echo $price * $view_money['exchange_money'];
					?> <?php echo $view_money['key_money'];?>
				</span>
			</td>
			<td class="td">
				<?php
					echo '<span class="td_text" style="border-radius: 3px; padding: 4px 10px; background: '.$name_status['color'].'">'.$name_status['name'].'</span>';
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>