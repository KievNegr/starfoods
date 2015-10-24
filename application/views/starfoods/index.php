	<div id="cake" class="wow bounceInLeft" data-wow-duration="2s" ></div>
	<div id="cake-center" class="wow bounceInRight" data-wow-duration="2s">
		<div class="candle1 wow bounceInDown" data-wow-duration="2s"></div>
		<div class="candle2 wow ZoomIn" data-wow-duration="2s"></div>
		<div class="candle3 wow bounceInRight" data-wow-duration="2s"></div>
		<div class="candle4 wow ZoomIn" data-wow-duration="2s"></div>
		<div class="candle5 wow bounceInUp" data-wow-duration="2s"></div>
		<div class="candle6 wow ZoomIn" data-wow-duration="2s"></div>
		<div class="candle7 wow bounceInLeft" data-wow-duration="2s"></div>
		<div class="candle8 wow ZoomIn" data-wow-duration="2s"></div>
		<div class="center wow bounceIn" data-wow-duration="2s"></div>
	</div>
	<div id="shadow-1" class="wow fadeIn" data-wow-delay="2s"></div>
	<div id="shadow-2" class="wow fadeIn" data-wow-delay="2s"></div>
	<div id="round"></div>
	<div id="catalog">
		<h2 class="center" style="color: #6D8253;">Каталог тiртикiв</h2>
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
					<input type="button" value="Купить" />
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
		<div class="more-load"></div>
		<div style="clear: both;"></div>
		<div class='uil-ring-css' style='-webkit-transform:scale(0.36)'><div></div></div>
		<?php
			if(($countItems - 3) > 3)
			{
				$countCake = 3;
			}
			else
			{
				$countCake = $countItems - 3;
			}
		?>
		<div class="more-load-button">Загрузить еще <span class="countCake" count="<?php echo $countCake; ?>"><?php echo $countCake; ?></span> тортов</div>
		<div style="clear: both;"></div>
		<input type="hidden" id="free" value="<?php echo $countItems; ?>" />
		<input type="hidden" id="from" value="3" />
	</div>

	<div id="round2"></div>
	<div id="adv-field">
		<h2 class="center">О преимуществаХ</h2>
		<ul>
			<li class="frozen wow bounceInRight" data-wow-duration="2s">
				<p>Тут какая-то текстовочка для описания преимущества тортов и еще какой-то текст что б просто тут заполнить пространство блока и еще раз напишем, что тут 		преимущество.</p>
				<p>Можно еще начать текст с нового абзаца, что б было видно какое-то разделение текста. После точки, с началом нового предложения можнон еще раз упомянуть.</p>
			</li>
			<li class="frozen wow bounceInLeft" data-wow-duration="2s">
				<p>Тут какая-то текстовочка для описания преимущества тортов и еще какой-то текст что б просто тут заполнить пространство блока и еще раз напишем, что тут 		преимущество.</p>
				<p>Можно еще начать текст с нового абзаца, что б было видно какое-то разделение текста. После точки, с началом нового предложения можнон еще раз упомянуть.</p>
			</li>
		</ul>
	</div>
</div>