<?php
	$i = 0;
	foreach($product as $item):
		switch($i){
			case 0:
				$anim = 'bounceInLeft';
				break;
			case 1:
				$anim = 'bounceInUp';
				break;
			case 2:
				$anim = 'bounceInRight';
				break;
		}
?>
	<div class="item wow <?php echo $anim;?>" data-wow-duration="2s">
		<a href="<?php echo base_url('products/get/' . $item['rewrite'] . '.html');?>">
			<h3 class="center"><?php echo $item['categoryName'];?><br /><span class="name-item"><?php echo $item['name'];?></span></h3>
			<?php echo $item['text'];?>
			<div class="img">
				<img src="<?php echo base_url('images/upload/' . $item['img']);?>" />
			</div>
			<!--<p class="weight">1000 гр.</p>-->
		</a>
		<div class="buy-form">
			<form action="<?php echo base_url();?>" method="post" accept-charset="utf-8">	
			<?php 
				if( $item['buy'] == TRUE ):
			?>
				<input type="submit" value="Купить" />
			<?php
			else:
			?>
				<input type="button" class="in_cart" value="Уже в корзине" disabled>
			<?php
				endif;
			?>	

			<input type="hidden" value="<?php echo $item['id_product']; ?>" name="cart_id" />
			<input type="hidden" value="<?php echo $item['price']; ?>" name="cart_price" />
			<input type="hidden" value="<?php echo $item['rewrite']; ?>" name="cart_name" />
			<input type="hidden" value="<?php echo $item['img']; ?>" name="cart_img" />
			</form>
			<p class="price"><?php echo $item['price']*$view_money['exchange_money'];?> <?=$view_money['key_money'];?></p>
		</div>
	</div>
<?php
	if($i == 2)
	{
		$i = 0;
		echo '<div style="clear: both;"></div>';
	}
	else
	{
		$i++;
	}
	endforeach;
?>
<div style="clear: both;"></div>