<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('main_md');
		$this->load->model('category_md');
		$this->load->model('admin_md');
		$this->load->library('cart');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index()
	{	
		$info = $this->admin_md->get_settings();
		$themePath = $info[9]['value'];
		$data = array(
			'themePath' => $themePath,
			'title' => $info[0]['value'],
			'description' => $info[7]['value'],
			'keywords' => $info[8]['value'],
			'height' => $info[2]['height'],
			'static' => $this->main_md->get_static(),
			'parent_category' => $this->main_md->get_parent_category(),
			'cart_count' => '',
			'product' => $this->main_md->get_added_product(3, 0), //Загружаем N последних добавленных товаров
			'countItems' => $this->main_md->getCountProducts(),
			//'page' => $this->main_md->get_pages(),
			'default_money' => $this->main_md->get_money_default(), //Загружаем валюту по умолчанию
			'view_money' => $this->main_md->get_money_view(), //Загружаем валюту отображения
			'index' => TRUE
		);

		$temp = $data['product'];

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

		if( $this->cart->total_items() > 0 )
		{
			$data['cartCount'] = $this->cart->total_items();
			$data['cart_price'] = $this->cart->total();

			foreach( $temp as $key => $itemProd )
			{
				$buy = TRUE;
				foreach($this->cart->contents() as $itemcart)
				{
					if($buy == TRUE)
					{
						if( $itemcart['id'] == $itemProd['id_product'] )
						{
							$data['product'][$key]['buy'] = FALSE;
							$buy = FALSE;
						}
						else
						{
							$data['product'][$key]['buy'] = TRUE;
						}
					}
				}
				
			}
		}
		else
		{
			$data['cartCount'] = 0;
			foreach( $temp as $key => $itemProd )
			{
				$data['product'][$key]['buy'] = TRUE;
			}
		}
		
		$this->load->view($themePath . '/header', $data);
		$this->load->view($themePath . '/menu', $data);
		$this->load->view($themePath . '/slider');
		$this->load->view($themePath . '/sidebar', $data);
		$this->load->view($themePath . '/index', $data);
		$this->load->view($themePath . '/footer', $data);
	}

	function load()
	{
		$from = $this->input->post('from');
		$data = Array(
			'product' => $this->main_md->get_added_product(3, $from),
			'view_money' => $this->main_md->get_money_view()
			);
		$temp = $data['product'];

		if( $this->cart->total_items() > 0 )
		{
			$data['cartCount'] = $this->cart->total_items();
			$data['cart_price'] = $this->cart->total();

			foreach( $temp as $key => $itemProd )
			{
				$buy = TRUE;
				foreach($this->cart->contents() as $itemcart)
				{
					if($buy == TRUE)
					{
						if( $itemcart['id'] == $itemProd['id_product'] )
						{
							$data['product'][$key]['buy'] = FALSE;
							$buy = FALSE;
						}
						else
						{
							$data['product'][$key]['buy'] = TRUE;
						}
					}
				}
				
			}
		}
		else
		{
			$data['cartCount'] = 0;
			foreach( $temp as $key => $itemProd )
			{
				$data['product'][$key]['buy'] = TRUE;
			}
		}

		$info = $this->admin_md->get_settings();
		$themePath = $info[9]['value'];
		$this->load->view($themePath . '/load', $data);
	}

	function setInCart()
	{
		$cart = array(
			'price' => $this->input->post('price'),
			'id' => $this->input->post('id'),
			'qty' => 1,
			'name' => $this->input->post('name'),
			'options' => array('image' => $this->input->post('img'))
			);
		
		$this->cart->insert($cart);

		echo $this->cart->total_items();
	}
}