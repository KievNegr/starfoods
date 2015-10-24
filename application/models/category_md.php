<?php
	class Category_md extends CI_Model
	{
		function __construct()
		{
			$this->load->database();
		}
		
		function get_brand($id)
		{
			if( !empty($id) || $id != 0 )
			{
				$query = $this->db->query('SELECT*FROM brand WHERE id_brand in (' . $id . ')');
				return $query->result_array();
			}
		}
		
		function get_category($input_id)
		{
			$query = $this->db->get_where('category', array('sub_category' => $input_id));
			return $query->result_array();	
		}
		
		function get_id_category($input_name)
		{
			if( is_numeric( $input_name ) )
			{
				$query = $this->db->get_where('category', array('id_category' => $input_name));
			}
			else
			{
				$query = $this->db->get_where('category', array('rewrite' => $input_name));
			}
			return $query->row_array();
		}
		
		function get_parent_category($sub)
		{
			$query = $this->db->get_where('category', array('id_category' => $sub));
			return $query->row_array();
		}
		
		function get_products($cat_id, $brandList = '')
		{
			if( empty($brandList) )
			{
				$this->db->order_by('id_product', 'desc');
				$query = $this->db->get_where('products', array('id_category' => $cat_id));
			}
			else
			{
				$query = $this->db->query('SELECT*FROM products WHERE id_brand in (' . $brandList . ') AND id_category = ' . $cat_id . ' ORDER BY id_product DESC');
			}

			return $query->result_array();
		}

		function get_filter_products($id_category, $filter, $bFilter = '')
		{
			$arr1 = explode(';', $filter);
			$selId = Array();
			$productId = Array();

			foreach( $arr1 as $new )
			{
				$arr2 = explode('=', $new);
				$arr3 = explode(',', $arr2[1]);

				$listFilter = '';
				foreach( $arr3 as $hash )
				{
					$listFilter .= $hash . ', ';
				}
				$listFilter = substr($listFilter, 0, -2);
				if( empty($productId) )
				{
					$query = $this->db->query('SELECT*FROM filter WHERE hash in (' . $listFilter . ') AND id_category = ' . $id_category);
					$res = $query->result_array();

					foreach( $res as $item )
					{
						$productId[] = $item['id_product'];
					}
				}
				else
				{
					$tempIdProduct = Array();
					foreach($productId as $id )
					{
						$query = $this->db->query('SELECT*FROM filter WHERE hash in (' . $listFilter . ') AND id_product = ' . $id . ' AND id_category = ' . $id_category);
						$res = $query->row_array();
						if(count($res) != 0)
						{
							$tempIdProduct[] = $res['id_product'];
						}
					}
					$productId = $tempIdProduct;
				}
				
			}
			$idProd = '';
			foreach( $productId as $id )
			{
				$idProd .= $id . ', ';
			}
			$idProd = substr($idProd, 0, -2);

			if( empty($bFilter) && !empty($idProd))
			{
				$query = $this->db->query('SELECT*FROM products WHERE id_product in (' . $idProd . ') AND view = 1 ORDER BY id_product DESC');
			}
			elseif(!empty($idProd))
			{
				$query = $this->db->query('SELECT*FROM products WHERE id_product in (' . $idProd . ') AND id_brand in (' . $bFilter . ') AND view = 1 ORDER BY id_product DESC');
			}

			return $query->result_array();
		}
		
		function get_count_item($hash, $id_category)
		{
			$query = $this->db->get_where('filter', array('hash' => $hash, 'id_category' => $id_category));
			$res = $query->result_array();
			return count($res);
		}

		function set_product()
		{
			$data = array(
				'id_category' => $this->input->post('prod_category'),
				'id_brand' => $this->input->post('prod_brand'),
				'rewrite' => $this->input->post('prod_url'),
				'name' => $this->input->post('prod_name'),
				'title' => $this->input->post('prod_title'),
				'description' => $this->input->post('prod_description'),
				'text' => $this->input->post('prod_text'),
				'price' => $this->input->post('prod_price'),
				'dt' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return $this->db->insert('products', $data);	
		}
		
		function set_brand()
		{
			$data = array(
				'name' => $this->input->post('brand_name'),
				'text' => $this->input->post('brand_text'),
				'dt' => date("Y-m-d H:i:s"),
				'ip' => $_SERVER['REMOTE_ADDR'],
				'login' => 'Admin'
				);
			return $this->db->insert('brand', $data);	
		}
		
		//Ôóíêöèÿ ïîèñêà ãëàâíîãî èçîáðàæåíèÿ òîâàðà ïî ID
		function get_boss_image( $id )
		{
			//Ïðîèçâîäèì çàïðîñ â ÁÄ ñ ID òîâàðà
			$query = $this->db->get_where('images', array('id_product' => $id, 'img_boss' => 1));
			//Âîçâðàùàåì ñòðîêó ñ òåõ.äàííûìè èçîáðàæåíèÿ
			return $query->row_array();
		}
		
		function get_list_option( $id_category, $listProduct = '' ) 
		{
			if( empty($listProduct) )
			{
				$query = $this->db->get_where('filter', array('id_category' => $id_category));
			}
			else
			{
				$query = $this->db->query('SELECT*FROM filter WHERE id_product in (' . $listProduct . ') AND id_category = ' . $id_category );
			}
			$res = $query->result_array();
			if( count($res) > 0 )
			{
				$temp = Array();
				$result = Array();
				$t = 0;
				foreach( $res as $arr )
				{
					if( !in_array($arr['id_option'], $temp) )
					{
						$id = $arr['id_option'];
						$temp[] = $id;

						for( $i = 0; $i < count($res); $i++ )
						{
							if( $res[$i]['id_option'] == $id )
							{
								$result[$t]['id_option'] = $id;
								$result[$t]['val'][] = $res[$i]['value'] . '##' . $res[$i]['hash'];
							}
						}
					}

					
					$t++;
				}
				foreach( $result as $un_array )
				{
					$t_array = array_unique($un_array['val']);
					$name = $this->category_md->get_name_option($un_array['id_option']);
					$array[] = Array('id_option' => $un_array['id_option'], 'name' => $name['value'], 'measurement' => $name['measurement'], 'value' => $t_array);
				}
				//print_r($array);
				return $array;
			}
		}
		
		function get_name_option( $id_option )
		{
			$query = $this->db->get_where('options', array('id' => $id_option));
			$res = $query->row_array();
			return $res;
		}
		
		function get_list_item( $id_category )
		{
			$query = $this->db->get_where('products', array('id_category' => $id_category));
			return $query->result_array();
		}		
		
		function get_val_option( $id_option, $id_product )
		{
			$this->db->where('id_option', $id_option);
			$this->db->where('id_product', $id_product);
			$query = $this->db->get('options_for_product');
			return $query->row_array();
		}
		
		function get_products_with_options( $id_category, $value_option, $id_option )
		{	
			$this->db->where( array('id_option' => $id_option, 'text_option' => $value_option) );
			$query = $this->db->get('options_for_product');
			
			$res = $query->result_array();
			$list = Array();
			foreach( $res as $item )
			{
				$this->db->where( array('id_product' => $item['id_product'], 'id_category' => $id_category) );
				$query = $this->db->get('products');
				if( count( $query->row_array() ) != 0 )
				{
					$list[] = $query->row_array();
				}
			}
			return $list;
		}
	}