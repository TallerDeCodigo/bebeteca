<?php

namespace Comments;


	class Posts {

		protected $wpdb;

		public function __construct()
		{
			global $wpdb;
			$this->wpdb = &$wpdb;
		}


		public function getFechaLimite()
		{
			return date('Y-m-d H:i:s', strtotime('-30 days'));
		}


		public function get_from_last_week()
		{
			$fecha_limite = $this->getFechaLimite();
			$url_site = site_url();

			return $this->wpdb->get_results(
				"SELECT p.*, CONCAT('$url_site',IF(p.post_type='post','','/'),IF(p.post_type='post','',p.post_type),'/',p.post_name,'/') AS permalink
					FROM wp_posts AS p
						WHERE p.post_date > '$fecha_limite'
							AND p.post_status = 'publish' AND post_type != 'page';", OBJECT
			);
		}



		public function sort_objects_by_comments($a, $b)
		{
			if($a->comments == $b->comments){ return 0 ; }
			return ($a->comments > $b->comments) ? -1 : 1;
		}


		public function get_permalinks($list = array())
		{
			$permalinks = wp_list_pluck($list, 'permalink');
			return $permalinks ? $permalinks : array();
		}

	}





	class Facebook extends Posts {


		public $entradas;

		public $comentados;


		public function __construct()
		{
			parent::__construct();
		}


		public function get_facebook_data_comments($permalinks)
		{
			if ( empty($permalinks)) return array();


			$permalinks = (array)$permalinks;
			$permalinks_urls = implode(',', $permalinks);

			$results   = file_get_contents("http://graph.facebook.com/?ids=$permalinks_urls");

			return json_decode($results);
		}


		public function getComentados()
		{
			if ( $this->comentados = get_transient('posts_mas_comentados') )
				return $this->comentados;

			$this->comentados = $this->get_from_last_week();
			$permalinks       = $this->get_permalinks( $this->comentados );
			$results          = $this->get_facebook_data_comments( $permalinks );

			$results          = (array)$results;



			foreach ($this->comentados as $index => &$entrada) {

				if ( isset($results[ $entrada->permalink ]->comments) ){
					$entrada->comments = $results[ $entrada->permalink ]->comments;
				}else{
					unset($this->comentados[$index]);
				}
			}

			@usort( $this->comentados, array('Comments\Facebook', 'sort_objects_by_comments') );

			set_transient( 'posts_mas_comentados', $this->comentados, 14400 );

			return $this->comentados;
		}

	}
