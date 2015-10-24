<script type="text/javascript">
	$(document).ready(function()
	{
		$(".sort").change(function()
		{
			res = new Array();
			$('.sort').each(function(){
				res[res.length] = $(this).val();
			});
			alert(res);

			
		});
	});
</script>
<div id="content">
	<table class="table">
		<tr class="tr_header">
			<td colspan="5" class="td">
				<h4>Статические страницы</h4>
			</td>
		</tr>
		<tr>
			<td colspan="5" class="header_td" style="height: 50px;">
				<a href="<?=base_url('admin/add_page');?>" class="add_item" id="add_money">Добавить</a>
			</td>
		</tr>
		<tr>
			<td class="td" width="30"><span class="td_text"><strong>№</strong></span></td>
			<td class="td"><span class="td_text"><strong>Название страницы</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Добавлено</strong></span></td>
			<td class="td" width="150"><span class="td_text"><strong>Сортировка</strong></span></td>
			<td class="td" width="100"><span class="td_text"><strong>Действия</strong></span></td>
		</tr>
		<?php foreach( $pages as $item ): ?>
		<tr>
			<td class="td" width="30"><span class="td_text"><?php echo $item['id_page']; ?></span></td>
			<td class="td"><span class="td_text"><?php echo $item['title']; ?></span></td>
			<td class="td"><span class="td_text"><?php echo $item['dt']; ?></span></td>
			<td class="td"><span class="td_text"><input type="text" value="<?php echo $item['sort']; ?>" id-page="<?php echo $item['id_page']; ?>" class="sort" /></span></td>
			<td class="td">
				<a href="<?=base_url('admin/edit_page/'.$item['id_page']);?>" title="Изменить" class="function_link">
					<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['title'];?>" title="Изменить <?=$item['title'];?>" />
				</a>
				<a href="<?=base_url('admin/trash_page/'.$item['id_page']);?>" title="Удалить" class="function_link">
					<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['title'];?>" title="Удалить <?=$item['title'];?>" />
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>