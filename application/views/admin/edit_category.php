<div id="content">
	<?php echo form_open_multipart(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Редактирование категории "<?php echo $category['name'];?>"</h4>
				<input type="submit" name="cat_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $notify;?></p>
				<p>Название категории:</p>
				<input type="text" name="cat_name" class="text" value="<?php echo $category['name'];?>" />
				<p>Изображение для категории:</p>
				<p><img src="<?php echo base_url('images/upload/'.$category['image']);?>" /></p>
				<input type="file" name="userfile" class="file" />
				<p>Заголовок (тэг title):</p>
				<input type="text" name="cat_title" class="text" value="<?php echo $category['title'];?>" />
				<p>Rewrite (ЧПУ):</p>
				<input type="text" name="cat_url" class="text" value="<?php echo $category['rewrite'];?>" />
				<p>Описание(тэг Description):</p>
				<input type="text" name="cat_description" class="text" value="<?php echo $category['description'];?>" />
				<p>Описание категории:</p>
				<p><textarea name="cat_text" class="text_area"><?php echo $category['text'];?></textarea></p>
				<input type="hidden" name="category_id" value="<?php echo $category['id_category'];?>" />
			</td>
			<td class="td" valign="top">
				<?php echo validation_errors(); ?>
			</td>
		</tr>
	</table>
	</form>
</div>