
<?php

require_once "Models/crud_n1.php";
//require_once "Models/conexion.php";
include "Models/crud_n2.php";
include "Models/crud_n3.php";
include "Models/crud_n4.php";
include "Models/crud_n5.php";
include "Models/crud_n6.php";


    foreach ($_GET as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //  echo $asignacion;
    }
    //$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
    $res = Datosnuno::vistan1Model("ca_nivel2");
    $nivel = 1;
    if (isset($clanivel1)) {
        $res = Datosndos::vistandosByn1($clanivel1, "ca_nivel2");
        $nivel = 2;
    } if (isset($clanivel2)) {
        $res = Datosntres::vistaN3Byn2($clanivel2, "ca_nivel3");
        $nivel = 3;
    } if (isset($clanivel3)) {
        $res = Datosncua::vistaN4Byn3($clanivel3, "ca_nivel4");
        $nivel = 4;
    } if (isset($clanivel4)) {
        $res = Datosncin::vistanN5Byn4($clanivel4, "ca_nivel5");
        $nivel = 5;
    } if (isset($clanivel5)) {
        $res = Datosnsei::vistanN6Byn5($clanivel5, "ca_nivel6");
        $nivel = 6;
    }
    
    foreach ($res as $item) {
        
        $menu[] = array("name" => $item["n" . $nivel . "_nombre"], "value" => $item["n" . $nivel . "_id"]);
    }
    
    echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);

