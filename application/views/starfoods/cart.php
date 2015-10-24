<h1>Ваша корзина</h1>
<div class="close-cart">Закрыть</div>
<?php 
	foreach($contents as $item): 
	$item = array_reverse($item);
?>
	<div class="cart">
		<div class="cart-img" style="background-image: url('<?php echo base_url('images/upload/thumbs/'.$item['options']['image']);?>');"></div><!--/cart-img-->
		<div class="cart-text">
			<p><a href="<?php echo base_url('products/get/'.$item['name']);?>"><?php echo $this->cart_md->get_name_item( $item['name'] );?></a></p>
			<p class="price"><?php echo $item['price'] * $view_money['exchange_money'];?> <?=$view_money['key_money'];?></p>
		</div><!--/cart-text-->
		<div class="cart-count">
			<div class="item-down" down-rowid="<?php echo $item['rowid'];?>"></div><!--/item-down-->
			<input type="text" value="<?php echo $item['qty'];?>" class="cart-qty" id="<?php echo $item['rowid'];?>"/>
			<input type="hidden" value="" class="text_rowid" />
			<div class="item-up" up-rowid="<?php echo $item['rowid'];?>"></div><!--/item-up-->
		</div><!--/cart-count-->
		<div class="cart-sumprice">
			<p class="cart-price"><?php echo $item['qty'] * $item['price'] * $view_money['exchange_money'];?> <?=$view_money['key_money'];?></p>
		</div><!--/cart-sumprice-->
		<div class="cart-remove">
			<div class="remove-item delete" del-rowid="<?php echo $item['rowid'];?>"></div>
		</div><!--/cart-sumprice-->
	</div><!--/cart-->
<?php endforeach; ?>
<div class="buy-from-cart">
	<div class="all-price">Сумма к оплате: <strong><?php echo $total * $view_money['exchange_money'];?> <?=$view_money['key_money'];?></strong></div>
	<div class="buy">Оформить заказ</div>
</div><!--/buy-from-cart-->