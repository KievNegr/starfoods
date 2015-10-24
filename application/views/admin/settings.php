<script type="text/javascript">
	$(document).ready(function()
	{
		$("#money [value='<?=$default_money;?>']").attr("selected", "selected");
		$("#view_money [value='<?=$view_money;?>']").attr("selected", "selected");
		
		$("#table2").hide();
		$("#show1").css("background-color","#E2E2E2");
		
		$("#show1").click(function()
		{
			$("#table2").hide();
			$(this).css("background-color","#E2E2E2");
			$("#show2").css("background-color","#FFF");
			$("#table1").show(500);
		});
		
		$("#show2").click(function()
		{
			$("#table1").hide();
			$(this).css("background-color","#E2E2E2");
			$("#show1").css("background-color","#FFF");
			$("#table2").show(500);
		});
		
		$("#money [value='<?=$default_money;?>']").attr("selected", "selected");
		
	});
</script>
<div id="content">
	<p style="color: green;"><?=$notify;?></p>
	<?php echo form_open(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Настройки магазина</h4>
				<input type="submit" name="button" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td colspan="2" style="height: 45px;">
				<p>
					<div id="show1" class="show_item_menu">Общие</div>
					<div id="show2" class="show_item_menu">Изображения</div>
				</p>
			</td>
		</tr>
		<tr id="table1">
			<td class="td" style="width: 600px;">
				<p>Название магазина:</p>
				<input type="text" name="title_shop" class="text" value="<?=$settings['0']['value'];?>" />
				<p>Описание магазина:</p>
				<input type="text" name="description_shop" class="text" value="<?=$settings['7']['value'];?>" />
				<p>Ключевые слова магазина:</p>
				<input type="text" name="keywords_shop" class="text" value="<?=$settings['8']['value'];?>" />
				<p>Папка шаблона:</p>
				<input type="text" name="theme_shop" class="text" value="<?=$settings['9']['value'];?>" />
				<p>Колличество товаров на страницу:</p>
				<input type="text" name="count_item" class="text" value="<?=$settings['1']['value'];?>" style="width: 50px;" />
				<p>Валюта по умолчанию:</p>
				<select name="default_money" id="money">
				<?php
					foreach( $money as $item ):
				?>
					<option value="<?=$item['id_money'];?>"><?=$item['name_money'];?></option>
				<?php
					endforeach;
				?>
				</select>
				<p>Валюта отображения:</p>
				<select name="view_money" id="view_money">
				<?php
					foreach( $money as $item ):
				?>
					<option value="<?=$item['id_money'];?>"><?=$item['name_money'];?></option>
				<?php
					endforeach;
				?>
				</select>
			</td>
			<td valign="top" style="border: none;">
				<?php echo validation_errors(); ?>
			</td>
		</tr>
		<tr id="table2">
			<td valign="top" style="border: none;">
				<p>Размеры изображений в списке товаров:</p>
				<p>
					<input type="text" name="image_list_item_w" value="<?=$settings['2']['width'];?>" class="text" style="margin: 0 5px; width: 50px;" />
					x
					<input type="text" name="image_list_item_h" value="<?=$settings['2']['height'];?>" class="text" style="margin: 0 5px; width: 50px;" />px
				</p>
				<p>Размер главного изображения в товаре:</p>
				<p>
					<input type="text" name="image_boss_item_w" value="<?=$settings['3']['width'];?>" class="text" style="margin: 0 5px; width: 50px;" />
					x
					<input type="text" name="image_boss_item_h" value="<?=$settings['3']['height'];?>" class="text" style="margin: 0 5px; width: 50px;" />px
				</p>
				<p>Размер preview в товаре (высота):</p>
				<p>
					<!--<input type="text" name="image_preview_item_w" value="<?=$settings['4']['width'];?>" class="text" style="margin: 0 5px; width: 50px;" />
					x-->
					<input type="text" name="image_preview_item_h" value="<?=$settings['4']['height'];?>" class="text" style="margin: 0 5px; width: 50px;" />px
				</p>
				<p>Размер изображения категории:</p>
				<p>
					<input type="text" name="image_category_w" value="<?=$settings['5']['width'];?>" class="text" style="margin: 0 5px; width: 50px;" />
					x
					<input type="text" name="image_category_h" value="<?=$settings['5']['height'];?>" class="text" style="margin: 0 5px; width: 50px;" />px
				</p>
				<p>Размер логотипа производителя:</p>
				<p>
					<input type="text" name="image_logo_brand_w" value="<?=$settings['6']['width'];?>" class="text" style="margin: 0 5px; width: 50px;" />
					x
					<input type="text" name="image_logo_brand_h" value="<?=$settings['6']['height'];?>" class="text" style="margin: 0 5px; width: 50px;" />px
				</p>
			</td>
		</tr>
	</table>
	</form>
</div>