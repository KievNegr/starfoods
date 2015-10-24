<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_cart extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('cart');
		$this->load->model('cart_md');
		$this->load->model('admin_md');
		$this->load->model('main_md');
		$this->load->model('category_md');
	}
	
	public function index()
	{	
		$info = $this->admin_md->get_settings();
		$themePath = $info[9]['value'];

		$data = Array(
				'themePath' => $themePath,
				'settings' => $info,
				//'static' => $this->main_md->get_static(),
				//'parent_category' => $this->main_md->get_parent_category(),
				'view_money' => $this->main_md->get_money_view(), //Загружаем валюту отображения
				//'title' => 'Cart',
				//'description' => $info[7]['value'],
				//'keywords' => $info[8]['value'],
				'default_money' => $this->main_md->get_money_default(), //Загружаем валюту по умолчанию
				'total' => $this->cart->total(), //Полная стоимость корзины
				'contents' => $this->cart->contents() //Заносим все товары корзины в переменную
			);	
		
		//Загружаем шаблон
		//$this->load->view($themePath . '/header', $data);
		//$this->load->view($themePath . '/menu', $data);
		$this->load->view($themePath . '/cart', $data);
		//$this->load->view($themePath . '/footer', $data);
	}
	
	//Функция оформления заказа
	public function buy()
	{
		//Заносим все товары корзины в переменную
		$data['contents'] = $this->cart->contents();
		
		//Полная стоимость корзины
		$data['total'] = $this->cart->total();
		
		//Загружаем валюту по умолчанию
		$data['default_money'] = $this->main_md->get_money_default();
		
		//Загружаем валюту отображения
		$data['view_money'] = $this->main_md->get_money_view();
		
		//Загружаем все способы оплаты
		$data['pay'] = $this->cart_md->get_pay();
		
		//Загружаем все способы доставки
		$data['delivery'] = $this->cart_md->get_delivery();
		
		//Загружаем все города доставки
		$data['city'] = $this->admin_md->get_city();
		
		//Загружаем шаблон
		$this->load->view('main/buy', $data);
	}
	
	public function reg()
	{
		$key_order = $this->cart_md->set_order_user();
		$this->cart_md->set_order_product($key_order);
		$this->cart_md->set_order($key_order);
		$this->cart->destroy();
	}
	
	public function succes()
	{
		$this->load->view('main/reg');
	}
	
	public function pay_change()
	{
		$percent = $this->cart_md->get_percent($this->input->post('key'));
		echo $percent['markup'];
	}
	
	public function delivery_change()
	{
		$sum = $this->cart_md->get_delivery($this->input->post('key'));
		echo $sum['price'];
	}
	
	public function qty_change()
	{
		$data = array(
			'rowid' => $this->input->post('rowid'),
			'qty' => $this->input->post('qty')
		);
		$this->cart->update($data);
		
		echo $this->cart->total();
	}
	
}