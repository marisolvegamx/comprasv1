<?php
require_once "Models/conexion.php";
class DatosSustit extends Conexion{

	# CLASE NIVEL 1n1
	public function vistasustitModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarSustit($datosModel,$tabla){
      // var_dump($datosModel);
          	try{
          		
              $sSQL= "INSERT INTO `ca_sustitucion`(`su_cliente`,`su_tipoempaque`,`su_producto`, `su_tamaño`) 
VALUES (:idclien,:tipoemp,:idprod,:tamano)";
                              		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idclien", $datosModel["cliente"],PDO::PARAM_INT);
              $stmt->bindParam(":idprod", $datosModel["idprod"],PDO::PARAM_INT);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"],PDO::PARAM_INT);
          	  $stmt->bindParam(":tamano", $datosModel["tamano"], PDO::PARAM_STR);
              
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el atributo");
          	}
          	
    }

    public function editasustitModel($susid, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where id_sustitucion=:susid");
		 $stmt->bindParam(":susid", $susid,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function actualizarSus($datosModel,$tabla){
          	try{
               
              $sSQL= "UPDATE $tabla SET `su_cliente`=:idclien, `su_tipoempaque`=:tipemp,`su_producto`=:numprod,`su_tamaño`=:nomtam WHERE `id_sustitucion`=:idsus";

          	  $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idclien", $datosModel["cliente"],PDO::PARAM_INT);
          	  $stmt->bindParam(":numprod", $datosModel["numprod"],PDO::PARAM_INT);
              $stmt->bindParam(":nomtam", $datosModel["nomtam"],PDO::PARAM_INT);
          	  $stmt->bindParam(":tipemp", $datosModel["tipemp"], PDO::PARAM_INT);
              $stmt->bindParam(":idsus", $datosModel["idsus"],PDO::PARAM_INT);
             
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }


    public function eliminaSustit($idprod,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE id_sustitucion=:idprod";
              //echo $sSQL;
              //echo $idprod;
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idprod", $idprod,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar el atributo");
            }
            
    }
}	