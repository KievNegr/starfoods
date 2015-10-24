<script type="text/javascript" src="<?php echo base_url('js/check_option.js');?>"></script>
<div id="content">
<?php echo form_open(); ?>
<table class="table">
		<tr class="tr_header">
			<td class="td">
				<h4>Изменение свойства "<?php echo $option['value'];?>"</h4>
				<input type="submit" name="option_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td class="td" style="width: 600px;">
				<p style="color: green;"><?php echo $notify;?></p>
					<p>Название свойства:</p>
					<input type="text" name="option_name" class="text" id="name_option" value="<?php echo $option['value'];?>" />
					<p>Измерение свойства:</p>
					<input type="text" name="option_value" class="text" id="value_option" value="<?php echo $option['measurement'];?>" />
					<p>Используемые категории:</p>
					<?php
						$i = 0;
						foreach( $category as $item ):
						++$i;
						$checked = '';
						if( $this->admin_md->get_chek( $item['id_category'], $option['id'] ) != 0  )
						{
							$checked = 'checked';
						}
					?>
					<p><input type="checkbox" name="cat<?php echo $i;?>" <?php echo $checked;?> class="check" /> 
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
					<input type="hidden" name="count_cat" value="<?php echo $i;?>" />		
			</td>
		</tr>
	</table>
	</form>
</div>
<div id="errors"></div>