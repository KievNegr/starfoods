<script type="text/javascript" src="<?php echo base_url('js/check_product.js');?>"></script>
<?php $id = $product['id_product'];?>
<script type="text/javascript">
	$(document).ready(function()
	{
		i = 1;
		$("#input_file").append('<input type="file" name="name'+i+'" class="file" />');
		
		$("#numb").val(i);
		
		$("#prod_price").change(function()
		{
			ex = <?php echo $view_money['exchange_money'];?>;
			conv = $(this).val() * ex;
			$("#prod_price_view").val(conv + ' <?php echo $view_money['key_money'];?>');
		});
		
		$(".file").change(function()
		{
			i++;
			$("#input_file").append('<input type="file" name="name'+i+'" class="file" />');
			$("#numb").val(i);
		});
		
		$("#add_field").click(function()
		{
			i++;
			$("#input_file").append('<input type="file" name="name'+i+'" class="file" />');
			$("#numb").val(i);
		});
		
		$("#del_field").click(function()
		{
			if(i > 1)
			{
				$(".file:last").remove();
				i--;
				$("#numb").val(i);
			}
		});
		
		$("#name_prod").change(function()
		{
			text = $(this).val();
			$.post('<?php echo base_url('admin/set_lett');?>', {url: text}, urlok);
		});
		
		function urlok(data)
		{
			$("#url_prod").val(data);
		}
		
		$("#prod_option").change(function()
		{
			value = $(this).val();
			if( value == 0 )
			{
				$("#block_option").css("display","none");
			}
			else
			{
				$("#block_option").css("display","block");
			}
		});
		
		$("#table2").hide();
		$("#table3").hide();
		$("#show1").css("background-color","#E2E2E2");
		
		$("#show1").click(function()
		{
			$("#table2").hide();
			$("#table3").hide();
			$(this).css("background-color","#E2E2E2");
			$("#show2").css("background-color","#FFF");
			$("#show3").css("background-color","#FFF");
			$("#table1").show(500);
		});
		
		$("#show2").click(function()
		{
			$("#table1").hide();
			$("#table3").hide();
			$(this).css("background-color","#E2E2E2");
			$("#show1").css("background-color","#FFF");
			$("#show3").css("background-color","#FFF");
			$("#table2").show(500);
		});
		
		$("#show3").click(function()
		{
			$("#table1").hide();
			$("#table2").hide();
			$(this).css("background-color","#E2E2E2");
			$("#show1").css("background-color","#FFF");
			$("#show2").css("background-color","#FFF");
			$("#table3").show(500);
		});
		
		
		
		$('html').on('click', '.box_edit_images', function()
		{
			id_img = $(this).attr('id').substr(9);
			id_prod = <?php echo $id;?>;
			
			$.ajax({
				url: '<?php echo base_url('admin/set_boss_image/');?>',
				type: 'post',
				data: {'id_image': id_img, 'id_item': id_prod},
				success: function()
					{
						$(".box_edit_images").css({'border':'1px solid #4776cd', 'background-color':'transparent',  'margin-right': ''});
						$(".del_img").show(10);
						$("#id_image_" + id_img).css({'border':'1px solid rgb(181, 192, 176)', 'background-color':'rgb(181, 192, 176)',  'margin-right': '39px'});
						$('[id-img = ' + id_img + ']').hide(10);
					}
				});
		});
		
		$('html').on('click', '.del_img', function()
		{
			id = $(this).attr('id-img');
			$.post('<?php echo base_url('admin/get_edit_image/'.$id);?>', {id_image: id}, show_images);
			$('#id_image_' + id).remove();
			$(this).remove();
		});
		
		function show_images(data)
		{
			//$("#jquery_box_images").html(data);
			//alert('Потрачено');
		}
		
		$("#available [value='<?php echo $product['available'];?>']").attr("selected", "selected");
		$("#prod_category [value='<?php echo $product['id_category'];?>']").attr("selected", "selected");
		
		select_options(<?php echo $product['id_category'];?>);
		
		$("#prod_category").change(function()
		{
			select_options($(this).val());
		});
		
		function select_options(id)
		{
			$.post('<?php echo base_url('admin/select_options/'.$id);?>', {id_category: id}, options);
		}
		
		function options(data)
		{
			if( data == '' )
			{
				data = 'отсутствуют опции';
			}
			$("#output_options").html(data);
		}
		
		
		///////////////////////////////////////////////////////////////////////
		
		
		var upload = new AjaxUpload('#userfile', {
		//upload script 
		action: '<?php echo base_url('admin/images/'.$id);?>',
		onSubmit : function(file, extension){
		//show loading animation
		$("#loading").show();
		//check file extension
		if (! (extension && /^(jpg|png|jpeg|gif)$/.test(extension))){
       // extension is not allowed
			 $("#loading").hide();
			 $("<span class='error'>Error: Not a valid file extension</span>").appendTo("#file_holder #errormes");
			// cancel upload
       return false;
			} else {
			  // get rid of error
			$('.error').hide();
			}	
			//send the data
			upload.setData({'file': file});
		},
		onComplete : function(file, response){
		//hide the loading animation
		$("#loading").hide();
		//add display:block to success message holder
		//$(".success").css("display", "inline");
		
//This lower portion gets the error message from upload.php file and appends it to our specifed error message block
		//find the div in the iFrame and append to error message	
		var oBody = $(".iframe").contents().find("div");
		//add the iFrame to the errormes td
		$(oBody).appendTo("#file_holder #errormes");
		
//This is the demo dummy success message, comment this out when using the above code
		//$("#file_holder #errormes").html("<span class='success'>Your file was uploaded successfully</span>");
}
	});
		
		
		////////////////////////////////////////////////////////////////////////////
	});
