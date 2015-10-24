<script type="text/javascript">
	$(document).ready(function()
	{
		$("#cat_name").change(function()
		{
			text = $(this).val();
			$.post('<?php echo base_url('admin/set_lett');?>', {url: text}, urlok);
		});
		
		function urlok(data)
		{
			$("#cat_url").val(data);
		}
	});
</script>
<div id="content">
	<?php echo form_open_multipart(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Добавление новой категории</h4>
				<input type="submit" name="cat_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p>Название категории:</p>
				<input type="text" name="cat_name" id="cat_name" class="text" />
				<p>Родительская категория:</p>
				<select name="cat_parent">
					<option value="0">Отсутствует</option>
					<?php foreach($category as $item): ?>
					
					<?php 
						if( $item['sub_category'] != 0 )
						{
							$cat = $item['sub_category'];
							$val = $item['id_category'];
							$res = $item['name'];
							while( $cat != 0)
							{
								$parent = $this->admin_md->get_parent_category($cat);
								$res = $parent['name'].' > '.$res;
								$cat = $parent['sub_category'];
							}
							echo '<option value="'.$val.'">'.$res.'</option>';
						}
						else
						{
							echo '<option value="'.$item['id_category'].'">'.$item['name'].'</option>'; 
						}
					?>
					
					<?php endforeach; ?>
				</select>
				<p>Изображение для категории:</p>
				<input type="file" name="userfile" class="file" />
				<p>Заголовок (тэг title):</p>
				<input type="text" name="cat_title" class="text" />
				<p>Rewrite (ЧПУ):</p>
				<input type="text" name="cat_url" id="cat_url" class="text" />
				<p>Описание(тэг Description):</p>
				<input type="text" name="cat_description" class="text" />
				<p>Описание категории:</p>
				<p><textarea name="cat_text" class="text_area"></textarea></p>
			</td>
			<td class="td" valign="top">
				<?php echo validation_errors(); ?>
			</td>
		</tr>
	</table>
	</form>
</div>