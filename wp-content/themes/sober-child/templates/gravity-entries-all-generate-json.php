<?php
// Template Name: Custom Gravity Entries JSON Generate 
get_header();
?>


<?php

$search_criteria = array();
$sorting         = array();
$paging = array('offset' => 0, 'page_size' => 9999);

$path = '/home/speedsixonline/cron.speedsixonline.com/sats/_json/';


/***********************/
/** CLIENTES ***********/
/***********************/


$form_id = 1;
$entries_sat_particulares = GFAPI::get_entries($form_id, $search_criteria, $sorting, $paging);
$count_particulares = 0;
$nat = 'particular';
foreach ($entries_sat_particulares as $entry) {
    $entry['nat'] = $nat;
    $array_entries_particulares[$entry[20]] = $entry;
    $count_particulares++;
}


$nombre = 'form_entries_particulares.json';

$file = $path . $nombre;

if ($count_particulares) {
    $fp = fopen($file, 'w');
    fwrite($fp, json_encode($array_entries_particulares));
    fclose($fp);
    $result =  "<h3>Clientes</h3> <hr />";
    $result .= '<div class="alert alert-black">Se han generado ' . $count_particulares . ' entradas </div>';
} else {
    $result = '<div class="alert alert-black">No se han generado entradas </div>';
}

echo $result;


/***********************/
/** DISTRIBUIDORES *****/
/***********************/

$form_id = 2;
$entries_sat_distribuidores = GFAPI::get_entries($form_id, $search_criteria, $sorting, $paging);
$count_dis = 0;
$nat = 'distribuidor';
foreach ($entries_sat_distribuidores as $entry) {
    $entry['nat'] = $nat;
    $array_entries_distribuidores[$entry[20]] = $entry;
    $count_dis++;

   
}


$nombre = 'form_entries_distribuidores.json';

$file = $path . $nombre;

if ($count_dis) {
    $fp = fopen($file, 'w');
    fwrite($fp, json_encode($array_entries_distribuidores));
    fclose($fp);
    $result =  "<h3>Distribuidores</h3> <hr />";
    $result .= '<div class="alert alert-black">Se han generado ' . $count_dis . ' entradas </div>';

} else {
    $result = '<div class="alert alert-black">No se han generado entradas </div>';
}

echo $result;



/***********************/
/** Embjajadores *******/
/***********************/

$form_id = 7;
$entries_sat_embajadores = GFAPI::get_entries($form_id,$search_criteria, $sorting, $paging );


$count_emb = 0;
$nat = 'embajador';
foreach($entries_sat_embajadores as $entry){
    $entry['nat'] = $nat;
    $array_entries_emajadores[$entry[20]] = $entry;
    $count_emb++;
}



$nombre = 'form_entries_embajadores.json';

$file = $path . $nombre;

if($count_emb){
    $fp = fopen($file, 'w');
    fwrite($fp, json_encode($array_entries_emajadores));
    fclose($fp);
    $result =  "<h3>Embajadores</h3> <hr />";
    $result .= '<div class="alert alert-black">Se han generado ' . $count_emb . ' entradas </div>';
}
else{
    $result = '<div class="alert alert-black">No se han generado entradas </div>';
}

echo $result;



?>

<?php get_footer() ?>