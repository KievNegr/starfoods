<?php
	class Admin_md extends CI_Model
	{
		function __construct()
		{
			$this->load->database();
		}
		
		function get_order_products($id)
		{
			$query = $this->db->get_where('products', array('id_product' => $id));
			return $query->row_array();
		}
		
		function get_category( $id = 0)
		{
			if( $id == 0 )
			{
				$this->db->order_by('id_category', 'desc');
				$query = $this->db->get('category');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('category', array('id_category' => $id));
				return $query->row_array();
			}
		}
		
		function get_parent_category($sub)
		{
			$query = $this->db->get_where('category', array('id_category' => $sub));
			return $query->row_array();
		}
		
		function delete_category( $id )
		{
			$query = $this->db->get_where('category', array('id_category' => $id));
			$res = $query->row_array();
			unlink('./images/upload/'.$res['image']);
			$this->db->delete('category', array('id_category' => $id));
			return true;
		}
		
		function set_category( $image )
		{
			$data = array(
				'sub_category' => $this->input->post('cat_parent'),
				'rewrite' => $this->input->post('cat_url'),
				'name' => $this->input->post('cat_name'),
				'title' => $this->input->post('cat_title'),
				'description' => $this->input->post('cat_description'),
				'text' => $this->input->post('cat_text'),
				'sort' => '1',
				'image' => $image,
				'dt' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return $this->db->insert('category', $data);	
		}
		
		function edit_category($image)
		{
			if( $image == 'noimage' )
			{
				$data = array(
					'rewrite' => $this->input->post('cat_url'),
					'name' => $this->input->post('cat_name'),
					'title' => $this->input->post('cat_title'),
					'description' => $this->input->post('cat_description'),
					'text' => $this->input->post('cat_text'),
					'dt' => date("Y-m-d H:i:s"),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'login' => 'Admin'
				);
			}
			else
			{
				$query = $this->db->get_where('category', array('id_category' => $this->input->post('category_id')));
				$row = $query->row_array();
				
				unlink('./images/upload/'.$row['image']);
				
				$data = array(
					'rewrite' => $this->input->post('cat_url'),
					'name' => $this->input->post('cat_name'),
					'title' => $this->input->post('cat_title'),
					'description' => $this->input->post('cat_description'),
					'text' => $this->input->post('cat_text'),
					'image' => $image,
					'dt' => date("Y-m-d H:i:s"),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'login' => 'Admin'
				);
			}
			
			$this->db->where('id_category', $this->input->post('category_id'));
			return $this->db->update('category', $data);
		}
		
		// Функция вывода последних N товаров
		function get_added_product( $limit)
		{
			//Сортируем товары по ID
			$this->db->order_by('id_product', 'desc');
			//Выполняем запрос в БД товаров
			$query = $this->db->get_where('products', array('temp' => 0), $limit);
			//Возвращаем массив товаров
			return $query->result_array();		
		}
		
		function get_product( $id = 0)
		{
			$this->db->order_by('id_product', 'desc');
			if( $id == 0 )
			{
				$query = $this->db->get_where('products', array('temp' => 0));
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('products', array('id_product' => $id));
				return $query->row_array();
			}		
		}
		
		function set_option()
		{
			$data['value'] = $this->input->post('option_name');
			$data['measurement'] = $this->input->post('option_value');
			$this->db->insert('options', $data);
			
			if( $this->input->post('count_cat') != 0 )
			{
				
				$query = $this->db->get_where('options', array('value' => $this->input->post('option_name')));
				$res = $query->row_array();
				
				for( $i = 1; $i <= $this->input->post('count_cat'); $i++ )
				{
					if( $this->input->post('cat'.$i) == TRUE )
					{
						//echo 'Выделен №:'.$i.' id категории: '.$this->input->post('id_cat'.$i).'<br />';
						$data_set = array(
							'id_option' => $res['id'],
							'id_category' => $this->input->post('id_cat'.$i)
							);
						$this->db->insert('options_category', $data_set);
					}
				}
			}
			
			return TRUE;
		}
		
		function edit_option( $id )
		{
			//Получаем название опции
			$data['value'] = $this->input->post('option_name');
			//Получаем измерение опции
			$data['measurement'] = $this->input->post('option_value');
			
			//Выбираем нужную строку по ID опции
			$this->db->where('id', $id);
			
			//Обновляем название опции
			$this->db->update('options', $data);
			
			//Удаляем все опции для категории
			$this->db->delete('options_category', array('id_option' => $id));
			
			//Если есть выделенные чекбоксы то начинаем переборку и вставку для категорий
			if( $this->input->post('count_cat') != 0 )
			{				
				for( $i = 1; $i <= $this->input->post('count_cat'); $i++ )
				{
					if( $this->input->post('cat'.$i) == TRUE )
					{
						//echo 'Выделен №:'.$i.' id категории: '.$this->input->post('id_cat'.$i).'<br />';
						$data_set = array(
							'id_option' => $id,
							'id_category' => $this->input->post('id_cat'.$i)
							);
						$this->db->insert('options_category', $data_set);
					}
				}
				
				//Проверяем актуальность опции для товара
				/*$query = $this->db->get_where('options_for_product', array('id_option' => $id));
				$res = $query->result_array();
				foreach( $res as $item )
				{
					$query2 = $this->db->get_where('products', array('id_product' => $item['id_product']));
					$res2 = $query2->row_array();
					
					$query3 = $this->db->get_where('options_category', array('id_category' => $res2['id_category'], 'id_option'  => $id));
					$res3 = $query3->result_array();
					if( empty($res3) )
					{
						$this->db->delete('options_for_product', array('id_option' => $id, 'id_product' => $item['id_product']));
					}
					//echo $res2['id_category'].' - '.$item['id_product'].' - '.$id.'<br>';
				}*/
			}
			
			return TRUE;
		}
		
		/*Выбираем значения для редактирования свойства
		function get_option_value( $id )
		{
			$query = $this->db->get_where('options', array('id' => $id));
			return $query->result_array();
		}*/
		
		//Обновляем значения для свойства
		/*function edit_option_value( $id )
		{
			$this->db->delete('option_value', array('id' => $id));
			
			$string = trim($this->input->post('option_value'));
			
			if( substr($string ,-1) == ',' )
			{
				$string = substr($string ,0 ,-1);
			}
			
			$values = explode(',', $string);
			
			foreach( $values as $item )
			{
				$data = Array(
					'id' => $id,
					'value' => $item
					);
				
				$this->db->insert('option_value', $data);
			}
		}*/
		
		function get_options( $id = 0)
		{
			if( $id != 0 )
			{
				$query = $this->db->get_where('options', array('id' => $id));
				return $query->row_array();
			}
			else
			{
				$query = $this->db->get('options');
				
				return $query->result_array();
			}
		}
		
		function get_chek( $id_category, $id_option )
		{
			$query = $this->db->get_where('options_category', array('id_category' => $id_category, 'id_option' => $id_option));
			$res = $query->row_array();
			return count($res);
		}	
		
		function delete_option( $id )
		{
			$this->db->delete('options', array('id' => $id));
			$this->db->delete('options_category', array('id_option' => $id));
			//$this->db->delete('options_for_product', array('id_option' => $id));
			return TRUE;
		}
		
		function set_image( $id_product, $name)
		{
			$query = $this->db->get_where('images', array('id_product' => $id_product));
			if( count($query->result_array()) == 0 )
			{
				$boss = 1;
			}
			else
			{
				$boss = 0;
			}
			$data = array(
				'id_product' => $id_product,
				'name' => $name,
				'img_boss' => $boss
			);
			
			$this->db->insert('images', $data);
			return mysql_insert_id();
		}
		
		//Занесение товара в БД
		function set_product( $id = 0 )
		{
			//Если $id = 0 то создаем новую временную строку для товара
			if( $id == 0 )
			{
				$dt = date("Y-m-d H:i:s");
				$data = array(
					'dt' => $dt,
					'temp' => 1
					);
				$this->db->insert('products', $data);
				$this->db->select('id_product');
				$query = $this->db->get_where('products', array('dt' => $dt));
				return $query->row_array();
			}
			else //Иначе снимаем флаг временной строки и добавляем значения товара
			{
				$brand = $this->input->post('brand');
				if( !empty($brand) )
				{
					$query = $this->db->get_where('brand', array('name' => $brand));
					$resBrand = $query->row_array();
					if( count($resBrand) != 0 )
					{
						$idBrand = $resBrand['id_brand'];
					}
					else
					{
						$dataBrand = Array('name' => $brand);
						$this->db->insert('brand', $dataBrand);
						$idBrand = mysql_insert_id();
					}
				}
				else
				{
					$idBrand = 0;
				}
				$data = array(
					'id_category' => $this->input->post('prod_category'),
					'id_brand' => $idBrand,
					'available' => $this->input->post('available'),
					'rewrite' => $this->input->post('prod_url'),
					'name' => $this->input->post('prod_name'),
					'title' => $this->input->post('prod_title'),
					'description' => $this->input->post('prod_description'),
					'text' => $this->input->post('prod_text'),
					'full_text' => $this->input->post('full_prod_text'),
					'price' => $this->input->post('prod_price'),
					'temp' => 0
					);
				$this->db->where('id_product', $id);
				$this->db->update('products', $data);
				
				for( $t = 1; $t <= $this->input->post('count_option'); $t++ )
				{
					$data = array(
						'id_option' => $this->input->post('id_option'.$t),
						'id_category' => $this->input->post('prod_category'),
						'id_product' => $id,
						'value' => $this->input->post('option'.$t)
					);
					
					$query = $this->db->get_where('filter', array('id_option' => $this->input->post('id_option'.$t), 'id_product' => $id));
					$res = $query->row_array();

					if( count($res) == 0 )
					{
						$query = $this->db->get_where('filter', array('value' => $data['value'], 'id_option' => $this->input->post('id_option'.$t)));
						$res_v = $query->row_array();
						if(count($res_v) != 0 )
						{
							$data['hash'] = $res_v['hash'];
							$this->db->insert('filter', $data);
						}
						else
						{
							$this->db->insert('filter', $data);
							$hashVal = mysql_insert_id();
							$this->db->where(array('id' => $hashVal));
							$data['hash'] = $hashVal;
							$this->db->update('filter', $data);
						}

						
					}
					else
					{
						$query = $this->db->get_where('filter', array('value' => $data['value']));
						$res_v = $query->row_array();
						if(count($res_v) != 0 )
						{
							$data['hash'] = $res_v['hash'];
							$this->db->where(array('id_option' => $this->input->post('id_option'.$t), 'id_product' => $id));
							$this->db->update('filter', $data);
						}
						else
						{
							$query = $this->db->get_where('filter', array('id_option' => $this->input->post('id_option'.$t), 'id_product' => $id));
							$res_v = $query->row_array();
							$data['hash'] = $res_v['id'];
							$this->db->where(array('id_option' => $this->input->post('id_option'.$t), 'id_product' => $id));
							$this->db->update('filter', $data);
						}
					}
				}
				
				//Удаляем все временные строки
				$this->db->delete('products', array('temp' => 1));
				return true;
			}
		}
		
		//Удаление изображения из базы и с диска
		function del_product_image()
		{
			//Получаем ID картинки методом POST и узнаем ее имя в БД
			$query = $this->db->get_where('images', array('id_images' => $this->input->post('id_image')));
			$row = $query->row_array();
			
			//Удаляем с диска изображение и его миниатюру
			unlink('./images/upload/'.$row['name']);
			unlink('./images/upload/thumbs/'.$row['name']);
			
			//Удаляем с БД изображение
			return $this->db->delete('images', array('id_images' => $this->input->post('id_image')));
		}
		
		function set_boss_image()
		{
			$data['img_boss'] = 0;
			$this->db->where(array('id_product' => $this->input->post('id_item')));
			$this->db->update('images', $data);
			
			$data['img_boss'] = 1;
			$this->db->where(array('id_images' => $this->input->post('id_image')));
			$this->db->update('images', $data);
			
			return TRUE;
		}
		
		function delete_product( $id )
		{
			$this->db->delete('products', array('id_product' => $id));
			$query = $this->db->get_where('images', array('id_product' => $id));
			$res = $query->result_array();
			for( $i = 0; $i < count($res); $i++ )
			{
				unlink('./images/upload/'.$res[$i]['name']);
				unlink('./images/upload/thumbs/'.$res[$i]['name']);
			}
			$this->db->delete('images', array('id_product' => $id));
			return true;
		}

		function delete_order( $key )
		{
			$this->db->delete('orders', array('key_order' => $key));
			$this->db->delete('order_products', array('id_orders' => $key));
			$this->db->delete('users_orders', array('key_orders' => $key));
		}
		
		function get_brand($id = 0)
		{
			if($id == 0){
				$query = $this->db->get('brand');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('brand', array('id_brand' => $id));
				return $query->row_array();
			}
		}
		
		function delete_brand( $id )
		{
			$query = $this->db->get_where('brand', array('id_brand' => $id));
			$res = $query->row_array();

			unlink('./images/upload/'.$res['image']);

			$this->db->delete('brand', array('id_brand' => $id));
			return true;
		}
		
		function edit_brand($image)
		{
			if( $image == 'noimage' )
			{
				$data = array(
					'name' => $this->input->post('brand_name'),
					'text' => $this->input->post('brand_text'),
					'dt' => date("Y-m-d H:i:s"),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'login' => 'Admin'
				);
			}
			else
			{
				$query = $this->db->get_where('brand', array('id_brand' => $this->input->post('brand_id')));
				$row = $query->row_array();
				
				unlink('./images/upload/'.$row['image']);
				
				$data = array(
					'name' => $this->input->post('brand_name'),
					'text' => $this->input->post('brand_text'),
					'image' => $image,
					'dt' => date("Y-m-d H:i:s"),
					'ip' => $_SERVER['REMOTE_ADDR'],
					'login' => 'Admin'
				);
			}
			
			$this->db->where('id_brand', $this->input->post('brand_id'));
			$this->db->update('brand', $data);
			return $image;
		}
		
		function set_brand($image)
		{
			$data = array(
				'name' => $this->input->post('brand_name'),
				//'text' => $this->input->post('brand_text'),
				//'image' => $image,
				'dt' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return $this->db->insert('brand', $data);	
		}
		
		function get_orders( $limit = 0 )
		{
			$this->db->order_by('id_user', 'desc');
			if( $limit == 0 )
			{
				$query = $this->db->get('users_orders');
			}
			else
			{
				$query = $this->db->get('users_orders', $limit);
			}
			return $query->result_array();
		}
		
		function get_order( $key_order )
		{
			$query = $this->db->get_where('users_orders', array('key_orders' => $key_order));
			return $query->row_array();
		}
		
		function update_order()
		{
			$data = Array(
				'name_user' => $this->input->post('name'),
				'mail_user' => $this->input->post('mail'),
				'phone_user' => $this->input->post('phone'),
				'fax_user' => $this->input->post('fax'),
				'city_user' => $this->input->post('city'),
				'street_user' => $this->input->post('street'),
				'build_user' => $this->input->post('build'),
				'app_user' => $this->input->post('app'),
				'pay_user' => $this->input->post('pay'),
				'ships_user' => $this->input->post('shipps')
				);
			$this->db->where('key_orders', $this->input->post('key_order'));
			$this->db->update('users_orders', $data);
			
			$data2['status'] = $this->input->post('status');
			$this->db->where('key_order', $this->input->post('key_order'));
			$this->db->update('orders', $data2);
			return TRUE;
		}
		
		function delete_product_from_order()
		{
			$id_product = $this->input->post('id');
			$id_order = $this->input->post('id_order');
			return $this->db->delete('order_products', array('id_product' => $id_product, 'id_orders' => $id_order));
		}
		
		function get_new_item_order()
		{
			$id_product = $this->input->post('id_product');
			$query = $this->db->get_where('products', array('id_product' => $id_product));
			if( $query == TRUE )
			{
				return $query->row_array();
			}
		}
		
		function add_new_item_order()
		{
			$id_product = $this->input->post('id_product');
			$key_order = $this->input->post('key_order');
			
			$query = $this->db->get_where('order_products', array('id_product' => $id_product, 'id_orders' => $key_order));
			$arr = $query->row_array();
			
			if( empty($arr) )
			{
				$query = $this->db->get_where('products', array('id_product' => $id_product));
				$price = $query->row_array();
				
				$data = Array(
					'qty' => 1,
					'id_orders' => $key_order,
					'id_product' => $id_product,
					'price' => $price['price']
				);
				$this->db->insert('order_products', $data);
				return TRUE;
			}
			else
			{
				$qty = $arr['qty'] + 1;
				$data = Array(
					'qty' => $qty
				);
				
				$this->db->where(array('id_product' => $id_product, 'id_orders' => $key_order));
				$this->db->update('order_products', $data);
				return TRUE;
			}
		}
		
		function edit_qty()
		{
			$data = Array(
				'qty' => $this->input->post('qty')
				);
			$this->db->where(array('id_product' => $this->input->post('id'), 'id_orders' => $this->input->post('order')));
			$this->db->update('order_products', $data);
			
			$query = $this->db->get_where('order_products', array('id_product' => $this->input->post('id'), 'id_orders' => $this->input->post('order')));
			return $query->row_array();
		}
		
		function sum_prod()
		{
			$query = $this->db->get_where('order_products', array('id_orders' => $this->input->post('order')));
			return $query->result_array();
		}
		
		function get_status( $id_status = 0 )
		{
			if( $id_status == 0 )
			{
				$query = $this->db->get('status');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('status', array('id_status' => $id_status));
				return $query->row_array();
			}
		}
		
		function check_status()
		{
			$query = $this->db->get_where('status', array( 'name' => $this->input->post('name') ) );
			return $query->row_array();
		}
		
		//Функция добавления нового статуса заказа
		function set_status()
		{
			//Проверка на правильность поля ЦВЕТ - наличие #
			$color = $this->input->post('color');
			$textcolor = $this->input->post('textcolor');

			if( substr($color, 0, 1) != '#' )
			{
				$color = '#'.$color;
			}
			
			if( substr($textcolor, 0, 1) != '#' )
			{
				$textcolor = '#'.$textcolor;
			}
			$data = array(
				'name' => $this->input->post('name_status'),
				'color' => $color,
				'textcolor' => $textcolor,
				'data' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return	$this->db->insert('status', $data);
		}
		
		//Функция редактирования
		function edit_status()
		{
			//Проверка на правильность поля ЦВЕТ - наличие #
			$color = $this->input->post('color');
			if( substr($color, 0, 1) != '#' )
			{
				$color = '#'.$color;
			}
			$textcolor = $this->input->post('textcolor');
			if( substr($textcolor, 0, 1) != '#' )
			{
				$textcolor = '#'.$textcolor;
			}
			$data = array(
				'name' => $this->input->post('name'),
				'color' => $color,
				'textcolor' => $textcolor,
				'data' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
				
			$this->db->where('id_status', $this->input->post('status_id'));
			return $this->db->update('status', $data);
		}
		
		function trash_status()
		{
			$data = array(
				'name' => $this->input->post('name_status'),
				'data' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return $this->db->insert('status', $data);	
		}
		
		function delete_status( $id )
		{
			return $this->db->delete('status', array('id_status' => $id));
		}
		
		function get_status_order( $key_order )
		{
			$query = $this->db->get_where('orders', array('key_order' => $key_order));
			return $query->row_array();
		}
		
		function get_products_order( $key_order )
		{
			$query = $this->db->get_where('order_products', array('id_orders' => $key_order));
			return $query->result_array();
		}
		
		function get_money($id = 0)
		{
			if($id == 0)
			{
				$query = $this->db->get('money');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('money', array('id_money' => $id));
				return $query->row_array();
			}
		}
		
		function edit_money()
		{
			/*if( $this->input->post('money_check') == TRUE )
			{
				$this->db->where('default_money', 1);
				$this->db->update('money', array('default_money' => 0));
				
				$data['default_money'] = 1;
			}*/
			
			$data['name_money'] = $this->input->post('edit_money_name');
			$data['key_money'] = $this->input->post('edit_money_key');
			$data['exchange_money'] = $this->input->post('edit_money_ex');
			$data['data'] = date("Y-m-d H:i:s");
			
			$this->db->where('id_money', $this->input->post('edit_money_id'));
			return $this->db->update('money', $data);
		}
		
		function delete_money( $id )
		{
			return $this->db->delete('money', array('id_money' => $id));
		}
		
		function edit_pay()
		{
			$data = array(
				'name_pay' => $this->input->post('edit_pay_name'),
				'markup' => $this->input->post('edit_pay_markup'),
				'data' => date("Y-m-d H:i:s")
			);
			
			$this->db->where('id_pay', $this->input->post('edit_pay_id'));
			return $this->db->update('pay', $data);
		}
		
		function get_pay( $id = 0)
		{
			if( $id == 0 )
			{
				$query = $this->db->get('pay');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('pay', array('id_pay' => $id));
				return $query->row_array();
			}
		}
		
		function delete_pay( $id )
		{
			return $this->db->delete('pay', array('id_pay' => $id));
		}
		
		function get_delivery( $id = 0)
		{
			if( $id == 0 )
			{
				$query = $this->db->get('shipping');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('shipping', array('id_shipping' => $id));
				return $query->row_array();
			}
		}
		
		//Проверка на наличие имени доставки
		function check_delivery()
		{
				$query = $this->db->get_where('shipping', array('name_shipping' => $this->input->post('name')));
				return $query->row_array();
		}
		
		function set_tax()
		{
			$data = array(
				'name' => $this->input->post('name_tax'),
				'tax_val' => $this->input->post('val_tax'),
				'type' => $this->input->post('type_tax')
				);
			return $this->db->insert('taxes', $data);	
		}
		
		function get_tax( $id = 0)
		{
			if( $id == 0 )
			{
				$query = $this->db->get('taxes');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('taxes', array('id_tax' => $id));
				return $query->row_array();
			}
		}
		
		function edit_delivery()
		{
			$data = array(
				'name_shipping' => $this->input->post('edit_delivery_name'),
				'price' => $this->input->post('edit_delivery_price'),
				'data' => date("Y-m-d H:i:s")
			);
			
			$this->db->where('id_shipping', $this->input->post('edit_delivery_id'));
			return $this->db->update('shipping', $data);
		}
		
		function delete_delivery( $id )
		{
			return $this->db->delete('shipping', array('id_shipping' => $id));
		}
		
		function set_money()
		{
			if( $this->input->post('money_check') == TRUE  )
			{
				$data['default_money'] = 0;
				$this->db->where('default_money', 1);
				$this->db->update('money', $data);
				$default = 1;
			}
			else
			{
				$default = 0;
			}
			
			$data = array(
				'name_money' => $this->input->post('money_name'),
				'key_money' => $this->input->post('money_key'),
				'exchange_money' => $this->input->post('money_ex'),
				'default_money' => $default,
				'data' => date("Y-m-d H:i:s")
			);
			
			return $this->db->insert('money', $data);
		}
		
		function set_pay()
		{
			$data = array(
				'name_pay' => $this->input->post('pay_name'),
				'markup' => $this->input->post('pay_markup'),
				'data' => date("Y-m-d H:i:s")
			);
			
			return $this->db->insert('pay', $data);
		}
		
		function set_delivery()
		{
			$data = array(
				'name_shipping' => $this->input->post('delivery_name'),
				'price' => $this->input->post('delivery_price'),
				'data' => date("Y-m-d H:i:s")
			);
			
			return $this->db->insert('shipping', $data);
		}
		
		function set_city()
		{
			$data = array(
				'name_city' => $this->input->post('city_name')
			);
			
			return $this->db->insert('city', $data);
		}
		
		function get_city( $id = 0)
		{
			if( $id == 0 )
			{
				$query = $this->db->get('city');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('city', array('id_city' => $id));
				return $query->row_array();
			}
		}
		
		function delete_city( $id )
		{
			return $this->db->delete('city', array('id_city' => $id));
		}
		
		function edit_city()
		{
			$data = array(
				'name_city' => $this->input->post('edit_city_name')
			);
			
			$this->db->where('id_city', $this->input->post('edit_city_id'));
			return $this->db->update('city', $data);
		}
		
		function select_options( $id_option = 0)
		{
			if( $id_option == 0 )
			{
				$query = $this->db->get_where('options_category', array('id_category' => $this->input->post('id_category')));
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('options', array('id' => $id_option));
				return $query->row_array();
			}
		}
		
		function get_product_options( $id_option, $id_prod )
		{
			$query = $this->db->get_where('filter', array('id_option' => $id_option, 'id_product' => $id_prod));
			return $query->row_array();
		}
		
		function get_settings()
		{
			$query = $this->db->get('settings');
			return $query->result_array();
		}
		
		function set_settings()
		{
			$data = array(
				'value' => $this->input->post('title_shop')
			);
			$this->db->where('name', 'title_shop');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => $this->input->post('description_shop')
			);
			$this->db->where('name', 'description');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => $this->input->post('keywords_shop')
			);
			$this->db->where('name', 'keywords');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => $this->input->post('theme_shop')
			);
			$this->db->where('name', 'themePath');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => $this->input->post('count_item')
			);
			$this->db->where('name', 'count_item_page');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => '',
				'width' => $this->input->post('image_list_item_w'),
				'height' => $this->input->post('image_list_item_h')
			);
			$this->db->where('name', 'image_list_item');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => '',
				'width' => $this->input->post('image_boss_item_w'),
				'height' => $this->input->post('image_boss_item_h')
			);
			$this->db->where('name', 'image_boss_item');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => '',
				//'width' => $this->input->post('image_preview_item_w'),
				'height' => $this->input->post('image_preview_item_h')
			);
			$this->db->where('name', 'image_preview_item');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => '',
				'width' => $this->input->post('image_category_w'),
				'height' => $this->input->post('image_category_h')
			);
			$this->db->where('name', 'image_category');
			$this->db->update('settings', $data);
			
			$data = array(
				'value' => '',
				'width' => $this->input->post('image_logo_brand_w'),
				'height' => $this->input->post('image_logo_brand_h')
			);
			$this->db->where('name', 'image_logo_brand');
			$this->db->update('settings', $data);
			
			$data = array(
				'default_money' => 0,
				'view_money' => 0
			);
			$this->db->update('money', $data);
			
			$data = array(
				'default_money' => 1
			);
			$this->db->where('id_money', $this->input->post('default_money'));
			$this->db->update('money', $data);
			
			$data2 = array(
				'view_money' => 1
			);
			$this->db->where('id_money', $this->input->post('view_money'));
			$this->db->update('money', $data2);
			
			return TRUE;
		}
		
		function get_pages( $id = 0)
		{
			$this->db->order_by('id_page', 'desc');
			if( $id == 0 )
			{
				$query = $this->db->get('pages');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('pages', array('id_page' => $id));
				return $query->row_array();
			}		
		}
		
		function set_page()
		{
			$data = Array(
				'title' => $this->input->post('page_name'),
				'h1' => $this->input->post('page_title'),
				'rewrite' => $this->input->post('page_url'),
				'description' => $this->input->post('page_description'),
				'keywords' => $this->input->post('page_keywords'),
				'text' => $this->input->post('page_text'),
				'dt' => date("Y-m-d H:i:s")
			);
			if( $this->input->post('view') == TRUE )
			{
				$data['view'] = 1;
			}
			else
			{
				$data['view'] = 0;
			}
			
			return $this->db->insert('pages', $data);
		}

		function update_page($id = '')
		{
			$data = Array(
				'title' => $this->input->post('pageName'),
				'h1' => $this->input->post('pageH1'),
				'rewrite' => $this->input->post('pageRewrite'),
				'description' => $this->input->post('pageDescription'),
				'keywords' => $this->input->post('pageKeywords'),
				'text' => $this->input->post('pageText'),
				'view' => $this->input->post('view')
			);
			
			if( !empty($id) )
			{
				$this->db->where('id_page', $id);
				return $this->db->update('pages', $data);
			}
			else
			{
				$data['dt'] = date("Y-m-d H:i:s");
				return $this->db->insert('pages', $data);
			}
		}

		function delete_page( $id )
		{
			return $this->db->delete('pages', array('id_page' => $id));
		}
	}