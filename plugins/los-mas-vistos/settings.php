<?php if (isset($_POST['guardar_info_app']) AND $_POST['guardar_info_app'] == 'si' ) save_options_analitycs($_POST); ?>
<h2>Configuración Google Analitycs</h2>

<?php global $current_user;
$email_user = $current_user->data->user_email;
$domain = explode('@', $email_user);
$dominio = $domain[1];

if ($dominio == 'hacemoscodigo.com' || $dominio == 'losmaquiladores.com') :?>
	<form method="post" action="">
		<table class="form-table">
			<tbody>

				<tr>
					<th scope="row"><label for="name_app">Nombre de la App </label></th>
					<td>
						<input name="name_app" type="text" id="name_app" value="<?php echo get_option( 'name_app_GA' ); ?>" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="email_app">Email que se agrego a GA</label></th>
					<td>
						<input name="email_app" type="text" id="email_app" value="<?php echo get_option( 'email_app_GA' ); ?>" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="keyfile_app">keyfile que se descargo</label></th>
					<td>
						<input name="keyfile_app" type="text" id="keyfile_app" value="<?php echo get_option( 'keyfile_app_GA' ); ?>" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="client_id_app">Cliente Id</label></th>
					<td>
						<input name="client_id_app" type="text" id="client_id_app" value="<?php echo get_option( 'client_id_app_GA' ); ?>" class="regular-text">
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="analitics_id_app">Analitycs Id</label></th>
					<td>
						<input name="analitics_id_app" type="text" id="analitics_id_app" value="<?php echo get_option( 'analitics_id_app_GA' ); ?>" class="regular-text">
					</td>
				</tr>

				<tr>
					<th>
						<input name="guardar_info_app" type="hidden" id="guardar_info_app" value="si">

						<input type="submit" class="button-primary" value="Guardar">
					</th>
				</tr>

			</tbody>
		</table>
	</form>

	<h2>Usar la funcion</h2>
	<p>
		<b>lo_mas_visto_GA()</b> <br><br>

		Devuelve un arreglo con el ID y el slug de cada uno de los posts mas visitados en GA

	</p>
<?php else:
	echo 'Permisos denegados para ver la informacion';
endif;




