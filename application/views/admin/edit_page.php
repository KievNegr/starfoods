<script type="text/javascript">
	$(document).ready(function()
	{
		/*$("#page_name").change(function()
		{
			text = $(this).val();
			$.post('<?php echo base_url('admin/set_lett');?>', {url: text}, urlok);
		});
		
		function urlok(data)
		{
			$("#url_page").val(data);
		}*/

		$('html').on('click', '#save-page', function()
		{
			namePage = $('#page_name').val();
			pageH1 = $('#page_title').val();
			pageRewrite = $('#url_page').val();
			pageDescription = $('#page_description').val();
			pageKeywords = $('#page_keywords').val();
			idPage = $('#id-page').val();
			pageText = tinyMCE.get('page_text').getContent();//$('#tinymce').val();
			view = 0;

			if( $("#check").prop("checked") == true )
			{
				view = 1;
			}

			if( namePage.trim().length == 0 )
			{
				$('#page_name').css('border-color', 'rgba(255, 0, 0, 0.5)');
				error = 1;
				$('.success-error').fadeIn(1);
			}
			else
			{
				$('#page_title').css('border-color', '');
				error = 0;
			}

			if( pageH1.trim().length == 0 )
			{
				$('#page_title').css('border-color', 'rgba(255, 0, 0, 0.5)');
				error = 1;
				$('.success-error').fadeIn(1);
			}
			else
			{
				$('#page_title').css('border-color', '');
				error = 0;
			}

			if( pageRewrite.trim().length == 0 )
			{
				$('#url_page').css('border-color', 'rgba(255, 0, 0, 0.5)');
				error = 1;
				$('.success-error').fadeIn(1);
			}
			else
			{
				$('#url_page').css('border-color', '');
				error = 0;
			}

			if( error == 0 )
			{
				$('.success-error').fadeOut(1);
				$.post('<?php echo base_url('admin/savePage');?>', 
						{
							idPage: idPage,
							pageName: namePage,
							pageH1: pageH1,
							pageRewrite: pageRewrite,
							pageDescription: pageDescription,
							pageKeywords: pageKeywords,
							pageText: pageText,
							view: view
						}, succSave
				);
			}
			
		});

		function succSave()
		{
			$('.success-save').fadeIn(1);
			$('.success-save').fadeOut(3000);
		}

		///////////////////////////////////////////////////////////////////////
		
		
		var upload = new AjaxUpload('#userfile', {
		//upload script 
		action: '<?php echo base_url('admin/images/');?>',
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
		$(oBody).prependTo("#file_holder #errormes");
		
//This is the demo dummy success message, comment this out when using the above code
		//$("#file_holder #errormes").html("<span class='success'>Your file was uploaded successfully</span>");
}
	});
		
		
		////////////////////////////////////////////////////////////////////////////
	});
</script>
<div id="content">
	<div class="success-save">Страница успешно сохранена</div>
	<div class="success-error">Проверьте правильность заполнения полей!</div>
	<table class="table">
		<tr class="tr_header">
			<td colspan="2" class="td">
				<h4>Добавление страницы</h4>
				<input type="button" name="cat_btn" value="Сохранить" class="submit" id="save-page" />
			</td>
		</tr>
		<tr>
			<td class="td" valign="top" style="width: 70%;">
				<input type="hidden" id="id-page" value="<?php echo $page['id_page']; ?>" />
				<p>Название страницы:</p>
				<input type="text" name="page_name" class="text" id="page_name" value="<?php echo $page['title']; ?>" />
				<p>Заголовок (H1):</p>
				<input type="text" name="page_title" class="text" id="page_title" value="<?php echo $page['h1']; ?>"/>
				<p>Rewrite:</p>
				<input type="text" name="page_url" class="text" id="url_page"  value="<?php echo $page['rewrite']; ?>"/>
				<p>Описание(Description):</p>
				<input type="text" id="page_description" class="text"  value="<?php echo $page['description']; ?>"/>
				<p>Ключевые слова(через запятую):</p>
				<input type="text" id="page_keywords" class="text"  value="<?php echo $page['keywords']; ?>"/>
				<?php
					$check = '';
					if( $page['view'] == 1 )
					{
						$check = ' checked';
					}
				?>
				<p><input type="checkbox" name="view" class="check" id="check" <?php echo $check; ?>/> Отображать в меню</p>
				<p>Текст страницы:</p>
				<p><textarea id="page_text" class="text_area"><?php echo $page['text']; ?></textarea></p>
			</td>
			<td valign="top" style="border: none;">
				<div id="file_holder" style="float:none; width:100%;">
					 <?php echo form_open_multipart('admin/page_images/'); ?>
					<div class="success">
						<input id="userfile" class="input_img" type="file" name="userfile" />
						<div class="input_over">Добавить изображение</div>
					</div>					  
					<noscript>
						<input type="submit" value="submit" class="button2" />
					</noscript>				
					<div id="loading"><img src="<?php echo base_url('images/admin/ajax-loader.gif');?>" alt="Loading" /></div>
					<div style="clear: both;"></div>
					<div id="errormes"></div>
					
				</div>
				
				</form>
				<?php
					$dir = 'images/upload/thumbs';
					$files = scandir($dir);
					$ext = Array('jpg','JPG','png','PNG','gif','GIF');
					foreach( $files as $img ):
						if( in_array(substr($img, -3), $ext)):
				?>
				<div style="clear: both;"></div>
				<div class="page-img">
					<div class="list-img">
						<img src="<?php echo base_url('images/upload/thumbs/' . $img);?>">
					</div>
					<input type="text" class="text-page-img" value="<?php echo base_url('images/upload/' . $img);?>">
				</div>
				<?php
						endif;
					endforeach;
				?>

			</td>
		</tr>
	</table>
</div>