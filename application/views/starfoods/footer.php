<div id="footer">
	<div class="logo-footer"></div>
	<div class="block">
		<ul class="footer-menu">
			<li><a href="<?php echo base_url('cheesecake/about.html');?>" class="active">О нас</a></li>
			<li><a href="<?php echo base_url('pages/get/gde-kupit.html');?>">Где купить</a></li>
			<li><a href="<?php echo base_url('cheesecake/catalog.html');?>">Продукция</a></li>
			<li><a href="<?php echo base_url('cheesecake/fabrica.html');?>">Производство</a></li>
			<li><a href="<?php echo base_url('cheesecake/media.html');?>">Медиа</a></li>
			<li><a href="<?php echo base_url('pages/get/contacts.html');?>">">Контакты</a></li>
		</ul>
	</div>
	<div style="clear: both;"></div>
	<span class="copy">&copy; 2015 ООО "Стар Фудс"</span>
</div>

<div id="show-cart"></div><!--/show-cart-->
<div id="fade"></div><!--/fade-->
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.load-cart').click(function()
		{
			$("#show-cart").load('<?php echo base_url('my_cart');?>');
			$("#show-cart").fadeIn();
			$("#fade").fadeIn();
		});

		$('html').on('click', '.cart-back', function()
		{
			$("#show-cart").load('<?php echo base_url('my_cart');?>');
		});

		$('html').on('change', '.cart-qty', function()
		{
			new_qty = $(this).val();
			if( new_qty < 1 )
			{
				alert('не гони!');
				$(this).val('1');
			}
			else
			{
				rowid = $(this).attr('id');
				$.post('<?php echo base_url("my_cart/qty_change");?>', {qty: new_qty, rowid: rowid}, ok);
			}
		});

		$('html').on('click', '.item-down', function()
		{
			qty = $('#' + $(this).attr('down-rowid')).val();
			new_qty = parseInt(qty) - 1;
			if( new_qty < 1 )
			{
				alert('не гони!');
				$(this).val('1');
			}
			else
			{
				rowid = $(this).attr('down-rowid');
				$.post('<?php echo base_url("my_cart/qty_change");?>', {qty: new_qty, rowid: rowid}, ok);
				$('.load-cart').html('Корзина (' + new_qty + ')');
			}
		});

		$('html').on('click', '.item-up', function()
		{
			qty = $('#' + $(this).attr('up-rowid')).val();
			new_qty = parseInt(qty) + 1;
			if( new_qty < 1 )
			{
				alert('не гони!');
				$(this).val('1');
			}
			else
			{
				rowid = $(this).attr('up-rowid');
				$.post('<?php echo base_url("my_cart/qty_change");?>', {qty: new_qty, rowid: rowid}, ok);
				$('.load-cart').html('Корзина (' + new_qty + ')');
			}
		});
		
		$('html').on('click', '.delete', function()
		{
			rowid = $(this).attr('del-rowid');
			new_qty = '0';
			$.post('<?php echo base_url("my_cart/qty_change");?>', {qty: new_qty, rowid: rowid}, reload);
		});
		
		function ok(data)
		{
			$("#show-cart").load('<?php echo base_url("my_cart");?>');
		}
		
		function reload(data)
		{
			if( data == 0 )
			{
				location.reload(true);
			}
			else
			{
				$("#show-cart").load('<?php echo base_url("my_cart");?>');
			}
		}

		$('html').on('click', '.close-cart', function()
		{
			$("#show-cart").fadeOut();
			$("#fade").fadeOut();
		});
		
		$('html').on('click', '.buy', function()
		{
			$("#show-cart").load('<?php echo base_url("my_cart/buy");?>');
		});
	});
	
</script>
</body>
</html>