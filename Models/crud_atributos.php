<?php
require_once "Models/conexion.php";
class DatosAtrib extends Conexion{

	# CLASE NIVEL 1n1
	public function vistaatribModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarAtrib($datosModel,$tabla){
      // var_dump($datosModel);
          	try{
          		
         $sSQL= "INSERT INTO `ca_atributo`(`at_idcliente`, `id_tipoempaque`, `at_idclasificaciondano`, `at_idponderaciondano`, `at_nombre`) VALUES (:idclien, :tipoemp, :cladan, :pondan, :nomatrib)";
                              		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idclien", $datosModel["idclien"],PDO::PARAM_INT);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"],PDO::PARAM_INT);
          	  $stmt->bindParam(":cladan", $datosModel["cladan"],PDO::PARAM_INT);
              $stmt->bindParam(":pondan", $datosModel["pondan"],PDO::PARAM_INT); 
              $stmt->bindParam(":nomatrib", $datosModel["nomatrib"], PDO::PARAM_STR);
              
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el atributo");
          	}
          	
    }

    public function editaprodModel($atrid, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where id_atributo=:atrid");
		 $stmt->bindParam(":atrid", $atrid,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function actualizarAtr($datosModel,$tabla){
          	try{
          		
              $sSQL= "UPDATE `ca_atributo` SET `id_tipoempaque` =:tipoemp,`at_nombre`=:nomatr, `at_idcliente`=:idclien, `at_idclasificaciondano`=:cladano, `at_idponderaciondano`=:pondano  WHERE `id_atributo`=:idatr";
	
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"],PDO::PARAM_INT);
              $stmt->bindParam(":idclien", $datosModel["idclien"],PDO::PARAM_INT);
          	  $stmt->bindParam(":cladano", $datosModel["cladano"],PDO::PARAM_INT);
              $stmt->bindParam(":pondano", $datosModel["pondano"],PDO::PARAM_INT);
              $stmt->bindParam(":nomatr", $datosModel["nomatrib"], PDO::PARAM_STR);
              $stmt->bindParam(":idatr", $datosModel["idatr"],PDO::PARAM_INT);
             

          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }


    public function eliminaAtrib($idprod,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE id_atributo=:idprod";
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