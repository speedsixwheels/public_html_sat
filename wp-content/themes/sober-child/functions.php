<?php
/**
 * Sober functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sober Child
 */

add_action( 'wp_enqueue_scripts', 'sober_child_enqueue_scripts', 20 );

function sober_child_enqueue_scripts() {
	wp_enqueue_style( 'sober-child', get_stylesheet_uri() );



	//custom styles
    //wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/assets/bootstrap4/bootstrap.min.css',true, NULL, 'all' );
    //wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/bootstrap4/bootstrap.min.js', array( 'jquery' ), true);

    wp_enqueue_style( 'my-google-fonts', 'https://fonts.googleapis.com/css2?family=Archivo&display=swap', false );
    wp_enqueue_style('fontawesome-css', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css', false, NULL, 'all');

}



require_once 'assets/mysqliclass/class.db.mysqli.php';


function conn_ontario(){
    $conn['servername'] = "oxb7.ddns.net";
    $conn['port'] = '3777';
    $conn['database'] = "bd_spx";
    $conn['username'] = "UX#SPX";
    $conn['password'] = "PX#SPX";
    $db = new dbmysqli($conn);

    return $db;
}

function pre($item){
    echo "<pre>";
    print_r($item);
    echo "</pre>";
}


function get_data_cli($codigo){
    $db_ontario = conn_ontario();

    $sql = "SELECT * FROM dclie WHERE CODIGO='" . $codigo . "'";
    $res = $db_ontario->get_results($sql);

    if(!empty($db_ontario->error)){
        echo "error 125";
        die();
    }

    $res = $res[0];

    
    if($res['CCLAVE'] == 'DIS'){
        $tipo = 'DISTRIBUIDOR';
    }
    elseif($res['CCLAVE'] == 'PAT'){
        $tipo = 'EMBAJADOR';
    }
    elseif($res['CCLAVE'] == 'PAR'){
        $tipo = 'CLIENTE';
    }
    else{
        //Si no está categoritzat com a cap tipus, doncs es un client final
        $tipo = 'CLIENTE';  
    }
    
    $data['REGISTRO_ENTRADA_ID'] = time();
    $data['CODIGO'] = $res['CODIGO'];
    $data['NOMBRE'] = $res['NOMBRE'];
    $data['NOMBREC']  = $res['NOMBREC'];
    $data['DOMICILIO']  = $res['DOMICILIO'];
    $data['POBLACION'] = $res['POBLACION'];
    $data['PROVINCIA'] = $res['PROVINCIA'];
    $data['CP'] = $res['CP'];
    $data['EMAIL'] = $res['EMAIL'];
    $data['TIPO'] = $tipo;


    $db_ontario->close();

    return $data;
}


function get_field_values($cli){

    $field_values = 'field_values="registro_entrada_id=' . $cli['REGISTRO_ENTRADA_ID'];
    $field_values .= '&cliente_ontario=' . $cli['CODIGO'];
    $field_values .= '&tipo=' . $cli['TIPO'];
    $field_values .= '&nombre=' . $cli['NOMBRE'];
    $field_values .= '&nombre_comercial=' . $cli['NOMBREC'];
    $field_values .= '&domicilio=' . $cli['DOMICILIO'];
    $field_values .= '&ciudad=' . $cli['POBLACION'];
    $field_values .= '&provincia=' . $cli['PROVINCIA'];
    $field_values .= '&codigo_postal=' . $cli['CP'];
    $field_values .= '&email=' . $cli['EMAIL'];
    $field_values .= '"';

    return $field_values;
}


function is_embajador($dnicif){
    $db_ontario = conn_ontario();
    $sql = "SELECT * FROM dclie WHERE NIF='" . trim($_POST['dnicif']) . "' AND CCLAVE='PAT'";

    $emb = $db_ontario->get_results($sql);
    $emb = $emb[0];

    if(!empty($db_ontario->error)){
        echo "error 889";
        die();
    }

    $db_ontario->query($sql);

    if($db_ontario->numrows){
        $return = $emb['CODIGO'];
    }
   

    $db_ontario->close();
    return $return;    
}

