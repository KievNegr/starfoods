<script type="text/javascript" src="<?php echo base_url('js/check_option.js');?>"></script>
<div id="content">
<table class="table">
		<tr class="tr_header">
			<td class="td">
				<h4>Добавление свойства товаров</h4>
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $res;?></p>
				<?php echo form_open(); ?>
					<p>Название свойства:</p>
					<input type="text" name="option_name" class="text" id="name_option" />
					<p>Измерение свойства:</p>
					<input type="text" name="option_value" class="text" id="value_option" />
					<p>Используемые категории:</p>
					<?php
						$i = 0;
						foreach( $category as $item ):
						++$i;
					?>
					<p><input type="checkbox" name="cat<?php echo $i;?>" class="check" />
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
					<input type="hidden" name="id_cat<?php echo $i;?>" value="<?php echo $item['id_category'];?>" /></p>
					<?php 
						endforeach; 
					?>
					
					<br />
					<input type="hidden" name="count_cat" value="<?php echo $i;?>" />
					<input type="submit" name="option_btn" value="Сохранить" class="submit" />
				</form>
			</td>
		</tr>
	</table>
</div>
<div id="errors"></div>