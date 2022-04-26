
<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
include "Models/crud_n5.php";
include "Models/crud_recolectores.php";


    foreach ($_POST as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_POST, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //  echo $asignacion;
    }
  //busco las plantas
    $res = Datosncin::listaplantaClien($clientelis,"ca_nivel5");
    $nivel=5;
    $opciones="";
    foreach ($res as $item) {
        
        $opciones.= '<option  value ="'.$item["n" . $nivel . "_id"].'">'.$item["n" . $nivel . "_nombre"].'</option>';
    }
    
    $opcionesrec="";
    $dr=new DatosRecolector();
    $res2=$dr->vistarecxCliente($clientelis,"ca_recolectores");
    foreach ($res2 as $item) {
        
        $opcionesrec.= '<option  value ="'.$item["rec_id"].'">'.$item["rec_nombre"].'</option>';
    }
    //busco los recolectores
    echo $opciones."¬¬".$opcionesrec;

