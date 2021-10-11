
<?php

include "Models/crud_n4.php";


    foreach ($_GET as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //  echo $asignacion;
    }
    //$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
   
    if (isset($paisuneg)) {
        $res = Datosncua::vistaN4Byn3($paisuneg, "ca_nivel4");
        $nivel = 4;
    }
    foreach ($res as $item) {
        
        $menu[] = array("name" => $item["n" . $nivel . "_nombre"], "value" => $item["n" . $nivel . "_id"]);
    }
    
    echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);

