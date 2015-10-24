<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
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
		
		$staticPage = $this->main_md->get_static_page($input_product);
		
		$themePath = $info[9]['value'];
		
		$data = array(
			'themePath' => $themePath,
			'title' => $staticPage['title'],
			'description' => $staticPage['description'],
			'keywords' => $staticPage['keywords'],
			'height' => $info[2]['height'],
			'h1' => $staticPage['h1'],
			'text' => $staticPage['text'],
			'static' => $this->main_md->get_static(),
			'parent_category' => $this->main_md->get_parent_category(),
			'cart_count' => '',
			'product' => $this->admin_md->get_added_product( 9 ), //Çàãðóæàåì N ïîñëåäíèõ äîáàâëåííûõ òîâàðîâ
			'default_money' => $this->main_md->get_money_default(), //Çàãðóæàåì âàëþòó ïî óìîë÷àíèþ
			'view_money' => $this->main_md->get_money_view() //Çàãðóæàåì âàëþòó îòîáðàæåíèÿ
		);
			
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
			$data['cart_count'] = $this->cart->total_items();
			$data['cart_price'] = $this->cart->total();
		}
		else
		{
			$data['cart_count'] = 0;
		}	
		
		$this->load->view($themePath . '/header', $data);
		$this->load->view($themePath . '/menu', $data);
		//$this->load->view('demo2/sidebar', $data);
		$this->load->view($themePath . '/static', $data);
		$this->load->view($themePath . '/footer', $data);
	}
	
}