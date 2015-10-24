<ul id="breadcrumb">
	<li><a href="<?php echo base_url(); ?>">Index page</a></li>
	<?php
		foreach( $breadcrumb as $listBread )
		{
			echo '<li><a href="' . base_url('category/get/' . $listBread['rewrite']) . '">' . $listBread['name'] . '</a></li>';
		}
	?>
</ul><!--/breadcrumb-->

<div id="content">
	<div class="grid-30">	
			<?php 
				if( count($category_sidebar) > 0 ):
				echo '<h2>' . $category_name . '</h2>';
				echo '<ul class="category-child">';
					foreach( $category_sidebar as $sub_cat ): 
			?>
					<li><a href="<?php echo $sub_cat['rewrite'];?>" class="h_a"><?php echo $sub_cat['name'];?></a>
					<?php
						$sub_sub = $this->category_md->get_category($sub_cat['id_category']);
						if( count($sub_sub) != 0 ):
					?>
						<ul>
							<?php foreach( $sub_sub as $sub_sub_cat ): ?>
							<li><a href="<?php echo $sub_sub_cat['rewrite'];?>"><?php echo $sub_sub_cat['name'];?></a></li>
							<?php endforeach;?>
						</ul>
					<?php
						endif;
					?>
					</li>
			<?php 
					endforeach; 
					echo '</ul><!--/category-child-->';
					echo '<div class="wave"></div>';
				endif;
				//echo $brandFilter . '////' . $filter;


			$root =base_url('category/get/' . $input_category);
			if( !empty($filter) || $brandFilter != 'All' )
			{
				echo '<h4>Вы выбрали:</h4>';
				echo '<ul id="filter-selected">';
			}
			
			if( $brandFilter != 'All' )
			{
				echo '<li>';
					echo '<h5>Производитель</h5>';
					echo '<ul>';
						$brandLinkFilter = $brandFilter;
						$arrBrand = explode(',', substr($brandFilter, 2, strlen($brandFilter)));
						foreach( $arrBrand as $itemFilter )
						{
							foreach( $brand as $itemBrand )
							{
								if( $itemFilter == $itemBrand['id_brand'] )
								{
									if( count($arrBrand) > 1 )
									{
										$brandLink = 'b=';
										foreach($arrBrand as $link)
										{
											if( $itemFilter != $link )
											{
												$brandLink .= $link . ',';
											}
										}
										$brandLink = substr($brandLink, 0, -1) . '/';
									}
									else
									{
										$brandLink = '';
										//$brandLinkFilter = '';
									}
									echo '<li><a href="' . $root . '/' . $brandLink . $filter . '">' . $itemBrand['name'] . '</a></li>';
								}
							}
						}
					echo '</ul>';
				echo '</li>';
				$root =base_url('category/get/' . $input_category . '/' . $brandLinkFilter);
			}

			if( !empty($filter) ):
				foreach( $options as $res_options ):
					$title = 0;
			
					foreach($res_options['value'] as $val)
					{
						$arrValHash = explode('##', $val);
						$show = FALSE;
						if(!empty($filter))
						{
							//$show = FALSE;
							$catFilter = explode(';', $filter);
							$d = '';
							$d1 = '';
							$n = '';
							foreach($catFilter as $key => $arr1)
							{
								$sub = explode('=', $arr1);
								//print_r($sub);
								if($sub[0] == $res_options['id_option'])
								{
									$arrHash = explode(',', $sub[1]);
									//print_r($arrHash);
									if( in_array($arrValHash[1], $arrHash) )
									{
										if($title == 0 )
										{
											$measurement = '';
											if( !empty($res_options['measurement']) )
											{
												$measurement = ', ' . $res_options['measurement'];
											}
											echo '<li><h5>' . $res_options['name'] . $measurement . '</h5>';
											echo '<ul>';
											$title = 1;
										}
										
										$l = '';
										foreach( $arrHash as $new )
										{
											if($new != $arrValHash[1])
											{
												$l .= $new . ',';
											}
										}
										if(strlen(substr($l, 0, strlen($l) -1)) > 0 )
										{
											$n = $sub[0] . '=' . substr($l, 0, strlen($l) -1) . ';';
										}
										else
										{
											$n = '';
										}
										
										$show = TRUE;
									}
								}
								else
								{
									$d .= ';' . $sub[0] . '=' . $sub[1];
									$d1 .= ';' . $sub[0] . '=' . $sub[1];
									if( empty($n) )
									{
										$d = substr($d1, 1);
									}

								}
							}
							if( $show == TRUE )
							{
								if( substr($d, 0, 1) == ';' )
								{
									$d = substr($d, 1, strlen($d));
								}
								if( empty($d) && substr($n, -1) == ';' )
								{
									$n = substr($n, 0, strlen($n) -1);
								}

								echo '<li><a href="' . $root . '/' . $n . $d .'">' . $arrValHash[0] . '</a></li>';
							}
						}
					}
					if( $title == 1 )
					{
						echo '</ul></li>';
					}
				endforeach;
			endif;
			if(!empty($filter) || $brandFilter != 'All')
			{
				echo '</ul>';
				echo '<div class="wave"></div>';
			}
		?>

		
		<?php if(!empty($filter) || $brandFilter != 'All' || count($options[0]) != 0): ?>
			<h4>Фильтр товаров</h4>
			<ul id="filter">
			<?php
				echo '<li><h5>Производитель</h5>';
					echo'<ul>';
						foreach( $brand as $name )
						{
							if( $brandFilter != 'All' )
							{
								if(!in_array($name['id_brand'], $arrBrand))
								{
									echo '<li><a href="http://magazin/category/get/' . $input_category . '/' . $brandFilter . ',' . $name['id_brand'] . '/' . $filter . '">' . $name['name'] . '</a></li>';
								}
							}
							else
							{
								echo '<li><a href="http://magazin/category/get/' . $input_category . '/b=' . $name['id_brand'] . '/' . $filter . '">' . $name['name'] . '</a></li>';
							}
						}
					echo'</ul>';
				echo'</li>';
			if( count($options[0]) != 0 ):
				foreach( $options as $key => $res_options ):
					$measurement = '';
					if( !empty($res_options['measurement']) )
					{
						$measurement = ', ' . $res_options['measurement'];
					}
					//print_r($avOptions[$key]['value']);
					if( count($avOptions[$key]['value']) > 0 ):
			?>
					<li><h5><?php echo $res_options['name'] . $measurement;?></h5>
						<ul>
							<?php

								foreach($res_options['value'] as $val)
								{
									$show = TRUE;
									$add = FALSE;
									$active = TRUE;
									$arrValHash = explode('##', $val);
									$count = '';
									

									$d = '';
									$d1 = '';
									$n = '';

									if(!empty($filter))
									{
										$catFilter = explode(';', $filter);
										//print_r($catFilter);
										
										foreach($catFilter as $arr1)
										{
											
											$sub = explode('=', $arr1);
											$av = explode('=', $catFilter[0]);

											if($sub[0] == $res_options['id_option'])
											{
												$arrHash = explode(',', $sub[1]);
												if( in_array($arrValHash[1], $arrHash) )
												{
													$show = FALSE;
												}
												else
												{
													$adding = $sub[1] . ',' . $arrValHash[1];
													//echo $sub[1] . '<br>';
													$d .= ';' . $res_options['id_option'] . '=' . $adding;
													
													$active = FALSE;
													if( $av[0] == $res_options['id_option'])
													{
														$active = TRUE;
														$count = ' (+' . $this->category_md->get_count_item($arrValHash[1], $id_category) . ')';
													}
												}
											}
											else
											{
												foreach($catFilter as $arr2)
												{
													$sub2 = explode('=', $arr2);
													if( $sub2[0] == $res_options['id_option'] )
													{
														$add = TRUE;
													}
												}
												if($add == TRUE)
												{
													$d .= ';' . $arr1;//$sub[0] . '=' . $sub[1];
												}
												else
												{
													$active = FALSE;
													foreach( $avOptions[$key]['value'] as $arrt )
													{
														$n = explode('##', $arrt);
														if($n[1] == $arrValHash[1])
														{
															$active = TRUE;
														}
													}
													$d = $filter . ';' . $res_options['id_option'] . '=' . $arrValHash[1];
													$count = '(' . $arrValHash[0] . ')';
												}
											}
											
										}
									}
									else
									{
										$d = $res_options['id_option'] . '=' . $arrValHash[1];
									}

									if( $show == TRUE )
									{
										if( substr($d, 0, 1) == ';' )
										{
											$d = substr($d, 1, strlen($d));
										}
										
										if( $active == TRUE )
										{
											echo '<li><a href="' . $root . '/' . $d . '">' . $arrValHash[0] . '</a>' . $count . '</li>';
										}
										else
										{
											echo '<li><span style="color: #EEE;">' . $arrValHash[0] . $count . '</span></li>';
										}
									}
								}
							?>
						</ul>
					</li>					
			<?php
				endif;
				endforeach; 
				endif;
			?>
			</ul>
			<div class="wave"></div>
		<?php endif;?>

		<div style="width: 100%; text-align: center; margin-top: 10px;">
			<img src="<?php echo base_url('themes/' . $themePath . '/images/item2.jpg');?>" style="max-width: 100%; height: 375px;" />
		</div>

	</div><!--/grid-30-->