</script>
<div id="content">
	<?php echo form_open_multipart(); ?>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Изменение товара</h4><input type="submit" name="cat_btn" value="Сохранить" class="submit" />
			</td>
		</tr>
		<tr>
			<td colspan="2" style="height: 45px;">
				<p>
					<div id="show1" class="show_item_menu">Товар</div>
					<div id="show2" class="show_item_menu">Свойства</div>
					<div id="show3" class="show_item_menu">Изображения</div>
				</p>
			</td>
		</tr>
		<tr id="table1">
			<td class="td" style="width: 80%;">
				<p>Название товара:</p>
				<input type="text" name="prod_name" class="text" id="name_prod" value="<?php echo $product['name'];?>" />
				<p>Производитель:</p>
				<?php
					$nameBrand = '';
					foreach( $brand as $name )
					{
						$nameBrand .= '"' . $name['name'] . '", ';
					}
					$nameBrand = substr($nameBrand, 0, -2);
				?>
				<input 
					type="text" 
					name="brand" 
					class="text" 
					id="name_prod" 
					autocomplete="off" 
					value = "<?php echo $insertBrand; ?>"
					data-provide="typeahead" 
					data-items="20" 
					data-source='[<?php echo $nameBrand; ?>]'
				/>
				<p>Категория:</p>
				<select name="prod_category" id="prod_category">
					<?php
						foreach($category as $item): 
							if( $item['sub_category'] != 0 )
							{
								$cat = $item['sub_category'];
								$val = $item['id_category'];
								$res = $item['name'];
								while( $cat != 0)
								{
									$parent = $this->admin_md->get_parent_category($cat);
									$res = $parent['name'].'->'.$res;
									$cat = $parent['sub_category'];
								}
								echo '<option value="'.$val.'">'.$res.'</option>';
							}
							else
							{
								echo '<option value="'.$item['id_category'].'">'.$item['name'].'</option>'; 
							}
						endforeach; 
					?>
				</select>
				<p>Наличие:</p>
				<select name="available" id="available">
					<option value="1">В наличии</option>
					<option value="2">Отсутствует</option>
					<option value="3">Ожидается</option>
					<option value="4">Снято с производства</option>
				</select>
				<p>Цена в <?php echo $default_money['key_money'];?> <small>(валюта по умолчанию <?php echo $default_money['name_money'];?>, валюта отображения <?php echo $view_money['name_money'];?>)</small>:</p>
				<input type="text" name="prod_price" id="prod_price" class="text" value="<?php echo $product['price'];?>" />
				<p>Цена в <?php echo $view_money['name_money'];?> <small>(курс <?php echo $view_money['exchange_money'];?>)</small>:</p>
				<input type="text" id="prod_price_view" class="text" value="<?php echo $product['price'] * $view_money['exchange_money'].' '.$view_money['key_money'];?>" disabled>
				<p>Заголовок:</p>
				<input type="text" name="prod_title" id="prod_title" class="text" value="<?php echo $product['title'];?>" />
				<p>Rewrite:</p>
				<input type="text" class="text" value="<?php echo $product['rewrite'];?>" disabled>
				<input type="hidden" name="prod_url" id="prod_url" class="text" id="url_prod" value="<?php echo $product['rewrite'];?>">
				<p>Описание(Description):</p>
				<input type="text" name="prod_description" id="prod_description" class="text" value="<?php echo $product['description'];?>" />
				<p>Описание товара:</p>
				<p><textarea name="prod_text" id="prod_text" class="text_area"><?php echo $product['text'];?></textarea></p>
				<p>Полное описание товара:</p>
				<p><textarea name="full_prod_text" id="prod_text" class="text_area" ><?php echo $product['full_text'];?></textarea></p>
				<input type="hidden" name="prod_id" value="<?php echo $id;?>" />
			</td>
			<td valign="top" style="border: none;">
				<?php echo validation_errors(); ?>
				<div id="errors"></div>
			</td>
		</tr>
		<tr id="table2">
			<td valign="top" style="border: none;">
				<div id="output_options"></div>
				<br />
			</td>
		</tr>
		<tr id="table3">
			<td valign="top" style="border: none;">
				<div id="jquery_box_images"">
					<?php 
						$t = 0;
						foreach( $images as $img ): 
							if( $img['img_boss'] == 1 )
							{
								$border = 'border: 1px solid rgb(181, 192, 176); background-color: rgb(181, 192, 176); margin-right: 39px;';
								$show_del = 'style="display: none;"';
							}
							else
							{
								$border = 'border: 1px solid #4776cd; background-color: transparent;';
								$show_del = '';
							}
					?>
						<div title="Клик установит это изображение главным" class="box_edit_images" id="id_image_<?php echo $img['id_images'];?>" style="<?php echo $border;?> background-image: url(<?php echo base_url('images/upload/thumbs/'.$img['name']);?>);">
						</div>
						<div class="del_img" id-img="<?php echo $img['id_images'];?>" <?php echo $show_del;?>></div>
					<?php
						$t++;
						endforeach; 
					?>
				<div id="file_holder">
					 <?php echo form_open_multipart('admin/images/'.$id); ?>						  
						<div></div>
						<div id="loading">
							<img src="<?php echo base_url('images/admin/ajax-loader.gif');?>" alt="Loading" />
						</div>
						<div id="errormes"></div>
						<noscript>
							<input type="submit" value="submit" class="button2" />
						</noscript>
						</div>
						<div class="success">
							<input id="userfile" class="input_img" type="file" name="userfile" />
							<div class="input_over">Add image</div>
						</div>
					</form>
				</div>
			</td>
		</tr>
	</table>
	</form>
</div>