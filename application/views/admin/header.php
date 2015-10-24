<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/admin.css');?>" />
	<script type="text/javascript" src="<?=base_url('js/jquery-1.7.1.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('js/admin/jquery.ajax.upload.js');?>"></script>
	<script src="<?=base_url('js/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
	<script src="<?=base_url('js/typeahead.min.js');?>" type="text/javascript"></script>
	<script type="text/javascript">
		tinymce.init({
			language : 'ru',
		    selector: ".text_area",
		    plugins: "media, image, table, preview, link, fullscreen, code",
		    extended_valid_elements : "script[language|type|src|charset]"
		 });
	//bkLib.onDomLoaded(function() {
		//new nicEditor({fullPanel : true, iconsPath : '<?=base_url('images/admin/nicEditorIcons.gif');?>'}).panelInstance('prod_text');
		//new nicEditor({fullPanel : true, iconsPath : '<?=base_url('images/admin/nicEditorIcons.gif');?>'}).panelInstance('full_prod_text');
	//});
	</script>
	
</head>
<style type="text/css">
#loading {display:none;}
</style>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("li.sub").hover(
		function()
		{
			$('ul', this).fadeIn(300);
			$(".dashed", this).css({"border":"none", "color": "#780606"});
		},
		function()
		{
			$('ul', this).fadeOut(800);
			$(".dashed", this).css({"border-bottom":"1px dashed #1352ba", "color": "#232323"});
		});
	});
</script>
<body>

<div id="container">
	<div id="header">
		<div id="logo">
			<a href="<?=base_url('admin');?>"><img src="<?=base_url('images/admin/logo.png');?>" /></a>
		</div>
	</div>
	<div id="menu">
		<ul>
			<li><a href="<?php echo base_url('admin/'); ?>">Заказы</a></li>
			<li class="sub">
				<a href="#" class="dashed">Товары</a>
					<ul>
						<li><a href="<?php echo base_url('admin/product/'); ?>">Список товаров</a></li>
						<!--<li><a href="<?php echo base_url('admin/add_product/'); ?>">Добавить новый товар</a></li>-->
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Свойства</a>
					<ul>
						<li><a href="<?php echo base_url('admin/options/'); ?>">Список свойств</a></li>
						<li><a href="<?php echo base_url('admin/add_option/'); ?>">Добавить новое свойство</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Категории</a>
					<ul>
						<li><a href="<?php echo base_url('admin/category/'); ?>">Список категорий</a></li>
						<li><a href="<?php echo base_url('admin/add_category/'); ?>">Добавить категорию</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Страницы</a>
					<ul>
						<li><a href="<?php echo base_url('admin/pages/'); ?>">Список страниц</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Производители</a>
					<ul>
						<li><a href="<?=base_url('admin/brand/');?>">Список производителей</a></li>
						<li><a href="<?=base_url('admin/add_brand/');?>">Добавить производителя</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Настройки</a>
					<ul>
						<li><a href="<?php echo base_url('admin/settings'); ?>">Настройки сайта</a></li>
						<li><a href="<?php echo base_url('admin/list_money/'); ?>">Управление валютой</a></li>
						<li><a href="<?php echo base_url('admin/list_pay/'); ?>">Управление платежами</a></li>
						<!--<li><a href="<?php echo base_url('admin/list_tax/'); ?>">Управление налогами</a></li>-->
						<li><a href="<?php echo base_url('admin/shipps/'); ?>">Управление доставкой</a></li>
						<li><a href="<?php echo base_url('admin/status/'); ?>">Управление состояниями заказов</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Статистика</a>
					<ul>
						<li><a href="<?php echo base_url('admin/product/'); ?>">Товары</a></li>
						<li><a href="<?php echo base_url('admin/add_product/'); ?>">Заказы</a></li>
					</ul>
			</li>
			<li class="sub">
				<a href="#" class="dashed">Администратор</a>
					<ul>
						<li><a href="<?php echo base_url('auth/edit_user/' . $this->ion_auth->user()->row()->id); ?>">Профиль</a></li>
						<li><a href="<?php echo base_url('auth/logout'); ?>">Выход</a></li>
					</ul>
			</li>
			<li><a href="<?php echo base_url(); ?>" target="_blank">На сайт</a></li>
		</ul>
	</div>