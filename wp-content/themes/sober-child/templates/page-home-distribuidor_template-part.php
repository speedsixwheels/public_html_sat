<br />
  <h3><i class="fab fa-wpforms"></i> Formulario de solicitud de apertura incidencia/consulta para distribuidores.</h3>
  <hr />

<div class="row jumbotron custom">
    <p><strong>Estimado distribuidor:</strong> <?php echo $cli['NOMBRE'] ?><br /></p>
    <div class="col-md-6">
        <strong>Codigo: </strong> <?php echo $codigo ?><br />
        <strong>Distribuidor:</strong> <?php echo $cli['NOMBREC'] ?><br />
        <strong>Domicilio:</strong> <?php echo $cli['DOMICILIO'] ?><br />
        <strong>Email:</strong> <?php echo $cli['EMAIL'] ?><br />
    </div>
    <div class="col-md-6">
        <strong>Ciudad:</strong> <?php echo $cli['POBLACION'] ?><br />
        <strong>Provincia:</strong> <?php echo $cli['PROVINCIA'] ?><br />
        <strong>Código Postal:</strong> <?php echo $cli['CP'] ?><br />
    </div>
</div>


<?php
    $field_values = get_field_values($cli);
    echo do_shortcode('[gravityform id="2" title="false" description="true" ajax="true" ' . $field_values .  ' "]');
?>