
<?php
include "Models/crud_ciudades.php";
include "Models/crud_catalogoDetalle.php";



    foreach ($_GET as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //  echo $asignacion;
    }
    //$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($recol)&&$recol==1) { //vengo de recolector
        $res = DatosCiudadesResidencia::listaCiudadesxPais($paisrec, "ca_ciudadesresidencia");
        
    }
    if (isset($paisuneg)) {
        $res = DatosCiudadesResidencia::listaCiudadesxPais($paisuneg, "ca_ciudadesresidencia");
      
    }
    foreach ($res as $item) {
        
        $menu[] = array("name" => $item["ciu_descripcionesp"], "value" => $item["ciu_id"]);
    }
    
    echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);

