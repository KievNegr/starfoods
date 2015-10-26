<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('cart');
		$this->load->model('product_md');
		$this->load->model('category_md');
		$this->load->model('main_md');
		$this->load->model('admin_md');
	}
	
	public function get($input_product)
	{	
		$info = $this->admin_md->get_settings();
		$themePath = $info[9]['value'];

		$product = $this->product_md->get_products($input_product);

		$data = Array(
				'themePath' => $themePath,
				'settings' => $info,
				'static' => $this->main_md->get_static(),
				//'category' => $this->category_md->get_category($id_category['id_category']),
				'parent_category' => $this->main_md->get_parent_category(),
				'products' => $this->product_md->get_products($input_product),
				'images' => $this->product_md->get_products_images($product['id_product']),
				'default_money' => $this->product_md->get_default_money(),
				'view_money' => $this->main_md->get_money_view(),
				'title' => $product['title'],
				'description' => $product['description'],
				'keywords' => 'Внести текст',
				//'input_category' => $input_category,
				'money' => $this->main_md->get_money_default(),
			);

		/*$data['settings'] = $this->admin_md->get_settings();
		$data['default_money'] = $this->product_md->get_default_money();
		$data['view_money'] = $this->main_md->get_money_view();
		$data['page'] = $this->main_md->get_pages();
		$data['products'] = $this->product_md->get_products($input_product);
		$data['images'] = $this->product_md->get_products_images($data['products']['id_product']);*/
		$get_options = $this->product_md->get_options_product($product['id_product']);
		
		$data['options'] = array();
		if( count($get_options) > 0 )
		{
			for( $t = 0; $t <= count($get_options) - 1; $t++ )
			{
				$data['options'][$t] = array (
					'name' => $this->product_md->get_options($get_options[$t]['id_option']),
					'item' => $get_options[$t]['value']
				);
			}
		}

		$id_category = $this->category_md->get_id_category($data['products']['id_category']);

		$data['category_name'] = $id_category['name'];

		while( $id_category['id_category'] != 0)
		{
			$parent = $this->category_md->get_parent_category($id_category['id_category']);

			$breadcrumb[] = Array('name' => $parent['name'], 'rewrite' => $parent['rewrite']);
			//$data['navigation_rewrite'][] = $parent['rewrite'];
			$id_category['id_category'] = $parent['sub_category'];
		}
		//$data['count_navi'] = count($data['navigation_name']);
		$data['breadcrumb'] = array_reverse($breadcrumb);
		
		$data['rewrite'] = $input_product;

		$data['all_money'] = $this->product_md->get_all_money();
		$data['cartCount'] = '';
		$data['title'] = $data['products']['title'];
		$data['description'] = $data['products']['description'];
		$data['keywords'] = $data['settings'][8]['value'];
		$data['money'] = $this->main_md->get_money_default();
		
		$this->form_validation->set_rules('cart_id', 'cart_id', 'required');
		
		if( $this->form_validation->run() == TRUE )
		{
			$cart = array(
				'price' => $this->input->post('cart_price'),
				'id' => $this->input->post('cart_id'),
				'qty' => 1,
				'name' => $this->input->post('cart_name'),
				'options' => array('image' => $this->input->post('cart_img'))
				);
			
			$this->cart->insert($cart);
		}
		
		$data['buy'] = TRUE;
		
		if( $this->cart->total_items() > 0 )
		{
			$data['cartCount'] = $this->cart->total_items();
			$data['cart_price'] = $this->cart->total();
			foreach( $this->cart->contents() as $item )
			{
				if( $item['id'] == $data['products']['id_product'] )
				{
					$data['buy'] = FALSE;
				}
			}
		}
		else
		{
			$data['cartCount'] = 0;
		}

		$this->load->view($themePath . '/header', $data);
		$this->load->view($themePath . '/menu', $data);
		$this->load->view($themePath . '/products', $data);
		$this->load->view($themePath . '/footer');
		
	}
	
}