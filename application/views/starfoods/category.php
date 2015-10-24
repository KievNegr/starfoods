<div class="grid-70 right">
	<h1><?php echo $category_name;?></h1>
	<ul id="category">
		<?php foreach( $category as $item ): ?>	
			<li>
				<a href="<?=base_url('category/get/'.$item['rewrite'].'/');?>">
					<img style="height: <?=$settings[5]['height'];?>px;" src="<?=base_url('images/upload/'.$item['image']);?>" />
				</a>
				<br>
				<a href="<?=base_url('category/get/'.$item['rewrite'].'/');?>"><?=$item['name'];?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php 
		if( count( $products ) != 0 ):
			foreach( $products as $item ): 
				$image = $this->category_md->get_boss_image( $item['id_product'] );
				
				$availableInCart = Array();
				foreach( $this->cart->contents() as $in_cart )
				{
					$availableInCart[] = $in_cart['id'];
				}
				$buy = TRUE;
				if( in_array($item['id_product'], $availableInCart) )
				{
					$buy = FALSE;
					$background = 'style="background-color: #F5F5F5"';
					$opacity = 'opacity: .3;';
					$opacityLink = 'style="opacity: 1"';
				}
				else
				{
					$background = '';
					$opacity = '';
					$opacityLink = '';
				}
	?>
		
		<div class="item new" <?php echo $background; ?>>
			<div class="item-prew" style="<?php echo $opacity; ?> background-image: url('<?php echo base_url('images/upload/'.$image['name']);?>');"></div><!--/item-prew-->
			<div class="item-info">
				<div class="item-link" <?php echo $opacityLink; ?>>
					<?php echo form_open();?>
						<?php
							if( $buy == FALSE ):
						?>
							<input type="button" class="in_cart" value="Уже в корзине" disabled>
						<?php
							else:
						?>
							<input type="submit" class="add-to-cart" value="Add to Cart">
						<?php
							endif;
						?>
						<input type="hidden" value="<?=$item['rewrite'];?>" name="cart_name" />
						<input type="hidden" value="<?=$item['price'];?>" name="cart_price" />
						<input type="hidden" value="<?=$item['id_product'];?>" name="cart_id" />
						<input type="hidden" value="<?=$image['name'];?>" name="cart_img" />
					</form>
					<div style="clear: both;"></div>
					<a href="<?=base_url('products/get/'.$item['rewrite']);?>" class="go-to-product">Show item</a>
				</div>
				<div class="item-text">
					<h3><?php echo $item['name'];?></h3>
					<p class="price"><?=$item['price']*$view_money['exchange_money'];?> <?=$view_money['key_money'];?></p>
					<?php
						if( $default_money['id_money'] != $view_money['id_money'] ):
					?>
					<p class="default_price">(<?=$item['price'];?> <?=$default_money['key_money'];?>)</p>
					<?php
						endif;
					?>
				</div>
			</div><!--/new-item-info-->
		</div><!--/new-item-->
	<?php 
			endforeach;
		endif;
	?>
			

	<input type="hidden" id="input_category" value="<?=$input_category;?>">

</div><!--/grid-70-->

<div style="clear: both;"></div>
</div><!--/content-->
</div><!--/wrapper-->