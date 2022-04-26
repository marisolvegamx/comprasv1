<?php

require_once "Models/conexion.php";
class DatosCiuResidencia extends Conexion{

	# CLASE NIVEL 1n1
	public function vistaciudadresModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM `ca_ciudadesresidencia`");

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function insertarCiuRes($datosModel,$tabla){	

	$sSQL= "INSERT INTO `ca_ciudadesresidencia`( `ciu_descripcionesp`, `ciu_paisid`) VALUES (:nomciu,:idpais)";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":nomciu", $datosModel["nomciu"],PDO::PARAM_STR);
          		$stmt->bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_INT);
          		$stmt-> execute();
      }    		

    public function editaciuresModel($idciures, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where `ciu_id`=:idciures");
		 $stmt->bindParam(":idciures", $idciures,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

    public function actualizarCiuRes($datosModel,$tabla){	

	$sSQL= "UPDATE `ca_ciudadesresidencia` SET `ciu_descripcionesp`=:nomciu,`ciu_paisid`=:idpais WHERE `ciu_id`=:idciu";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":nomciu", $datosModel["nomciu"],PDO::PARAM_STR);
          		$stmt->bindParam(":idpais", $datosModel["idpais"], PDO::PARAM_INT);
          		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_INT);
          		$stmt-> execute();
      }    		


    public function eliminaCiuRes($idrec,$tabla){
             //try{      
              
              $sSQL= "DELETE FROM $tabla WHERE ciu_id=:idrec";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idrec", $idrec,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            //}//catch(PDOException $ex){
              //throw new Exception("Hubo un error al eliminar la ciudad de residencia");
            //}
            
    }



}
?>
