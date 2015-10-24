<?php
	class Product_md extends CI_Model
	{
		function __construct()
		{
			$this->load->database();
		}
		
		function get_products($input_product)
		{
			$query = $this->db->get_where('products', array('rewrite' => $input_product));
			return $query->row_array();
		}
		
		function get_products_images($input_id_product)
		{
			$this->db->order_by('img_boss', 'desc');
			$query = $this->db->get_where('images', array('id_product' => $input_id_product));
			return $query->result_array();
		}
		
		function get_options_product( $id_product )
		{
			$query = $this->db->get_where('filter', array('id_product' => $id_product));
			return $query->result_array();
		}
		
		function get_options( $id_option )
		{
			$query = $this->db->get_where('options', array('id' => $id_option));
			$res = $query->row_array();
			return $res['value'];
		}
		
		function get_brand($count_prod = FALSE)
		{
			if( $count_prod == TRUE )
			{
				$query = $this->db->get_where('products', array('id_brand' => $count_prod));
				return $query->num_rows();
			}
			else
			{
				$query = $this->db->get('brand');
				return $query->result_array();
			}
		}
		
		function get_category()
		{
			$query = $this->db->get_where('category', array('sub_category' => 0));
			return $query->result_array();	
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
		
		function get_default_money()
		{
			$query = $this->db->get_where('money', array('default_money' => 1));
			return $query->row_array();
		}
		
		function get_all_money()
		{
			$query = $this->db->get_where('money', array('default_money' => 0));
			return $query->result_array();
		}
	}