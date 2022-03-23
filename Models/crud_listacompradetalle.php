<?php

require_once "Models/conexion.php";
class DatosListaCompraDet extends Conexion{

	# CLASE NIVEL 1n1
	public function vistalistacomModel($idliscomp, $tabla){
    
		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra where lid_idlistacompra=:idliscomp order by lid_orden;");
    $stmt->bindParam(":idliscomp", $idliscomp,PDO::PARAM_INT);
              
		$stmt-> execute();
		return $stmt->fetchAll();

	}


  public function vistacodigosnopermitidos($datosModel, $tabla){
    
    $stmt = Conexion::conectar()-> prepare("SELECT inf_id, ind_caducidad, inf_indice, inf_plantasid, ind_productos_id, ind_tamanio_id, ind_empaque, ind_tipoanalisis FROM $tabla 
inner join informes on
ind_informes_id = inf_id
	and inf_indice = ind_indice
	and ind_recolector = inf_usuario
 where inf_indice=:indice and inf_plantasid= :planta and ind_productos_id=:producto and ind_tamanio_id =:tamanio and ind_empaque=:empaque and ind_tipoanalisis=:tipoanalisis 
      group by inf_indice, inf_plantasid, ind_productos_id, ind_tamanio_id, ind_caducidad desc;");

    $stmt->bindParam(":indice", $datosModel["cnpindi"],PDO::PARAM_STR);
    $stmt->bindParam(":planta", $datosModel["planta"],PDO::PARAM_INT);          
    $stmt->bindParam(":producto", $datosModel["cnpprod"],PDO::PARAM_INT);
    $stmt->bindParam(":tamanio", $datosModel["cnptam"],PDO::PARAM_INT);          
    $stmt->bindParam(":empaque", $datosModel["cnpempa"],PDO::PARAM_INT);
    $stmt->bindParam(":tipoanalisis", $datosModel["cnptipana"],PDO::PARAM_INT);      
    
    $stmt-> execute();
  //  $stmt->debugDumpParams();
    return $stmt->fetchAll();

  }

	public function insertarProdLista($datosModel,$tabla){
          	try{
          		
              $sSQL= "INSERT INTO `pr_listacompradetalle`(`lid_idlistacompra`, `lid_idprodcompra`, `lid_idproducto`, `lid_idtamano`, `lid_idempaque`, `lid_idtipoanalisis`, `lid_cantidad`, `lid_tipo`, `lid_fechapermitida`, `lid_fecharestringida`) VALUES (:idlis, :claop, :numprod, :numtam, :numemp, :tipana, :cantidad, :tipomues, :fechab, :fecres)";

          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":idlis", $datosModel["idlis"],PDO::PARAM_INT);
          		$stmt->bindParam(":claop", $datosModel["claop"], PDO::PARAM_INT);
              $stmt->bindParam(":numprod", $datosModel["numprod"], PDO::PARAM_INT);
              $stmt->bindParam(":numtam", $datosModel["numtam"],PDO::PARAM_INT);
              $stmt->bindParam(":numemp", $datosModel["numemp"],PDO::PARAM_INT);
              $stmt->bindParam(":tipana", $datosModel["tipana"], PDO::PARAM_INT);
              $stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
              $stmt->bindParam(":tipomues", $datosModel["tipomues"],PDO::PARAM_INT);
              $stmt->bindParam(":fechab", $datosModel["fechab"],PDO::PARAM_STR);
              $stmt->bindParam(":fecres", $datosModel["fecres"],PDO::PARAM_STR);

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

  public function vistalistacomdetModel($idliscomp, $idprodcom, $tabla){
    
    $stmt = Conexion::conectar()-> prepare("SELECT * FROM pr_listacompradetalle where lid_idlistacompra=:idliscomp and `lid_idprodcompra`=:idprodcom;");

    $stmt->bindParam(":idliscomp", $idliscomp, PDO::PARAM_INT);
    $stmt->bindParam(":idprodcom", $idprodcom, PDO::PARAM_INT);          
    $stmt-> execute();
    return $stmt->fetchAll();

  }

public function actualizaProdLista($datosModel,$tabla){
            try{
              
            $sSQL= "UPDATE pr_listacompradetalle SET lid_idproducto=:numprod, lid_idtamano=:numtam, lid_idempaque=:numemp, lid_idtipoanalisis=:tipana, lid_cantidad=:cantidad, lid_tipo=:tipomues, lid_fechapermitida=:fechab, lid_fecharestringida=:fecres WHERE lid_idlistacompra=:idlis and lid_idprodcompra=:claop";


              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idlis", $datosModel["idlis"],PDO::PARAM_INT);
              $stmt->bindParam(":claop", $datosModel["claop"], PDO::PARAM_INT);
              $stmt->bindParam(":numprod", $datosModel["numprod"], PDO::PARAM_INT);
              $stmt->bindParam(":numtam", $datosModel["numtam"],PDO::PARAM_INT);
              $stmt->bindParam(":numemp", $datosModel["numemp"],PDO::PARAM_INT);
              $stmt->bindParam(":tipana", $datosModel["tipana"], PDO::PARAM_INT);
              $stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
              $stmt->bindParam(":tipomues", $datosModel["tipomues"],PDO::PARAM_INT);
              $stmt->bindParam(":fechab", $datosModel["fechab"],PDO::PARAM_STR);
              $stmt->bindParam(":fecres", $datosModel["fecres"],PDO::PARAM_STR);

              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar la lista");
            }
            
    }


    public function eliminaProLis($id, $idp,$tabla){
            try{      
              $sSQL= "DELETE FROM $tabla WHERE lid_idlistacompra=:id and lid_idprodcompra=:idp";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":id", $id,PDO::PARAM_INT);
              $stmt->bindParam(":idp", $idp,PDO::PARAM_INT);   
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar el recolector");
            }
            
    }

    public function eliminaLisDetalle($id, $tabla){
            try{      
              $sSQL= "DELETE FROM $tabla WHERE lid_idlistacompra=:id";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":id", $id,PDO::PARAM_INT);
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar el recolector");
            }
            
    }

public function vistalistaordenas($idliscomp, $numorden, $tabla){
    
    $stmt = Conexion::conectar()-> prepare("SELECT `lid_orden` FROM `pr_listacompradetalle` where lid_idlistacompra =:idliscompra AND lid_orden>=:numorden ORDER BY lid_orden;");

    $stmt->bindParam(":idliscompra", $idliscomp, PDO::PARAM_INT);
    $stmt->bindParam(":numorden", $numorden, PDO::PARAM_INT);          
    $stmt-> execute();
    return $stmt->fetchAll();

  }

public function actualizaorden($datosModel,$tabla){
    try{
      
    $sSQL= "UPDATE `pr_listacompradetalle` SET `lid_orden`=:nvoorden where lid_idlistacompra = :idlis AND lid_orden=:orden;";
    
      $stmt=Conexion::conectar()->prepare($sSQL);
      $stmt->bindParam(":idlis", $datosModel["idlis"],PDO::PARAM_INT);
      $stmt->bindParam(":orden", $datosModel["orden"], PDO::PARAM_INT);
      $stmt->bindParam(":nvoorden", $datosModel["nvoorden"], PDO::PARAM_INT);
      $stmt-> execute();
      
    }catch(PDOException $ex){
      throw new Exception("Hubo un error al insertar la lista");
    }
            
    }

}
?>	