				<?=form_open();?>
					<div class="list_item_category">
						<div style="padding: 0 10px 10px 0; width: <?=$settings[2]['width'];?>px; float: left; text-align: center;">
							<img style="width: <?=$settings[2]['width'];?>px; max-width: 100%;" src="<?=base_url('images/upload/'.$image['name']);?>" alt="<?=$item['name'];?>" title="<?=$item['name'];?>">
						</div>
						<div class="item_description">
							<a href="<?=base_url('products/get/'.$item['rewrite'].'/');?>" class="item_link"><?=$item['name'];?></a>
							<br>
							<div style="float: left; margin: 10px 20px 0 20px; height: 44px;">
								<p class="price"><?=$item['price']*$view_money['exchange_money'];?> <?=$view_money['key_money'];?></p>
								<?php
									if( $default_money['id_money'] != $view_money['id_money'] ):
								?>
								<p class="default_price">(<?=$item['price'];?> <?=$default_money['key_money'];?>)</p>
								<?php
									endif;
								?>
							</div>
							<div style="margin: 10px 0 10px 0; height: 44px;">
								<?php
									foreach( $this->cart->contents() as $in_cart )
									{
										if( $in_cart['id'] == $item['id_product'] )
										{
											$buy = FALSE;
										}
									}
									if( $buy == FALSE ):
								?>
								<input type="button" class="in_cart" value="Уже в корзине" disabled>
								<?php
									else:
								?>
									<input type="submit" class="add_cart" value="Купить">
								<?php
									endif;
									$buy = TRUE;
								?>
							</div>
							
							<p class="prev_text"><?=$item['text'];?></p>
							<input type="hidden" value="<?=$item['rewrite'];?>" name="cart_name" />
							<input type="hidden" value="<?=$item['price'];?>" name="cart_price" />
							<input type="hidden" value="<?=$item['id_product'];?>" name="cart_id" />
							<input type="hidden" value="<?=$image['name'];?>" name="cart_img" />
							
						</div>
						<div style="clear: both;"></div>
					</div>
					
				</form>