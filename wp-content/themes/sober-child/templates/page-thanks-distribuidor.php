<?php

/**
 * Template Name: Custom Page Thanks Distribuidor
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



<?php
	$datos['registro_entrada_id'] = $_GET['registro_entrada_id'];
	$datos['nombre'] = $_GET['nombre'];
	$datos['nombre_comercial'] = $_GET['nombre_comercial'];
	$datos['email'] = $_GET['email'];
?>

<div class="container">
	<br />
	<div class="jumbotron custom">
		<strong>Estimado/a: </strong> <?php echo $datos['nombre'] ?> - <?php echo $datos['nombre_comercial'] ?>
		<hr />
		<p>
			<i class="fas fa-clipboard-check"></i> Tu petición número <strong><?php echo $datos['registro_entrada_id'] ?></strong> se ha procesado correctamente.
		</p>

		<p>
			<strong>Durante los próximos 2-3 días laborables te informaremos de como proceder ante tu consulta / incidencia.</strong>
		</p>

		<p>
			Te hemos hecho llegar una copia a tu correo electrónico: <?php echo $datos['email'] ?>
		</p>
	</div>


</div>
<?php get_footer(); ?>