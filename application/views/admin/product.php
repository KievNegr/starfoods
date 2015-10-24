<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="5" class="td">
				<h4>Товары</h4>
			</td>
		</tr>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/add_product');?>" class="add_item">Добавить</a>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<p>Поиск по коду: A-<input type="text" id="search_id" class="search_id"></p>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td"><span class="td_text"><strong>Название товара</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Добавлено</strong></span></td>
			<td class="td" width="50"><span class="td_text"><strong>Цена</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Действия</strong></span></td>
		</tr>
		<?php foreach( $product as $item ): ?>
		<tr class="onload_item">
			<td class="td" width="30"><span class="td_text"><?php echo $item['id_product']; ?></span></td>
			<td class="td">
				<span class="td_text">
					<a href="<?=base_url('admin/edit_product/'.$item['id_product']);?>" title="Изменить">
						<?php echo $item['name']; ?>
					</a>
				</span>
			</td>
			<td class="td"><span class="td_text"><?php echo $item['dt']; ?></span></td>
			<td class="td"><span class="td_text"><?php echo $item['price']; ?></span></td>
			<td class="td">
				<a href="<?=base_url('admin/edit_product/'.$item['id_product']);?>" title="Изменить" class="function_link">
					<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name'];?>" title="Изменить <?=$item['name'];?>" />
				</a>
				<a href="<?=base_url('admin/trash_product/'.$item['id_product']);?>" title="Удалить" class="function_link">
					<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name'];?>" title="Удалить <?=$item['name'];?>" />
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#search_id").change(function()
		{
			if( isNaN( parseInt($(this).val()) ) == false )
			{
				//Если цифры то все норм
				id = parseInt($(this).val());
				$.ajax({
					type: 'post',
					url: '<?=base_url('admin/get_search_id/');?>',
					data: {'id_product':id},
					success: ok_search_item
				});
			}
		});
		
		function ok_search_item(data)
		{
			if( data != '' )
			{
				$('.onload_item').hide();
				$(".table").append(data);
			}
			else
			{
				$('.onload_item').show();
				a = $('tr').length - 1;
				$("tr:eq("+ a +")").remove();
			}
		}
	});
</script>