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

  public function getListaComDetxPlanRec($idplanta, $cverecolector, $indice, $tabla){
      
      $stmt = Conexion::conectar()-> prepare("SELECT lis_idlistacompra,lid_idprodcompra,lid_idlistacompra,
lis_idplanta, pro_id, pro_orden, lis_idindice, lid_idproducto, `lid_fechapermitida`,
`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto,
 lid_idtamano, lid_idempaque, lid_idtipoanalisis, desctam, ordtam,lid_saldoaceptado, lid_tipo,
 idemp, descemp, ordemp, idtipa, desctipa, ordtipa, idtipm, desctipm, ordtipm FROM (
   SELECT lis_idlistacompra, lis_idplanta,lid_idlistacompra, lid_idprodcompra, lis_idindice, `lid_fechapermitida`,
 `lid_fecharestringida`, `lid_backup`, lid_idproducto, lid_cantidad, pro_id, pro_orden,
 pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo, lid_saldoaceptado
 FROM pr_listacompradetalle inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra 
inner join ca_productos ON lid_idproducto=pro_id
 where lis_idplanta=:planta and lis_idrecolector=:recolector and lis_idindice=:indice) as A 
inner JOIN (SELECT cad_idopcion as idtam, cad_descripcionesp as desctam, cad_otro as ordtam 
FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as B ON A.lid_idtamano=B.idtam 
INNER JOIN (SELECT cad_idopcion as idemp, cad_descripcionesp as descemp, cad_otro as ordemp 
FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=12) as C
 ON A.lid_idempaque=C.idemp INNER JOIN 
(SELECT cad_idopcion as idtipa, cad_descripcionesp as desctipa, cad_otro as ordtipa
 FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=7) as D ON A.lid_idtipoanalisis=D.idtipa 
INNER JOIN (SELECT cad_idopcion as idtipm, cad_descripcionesp as desctipm, cad_otro as ordtipm 
 FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=15) as E ON A.lid_tipo=E.idtipm 
 ORDER BY pro_orden ASC, ordtam DESC, ordemp ASC, ordtipa ASC, ordtipm;");
      
      
      //$stmt = Conexion::conectar()-> prepare("SELECT lis_idplanta, pro_id, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, cad_descripcionesp, cad_otro, lid_tipo FROM (SELECT lis_idplanta, lid_idprodcompra, lis_idindice, `lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto, lid_cantidad, pro_id, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo FROM $tabla inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as a INNER JOIN (SELECT cad_idopcion, cad_descripcionesp, cad_otro FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as b ON lid_idtamano=cad_idopcion ORDER BY pro_id, cad_otro ASC, lid_idempaque ASC, lid_idtipoanalisis ASC, lid_tipo;");
      $stmt->bindParam(":planta", $idplanta,PDO::PARAM_INT);
      $stmt->bindParam(":recolector", $cverecolector,PDO::PARAM_INT);
      $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
      $stmt-> execute();
     // $stmt->debugDumpParams();
      return $stmt->fetchAll();
      
  }
  
  public function getListaComRec( $cverecolector, $indice, $tabla){
      
      $stmt = Conexion::conectar()-> prepare("SELECT *
 FROM  $tabla 
 where  lis_idrecolector=:recolector and lis_idindice=:indice");
      
   
     
      $stmt->bindParam(":recolector", $cverecolector,PDO::PARAM_INT);
      $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
      $stmt-> execute();
      // $stmt->debugDumpParams();
      return $stmt->fetchAll();
      
  }

}
?>	