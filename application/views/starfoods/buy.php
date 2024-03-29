<script type="text/javascript">
	$(document).ready(function()
	{
		delivery = 0;
		
		$("#buy_pay").change(function()
		{
			key = $(this).val();
			$.post('http://starfoods/my_cart/pay_change', {key: key}, keyok);
		});
		
		function keyok(data)
		{
			$("#total_sum").text(parseInt(data));
			total = parseInt(data) + delivery;
			$("#total_sum_width_del").text(total);
		}
		
		$("#buy_shipping").change(function()
		{
			key = $(this).val();
			$.post('http://starfoods/my_cart/delivery_change', {key: key}, delivOk);
		});
		
		function delivOk(data)
		{
			delivery = parseInt(data);
			$("#deliv_sum").text(data);
			sum = parseInt($("#total_sum").text()) + delivery;
			$("#total_sum_width_del").text(sum);
		}
		
		$('#set_order').click(function()
		{
			error = 0;
			name = $('#name_buy').val();
			phone = $('#phone_buy').val();
			mail = $('#mail_buy').val();
			fax = $('#fax_buy').val();
			city = $('#buy_city').val();
			street = $('#buy_street').val();
			build = $('#buy_build').val();
			office = $('#buy_appart').val();
			pay = $('#buy_pay').val();
			ship = $('#buy_shipping').val();
			
			if( name.length == 0 )
			{
				$('#name_buy').css('box-shadow',' inset 0 0 5px #FF0000');
				error = 1;
			}
			else
			{
				$('#name_buy').css('box-shadow',' inset 0 0 5px rgba(0, 0, 0, 0.15)');
			}
			
			if( phone.length == 0 )
			{
				$('#phone_buy').css('box-shadow',' inset 0 0 5px #FF0000');
				error = 1;
			}
			else
			{
				$('#phone_buy').css('box-shadow',' inset 0 0 5px rgba(0, 0, 0, 0.15)');
			}
			
			if( street.length == 0 )
			{
				$('#buy_street').css('box-shadow',' inset 0 0 5px #FF0000');
				error = 1;
			}
			else
			{
				$('#buy_street').css('box-shadow',' inset 0 0 5px rgba(0, 0, 0, 0.15)');
			}
			
			if( build.length == 0 )
			{
				$('#buy_build').css('box-shadow',' inset 0 0 5px #FF0000');
				error = 1;
			}
			else
			{
				$('#buy_build').css('box-shadow',' inset 0 0 5px rgba(0, 0, 0, 0.15)');
			}
			
			if( error == 0 )
			{
				$.post('http://starfoods/my_cart/reg', {
				name_buy:name, 
				phone_buy:phone, 
				mail_buy:mail, 
				fax_buy:fax, 
				buy_city:city, 
				buy_street:street,
				buy_build:build,
				buy_appart:office,
				buy_pay:pay,
				buy_shipping:ship
				}, ok);
			}
		});
		
		function ok()
		{
			$("#show-cart").load('<?php echo base_url("my_cart/succes");?>');
		}
	});
</script>

<div id="cart-center">
	<p class="h5 up">Последний шаг</p>
	<h1>Оформление заказа</h1>
	<div class="close-cart">Закрыть</div>
	<div class="left">
		<legend>Контактные данные</legend>
		<input type="text" id="name_buy" class="buy_text" placeholder="Имя*" />
		<input type="text" id="phone_buy" class="buy_text" placeholder="Телефон*" />
		<input type="text" id="mail_buy" class="buy_text" placeholder="E-mail" />
		<input type="text" id="fax_buy" class="buy_text" placeholder="Факс" />

		<legend>Адрес доставки</legend>
		<select id="buy_city">
			<?php foreach( $city as $name_city ): ?>
				<option value="<?=$name_city['id_city'];?>"><?=$name_city['name_city'];?></option>
			<?php endforeach; ?>
		</select>
		<input type="text" id="buy_street" class="buy_text" placeholder="Улица*" />
		<input type="text" id="buy_build" class="buy_text" placeholder="Дом*" />
		<input type="text" id="buy_appart" class="buy_text" placeholder="Квартира(офис)" />
   </div>
   
  <div class="right">
		<legend>Доставка и оплата</legend>
		<div class="show_item_buy">
			<select id="buy_shipping">
				<?php foreach( $delivery as $item ): ?>
					<option value="<?=$item['id_shipping'];?>"><?=$item['name_shipping'];?></option>
				<?php endforeach; ?>
			</select>
			<select id="buy_pay">
				<?php foreach( $pay as $item ): ?>
					<option value="<?=$item['id_pay'];?>"><?=$item['name_pay'];?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="show_item_price">
			<input type="hidden" value="<?=$total;?>" id="total" />
			<p class="result">Товаров на сумму: <span id="total_sum"><?=$total * $view_money['exchange_money'];?></span> <?=$view_money['key_money'];?></p>
			<p class="result">Доставка: <span id="deliv_sum">0</span> <?=$view_money['key_money'];?></p>
			<p class="result">Сумма к оплате: <span id="total_sum_width_del"><?=$total * $view_money['exchange_money'];?></span> <?=$view_money['key_money'];?></p>
		</div>
		<div id="set_order">Подтвердить заказ</div>
   </div>
   <div style="clear:both;"></div>
   <div class="cart-back">‹ Предыдущий шаг</div>
</div>