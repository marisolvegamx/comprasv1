
<?php
include "Models/conexion.php";
include "Models/crud_geocercas.php";




    foreach ($_POST as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_POST, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //  echo $asignacion;
    }
    //$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($cd)) { //vengo de recolector
        $res = DatosGeocercas::vistaGeocercaModelxnombreRes($cd, "ca_geocercas");
        echo json_encode( $res);
        
    }
   
   
    
   

