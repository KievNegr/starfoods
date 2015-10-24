<div id="product" class="wow fadeIn">
	<!--<ul id="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Index page</a></li>
	<?php
		foreach( $breadcrumb as $listBread )
		{
			echo '<li><a href="' . base_url('category/get/' . $listBread['rewrite']) . '">' . $listBread['name'] . '</a></li>';
		}
	?>
	<li><a href="<?php echo base_url('products/get/' . $rewrite);?>"><?php echo $products['name']; ?></a></li>
</ul><!--/breadcrumb-->
	<p class="h5 up"><?php echo $category_name; ?></p>
	<h1 class="bold wow bounceInLeft" style="margin-top: 20px;"><?php echo $products['name']; ?></h1>
	<div class="img-box">
		<?php
			$otherImg = '';
			foreach( $images as $viewImages )
			{
				if( $viewImages['img_boss'] == 1 )
				{
					$img_name = $viewImages['name'];
					//echo '<a href='.base_url('images/upload/'.$view_images['name']).'><img width="'.$settings[3]['width'].'" src="'.base_url('images/upload/'.$view_images['name']).'" class="boss"></a>';
					//echo '<div style="clear: both;"></div>';
					$background = 'url(' . base_url('images/upload/' . $img_name) . ');';
				}
				else
				{
					$otherImg .= '<li img-name="' . $viewImages['name'] . '" class="wow bounceInLeft"><img src="' . base_url('images/upload/thumbs/' . $viewImages['name']) . '" /></li>';
				}
			}
		?>
		<div class="large wow bounceIn" style="background-image: <?php echo $background;?>"data-wow-duration="2s" data-wow-delay="1s"></div>
		<ul class="list-img">
			<li img-name="<?php echo $img_name; ?>" class="active wow bounceInLeft"><img src="<?php echo base_url('images/upload/thumbs/' . $img_name);?>" /></li>
			<?php echo $otherImg; ?>
		</ul>
	</div>
	<div class="descr-box wow bounceInRight" data-wow-delay="1s">
		<?php echo $products['full_text'];?>
		<ul class="technical-data">
			<li class="weight"><?php echo $options['0']['item'];?> кг</li>
			<li class="parts"><?php echo $options['1']['item'];?></li>
			<li class="diam"><?php echo $options['2']['item'];?> см</li>
		</ul>
		<div class="buy-field">
			<span class="price"><?php echo $products['price']*$view_money['exchange_money'];?> <?=$view_money['key_money'];?></span>
			<?php 
				echo form_open();					
				if( $buy == TRUE ):
			?>
				<input type="submit" class="add-to-cart" value="Купить" />
				<?php
					else:
				?>
					<input type="button" class="in_cart" value="Уже в корзине" disabled>
			<?php
				endif;
			?>		
				<input type="hidden" value="<?php echo $products['id_product']; ?>" name="cart_id" />
				<input type="hidden" value="<?php echo $products['price']; ?>" name="cart_price" />
				<input type="hidden" value="<?php echo $products['rewrite']; ?>" name="cart_name" />
				<input type="hidden" value="<?php echo $img_name; ?>" name="cart_img" />
			</form>
		</div>
		<!--<?php
			if( $default_money['id_money'] != $view_money['id_money'] ):
		?>
		<span class="default_price"><?=$products['price'];?> <?=$default_money['key_money'];?></span>
		<br>
		<?php
			endif;

			switch($products['available'])
			{
				case 1:
					$available = 'В наличии';
					break;
				case 2:
					$available = 'Отсутствует';
					break;
				case 3:
					$available = 'Ожидается';
					break;
				case 4:
					$available = 'Снято с производства';
					break;
			}
		?>
		<p><strong>Наличие:</strong> <?php echo $available; ?></p>-->
	</div>
	<div style="clear: both;"></div>
</div>
</div><!--/wrapper-->