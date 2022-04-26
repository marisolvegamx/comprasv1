<?php


include "Models/crud_producto.php";
//include "Models/crud_recolectores.php";


    foreach ($_GET as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
      //echo $asignacion;
    }
  //busco los productos
    $res = DatosProd::listaprodModel($clanivel1,"ca_productos");
    //foreach ($res as $item) {
        
        //$opciones.= '<option  value ="'.$item["pro_id"].'">'.$item["pro_producto"].'</option>';
   // }
    $menu=array();
    foreach ($res as $item) {
        
        $menu[] = array("name" => $item["pro_producto"], "value" => $item["pro_id"]);
    }
    
    echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);
    
    
    //$opcionesrec="";
    //$dr=new DatosRecolector();
    //$res2=$dr->vistarecxCliente($clientelis,"ca_recolectores");
    //foreach ($res2 as $item) {
        
    //    $opcionesrec.= '<option  value ="'.$item["rec_id"].'">'.$item["rec_nombre"].'</option>';
    //}
    //busco los recolectores
//echo $opciones;