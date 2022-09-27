<?php


class DatosValMuestra extends Conexion{

	
	public function getValidacionMuestra($vam_id,$vam_idmuestra, $tabla){

		// consulta 
        $stmt = Conexion::conectar()->prepare("SELECT vam_id, vam_idprod, vam_cantidad, 
vam_idmuestra, vam_prodcompra, vam_estatus
FROM $tabla where vam_id=:vam_id and vam_idmuestra=:vam_idmuestra;");

        $stmt->bindParam(":vam_id", $vam_id, PDO::PARAM_INT);
        $stmt->bindParam(":vam_idmuestra", $vam_idmuestra, PDO::PARAM_INT);
		$stmt-> execute();
		$stmt->debugDumpParams();
		return $stmt->fetchall();

	}

	public function InsertaValidacion($datosModel, $tabla){
	    try{
		// consulta 
	  
	        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
(vam_id, vam_idprod, vam_cantidad, vam_idmuestra, vam_prodcompra, vam_estatus)
VALUES(:vam_id, :vam_idprod, :vam_cantidad,:vam_idmuestra, :vam_prodcompra, :vam_estatus);");
		
	        $stmt->bindParam(":vam_id", $datosModel["vam_id"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_idprod", $datosModel["vam_idprod"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_cantidad", $datosModel["vam_cantidad"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_idmuestra", $datosModel["vam_idmuestra"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_prodcompra", $datosModel["vam_prodcompra"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_estatus", $datosModel["vam_estatus"], PDO::PARAM_INT);
		$stmt->execute();
	//	$stmt->debugDumpParams();
		 
		

	    }catch(PDOException $ex){
	        throw new Exception("Error al insertar la val muestra");
	    }

	}

	public function UpdateValidacion($datosModel, $tabla){
	    try{
	        // consulta
	        $stmt = Conexion::conectar()->prepare("UPDATE $tabla
SET  vam_idprod=:vam_idprod, vam_cantidad=:vam_cantidad,
 vam_prodcompra=:vam_prodcompra,
vam_estatus=:vam_estatus
where vam_id=:vam_id and  vam_idmuestra=:vam_idmuestra);");
	        
	        $stmt->bindParam(":vam_id", $datosModel["vam_id"], PDO::PARAM_STR);
	        $stmt->bindParam(":vam_idprod", $datosModel["vam_idprod"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_cantidad", $datosModel["vam_cantidad"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_idmuestra", $datosModel["vam_idmuestra"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_prodcompra", $datosModel["vam_prodcompra"], PDO::PARAM_INT);
	        $stmt->bindParam(":vam_estatus", $datosModel["vam_estatus"], PDO::PARAM_INT);
	        $stmt->execute();
	        
	    }catch(PDOException $ex){
	        throw new Exception("Error al actualizar la val muestra");
	    }
	    
	}
	
	

}	
