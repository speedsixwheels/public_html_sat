<?php
  if ($_POST) {

    $codigo_embajador = is_embajador($dnicif);
    if ($codigo_embajador) {
        $emb = get_data_cli($codigo_embajador);
        $mostrar_formulario = true;
        $field_values = get_field_values($emb);
    } 
    else {
      $error_identificacion = '<br /><div class="alert alert-dark"><i class="fas fa-times"></i> Lo sentimos, no te hemos podido identificar como embajador</div>';
    }
  }
?>

<?php if (!$codigo_embajador) : ?>
  <br />
  <h3><i class="fab fa-wpforms"></i> Formulario de solicitud de apertura de incidencia / consulta para embajadores</h3>
  <hr />
  <form action="#" name="form_embajador" method="post">
    <input type="hidden" name="form_embajadores" value="1" />
    <label for="cif">Dni/Cif:</label><br>
    <input class="uppercase" type="password" id="dnicif" name="dnicif">
    <br /><br />

    <button type="sumbit" id="button" name="button">Enviar</button>
  </form>
<?php endif; ?>


<?php
  if ($mostrar_formulario) {
    echo do_shortcode('[gravityform id="7" title="false" description="true" ajax="true" ' . $field_values .  ' "]');
  }

  if ($error_identificacion) {
    echo $error_identificacion;
  }

?>