<script type="text/javascript" src="<?php echo base_url('js/check_order.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function()
	{	
		$("#buy_city [value=<?php echo $order['city_user'];?>]").attr("selected", "selected");
		$("#buy_pay [value=<?php echo $order['pay_user'];?>]").attr("selected", "selected");
		$("#buy_shipping [value=<?php echo $order['ships_user'];?>]").attr("selected", "selected");
		$("#buy_status [value=<?php echo $status['status'];?>]").attr("selected", "selected");
		
		var id_order = '<?php echo $order['key_orders'];?>';
		var delivery = [];
		<?php
			foreach( $delivery as $item ):
		?>
			delivery[<?php echo $item['id_shipping'];?>] = <?php echo $item['price'];?>;
		<?php
			endforeach;
		?>
		
		$("#buy_shipping").change(set_delivery);
		
		set_delivery();
		
		function set_delivery()
		{
			price_delivery = $("#buy_shipping").val();
			price_del = delivery[price_delivery];
			$("#price_delivery").html(price_del);
			sumary_price();
		}
		
		var pay = [];
		<?php
			foreach( $pay as $item ):
		?>
			pay[<?php echo $item['id_pay'];?>] = <?php echo $item['markup'];?>;
		<?php
			endforeach;
		?>
		
		$("#buy_pay").change(set_pay);
		
		set_pay();
		
		function set_pay()
		{
			id_pay = $("#buy_pay").val();
			price_pay = pay[id_pay];
			sum = $("#sum_product").text();
			sum_pay = (sum/100)*price_pay;
			$("#price_pay").html(price_pay+'% = '+sum_pay);
			$("#sum_pay").val(sum_pay);
			sumary_price();
		}
		
		
		sumary_price();
		function sumary_price()
		{
			var sumary_delivery = 0;
			var sumary_pay = 0;
			var sumary_product = 0;
			
			sumary_delivery = parseInt($('#price_delivery').text());
			sumary_pay = parseInt($('#sum_pay').val());
			sumary_product = parseInt($('#sum_product').text());
			
			all_price = sumary_delivery + sumary_product + sumary_pay;
			
			$('#itog').text(all_price);
			
		}
		
		$("#save_order").click(function()
		{
			name = $("#edit_name").val();
			mail = $("#edit_mail").val();
			phone = $("#edit_phone").val();
			fax = $("#edit_fax").val();
			city = $("#buy_city").val();
			street = $("#edit_street").val();
			house = $("#edit_house").val();
			office = $("#edit_office").val();
			pay = $("#buy_pay").val();
			shipps = $("#buy_shipping").val();
			status = $("#buy_status").val();
			key = $("#key_order").val();
			
			$.post("<?php echo base_url('admin/update_order/');?>", {key_order: key, name: name, mail: mail, phone: phone, fax: fax, city: city, street: street, build: house, app: office, pay: pay, shipps: shipps, status: status}, res);
		});
		
		function res(data)
		{
			$("#save").show().delay(2500).fadeOut();
		}
		
		$(".text").change(function()
		{
			qty = $(this).val();
			var id_product = $(this).next(".id_product").val();
			
			$.post("<?php echo base_url('admin/edit_qty/');?>", {qty: qty, id: id_product, order: id_order}, function(data)
			{
				$("."+id_product).html(data);
				
				$.post("<?php echo base_url('admin/sum_prod/');?>", {order: id_order}, function(data)
				{
					$("#sum_product").html(data);
					
					set_delivery();
					set_pay();
					sumary_price();
				});
			});
			
		});
		
		
		//delete_product_from_order
		
		$('.function_link').click(function()
		{
			var item_name = ($(this).next('a').text());
			left = $(window).width();
			$("#del_window").fadeIn(400);
			$("#del_window h4").html('Действительно удалить '+item_name+' из списка?');
			$("#id_delete").val($(this).attr('href').substr(1));
		});
		
		$('#yes').click(function()
		{
			id_prod = $('#id_delete').val();
			$.ajax({
				type:'post',
				url:'<?php echo base_url('admin/delete_product_from_order/');?>',
				data:{'id':id_prod, 'id_order':id_order},
				success: ok_del
			});
			$("#del_window").fadeOut(400);
		});
		
		function ok_del()
		{
			location.reload();
		}
		
		$('#no').click(function()
		{
			$("#del_window").fadeOut(400);
		});
		
		$("#add_new_item").click(function()
		{
			$(".add_btn").hide();
			$("#add_item_window").fadeIn(400);
			left = $(window).width();
		});
		
		$("#add_id_item").change(function()
		{
			id = $(this).val();
			$.ajax({
				type: 'post',
				url: '<?php echo base_url('admin/get_new_item_order/');?>',
				data: {'id_product':id},
				success: ok_new_item
			});
		});
		
		function ok_new_item(data)
		{
			if( (data).length > 0 )
			{
				data_text = data.split(':');
				$("#add_item_window a").text(data_text[0]);
				$("#add_item_window a").attr('href', '<?php echo base_url('products/get');?>/'+data_text[1]);
				if( data_text[0].length > 0 )
				{
					$(".add_btn").show();
				}
				else
				{
					$(".add_btn").hide();
				}
			}
			else
			{
				$("#add_item_window a").text();
				$(".add_btn").hide();
			}
		}
		
		$(".add_btn").click(function()
		{
			id_product = $("#add_id_item").val();
			
			$.ajax({
				type: 'post',
				url: '<?php echo base_url('admin/add_new_item_order/');?>',
				data: {'id_product':id_product, 'key_order':id_order},
				success: ok_add
			});
			$("#add_item_window").hide();
		});
		
		function ok_add(data)
		{
			location.reload();
		}
		
		$('.close_windows').click(function()
		{
			$('#add_item_window').fadeOut();
		});

	});
