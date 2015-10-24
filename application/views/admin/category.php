<div id="content">
	<h1>Категории</h1>
	<table class="table">
		<tr class="tr_header">
			<td colspan="4" class="td">
				<h4>Список категорий с подкатегориями</h4>
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 20px;"><span class="td_text"><strong>№</strong></span></td>
			<td class="td"><span class="td_text"><strong>Название категории</strong></span></td>
			<td class="td" style="width: 20px;"><span class="td_text"><strong>Сортировка</strong></span></td>
			<td class="td" style="width: 100px;"><span class="td_text"><strong>Действия</strong></span></td>
		</tr>
		<?php 
			$a = 0;
			foreach( $category as $item ): 
			$a++;
		?>
		<tr>
			<td class="td"><span class="td_text"><?=$a;?></span></td>
			<td class="td"><span class="td_text">
				<?php 
					if( $item['sub_category'] != 0 )
					{
						$cat = $item['sub_category'];
						$res = $item['name'];
						while( $cat != 0)
						{
							$parent = $this->admin_md->get_parent_category($cat);
							$res = $parent['name'].'->'.$res;
							$cat = $parent['sub_category'];
						}
						echo $res; 
					}
					else
					{
						echo $item['name']; 
					}
				?>
			</span></td>
			<td class="td"><span class="td_text"><?php echo $item['sort']; ?></span></td>
			<td class="td">
				<a href="<?=base_url('admin/edit_category/'.$item['id_category']);?>" title="Изменить" class="function_link">
					<img src="<?=base_url('images/admin/edit.png');?>" alt="Изменить <?=$item['name'];?>" title="Изменить <?=$item['name'];?>" />
				</a>
				<a href="<?=base_url('admin/trash_category/'.$item['id_category']);?>" title="Удалить" class="function_link">
					<img src="<?=base_url('images/admin/trash.png');?>" alt="Удалить <?=$item['name'];?>" title="Удалить <?=$item['name'];?>" />
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>