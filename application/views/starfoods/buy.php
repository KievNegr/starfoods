<script type="text/javascript">
	$(document).ready(function()
	{
		delivery = 0;
		
		$("#buy_pay").change(function()
		{
			key = $(this).val();
			$.post('my_cart/pay_change', {key: key}, keyok);
		});
		
		function keyok(data)
		{
			price = (parseInt($("#total").val()) * parseInt(data)) / 100 + parseInt($("#total").val());
			$("#total_sum").text(price);
			total = price + delivery;
			$("#total_sum_width_del").text(total);
		}
		
		$("#buy_shipping").change(function()
		{
			key = $(this).val();
			$.post('my_cart/delivery_change', {key: key}, deliv_ok);
		});
		
		function deliv_ok(data)
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
				$('#name_buy').css('border-color','#FF0000');
				error = 1;
			}
			else
			{
				$('#name_buy').css('border-color','#028b15');
			}
			
			if( phone.length == 0 )
			{
				$('#phone_buy').css('border-color','#FF0000');
				error = 1;
			}
			else
			{
				$('#phone_buy').css('border-color','#028b15');
			}
			
			if( street.length == 0 )
			{
				$('#buy_street').css('border-color','#FF0000');
				error = 1;
			}
			else
			{
				$('#buy_street').css('border-color','#028b15');
			}
			
			if( build.length == 0 )
			{
				$('#buy_build').css('border-color','#FF0000');
				error = 1;
			}
			else
			{
				$('#buy_build').css('border-color','#028b15');
			}
			
			if( office.length == 0 )
			{
				$('#buy_appart').css('border-color','#FF0000');
				error = 1;
			}
			else
			{
				$('#buy_appart').css('border-color','#028b15');
			}
			
			if( error == 0 )
			{
				$.post('my_cart/reg', {
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
		
		function ok(data)
		{
			$("#show_cart").load("<?=base_url("my_cart/succes");?>");
		}
	});
</script>

<div id="cart_center">
	<h1>Оформление заказа</h1>
	<fieldset>
		<legend>Контактные данные</legend>
		<p>ФИО*</p>
		<input type="text" id="name_buy" class="buy_text" />
		<p>Телефон*:</p>
		<td><input type="text" id="phone_buy" class="buy_text" />
		<p>E-mail:</p>
		<input type="text" id="mail_buy" class="buy_text" />
		<p>Факс:</p>
		<input type="text" id="fax_buy" class="buy_text" />
   </fieldset>
   
   	<fieldset id="adress">
		<legend>Адрес доставки</legend>
		<p>Город</p>
		<select id="buy_city">
			<?php foreach( $city as $name_city ): ?>
				<option value="<?=$name_city['id_city'];?>"><?=$name_city['name_city'];?></option>
			<?php endforeach; ?>
		</select>
		<p>Улица*</p>
		<input type="text" id="buy_street" class="buy_text" />
		<p>Дом*</p>
		<input type="text" id="buy_build" class="buy_text" />
		<p>Квартира(офис)*</p>
		<input type="text" id="buy_appart" class="buy_text" />
   </fieldset>
   
   <div style="clear: both;"></div>
   
    <fieldset style="width: 538px; margin-right: 5px;">
		<legend>Доставка и оплата</legend>
		<p>Способ доставки</p>
		<div class="show_item_buy">
			<select id="buy_shipping">
				<?php foreach( $delivery as $item ): ?>
					<option value="<?=$item['id_shipping'];?>"><?=$item['name_shipping'];?></option>
				<?php endforeach; ?>
			</select>
			<p>Вариант оплаты</p>
			<select id="buy_pay">
				<?php foreach( $pay as $item ): ?>
					<option value="<?=$item['id_pay'];?>"><?=$item['name_pay'];?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="show_item_price">
			<input type="hidden" value="<?=$total;?>" id="total" />
			<p style="color: #01085d; margin-top: -5px;">Товаров на сумму: <span id="total_sum"><?=$total * $view_money['exchange_money'];?></span> <?=$view_money['key_money'];?></p>
			<p style="color: #01085d;">Доставка: <span id="deliv_sum">0</span> <?=$view_money['key_money'];?></p>
			<p style="color: #01085d;">Сумма к оплате: <span id="total_sum_width_del"><?=$total * $view_money['exchange_money'];?></span> <?=$view_money['key_money'];?></p>
		</div>
   </fieldset>
   <div id="set_order">Оформить заказ</div>

</div>