<?php // CREAR TABLA PARA GUARDAR URL Y SHARES//////////////////////////////////////////////////////

	add_action('init', function(){
		global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}share_url (
				url VARCHAR(200) NOT NULL DEFAULT '',
				facebook bigint(20) NOT NULL DEFAULT 0,
				twitter bigint(20) NOT NULL DEFAULT 0,
				googlePlus bigint(20) NOT NULL DEFAULT 0,
				printerest bigint(20) NOT NULL DEFAULT 0,
				total bigint(20) NOT NULL DEFAULT 0,
				UNIQUE KEY `url` (`url`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);

	});


class Share {


		public function __construct()
		{

		}


		public function get_facebook_data($permalinks)
		{
			if ( empty($permalinks)) return array();

				$results = file_get_contents("http://graph.facebook.com/?id=$permalinks");
				$permalink = json_decode($results);





				// if ( isset($results[ $entrada->permalink ]->comments) )
				// 	$entrada->comments = $results[ $entrada->permalink ]->comments;

			return $permalink->{'shares'};
		}


		public function getUrlCompartida($permalinks)
		{

			$result_fb = $this->get_facebook_data($permalinks);



			return $result_fb ;
		}
	}




	/**
	 * CUENTA LAS VECES QUE SE COMPARTIO
	 */
	function get_count_share($permalinks){
		// $share_of_url = get_transient('share_url_redes')
		// if( $share_of_url === false ):

			$share = new Share();
			$total = $share->getUrlCompartida($permalinks);;
			// set_transient( "share_url_redes", 'trancent sahare url redes', 60);

		// else:

		// endif;

		return $total;
	}