</script>
<div id="add_item_window">
	<div class="close_windows"></div>
	<h4 style="margin-top: 10px; font-family: Arial;">Добавить товар к заказу</h4>
	<p style="margin-left: 1px;">Введите код товара: A-<input type="text" class="text" style="width:50px; margin-left: 1px;" id="add_id_item" value=""><p>
	<a href="#" target="_blank"></a>
	<br />
	<input type="button" class="add_btn" id="btn_add_item" value="">
</div>

<div id="del_window">
	<h4 style="margin-top: 10px; font-family: Arial;"></h4>
	<div id="yes">Да</div>
	<input type="hidden" id="id_delete" value="">
	<div id="no">Нет</div>
</div>
	
<div id="save">Информация о заказе сохранена</div>

<div id="errors"></div>

<div id="content">
	<table width="100%">
		<tr>
			<td style="width: 49%;" valign="top">
				<h1>Заказ</h1>
					<table class="table" style="width: 100%;">
						<tr class="tr_header">
							<td colspan="2" class="td">
								<h4>Информация о заказе</h4>
							</td>
						</tr>
						<tr>
							<td class="td" style="width: 170px;">
								<span class="td_text"><strong>Код заказа</strong></span>
							</td>
							<td class="td">
								<span class="td_text"><?php echo $order['id_user'];?></span>
								<input type="hidden" id="key_order" value="<?php echo $order['key_orders'];?>">
							</td>
						</tr>
						<tr>
							<td class="td"><span class="td_text"><strong>Покупатель</strong></span></td>
							<td class="td">
								<input type="text" id="edit_name" class="text" style="width:300px;" value="<?php echo $order['name_user'];?>">
							</td>
						</tr>
						<tr>
							<td class="td"><span class="td_text"><strong>E-mail покупателя</strong></span></td>
							<td class="td">
								<input type="text" id="edit_mail" class="text" style="width:300px;" value="<?php echo $order['mail_user'];?>">
							</td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Телефон покупателя</strong></span></td>
							<td class="td">
								<input type="text" id="edit_phone" class="text" style="width:300px;" value="<?php echo $order['phone_user'];?>">
							</td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Факс покупателя</strong></span></td>
							<td class="td">
								<input type="text" id="edit_fax" class="text" style="width:300px;" value="<?php echo $order['fax_user'];?>">
							</td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Адрес доставки</strong></span></td>
							<td class="td">
								<span class="td_text">Город:</span>
								<select id="buy_city" style="margin: 0 0 2px 17px;">
									<?php foreach( $city as $name_city ): ?>
										<option value="<?php echo $name_city['id_city'];?>"><?php echo $name_city['name_city'];?></option>
									<?php endforeach; ?>
								</select>
								<br /><span class="td_text">Адрес:<input type="text" id="edit_street" class="text" style="width:200px; margin: 0 0 0 20px;" value="<?php echo $order['street_user'];?>"></span>
							</td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Оплата покупателя</strong></span></td>
							<td class="td">
								<select id="buy_pay">
									<?php foreach( $pay as $item ): ?>
										<option value="<?php echo $item['id_pay'];?>"><?php echo $item['name_pay'];?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Доставка покупателя</strong></span></td>
							<td class="td">
							<select id="buy_shipping">
								<?php foreach( $delivery as $item ): ?>
									<option value="<?php echo $item['id_shipping'];?>">
										<?php echo $item['name_shipping'];?>
									</option>
								<?php endforeach; ?>
							</select>
							</td>
						</tr>
						<tr>
							<?php
								$orderDate = substr($order['data'], 8, 2) . '.' . substr($order['data'], 5, 2) . '.' . substr($order['data'], 0, 4) . ' в ' . substr($order['data'], 10, 6);
							?>
							<td class="td"><span class="td_text"><strong>Дата заказа</strong></span></td><td class="td"><span class="td_text"><?php echo $orderDate;?></span></td>
						</tr>
						<tr>	
							<td class="td"><span class="td_text"><strong>Состояние заказа</strong></span></td>
							<td class="td">
								<select id="buy_status">
									<?php foreach( $list_status as $item ): ?>
										<option value="<?php echo $item['id_status'];?>"><?php echo $item['name'];?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="td" colspan="2" style="padding: 10px;">
								<div class="add_item" id="save_order" style="margin: 10px;">Сохранить</div>
							</td>
						</tr>
					</table>
			</td>
			<td width="2%;"></td>
			<td style="width: 49%;" valign="top" rowspan="2">
				<h1>Товары</h1>
					<table class="table">
						<tr class="tr_header">
							<td colspan="4" class="td">
								<h4>Информация о товарах</h4>
							</td>
						</tr>
						<tr>
							<td class="td" style="width: 20px;"><span class="td_text"><strong>Код</strong></span></td>
							<td class="td"><span class="td_text"><strong>Название</strong></span></td>
							<td class="td" style="width: 130px;"><span class="td_text"><strong>Единиц</strong></span></td>
							<td class="td" style="width: 70px;"><span class="td_text"><strong>Сумма</strong></span></td>
						</tr>
						<?php
							$prod_sum = 0;
							foreach( $products as $item ): 
						?>
						<tr>
							<td class="td"><span class="td_text"><?php echo $item['id_product'];?></span></td>
							<td class="td">
									<?php 
										$item_name = $this->admin_md->get_order_products( $item['id_product'] );
									?>
									<a href="#<?php echo $item['id_product'];?>" title="Удалить" class="function_link">
										<img src="<?php echo base_url('images/admin/trash.png');?>" alt="Удалить <?php echo $item_name['name'];?>" title="Удалить <?php echo $item_name['name'];?>" />
									</a>
									<a href="<?php echo base_url('products/get/'.$item_name['rewrite']);?>" target="_blank" class="td_text" style="margin-left:0;"><?php echo $item_name['name'];?></a>
							</td>
							<td class="td">
								<span class="td_text"><?php echo $item['price'] * $view_money['exchange_money'].' '.$view_money['key_money'];?></span> × <input type="text" id="edit_qty" class="text" style="width:20px; margin: 0;" value="<?php echo $item['qty'];?>">
								<input type="hidden" class="id_product" value="<?php echo $item['id_product'];?>">
							</td>
							<td class="td"><span class="<?php echo $item['id_product'];?>"><?php echo $item['price'] * $item['qty'] * $view_money['exchange_money'];?></span> <?php echo $view_money['key_money'];?></td>
						</tr>
						<?php 
							$prod_sum = $prod_sum + $item['price']*$item['qty'];
							endforeach; 
						?>
						<tr>
							<td colspan="4" class="td">
								<a href="#" title="Добавить товар" id="add_new_item">
										<img src="<?php echo base_url('images/admin/add_item.png');?>" alt="Добавить товар" title="Добавить товар" />
										Добавить товар
								</a>
							</td>
						</tr>
					</table>
			</td>
		</tr>
		
		<tr>
			<td width="49%" valign="top">
					<table class="table">
						<tr class="tr_header">
							<td colspan="2" class="td">
								<h4>Детали оплаты</h4>
							</td>
						</tr>
						<tr>
							<td class="td" style="width: 170px;">
								<span class="td_text"><strong>Товаров на сумму</strong></span>
							</td>
							<td class="td">
								<span class="td_text" id="sum_product"><?php echo $prod_sum * $view_money['exchange_money'];?></span> <?php echo $view_money['key_money'];?>
							</td>
						</tr>
						<tr>
							<td class="td"><span class="td_text"><strong>Вариант оплаты</strong></span></td>
							<td class="td">
								<span class="td_text"><span id="price_pay"></span> <?php echo $view_money['key_money'];?></span>
								<input type="hidden" id="sum_pay" value="">
							</td>
						</tr>
						<tr>
							<td class="td"><span class="td_text"><strong>Доставка</strong></span></td>
							<td class="td">
								<span class="td_text"><span id="price_delivery"></span> <?php echo $view_money['key_money'];?></span>
							</td>
						</tr>
						<tr>
							<td class="td" colspan="2">
								<h2 class="itog">Итоговая сумма: <span id="itog"></span> <?php echo $view_money['key_money'];?></h2>
							</td>
						</tr>
						<tr>
							<td class="td" colspan="2" style="padding: 10px;">
								<div class="add_item" style="margin: 10px;">Создать счет</div>
							</td>
						</tr>
					</table>
			</td>
			<td width="2%;"></td>
			<td width="49%" valign="top">
			</td>
		</tr>

				<tr>
			<td width="49%" valign="top">
					<table class="table">
						<tr class="tr_header" style="background-color: #C71717;">
							<td class="td">
								<h4 style="color: #FFF;">Удаление заказа</h4>
							</td>
						</tr>
						<tr>
							<td class="td">
								<a href="<?php echo base_url('admin/trash_order/' . $order['key_orders']); ?>">Удалить</a>
							</td>
						</tr>
					</table>
			</td>
			<td width="2%;"></td>
			<td width="49%" valign="top">
			</td>
		</tr>
	</table>
</div>