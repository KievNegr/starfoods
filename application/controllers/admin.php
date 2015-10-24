<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct()
	{
		//Загружаем модели и библиотеки, с которыми будет работать контроллер
		parent::__construct();
		$this->load->model('admin_md');
		$this->load->model('main_md');
		$this->load->model('cart_md');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('ion_auth');
		$this->load->helper('language');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	// Стартовая страница при загрузке админской части
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			/*//Получаем список последних 10 добавленных товаров
			$data['product'] = $this->admin_md->get_added_product( 10 );
			
			//Получаем колличество всех товаров
			$data['count_product'] = count($this->admin_md->get_product());
			
			//получаем колличество всех категорий
			$data['count_category'] = count($this->admin_md->get_category());
			
			//Получаем колличество производителей
			$data['count_brand'] = count($this->admin_md->get_brand());
			
			//Получаем колличество городов доставки
			$data['count_city'] = count($this->admin_md->get_city());
			
			//Получаем колличество вариантов доставки
			$data['count_delivery'] = count($this->admin_md->get_delivery());
			
			//Получаем колличество вариантов оплаты
			$data['count_pay'] = count($this->admin_md->get_pay());
			
			//Получаем список последних 10 заказов
			$data['orders'] = $this->admin_md->get_orders( 10 );
			
			//Загружаем шаблон страницы
			$this->load->view('admin/header');
			$this->load->view('admin/default', $data);
			$this->load->view('admin/footer');*/

			//Получаем список последних 20 заказов
			$data['orders'] = $this->admin_md->get_orders(  );
			
			//Загружаем валюту отображения
			$data['view_money'] = $this->main_md->get_money_view();
			
			//Загружаем шаблон страницы
			$this->load->view('admin/header');
			$this->load->view('admin/default', $data);
			$this->load->view('admin/footer');
		}
	}
	
	// Страница заказов
	/*public function orders()
	{
		//Получаем список последних 20 заказов
		$data['orders'] = $this->admin_md->get_orders( 20 );
		
		//Загружаем валюту отображения
		$data['view_money'] = $this->main_md->get_money_view();
		
		//Загружаем шаблон страницы
		$this->load->view('admin/header');
		$this->load->view('admin/orders', $data);
		$this->load->view('admin/footer');
	}*/
	
	//Страница отображения заказа
	public function order( $key_order )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			//Загружаем информацию о покупателе
			$data['order'] = $this->admin_md->get_order( $key_order );
			
			//Если такой ключ заказ отсутствует то выводим ошибку 404
			if( empty( $data['order'] ) )
			{
				show_404();
			}
			else
			{
				//Загружаем список городов
				$data['city'] = $this->admin_md->get_city();
				
				//Загружаем варианты оплаты
				$data['pay'] = $this->cart_md->get_pay();
				
				//Загружаем варианты доставки
				$data['delivery'] = $this->cart_md->get_delivery();
				
				//Загружаем статус заказа
				$data['status'] = $this->admin_md->get_status_order( $key_order );
				
				//Читабельность статуса
				$data['view_status'] = $this->admin_md->get_status( $data['status']['status'] );
				
				//Все статусы
				$data['list_status'] = $this->admin_md->get_status();
				
				//Загружаем товары заказа
				$data['products'] = $this->admin_md->get_products_order( $key_order );
				
				//Загружаем валюту по умолчанию
				$data['default_money'] = $this->main_md->get_money_default();
				
				//Загружаем валюту отображения
				$data['view_money'] = $this->main_md->get_money_view();
			
				//Загружаем шаблон страницы
				$this->load->view('admin/header');
				$this->load->view('admin/order', $data);
				$this->load->view('admin/footer');
			}
		}
	}
	
	//Страница jQuery редактирования заказа
	public function update_order()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$result = $this->admin_md->update_order();
			echo $result;
		}
	}
	
	//Страница jQuery удаления товара
	public function delete_product_from_order()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->admin_md->delete_product_from_order();
			return TRUE;
		}
	}
	
	//Страница jQuery поиска нового товара в заказ
	public function get_new_item_order()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$result = $this->admin_md->get_new_item_order();
			if(!empty($result))
			{
				echo $result['name'].':'.$result['rewrite'];
			}
		}
	}
	
	public function add_new_item_order()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$arr = $this->admin_md->add_new_item_order();
			return TRUE;
		}
	}
	
	public function edit_qty()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			//Загружаем валюту отображения, что б знать текущий курс к валюте по умолчанию
			$view_money = $this->main_md->get_money_view();
			
			//Обновляем количество товаров в заказе
			$result = $this->admin_md->edit_qty();
			
			//Формируем новую цену товара в заказе
			$suma = $result['qty']* $result['price'] * $view_money['exchange_money'];
			
			//Выводим новую цену товара в заказе
			echo $suma;
		}
	}
	
	public function sum_prod()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			//Загружаем валюту отображения, что б знать текущий курс к валюте по умолчанию
			$view_money = $this->main_md->get_money_view();
			
			//Загружаем все товары с заказа
			$result = $this->admin_md->sum_prod();
			
			//Устанавливаем сумму заказа 0
			$sum = 0;
			
			
			foreach($result as $item)
			{
				$sum = $sum + $item['price']*$item['qty'];
			}
			
			//Выводим общую сумму заказа
			echo $sum * $view_money['exchange_money'];
		}
	}
	
	public function category()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$data['category'] = $this->admin_md->get_category();
			$this->load->view('admin/header');
			$this->load->view('admin/menu');
			$this->load->view('admin/category', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function add_category()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->form_validation->set_rules('cat_name', 'Имя категории', 'required');
			$this->form_validation->set_rules('cat_title', 'Заголовок', 'required');
			$this->form_validation->set_rules('cat_url', 'Rewrite', 'required');
			$this->form_validation->set_rules('cat_description', 'Description', 'required');
			$this->form_validation->set_rules('cat_text', 'Описание', 'required');
			
			$config = array(
				'upload_path' => './images/upload',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'max_size' => '800',
				'max_width' => '1024',
				'max_height' => '1024',
				);
			$this->load->library('upload', $config);
			
			if( $this->form_validation->run() == TRUE )
			{		
				if( $this->upload->do_upload() == TRUE )
				{
					$file = $this->upload->data();
			
					$config_img = Array(
						'image_library' => 'gd2',
						'source_image'	=> './images/upload/'.$file['file_name'],
						'maintain_ratio' => TRUE,
						'width'	 => 150,
						'height' => 150
					);

					$this->load->library('image_lib', $config_img); 
					$this->image_lib->resize();

					$image = $file['file_name'];
				}
				else
				{
					$image = '';
				}
				
				$this->admin_md->set_category($image);
				redirect('/admin/add_category/', 'refresh');
			}
			else
			{
				$data['category'] = $this->admin_md->get_category();
				$this->load->view('admin/header');
				$this->load->view('admin/menu');
				$this->load->view('admin/add_category', $data);
				$this->load->view('admin/footer');
			}
		}
	}
	
	public function edit_category( $id )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
			{$data['category'] = $this->admin_md->get_category( $id );
			$data['all_category'] = $this->admin_md->get_category();
			
			$this->form_validation->set_rules('cat_name', 'Название категории', 'required');
			$this->form_validation->set_rules('cat_title', 'Заголовок категории', 'required');
			$this->form_validation->set_rules('cat_url', 'Ссылка категории', 'required');
			$this->form_validation->set_rules('cat_description', 'Описание description категории', 'required');
			$this->form_validation->set_rules('cat_text', 'Описание категории', 'required');
			$data['notify'] = '';
				
			if( $this->form_validation->run() == TRUE )
			{
				$config = array(
					'upload_path' => './images/upload',
					'allowed_types' => 'gif|jpg|jpeg|png',
					'max_size' => '800',
					'max_width' => '1024',
					'max_height' => '1024'
				);
				$this->load->library('upload', $config);
				
				if( !$this->upload->do_upload() )
				{
					$this->admin_md->edit_category('noimage');
					$data['notify'] = 'Название категории изменилось на '.$this->input->post('cat_name').' но изображение не загрузилось - '.$this->upload->display_errors();
				}
				else
				{
					$image = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image']	= 'images/upload/'.$image['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = '150';
					$config['height']	= '150';

					$this->load->library('image_lib', $config); 

					$this->image_lib->resize();
					
					$this->admin_md->edit_category($image['file_name']);
					$data['notify'] = 'Название категории изменилось на '.$this->input->post('cat_name');
				}		
				$data['category'] = $this->admin_md->get_category( $id );
			}	
				
			$this->load->view('admin/header');
			$this->load->view('admin/menu');
			$this->load->view('admin/edit_category', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function options()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$data['options'] = $this->admin_md->get_options();
			$this->load->view('admin/header');
			$this->load->view('admin/options', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function add_option()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$data['category'] = $this->admin_md->get_category();
			$this->form_validation->set_rules('option_name', 'Название свойства', 'required');
			
			$data['res'] = '';
			
			$this->load->view('admin/header');
			$this->load->view('admin/menu');
			
			if( $this->form_validation->run() == TRUE )
			{
				$this->admin_md->set_option();
							
				$data['res'] = 'Свойство "'.$this->input->post('option_name').'" успешно добавлено';
			}
			$this->load->view('admin/add_option', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function edit_option( $id )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			//Информационное сообщение про успешное обновление
			$data['notify'] = '';
			
			//Проверка на введенные данные в название свойства
			$this->form_validation->set_rules('option_name', 'Название свойства', 'required');
			
			//Если обновляем свойство то вносим обновленные данные
			if( $this->form_validation->run() == TRUE )
			{
				//Обновляем значения (см admin_md.php edit_option )
				$this->admin_md->edit_option( $id );
				
				//Обновляем значения (см admin_md.php edit_option_value )
				//$a = $this->admin_md->edit_option_value( $id );
				
				//Выводим информацию, что свойство обновлено
				$data['notify'] = 'Свойство "'.$this->input->post('option_name').'" успешно обновлено';
			}
			
			//Выбираем нужное нам свойство по ID
			$data['option'] = $this->admin_md->get_options( $id );
			
			//Выбираем нужные значения свойства по ID
			//$data['option_value'] = $this->admin_md->get_option_value( $id );
			
			//Загружаем список категорий
			$data['category'] = $this->admin_md->get_category();
			
			$this->load->view('admin/header');
			$this->load->view('admin/edit_option', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function images( $id = 0 )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$config = array(
			'upload_path' => './images/upload',
			'allowed_types' => 'gif|jpg|jpeg|png',
			'max_size' => '4096',
			'max_width' => '4096',
			'max_height' => '4096'
			);
		
			$this->load->library('upload', $config);
						 
			if( $this->upload->do_upload() == TRUE )
			{
				$data['info_file'] = $this->upload->data();
				$img = $data['info_file']['file_name'];
				
				$config_res['image_library'] = 'gd2';
				$config_res['source_image']	= './images/upload/'.$data['info_file']['file_name'];
				$config_res['new_image'] = './images/upload/thumbs/'.$data['info_file']['file_name'];
				$config_res['create_thumb'] = TRUE;
				$config_res['thumb_marker'] = FALSE;
				$config_res['maintain_ratio'] = TRUE;
				$config_res['width']	 = 150;
				$config_res['height']	= 150;

				$this->load->library('image_lib'); 
				$this->image_lib->initialize($config_res);
				
				$this->image_lib->resize();
				$this->image_lib->clear();
				
				if( $id != 0 )
				{
					$idImg = $this->admin_md->set_image( $id, $img );
					//echo '<div "class="success"><img src="'.base_url('images/upload/thumbs/'.$img).'" /></div>';
					echo '<div title="Клик установит это изображение главным" class="box_edit_images" id="id_image_' . $idImg . '" style="border: 1px solid #4776cd; background-color: transparent; background-image: url('.base_url('images/upload/thumbs/'.$img).');"></div>
							<div class="del_img" id-img="' . $idImg . '"></div>';
				}
				else
				{
					echo '<div class="page-img"><img src="'.base_url('images/upload/thumbs/'.$img).'" style="width: 50px; float: left;" /><input type="text" class="text-page-img" value="' . base_url('images/upload/'.$img) . '" /></div>';
				}
			}
			
			echo $data['error_file'] = $this->upload->display_errors();
		}			
	}
	
	public function get_edit_image( $id )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			//Удаляем изображение с диска и с БД
			$this->admin_md->del_product_image();
			
			/*Загружаем оставшиеся изображения товара
			$this->load->model('product_md');
			$query = $this->product_md->get_products_images( $id );
			
			$t = 0;
			
			
			while( $t < count($query) )
			{
				echo '
				<div class="box_edit_images" style="background: url('.base_url('images/upload/thumbs/'.$query[$t]['name']).') no-repeat;">
					<div class="del_img">'.$query[$t]['id_images'].'</div>
					<div class="boss_img">'.$query[$t]['id_images'].'</div>
				</div>';
				$t++;
			}*/
		}
	}
	
	public function set_boss_image( $id )
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->admin_md->set_boss_image();
		}
	}
	
	//Функция добавления товара
	public function add_product()
	{	
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->form_validation->set_rules('prod_name', 'Название товара', 'required');
			$this->form_validation->set_rules('prod_price', 'Цена', 'required');
			$this->form_validation->set_rules('prod_title', 'Заголовок', 'required');
			$this->form_validation->set_rules('prod_url', 'Rewrite', 'required');
			$this->form_validation->set_rules('prod_description', 'Description', 'required');
			$this->form_validation->set_rules('prod_text', 'Краткое описание', 'required');
			$this->form_validation->set_rules('full_prod_text', 'Полное описание', 'required');
			
			if( $this->form_validation->run() == FALSE )
			{		
				//Загружаем валюту по умолчанию
				$data['default_money'] = $this->main_md->get_money_default();
				
				//Загружаем валюту отображения
				$data['view_money'] = $this->main_md->get_money_view();
				
				$data['id'] = $this->admin_md->set_product(0);
				
				//Загрузка списка категорий
				$data['category'] = $this->admin_md->get_category();
				$data['brand'] = $this->admin_md->get_brand();

				$this->load->view('admin/header');

				$this->load->view('admin/add_product', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$this->admin_md->set_product($this->input->post('prod_id'));
				redirect('/admin/product/', 'refresh');
			}
		}
	}
	
	public function edit_product( $id )
	{	
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			//return show_error('You must be an administrator to view this page.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->form_validation->set_rules('prod_name', 'Название товара', 'required');
			$this->form_validation->set_rules('prod_price', 'Цена', 'required');
			$this->form_validation->set_rules('prod_title', 'Заголовок', 'required');
			$this->form_validation->set_rules('prod_url', 'Rewrite', 'required');
			$this->form_validation->set_rules('prod_description', 'Description', 'required');
			$this->form_validation->set_rules('prod_text', 'Краткое описание', 'required');
			$this->form_validation->set_rules('full_prod_text', 'Полное описание', 'required');
			
			if( $this->form_validation->run() == FALSE )
			{		
				$this->load->model('product_md');
				
				//Загружаем валюту по умолчанию
				$data['default_money'] = $this->main_md->get_money_default();
				
				//Загружаем валюту отображения
				$data['view_money'] = $this->main_md->get_money_view();
				
				$data['images'] = $this->product_md->get_products_images( $id );
				
				$data['product'] = $this->admin_md->get_product( $id );
				$data['category'] = $this->admin_md->get_category();
				$data['brand'] = $this->admin_md->get_brand();
				
				if( $data['product']['id_brand'] != 0 )
				{
					$insertBrand = $this->admin_md->get_brand($data['product']['id_brand']);
					$data['insertBrand'] = $insertBrand['name'];
				}
				else
				{
					$data['insertBrand'] = '';
				}
				$get_options = $this->product_md->get_options_product( $id );

				if( count($get_options) > 0 )
				{
					$data['options'] = array();
					for( $t = 0; $t <= count($get_options) - 1; $t++ )
					{
						$data['options'][$t] = array (
							'name' => $this->product_md->get_options($get_options[$t]['id_option']),
							'item' => $get_options[$t]['value'],
							'id' => $get_options[$t]['id_option']
						);
					}
				}
				
				$this->load->view('admin/header');
				$this->load->view('admin/edit_product', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$this->admin_md->set_product( $id );
				redirect('/admin/edit_product/'.$id, 'refresh');
			}
		}
	}
	
	public function get_search_id()
	{
		$result = $this->admin_md->get_product( $this->input->post('id_product') );
		if( !empty( $result ) )
		{
			echo '<tr>';
				echo '<td class="td" width="30"><span class="td_text">'.$result['id_product'].'</span></td>';
				echo '<td class="td">';
					echo '<span class="td_text">';
						echo '<a href="'.base_url('admin/edit_product/'.$result['id_product']).'" title="Изменить">';
							echo $result['name'];
						echo '</a>';
					echo '</span>';
				echo '</td>';
				echo '<td class="td"><span class="td_text">'.$result['dt'].'</span></td>';
				echo '<td class="td"><span class="td_text">'.$result['price'].'</span></td>';
				echo '<td class="td">';
					echo '<a href="'.base_url('admin/edit_product/'.$result['id_product']).'" title="Изменить" class="function_link">';
						echo '<img src="'.base_url('images/admin/edit.png').'" alt="Изменить '.$result['name'].'" title="Изменить '.$result['name'].'" />';
					echo '</a>';
					echo '<a href="'.base_url('admin/trash_product/'.$result['id_product']).'" title="Удалить" class="function_link">';
						echo '<img src="'.base_url('images/admin/trash.png').'" alt="Удалить '.$result['name'].'" title="Удалить '.$result['name'].'" />';
					echo '</a>';
				echo '</td>';
			echo '</tr>';
		}
	}
	
	public function product()
	{
		$data['product'] = $this->admin_md->get_product();
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/product', $data);
		$this->load->view('admin/footer');
	}
	
	public function brand($id = 0)
	{
		$data['brand'] = $this->admin_md->get_brand();
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $id == 0 ){	
			$this->load->view('admin/brand', $data);
		}
		else
		{
			$this->form_validation->set_rules('brand_name', 'Название производителя', 'required');
			//$this->form_validation->set_rules('brand_text', 'Описание производителя', 'required');
			$data['notify'] = '';
			
			if( $this->form_validation->run() == TRUE )
			{
				$config = array(
					'upload_path' => './images/upload',
					'allowed_types' => 'gif|jpg|jpeg|png',
					'max_size' => '300',
					'max_width' => '1024',
					'max_height' => '768'
				);
				$this->load->library('upload', $config);
				
				if( !$this->upload->do_upload() )
				{
					$this->admin_md->edit_brand('noimage');
					$data['notify'] = 'Название производителя изменилось на '.$this->input->post('brand_name');//.' но изображение не загрузилось - '.$this->upload->display_errors();
				}
				else
				{
					$image = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image']	= 'images/upload/'.$image['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = '150';
					$config['height']	= '150';

					$this->load->library('image_lib', $config); 

					$this->image_lib->resize();
					
					$this->admin_md->edit_brand($image['file_name']);
					$data['notify'] = 'Название производителя изменилось на '.$this->input->post('brand_name');
				}				
			}	
			
			$data['get_brand'] = $this->admin_md->get_brand($id);
			$this->load->view('admin/edit_brand', $data);
		}
		$this->load->view('admin/footer');
	}
	
	public function add_brand()
	{
		$config = array(
			'upload_path' => './images/upload',
			'allowed_types' => 'gif|jpg|jpeg|png',
			'max_size' => '300',
			'max_width' => '1024',
			'max_height' => '768'
		);
		
		$this->load->library('upload', $config);
		$data['error_file'] = '';
		
		$this->form_validation->set_rules('brand_name', 'Название производителя', 'required');
		//$this->form_validation->set_rules('brand_text', 'Описание производителя', 'required');
		
		if( $this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header');
			$this->load->view('admin/menu');
			$this->load->view('admin/add_brand', $data);
			$this->load->view('admin/footer');
		}
		else
		{
			if( !$this->upload->do_upload() )
			{
				$image['file_name'] = 'no_brand.png';
			}
			else
			{
				$image = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image']	= 'images/upload/'.$image['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	 = '150';
				$config['height']	= '150';

				$this->load->library('image_lib', $config); 

				$this->image_lib->resize();
			}
			
			$this->admin_md->set_brand($image['file_name']);
			redirect('/admin/brand/', 'refresh');
		}
	}
	
	public function trash_brand( $id )
	{
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_brand( $id );
			redirect('/admin/brand/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/brand/', 'refresh');
		}
		
		$data['brand'] = $this->admin_md->get_brand( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_brand', $data);
		$this->load->view('admin/footer');
	}
	
	//Функция отображения вариантов доставки и городов доставки
	function shipps()
	{
		//Загружаем список вариантов доставки
		$data['delivery'] = $this->admin_md->get_delivery();
		
		//Загружаем список городов доставки
		$data['city'] = $this->admin_md->get_city();
		
		//Загружаем валюту отображения
		$data['view_money'] = $this->main_md->get_money_view();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/shipps', $data);
		$this->load->view('admin/footer');
	}
	
	function list_pay()
	{
		$data['pay'] = $this->admin_md->get_pay();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/list_pay', $data);
		$this->load->view('admin/footer');
	}
	
	//Получаем список налогов
	function list_tax()
	{
		$data['tax'] = $this->admin_md->get_tax();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/list_tax', $data);
		$this->load->view('admin/footer');
	}
	
	//Страница добавления налога
	public function add_tax()
	{
		$this->form_validation->set_rules('name_tax', 'Название налога', 'required');
		$this->form_validation->set_rules('val_tax', 'Ставка', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_tax();
			$data['res'] = 'Налог платежа "'.$this->input->post('name_tax').'" успешно добавлен';
		}
		$this->load->view('admin/add_tax', $data);
		$this->load->view('admin/footer');
	}
	
	function list_money()
	{
		$data['money'] = $this->admin_md->get_money();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/list_money', $data);
		$this->load->view('admin/footer');
	}
	
	function trash_money( $id_money )
	{
		$data['money'] = $this->admin_md->get_money( $id_money );
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_money( $data['money']['id_money'] );
			redirect('/admin/list_money/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/list_money/', 'refresh');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_money', $data);
		$this->load->view('admin/footer');
	}
	
	public function money()
	{
		$this->form_validation->set_rules('money_name', 'Название валюты', 'required');
		$this->form_validation->set_rules('money_key', 'Код валюты', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_money();
			$data['res'] = 'Валюта "'.$this->input->post('money_name').'" успешно добавлена';
		}
		$this->load->view('admin/money', $data);
		$this->load->view('admin/footer');
	}
	
	function status()
	{
		$data['status'] = $this->admin_md->get_status();
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/status', $data);
		$this->load->view('admin/footer');
	}
	
	function check_status()
	{
		$data = $this->admin_md->check_status();
		if( !empty( $data ) )
		{
			echo '1';
		}
	}
	
	function add_status()
	{
		$this->form_validation->set_rules('name_status', 'Название статуса заказа', 'required');
		$data['res'] = '';
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_status();
			$data['res'] = 'Статус заказа "'.$this->input->post('name_status').'" успешно добавлен';
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/add_status', $data);
		$this->load->view('admin/footer');
	}
	
	function edit_status( $id_status )
	{
		//Если ID статуса число, или же не пустое значение то продолжаем
		if( is_numeric($id_status) or !empty($id_status) )
		{
			$this->form_validation->set_rules('name', 'Название состояния заказа', 'required');
			
			$data['res'] = '';
			
			if( $this->form_validation->run() == TRUE )
			{
				$this->admin_md->edit_status();
				$data['res'] = 'Название состояния заказа "'.$this->input->post('name').'" успешно изменено';
			}
			
			//Отправляем запрос на принятие данных с таблицы статусов
			$data['status'] = $this->admin_md->get_status($id_status);
			
			//Если массив пустой то выводим ошибку 404
			if( !empty( $data['status'] ) )
			{
				$this->load->view('admin/header');
				$this->load->view('admin/menu');
				$this->load->view('admin/edit_status', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				show_404();
			}
		}
		else
		{
			show_404();
		}
	}
	
	public function trash_status( $id )
	{
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_status( $id );
			redirect('/admin/status/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/status/', 'refresh');
		}
		
		$data['status'] = $this->admin_md->get_status( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_status', $data);
		$this->load->view('admin/footer');
	}
	
	public function pay()
	{
		$this->form_validation->set_rules('pay_name', 'Название платежа', 'required');
		$this->form_validation->set_rules('pay_markup', 'Наценка %', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_pay();
			$data['res'] = 'Вид платежа "'.$this->input->post('pay_name').'" успешно добавлен';
		}
		$this->load->view('admin/pay', $data);
		$this->load->view('admin/footer');
	}
	
	function edit_pay( $id_pay = 0)
	{
		$this->form_validation->set_rules('edit_pay_name', 'Название платежа', 'required');
		$this->form_validation->set_rules('edit_pay_markup', 'Наценка %', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->edit_pay();
			$data['res'] = 'Вид платежа "'.$this->input->post('edit_pay_name').'" успешно изменен';
		}
		
		$data['pay'] = $this->admin_md->get_pay($id_pay);
		$this->load->view('admin/edit_pay', $data);
		$this->load->view('admin/footer');
	}
	
	function trash_pay( $id_pay )
	{
		$data['pay'] = $this->admin_md->get_pay( $id_pay );
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_pay( $data['pay']['id_pay'] );
			redirect('/admin/list_pay/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/list_pay/', 'refresh');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_pay', $data);
		$this->load->view('admin/footer');
	}
	
	function edit_delivery( $id_delivery = 0)
	{
		//Загружаем валюту отображения
		$data['view_money'] = $this->main_md->get_money_view();
		
		$this->form_validation->set_rules('edit_delivery_name', 'Название доставки', 'required');
		$this->form_validation->set_rules('edit_delivery_price', 'Стоимость доставки', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->edit_delivery();
			$data['res'] = 'Вид доставки "'.$this->input->post('edit_delivery_name').'" успешно изменен';
		}
		
		$data['delivery'] = $this->admin_md->get_delivery($id_delivery);
		$this->load->view('admin/edit_delivery', $data);
		$this->load->view('admin/footer');
	}
	
	//Функция проверки названия доставки
	public function check_delivery()
	{
		$arr = $this->admin_md->check_delivery();
		if( !empty($arr) )
		{
			echo '1';
		}
	}
	
	//Функция добавления варианта доставки
	public function delivery()
	{
		//Загружаем валюту отображения
		$data['view_money'] = $this->main_md->get_money_view();
		
		$this->form_validation->set_rules('delivery_name', 'Название доставки', 'required');
		$this->form_validation->set_rules('delivery_price', 'Стоимость доставки', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_delivery();
			$data['res'] = 'Вид доставки "'.$this->input->post('delivery_name').'" успешно добавлен';
		}
		$this->load->view('admin/delivery', $data);
		$this->load->view('admin/footer');
	}
	
	function trash_delivery( $id_delivery )
	{
		$data['delivery'] = $this->admin_md->get_delivery($id_delivery);
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_delivery( $data['delivery']['id_shipping'] );
			redirect('/admin/shipps/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/shipps/', 'refresh');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_delivery', $data);
		$this->load->view('admin/footer');
	}
	
	public function city()
	{
		$this->form_validation->set_rules('city_name', 'Название города', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->set_city();
			$data['res'] = 'Город "'.$this->input->post('city_name').'" успешно добавлен';
		}
		$this->load->view('admin/city', $data);
		$this->load->view('admin/footer');
	}
	
	function trash_city( $id_city )
	{
		$data['city'] = $this->admin_md->get_city($id_city);
		if( $this->input->post('delete') == 'yes' )
		{
			$this->admin_md->delete_city( $data['city']['id_city'] );
			redirect('/admin/shipps/', 'refresh');
		}
		elseif( $this->input->post('delete') == 'no' )
		{
			redirect('/admin/shipps/', 'refresh');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_city', $data);
		$this->load->view('admin/footer');
	}
	
	function edit_city( $id_city = 0)
	{
		$this->form_validation->set_rules('edit_city_name', 'Название города', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->edit_city();
			$data['res'] = 'Город "'.$this->input->post('edit_city_name').'" успешно изменен';
		}
		
		$data['city'] = $this->admin_md->get_city($id_city);
		$this->load->view('admin/edit_city', $data);
		$this->load->view('admin/footer');
	}
	
	public function edit_money($id_money = 0)
	{
		$this->form_validation->set_rules('edit_money_name', 'Название валюты', 'required');
		$this->form_validation->set_rules('edit_money_key', 'Код валюты', 'required');
		$this->form_validation->set_rules('edit_money_ex', 'Курс валюты', 'required');
		
		$data['res'] = '';
		
		$this->load->view('admin/header');
		
		if( $this->form_validation->run() == TRUE )
		{
			$this->admin_md->edit_money();
			$data['res'] = 'Валюта "'.$this->input->post('edit_money_name').'" успешно изменена';
		}
		
		if( $id_money != 0 )
		{
			$data['val'] = $this->admin_md->get_money( $id_money );
		}
		
		$this->load->view('admin/edit_money', $data);
		$this->load->view('admin/footer');
	}
	
	function set_lett()
	{
		$url = $this->input->post('url');
		$url = mb_strtolower($url);
		$letters = array(
			',' => '-',
			'.' => '-',
			'а' => 'a',
			'б' => 'b',
			'в' => 'v',
			'г' => 'g',
			'д' => 'd',
			'е' => 'e',
			'ж' => 'zh',
			'з' => 'z',
			'и' => 'i',
			'к' => 'k',
			'л' => 'l',
			'м' => 'm',
			'н' => 'n',
			'о' => 'o',
			'п' => 'p',
			'р' => 'r',
			'с' => 's',
			'т' => 't',
			'у' => 'u',
			'ф' => 'f',
			'х' => 'h',
			'ц' => 'c',
			'ч' => 'ch',
			'ш' => 'sh',
			'щ' => 'shch',
			'ъ' => '',
			'ы' => 'ui',
			'ь' => '',
			'э' => 'e',
			'ю' => 'yu',
			'я' => 'ya'
			);
		
		foreach($letters as $key => $item){
			$url = str_replace($key, $item, $url);
		}
		
		$url = url_title($url, 'dash', TRUE);
		
		echo $url;
	}
		
	function select_options( $id = 0)
	{
		$res = $this->admin_md->select_options();
		
		if( $id == 0 )
		{
			$i = 0;
			foreach( $res as $item )
			{
				++$i;
				$name = $this->admin_md->select_options($item['id_option']);
				echo '<p>'.$name['value'].':</p>
						<input type="text" name="option'.$i.'" class="text" /><span class="meas">' . $name['measurement'] . '</span>
						<input type="hidden" name="id_option'.$i.'" value="'.$item['id_option'].'" />';
			}
			echo '<input type="hidden" name="count_option" value="'.$i.'" />';
		}
		else
		{
			$i = 0;
			foreach( $res as $item )
			{
				++$i;
				$name = $this->admin_md->select_options($item['id_option']);
				$item_product = $this->admin_md->get_product_options( $item['id_option'], $id);
				$text_option = '';
				if( isset($item_product['value']) )
				{
					$text_option = $item_product['value'];
				}
				
				echo '<p>'.$name['value'].':</p>
						<input type="text" name="option'.$i.'" class="text" value="'.$text_option.'"/><span class="meas">' . $name['measurement'] . '</span>
						<input type="hidden" name="id_option'.$i.'" value="'.$item['id_option'].'" />';
			}
			echo '<input type="hidden" name="count_option" value="'.$i.'" />';
		}
	}
	
	//Настройки магазина 
	function settings()
	{
		//Проверка заполняемости полей
		$this->form_validation->set_rules('title_shop', 'Название магазина', 'required');
		$this->form_validation->set_rules('description_shop', 'Описание магазина', 'required');
		$this->form_validation->set_rules('keywords_shop', 'Ключевые слова магазина', 'required');
		$this->form_validation->set_rules('theme_shop', 'Ключевые слова магазина', 'required');
		$this->form_validation->set_rules('count_item', 'Колличество товаров на страницу', 'required');
		$this->form_validation->set_rules('image_list_item_w', 'Размеры изображений в списке товаров', 'required');
		$this->form_validation->set_rules('image_list_item_h', 'Размеры изображений в списке товаров', 'required');
		$this->form_validation->set_rules('image_boss_item_w', 'Размер главного изображения в товаре', 'required');
		$this->form_validation->set_rules('image_boss_item_h', 'Размер главного изображения в товаре', 'required');
		//$this->form_validation->set_rules('image_preview_item_w', 'Размер preview в товаре', 'required');
		$this->form_validation->set_rules('image_preview_item_h', 'Размер preview в товаре', 'required');
		$this->form_validation->set_rules('image_category_w', 'Размер изображения категории', 'required');
		$this->form_validation->set_rules('image_category_h', 'Размер изображения категории', 'required');
		$this->form_validation->set_rules('image_logo_brand_w', 'Размер логотипа производителя', 'required');
		$this->form_validation->set_rules('image_logo_brand_h', 'Размер логотипа производителя', 'required');
		
		//По умолчанию уведомление пустое
		$data['notify'] = '';
		
		//Если валидация полей не прошла то загружаем все сначала
		if( $this->form_validation->run() == FALSE )
		{
			$data['settings'] = $this->admin_md->get_settings();
			$data['money'] = $this->admin_md->get_money();
			foreach( $data['money'] as $default )
			{
				if( $default['default_money'] == 1 )
				{
					$data['default_money'] = $default['id_money'];
				}
				
				if( $default['view_money'] == 1 )
				{
					$data['view_money'] = $default['id_money'];
				}
			}
			$this->load->view('admin/header');
			$this->load->view('admin/settings', $data);
			$this->load->view('admin/footer');
		}
		else
		{
			//Иначе сохраняем
			$this->admin_md->set_settings();
			
			//И загружаем с новыми данными
			$data['settings'] = $this->admin_md->get_settings();
			$data['money'] = $this->admin_md->get_money();
			foreach( $data['money'] as $default )
			{
				if( $default['default_money'] == 1 )
				{
					$data['default_money'] = $default['id_money'];
				}
				
				if( $default['view_money'] == 1 )
				{
					$data['view_money'] = $default['id_money'];
				}
			}
			//Выводим уведомление об успешном сохранении
			$data['notify'] = 'Настройки сохранены';
			
			$this->load->view('admin/header');
			$this->load->view('admin/settings', $data);
			$this->load->view('admin/footer');
		}
	}
	
	//Статические страницы
	public function pages()
	{
		//Собираем все страницы в массив
		$data['pages'] = $this->admin_md->get_pages();
		
		//И выводим в шаблон
		$this->load->view('admin/header');
		$this->load->view('admin/pages', $data);
		$this->load->view('admin/footer');
	}
	
	//Добавление статической страницы
	public function add_page()
	{
		//Правила для полей
		$this->form_validation->set_rules('page_name', 'Название страницы', 'required');
		$this->form_validation->set_rules('page_title', 'H1 страницы', 'required');
		$this->form_validation->set_rules('page_url', 'Rewrite страницы', 'required');
		$this->form_validation->set_rules('page_description', 'Описание страницы', 'required');
		$this->form_validation->set_rules('page_keywords', 'Ключевые слова страницы', 'required');
		$this->form_validation->set_rules('page_text', 'Текст страницы', 'required');
		
		//Информационная переменная
		$data['notify'] = '';
		
		//Выводим хедер шаблона
		$this->load->view('admin/header');
		
		//Проверяем не пустые ли поля
		if( $this->form_validation->run() == TRUE )
		{
			//Заносим данные в базу
			$this->admin_md->set_page();
			
			$data['notify'] = 'Страница успешно создана';
			//Выводим инфу, что все отлично	
			$this->load->view('admin/add_page', $data);
		}
		else
		{
			//Если что-то пустое загружаем шаблон ввода снова	
			$this->load->view('admin/add_page', $data);
		}
		
		//Выводим подвал шаблона
		$this->load->view('admin/footer');
	}

	//Добавление статической страницы
	public function edit_page($id)
	{
		$data['page'] = $this->admin_md->get_pages( $id );

		//Выводим хедер шаблона
		$this->load->view('admin/header');
		
		//Если что-то пустое загружаем шаблон ввода снова	
		$this->load->view('admin/edit_page', $data);
		
		//Выводим подвал шаблона
		$this->load->view('admin/footer');
	}

	public function savePage()
	{
		$id = $this->input->post('idPage');
		$this->admin_md->update_page( $id );
	}

	public function trash_page( $id )
	{
		if( $this->input->post('yes_btn') == TRUE )
		{
			$this->admin_md->delete_page( $id );
			redirect('/admin/pages/', 'refresh');
		}
		elseif( $this->input->post('no_btn') == TRUE )
		{
			redirect('/admin/pages/', 'refresh');
		}
		
		$data['pages'] = $this->admin_md->get_pages( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_page', $data);
		$this->load->view('admin/footer');
	}

	public function trash_product( $id )
	{
		if( $this->input->post('yes_btn') == TRUE )
		{
			$this->admin_md->delete_product( $id );
			redirect('/admin/product/', 'refresh');
		}
		elseif( $this->input->post('no_btn') == TRUE )
		{
			redirect('/admin/product/', 'refresh');
		}
		
		$data['product'] = $this->admin_md->get_product( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_product', $data);
		$this->load->view('admin/footer');
	}

	public function trash_order( $key )
	{
		if( $this->input->post('yes_btn') == TRUE )
		{
			$this->admin_md->delete_order( $key );
			redirect('/admin/', 'refresh');
		}
		elseif( $this->input->post('no_btn') == TRUE )
		{
			redirect('/admin/', 'refresh');
		}
		
		$data['order'] = $this->admin_md->get_order( $key );
		$this->load->view('admin/header');
		$this->load->view('admin/menu');
		$this->load->view('admin/trash_order', $data);
		$this->load->view('admin/footer');
	}

	public function trash_option( $id )
	{
		if( $this->input->post('yes_btn') == TRUE )
		{
			$this->admin_md->delete_option( $id );
			redirect('admin/options/', 'refresh');
		}
		elseif( $this->input->post('no_btn') == TRUE )
		{
			redirect(base_url('admin/options'), 'refresh');
		}
		
		$data['option'] = $this->admin_md->get_options( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/trash_option', $data);
		$this->load->view('admin/footer');
	}

	public function trash_category( $id )
	{
		if( $this->input->post('yes_btn') == TRUE )
		{
			$this->admin_md->delete_category( $id );
			redirect('admin/category/', 'refresh');
		}
		elseif( $this->input->post('no_btn') == TRUE )
		{
			redirect(base_url('admin/category'), 'refresh');
		}
		
		$data['category'] = $this->admin_md->get_category( $id );
		$this->load->view('admin/header');
		$this->load->view('admin/trash_category', $data);
		$this->load->view('admin/footer');
	}
}