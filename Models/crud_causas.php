<?php
require_once "Models/conexion.php";
class DatosCausa extends Conexion{

	# CLASE NIVEL 1n1
	public function vistacausaModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarCausa($datosModel,$tabla){
      // var_dump($datosModel);
          	try{
          		
        $sSQL= "INSERT INTO `ca_causas`(`cau_descripcion`, `cau_estatus`) VALUES (:nomcausa,:idestatus)";
                              		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":nomcausa", $datosModel["nomcausa"],PDO::PARAM_STR);
          	  $stmt->bindParam(":idestatus", $datosModel["estatus"],PDO::PARAM_INT);
          	  
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar la causa");
          	}
          	
    }

    public function editacausaModel($causaid, $tabla){
		      $stmt = Conexion::conectar()-> prepare("SELECT `cau_descripcion`, `cau_estatus` FROM `ca_causas` WHERE ID_causa =:causaid;");
		      $stmt->bindParam(":causaid", $causaid,PDO::PARAM_INT);

		      $stmt-> execute();
		      return $stmt->fetchall();

	}

	public function actualizarCausa($datosModel,$tabla){
          	try{
          		
              $sSQL= "UPDATE `ca_causas` SET `cau_descripcion`=:nomcausa,`cau_estatus`=:idestatus WHERE `ID_causa`=:ID_causa";        
	
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":nomcausa", $datosModel["nomcausa"],PDO::PARAM_STR);
              $stmt->bindParam(":idestatus", $datosModel["idestatus"],PDO::PARAM_INT);
          	  $stmt->bindParam(":ID_causa", $datosModel["idcausa"],PDO::PARAM_INT);
             

          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }


    public function eliminaCausa($idcausa,$tabla){
            
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE ID_causa=:idcausa";
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idcausa", $idcausa,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar el atributo");
            }
            
    }
}	