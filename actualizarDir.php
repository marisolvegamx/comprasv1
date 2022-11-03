
<?php
include "Models/conexion.php";
include "Models/crud_visitas.php";
include "Models/crud_informes.php";
include "Models/crud_unegocios.php";



    foreach ($_POST as $nombre_campo => $valor) {
        $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_POST, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
        eval($asignacion);
       // echo $asignacion;
    }
    //$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($tab)&&$tab=="i") { //actualizo visita
        //busco el id visita
        $informe=DatosInforme::getInformexid($mesas,$idrec,$infid,"informes");
        if($informe!=null)
        {  $idvis=$informe["visitasId"];
        $dvis=new DatosVisita();
        $res = $dvis->actualizardir($idvis,$mesas,$idrec,$dir, "visitas");
        }
       
        
    }else {
        //actualizo catalogo
        $res=DatosUnegocio::actualizarDirUneg($idtienda,$dir,"ca_unegocios");
    }
   
    echo json_encode( $res);
    
   

