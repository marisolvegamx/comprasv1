<?php

require_once "Models/conexion.php";
class DatosListaCompra extends Conexion{

	# CLASE NIVEL 1n1
	public function vistalistacomModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function insertarLista($datosModel,$tabla){
          	try{
          		
              $sSQL= "INSERT INTO `pr_listacompra`(`lis_idcliente`, `lis_idplanta`,  `lis_idindice`, `lis_idrecolector`, `lis_idusuario`) VALUES (:clientelis, :plantalis, :indicelis, :recolectorlis, :usuarioact)";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":clientelis", $datosModel["clientelis"],PDO::PARAM_INT);
          		$stmt->bindParam(":plantalis", $datosModel["plantalis"], PDO::PARAM_INT);
              $stmt->bindParam(":indicelis", $datosModel["indicelis"], PDO::PARAM_STR);
              $stmt->bindParam(":recolectorlis", $datosModel["recolectorlis"],PDO::PARAM_INT);
              $stmt->bindParam(":usuarioact", $datosModel["usuariolis"],PDO::PARAM_STR);
                 
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar la lista");
          	}
          	
    }



 public function vistalistaEnccomModel($idlis,$tabla){
  
    $sSQL="SELECT * FROM pr_listacompra where lis_idlistacompra=:idlis;";
    $stmt = Conexion::conectar()-> prepare($sSQL);
    $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
    $stmt-> execute();
    return $stmt->fetchAll();

  }

public function eliminalista($idlis,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE `lis_idlistacompra`=:idlis";
                     
              //echo $sSQL;
              //echo $idprod;
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idlis", $idlis, PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar el atributo");
            }
            
    }

}
?>	