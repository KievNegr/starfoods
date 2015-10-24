<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('themes/' . $themePath . '/css/style.css');?>">
	<?php
		if(isset($index)):
	?>
	<link rel="stylesheet" href="<?php echo base_url('themes/' . $themePath . '/css/index.css');?>">
	<?php
		endif;
	?>
	<link rel="stylesheet" href="<?php echo base_url('themes/' . $themePath . '/css/animate.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('themes/' . $themePath . '/css/slider.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('themes/' . $themePath . '/css/ring.css');?>">
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/jquery-1.11.3.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/animation.js');?>"></script>
	<?php
		if(isset($index)):
	?>
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/index.js');?>"></script>
	<?php
		else:
	?>
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/photo_items.js');?>"></script>
	<?php
		endif;
	?>
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/wow.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('themes/' . $themePath . '/js/jquery.backgroundpos.min.js');?>"></script>
	<script>
		new WOW().init();
	</script>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<a href="<?php echo base_url();?>"><div class="logo"></div></a>
			<?php
				/*
					Тут меню статических страниц не выводится изза сложной структуры меню, для изменения или добавления
					меняй данные в меню ниже и в админке.

				foreach( $static as $page )
				{
					echo '<li><a href="' . base_url('pages/get/' . $page['rewrite']) . '">' . $page['title'] . '</a></li>';
				}*/
			?>
			<ul class="menu">
				<?php
					if(isset($index)):
				?>
				<li class="empty-li"></li>
				<?php
					endif;
				?>
				<li><a href="<?php echo base_url('cheesecake/about.html');?>" class="active">О нас</a></li>
				<li><a href="<?php echo base_url('pages/get/gde-kupit.html');?>">Где купить</a></li>
				<li><a href="<?php echo base_url('cheesecake/catalog.html');?>">Продукция</a></li>
				<?php
					if(isset($index)):
				?>
				<li class="li-logo">&nbsp;</li>
				<?php
					else:
				?>
				<li>&nbsp;</li>
				<?php
					endif;
				?>
				<li><a href="<?php echo base_url('cheesecake/fabrica.html');?>">Производство</a></li>
				<li><a href="<?php echo base_url('cheesecake/media.html');?>">Медиа</a></li>
				<li><a href="<?php echo base_url('pages/get/contacts.html');?>">Контакты</a></li>
				<?php
					if(isset($index)):
				?>
				<li class="empty-li"></li>
				<?php
					endif;
				?>
			</ul>
		</div><!--/Header-->
		<div class="cart-header-link">
			<a href="#" class="load-cart">Корзина (<?php echo $cart_count; ?>)</a>
		</div><!--/cart-header-link-->