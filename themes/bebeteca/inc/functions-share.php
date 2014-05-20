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

			return $permalink->{'shares'};
		}

		public function get_twitter_data($permalinks)
		{
			if ( empty($permalinks)) return array();

			$results = file_get_contents("http://cdn.api.twitter.com/1/urls/count.json?url=$permalinks");
			$permalink = json_decode($results);

			return $permalink->{'count'};
		}

		public function get_printerest_data($permalinks)
		{
			if ( empty($permalinks)) return array();

			$results = file_get_contents("http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=$permalinks");
			$json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $results);
            $permalink = json_decode($json_string, true);

			return $permalink['count'];
		}



		public function get_googlePlus_data($permalinks)
		{
			if ( empty($permalinks)) return array();

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($permalinks).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			$curl_results = curl_exec ($curl);
			curl_close ($curl);
			$permalink = json_decode($curl_results, true);
			$count = $permalink[0]['result']['metadata']['globalCounts']['count'];
			return $count;
		}


		public function checa_si_existe_url($permalinks)
		{
			global $wpdb;
			return $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT(url) FROM wp_share_url WHERE url = %s;",
				$permalinks
			));

		}

		public function agrega_nueva_url($permalinks, $result_fb, $result_tw, $result_gp, $result_pr, $total)
		{
			global $wpdb;
			$result = $wpdb->query( $wpdb->prepare(
				"INSERT INTO wp_share_url ( url, facebook, twitter, googlePlus, printeres, total ) VALUES ( %s, %d, %d, %d, %d, %d );",
				$permalinks, $result_fb, $result_tw, $result_gp, $result_pr, $total
			));
			return ($result !== false) ? 1 : 0;
		}


		public function edita_count_url($permalinks, $result_fb, $result_tw, $result_gp, $result_pr, $total)
		{
			global $wpdb;
			$result = $wpdb->update(
				'wp_share_url',
				array(
					'facebook'   => $result_fb,
					'twitter'    => $result_tw,
					'googlePlus' => $result_gp,
					'printeres'  => $result_pr,
					'total'      => $total
				),
				array( 'url' => $permalinks ),
				array(
					'%d',	// value1
					'%d',	// value2
					'%d',	// value3
					'%d',	// value4
					'%d'	// value5
				),
				array( '%s' )
			);
			return ($result !== false) ? 1 : 0;
		}


		public function getUrlCompartida($permalinks)
		{

			$result_fb = $this->get_facebook_data($permalinks);
			$result_tw = $this->get_twitter_data($permalinks);
			$result_gp = $this->get_googlePlus_data($permalinks);
			$result_pr = $this->get_printerest_data($permalinks);
			$total     = $result_fb + $result_tw + $result_gp + $result_pr;

			$existe = $this->checa_si_existe_url($permalinks);

			if (!$existe){
				$this->agrega_nueva_url($permalinks, $result_fb, $result_tw, $result_gp, $result_pr, $total);
			}else{
				$this->edita_count_url($permalinks, $result_fb, $result_tw, $result_gp, $result_pr, $total);
			}

			return $total;
		}

		public function getCountShareUrl($permalinks)
		{
			global $wpdb;
			return $wpdb->get_var( $wpdb->prepare(
				"SELECT total FROM wp_share_url WHERE url = %s;",
				$permalinks
			));
		}

	}




	/**
	 * CUENTA LAS VECES QUE SE COMPARTIO
	 */
	function get_count_share($permalinks){
		$share_of_url = get_transient('share_url_redes');
		if( $share_of_url === false ):

			$share = new Share();
			return $share->getUrlCompartida($permalinks);
			set_transient( "share_url_redes", 'trancent sahare url redes', 60);

		else:

			$share = new Share();
			return $share->getCountShareUrl($permalinks);

		endif;

	}