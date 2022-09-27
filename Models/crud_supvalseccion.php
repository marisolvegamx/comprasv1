<?php


class DatosValSeccion extends Conexion{

    public function ingresaregvalsecmues($datosModel, $tabla){
        //     echo "estoy en query";
        // busca el id de validacion
        $sql= 'INSERT INTO sup_validasecciones (vas_id, vas_idseccion,
 vas_descripcion, vas_aprobada, vas_noaplica, vas_observaciones, vas_estatus,vas_nummuestra)
 VALUES ('.$datosModel["idval"].','.$datosModel["idsec"].',"'.$datosModel["descrip"].'",
'.$datosModel["idaprob"].','.$datosModel["noap"].',"'.$datosModel["observ"].'",
'.$datosModel["estatus"].',"'.$datosModel["nummuestra"].'");';
        
        
        //	var_dump($sql);
       // 	die();
        $stmt = Conexion::conectar()-> prepare($sql);
        
        //$stmt = Conexion::conectar()-> prepare("INSERT INTO sup_validasecciones (vas_id, vas_idseccion, vas_descripcion, vas_apro$datosModel["idaprob"].'b'.ada, vas_noaplica, vas_observaciones, vas_estatus) VALUES (:idval,:idsec,:descrip,:aprob,:noap,:observ,:est);");
        
        //$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
        //$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
        //$stmt->bindParam(":descrip", $datosModel["descrip"], PDO::PARAM_STR);
        //$stmt->bindParam(":aprob", $datosModel["idaprob"], PDO::PARAM_INT);
        //$stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
        //$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
        //$stmt->bindParam(":est", $datosModel["estatus"], PDO::PARAM_INT);
        //var_dump($stmt);
        $stmt-> execute();
        
        
    }
    
    public function actualizaValidacionsecmues($datosModel, $tabla){
        
        // busca el id de validacion
        $stmt = Conexion::conectar()-> prepare("UPDATE `sup_validasecciones`
SET `vas_aprobada`=:idaprob, `vas_noaplica`=:noap, `vas_observaciones`=:observ,
`vas_estatus`=:estatus WHERE `vas_id`=:idval and `vas_idseccion`=:idsec and vas_numuestra=:nummuestra;");
        
        $stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
        $stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
        $stmt->bindParam(":idaprob", $datosModel["idaprob"], PDO::PARAM_INT);
        $stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
        $stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
        $stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
        $stmt->bindParam(":nummuestra", $datosModel["nummuestra"], PDO::PARAM_INT);
        $stmt-> execute();
    }
    
    public function getValSeccionMues($datosModel, $tabla){
        
        
        // busca el id de validacion
        $stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla 
WHERE `vas_id`=:idinf and vas_idseccion =:idsec and vas_nummuestra=:muestra");
        
        $stmt->bindParam(":idinf", $datosModel["idval"], PDO::PARAM_INT);
        $stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
        $stmt->bindParam(":muestra", $datosModel["nummuestra"], PDO::PARAM_INT);
        $stmt-> execute();
       //   $stmt->debugDumpParams();
        return $stmt->fetchall();
        
    }
    
    
	

}	
