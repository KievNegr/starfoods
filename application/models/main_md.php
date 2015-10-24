<?php
	class Main_md extends CI_Model
	{
		function __construct()
		{
			$this->load->database();
		}
		
		function get_parent_category()
		{
			$query = $this->db->get_where('category', array('sub_category' => 0));
			return $query->result_array();
		}
		
		function get_sub_category($parent)
		{
			$query = $this->db->get_where('category', array('sub_category' => $parent));
			return $query->result_array();
		}
		
		function get_static()
		{
			$this->db->order_by('sort', 'desk');
			$query = $this->db->get_where('pages', array('view' => 1));
			return $query->result_array();
		}

		function get_static_page($input)
		{
			$query = $this->db->get_where('pages', array('rewrite' => $input));
			return $query->row_array();
		}
		
		//Ôóíêöèÿ ïîèñêà âàëþòû ïî óìîë÷àíèþ (ò.å. âàëþòà, êîòîðàÿ ó÷èòûâàåòñÿ ïðè íàïîëíåíèè òîâàðîâ )
		function get_money_default()
		{
			//Âûïîëíÿåì çàïðîñ â ÁÄ äëÿ ïîèñêà âàëþòû ïî óìîë÷àíèþ
			$query = $this->db->get_where('money', array('default_money' => 1));
			//Âîçâðàùàåì ñòðî÷êó âàëþòû ïî óìîë÷àíèþ ñ òåõ.äàííûìè
			return $query->row_array();
		}
		
		//Ôóíêöèÿ ïîèñêà âàëþòû îòîáðàæåíèÿ (âàëþòû ðàñ÷åòà)
		function get_money_view()
		{
			//Âûïîëíÿåì çàïðîñ â ÁÄ äëÿ ïîèñêà âàëþòû îòîáðàæåíèÿ
			$query = $this->db->get_where('money', array('view_money' => 1));
			//Âîçâðàùàåì ñòðî÷êó âàëþòû îòîáðàæåíèÿ ñ òåõ.äàííûìè
			return $query->row_array();
		}

		// Функция вывода последних N товаров
		function get_added_product($limit, $from)
		{
			//Сортируем товары по ID
			$this->db->order_by('id_product', 'asc');
			//Выполняем запрос в БД товаров
			$this->db->limit($limit, $from);
			$query = $this->db->get_where('products', array('temp' => 0));
			//Возвращаем массив товаров
			$arr = Array();
			foreach($query->result_array() as $item)
			{
				//Вытащим картинку
				$img = $this->db->get_where('images', array('id_product' => $item['id_product'], 'img_boss' => 1));
				$resImg = $img->row_array();
				//Вытащим категорию
				$cat = $this->db->get_where('category', array('id_category' => $item['id_category']));
				$resCat = $cat->row_array();
				$item['img'] = $resImg['name'];
				$item['categoryName'] = $resCat['name'];
				$arr[] = $item;
			}
			return $arr;
		}

		function getCountProducts()
		{
			$this->db->where('temp', '0');
			$this->db->from('products');
			return  $this->db->count_all_results();
		}

	}