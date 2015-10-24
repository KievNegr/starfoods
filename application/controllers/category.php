<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('category_md');
		$this->load->model('main_md');
		$this->load->library('cart');
		$this->load->model('product_md');
		$this->load->model('admin_md');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function get($input_category, $brand = '', $filter = '')
	{	
		if( substr($brand, 0, 1) != 'b' )
		{
			$filter = $brand;
			$brand = 'All';
		}
		
		$info = $this->admin_md->get_settings();
		$themePath = $info[9]['value'];
		$id_category = $this->category_md->get_id_category($input_category);
		if( empty($filter) )
		{
			if( $brand == 'All' )
			{
				$products = $this->category_md->get_products($id_category['id_category']);
				$arrBrands = $products;
			}
			else
			{
				$bFilter = substr($brand, 2, strlen($brand));
				$products = $this->category_md->get_products($id_category['id_category'], $bFilter);
				$arrBrands = $this->category_md->get_products($id_category['id_category']);
			}
		}
		else
		{
			if( $brand == 'All' )
			{
				$products = $this->category_md->get_filter_products($id_category['id_category'], $filter);
				$idS = '';
				foreach( $products as $list )
				{
					$idS .= $list['id_brand'] . ', ';
				}
				$idS = substr($idS, 0, -2);

				$arrBrands = $this->category_md->get_products($id_category['id_category'], $idS);
			}
			else
			{
				$bFilter = substr($brand, 2, strlen($brand));
				$products = $this->category_md->get_filter_products($id_category['id_category'], $filter, $bFilter);
				$idS = '';
				foreach( $products as $list )
				{
					$idS .= $list['id_brand'] . ', ';
				}
				$idS = substr($idS, 0, -2);

				$arrBrands = $this->category_md->get_products($id_category['id_category'], $idS);
			}
		}
		
		$idBrands = '';
		foreach( $arrBrands as $list )
		{
			$idBrands .= $list['id_brand'] . ', ';
		}
		$idBrands = substr($idBrands, 0, -2);

		$data = Array(
				'themePath' => $themePath,
				'settings' => $info,
				'static' => $this->main_md->get_static(),
				'category' => $this->category_md->get_category($id_category['id_category']),
				'id_category' => $id_category,
				'parent_category' => $this->main_md->get_parent_category(),
				'products' => $products,
				'brand' => $this->category_md->get_brand($idBrands),
				'default_money' => $this->product_md->get_default_money(),
				'view_money' => $this->main_md->get_money_view(),
				'title' => $id_category['title'],
				'description' => $id_category['description'],
				'keywords' => $info[8]['value'],
				'category_name' => $id_category['name'],
				'input_category' => $input_category,
				'money' => $this->main_md->get_money_default(),
			);
		
		
		
		//Собираем список товаров категории
		//$product = $this->category_md->get_list_item( $id_category['id_category'] );

		//Собираем список опций для категории товаров
		//if( !empty($filter) )
		//{
			$idS = '';
			foreach( $products as $list )
			{
				$idS .= $list['id_product'] . ', ';
			}
			$idS = substr($idS, 0, -2);
			$sidebar['avOptions'] = $this->category_md->get_list_option( $id_category['id_category'], $idS );
			$sidebar['options'] = $this->category_md->get_list_option( $id_category['id_category'], $idS );//, $idS );
		//}
		//else
		//{
			//$sidebar['options'] = $this->category_md->get_list_option( $id_category['id_category'] );
			//$sidebar['avOptions'] = $sidebar['options'];
		//}

		$sidebar['id_category'] = $id_category['id_category'];
		$sidebar['input_category'] = $input_category;
		$sidebar['filter'] = $filter;
		$sidebar['brandFilter'] = $brand;
		
		$this->form_validation->set_rules('cart_id', 'cart_id', 'required');
		
		if( $this->form_validation->run() == TRUE )
		{
			$cart = array(
				'id' => $this->input->post('cart_id'),
				'price' => $this->input->post('cart_price'),
				'qty' => 1,
				'name' => $this->input->post('cart_name'),
				'options' => array('image' => $this->input->post('cart_img'))
				);
			
			$this->cart->insert($cart);
		}
		
		$data['buy'] = TRUE;
		
		if( $this->cart->total_items() > 0 )
		{
			$data['cart_count'] = $this->cart->total_items();
			$data['cart_price'] = $this->cart->total();
		}
		else
		{
			$data['cart_count'] = 0;
		}
		
		//Узнаем ID текущей категории
		$id_cat = $id_category['id_category'];
		
		while( $id_category['id_category'] != 0)
		{
			$parent = $this->category_md->get_parent_category($id_category['id_category']);

			$breadcrumb[] = Array('name' => $parent['name'], 'rewrite' => $parent['rewrite']);
			//$data['navigation_rewrite'][] = $parent['rewrite'];
			$id_category['id_category'] = $parent['sub_category'];
		}
		//$data['count_navi'] = count($data['navigation_name']);
		$data['breadcrumb'] = array_reverse($breadcrumb);

		$sidebar['category_sidebar'] = $this->category_md->get_category($id_cat);

		$this->load->view($themePath . '/header', $data);
		$this->load->view($themePath . '/menu', $data);
		$this->load->view($themePath . '/sidebar-category', $sidebar);
		$this->load->view($themePath . '/category', $data);
		$this->load->view($themePath . '/footer');
	}
}