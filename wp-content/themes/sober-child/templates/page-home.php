<?php

/**
 * Template Name: Custom Page Home
 *
 * The template file for displaying page content in full-width
 */

get_header(); ?>

<?php
if (have_posts()) :
	while (have_posts()) : the_post();
		the_content();
	endwhile;
endif;
?>

<div class="container">

	<?php

		$registro_entrada_id = time();

		$codigo = trim($_GET['cli']);
		$emb = trim($_GET['emb']);

		$db_ontario = conn_ontario();


		$cli = get_data_cli($codigo);



		if ($cli['TIPO'] == 'EMBAJADOR') {
			require_once 'page-home-embajador_template-part.php';
		}

		if ($cli['TIPO'] == 'DISTRIBUIDOR') {

			require_once 'page-home-distribuidor_template-part.php';
		}

		if ($cli['TIPO'] == 'CLIENTE') {
			require_once 'page-home-cliente_template-part.php';
		}
	?>


</div>
<?php get_footer(); ?>