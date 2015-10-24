<?php
	class Cart_md extends CI_Model
	{
		function __construct()
		{
			$this->load->database();
			
		}

		function set_order_user()
		{
			$data['total'] = $this->cart->total();
			$key = md5(date("YmdHis").$_SERVER['REMOTE_ADDR']);
			$data = array(
				'key_orders' => $key,
				'name_user' => $this->input->post('name_buy'),
				'mail_user' => $this->input->post('mail_buy'),
				'phone_user' => $this->input->post('phone_buy'),
				'fax_user' => $this->input->post('fax_buy'),
				'city_user' => $this->input->post('buy_city'),
				'street_user' => $this->input->post('buy_street'),
				'build_user' => $this->input->post('buy_build'),
				'app_user' => $this->input->post('buy_appart'),
				'pay_user' => $this->input->post('buy_pay'),
				'ships_user' => $this->input->post('buy_shipping'),
				'data' => date("Y-m-d H:i:s")
				);
			$this->db->insert('users_orders', $data);	
			return $key;
		}
		
		function set_order_product($key)
		{
			
			$cart = $this->cart->contents();
			$data['id_orders'] = $key;
			foreach( $cart as $item )
			{
				foreach( $item as $key_cart => $name )
				{
					switch ($key_cart) {
						case 'qty':
							$data['qty'] = $name;
							break;
						case 'price':
							$data['price'] = $name;
							break;
						case 'id':
							$data['id_product'] = $name;
							break;
						}
				}
					
				$this->db->insert('order_products', $data);	
			}
			return TRUE;
		}
		
		function set_order($key)
		{
			
			$data = array(
				'key_order' => $key,
				'status' => 1
				);
			return $this->db->insert('orders', $data);	
		}
		
		//Функция вывода названия товара в читабельном виде
		function get_name_item($name)
		{
			//Выполняем запрос в БД с REWRITE товара
			$query = $this->db->get_where('products', array('rewrite' => $name));
			
			//Присваиваем результат в массив
			$name = $query->row_array();
			
			//Возвращаем название товара
			return $name['name'];
		}
		
		function get_pay()
		{
			$query = $this->db->get('pay');
			return $query->result_array();
		}
		
		function get_delivery( $id = 0)
		{
			if( $id == 0)
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
		
		function get_percent($key)
		{
			$query = $this->db->get_where('pay', array('id_pay' => $key));
			return $query->row_array();
		}
	}