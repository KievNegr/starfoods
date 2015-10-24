		<div id="right_field">
				<?php /*--------------------------------------------------------------------------------*/ ?>
						
						<script type="text/javascript">
						$(document).ready(function() {
						var upload = new AjaxUpload('#userfile', {
								//upload script 
								action: 'admin/add_product',
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
								$(".success").css("display", "block");
								
						//This lower portion gets the error message from upload.php file and appends it to our specifed error message block
								//find the div in the iFrame and append to error message	
								var oBody = $(".iframe").contents().find("div");
								//add the iFrame to the errormes td
								$(oBody).appendTo("#file_holder #errormes");
								
						//This is the demo dummy success message, comment this out when using the above code
								//$("#file_holder #errormes").html("<span class='success'>Your file was uploaded successfully</span>");
						}
							});
						});	
								</script>
						
						  <div id="file_holder">
						 <?php echo form_open_multipart("admin/add_product"); ?>
							<h3>Ajax upload demo</h3>
						  
						  <div></div>
						  
							<p><label for="userfile">Choose images(s) to upload:</label> 
						 <input id="userfile" class="input" type="file" name="userfile" /></p>
						 <div id="loading"><img src="<?=base_url('images/admin/ajax-loader.gif');?>" alt="Loading" /> Loading, please wait...</div>
						 <div id="errormes"></div>
						 <p><?=$error_file;?></p>
						 <p><?=$info_file['file_name'];?></p>
						<noscript>
						<input type="submit" value="submit" class="button2" />
						</noscript>
						</form>
						</div>   
				
				<?php /*---------------------------------------------------------------------------------*/ ?>
			
		</div>
	</div>
</div>