<?php

require_once "Models/conexion.php";
class DatosListaCompra extends Conexion{

	# CLASE NIVEL 1n1
	public function vistalistacomModel($condi, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where (lis_estatus='A' or lis_estatus='T')".$condi." order by lis_idlistacompra desc;");


		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function insertarLista($datosModel,$tabla){
          	try{
          		
              $sSQL= "INSERT INTO `pr_listacompra`(`lis_idcliente`, `lis_idplanta`,  `lis_idindice`, `lis_idrecolector`, `lis_nota`, `lis_idusuario`, `lis_fechacreacion`,`lis_estatus`) VALUES (:clientelis, :plantalis, :indicelis, :recolectorlis, :notalis, :usuarioact, now(), 'A')";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":clientelis", $datosModel["clientelis"],PDO::PARAM_INT);
          		$stmt->bindParam(":plantalis", $datosModel["plantalis"], PDO::PARAM_INT);
              $stmt->bindParam(":indicelis", $datosModel["indicelis"], PDO::PARAM_STR);
              $stmt->bindParam(":notalis", $datosModel["notalis"],PDO::PARAM_STR);
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


public function actualizalista($datosModel,$tabla){
            try{      
              
              $sSQL= "UPDATE `pr_listacompra` SET `lis_idindice`=:indicelis,`lis_idrecolector`=:reclis,`lis_nota`=:notalis WHERE `lis_idlistacompra`= :idlis";
                     
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":indicelis", $datosModel["indicelis"], PDO::PARAM_STR);
              $stmt->bindParam(":reclis", $datosModel["reclis"], PDO::PARAM_INT);
              $stmt->bindParam(":notalis", $datosModel["notalis"], PDO::PARAM_STR);
              $stmt->bindParam(":idlis", $datosModel["idlis"], PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar el atributo");
            }
            
    }


 public function validanuevalistaModel($datosModel,$tabla){
  
    //$sSQL="SELECT * FROM pr_listacompra where lis_idlistacompra=:idlis;";
    $sSQL="SELECT * FROM `pr_listacompra` WHERE `lis_idcliente`=:idclien and `lis_idplanta`=:idplan and `lis_idindice`=:indice;";

    $stmt = Conexion::conectar()-> prepare($sSQL);
    $stmt->bindParam(":idclien", $datosModel["idclien"],PDO::PARAM_INT);
    $stmt->bindParam(":idplan", $datosModel["idplan"],PDO::PARAM_INT);
    $stmt->bindParam(":indice", $datosModel["indicelis"],PDO::PARAM_STR);
    $stmt-> execute();
    return $stmt->fetchAll();

  }



}
?>	