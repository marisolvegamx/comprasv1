<?php

require_once "Models/conexion.php";
class DatosListaCompraDet extends Conexion{

	# CLASE NIVEL 1n1
	public function vistalistacomModel($idliscomp, $tabla){
    
		$stmt = Conexion::conectar()-> prepare("SELECT lis_idplanta, pro_id, pro_orden, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad,   lid_numtienbak, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, desctam, ordtam, lid_tipo, idemp, descemp, ordemp, idtipa, desctipa, ordtipa, idtipm, desctipm, ordtipm FROM (
    SELECT lis_idplanta, lid_idprodcompra, lis_idindice, `lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto,  lid_numtienbak, lid_cantidad, pro_id, pro_orden, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo FROM pr_listacompradetalle inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as A inner JOIN (SELECT cad_idopcion as idtam, cad_descripcionesp as desctam, cad_otro as ordtam FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as B ON A.lid_idtamano=B.idtam INNER JOIN (SELECT cad_idopcion as idemp, cad_descripcionesp as descemp, cad_otro as ordemp FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=12) as C ON A.lid_idempaque=C.idemp INNER JOIN (SELECT cad_idopcion as idtipa, cad_descripcionesp as desctipa, cad_otro as ordtipa FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=7) as D ON A.lid_idtipoanalisis=D.idtipa INNER JOIN (SELECT cad_idopcion as idtipm, cad_descripcionesp as desctipm, cad_otro as ordtipm FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=15) as E ON A.lid_tipo=E.idtipm ORDER BY pro_orden ASC, ordtam DESC, ordemp ASC, ordtipa ASC, ordtipm;");


    //$stmt = Conexion::conectar()-> prepare("SELECT lis_idplanta, pro_id, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, cad_descripcionesp, cad_otro, lid_tipo FROM (SELECT lis_idplanta, lid_idprodcompra, lis_idindice, `lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto, lid_cantidad, pro_id, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo FROM $tabla inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as a INNER JOIN (SELECT cad_idopcion, cad_descripcionesp, cad_otro FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as b ON lid_idtamano=cad_idopcion ORDER BY pro_id, cad_otro ASC, lid_idempaque ASC, lid_idtipoanalisis ASC, lid_tipo;");

    $stmt->bindParam(":idliscomp", $idliscomp,PDO::PARAM_INT);
              
		$stmt-> execute();
		return $stmt->fetchAll();

	}


  public function vistacodigosnopermitidos($datosModel, $tabla){
    
    $stmt = Conexion::conectar()-> prepare("SELECT inf_id, ind_caducidad, inf_indice, inf_plantasid, ind_productos_id, ind_tamanio_id, ind_empaque, ind_tipoanalisis FROM informe_detalle inner join informes on inf_indice=ind_indice and inf_usuario=ind_recolector and inf_id=ind_informes_id where (inf_indice=:indice1 or inf_indice=:indice2  or inf_indice=:mesas)and inf_plantasid=:planta and ind_productos_id=:producto and ind_tamanio_id =:tamanio and ind_empaque=:empaque and ind_tipoanalisis=:tipoanalisis group by inf_indice, inf_plantasid, ind_productos_id, ind_tamanio_id, ind_caducidad order by ind_caducidad desc");

    $stmt->bindParam(":indice1", $datosModel["cnpindi1"],PDO::PARAM_STR);
    $stmt->bindParam(":indice2", $datosModel["cnpindi2"],PDO::PARAM_STR);
    $stmt->bindParam(":mesas", $datosModel["mesasig"],PDO::PARAM_STR);
    $stmt->bindParam(":planta", $datosModel["planta"],PDO::PARAM_INT);          
    $stmt->bindParam(":producto", $datosModel["cnpprod"],PDO::PARAM_INT);
    $stmt->bindParam(":tamanio", $datosModel["cnptam"],PDO::PARAM_INT);          
    $stmt->bindParam(":empaque", $datosModel["cnpempa"],PDO::PARAM_INT);
    $stmt->bindParam(":tipoanalisis", $datosModel["cnptipana"],PDO::PARAM_INT);      
    
    $stmt-> execute();
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
    
    $stmt = Conexion::conectar()-> prepare("SELECT * FROM pr_listacompradetalle inner join pr_listacompra on lis_idlistacompra=lid_idlistacompra where lid_idlistacompra=:idliscomp and `lid_idprodcompra`=:idprodcom;");

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

public function actualizabackup($datosModel,$tabla){
    try{
      
    $sSQL= "UPDATE `pr_listacompradetalle` SET `lid_backup`=:chkbac, `lid_numtienbak`=:ntbak where lid_idlistacompra = :idlis AND lid_idprodcompra=:orden;";
    
      $stmt=Conexion::conectar()->prepare($sSQL);
      $stmt->bindParam(":idlis", $datosModel["idlis"],PDO::PARAM_INT);
      $stmt->bindParam(":orden", $datosModel["orden"], PDO::PARAM_INT);
      $stmt->bindParam(":chkbac", $datosModel["chkbac"], PDO::PARAM_INT);
      $stmt->bindParam(":ntbak", $datosModel["notienchk"], PDO::PARAM_INT);
      $stmt-> execute();
      
    }catch(PDOException $ex){
      throw new Exception("Hubo un error al insertar la lista");
    }
            
    }
    public function sumaAceptadosLista($idlis,$claop,$cantidad,$tabla){
        try{
            
            $sSQL= "UPDATE $tabla SET
            lid_saldoaceptado=lid_saldoaceptado+:cantidad
             WHERE lid_idlistacompra=:idlis and lid_idprodcompra=:claop";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
            $stmt->bindParam(":claop", $claop, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt-> execute();
            //  $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar la cantidad");
        }
        
    }
    
    public function restaAceptadosLista($idlis,$claop,$cantidad,$tabla){
        try{
            
            $sSQL= "UPDATE $tabla SET
            lid_saldoaceptado=lid_saldoaceptado-:cantidad
             WHERE lid_idlistacompra=:idlis and lid_idprodcompra=:claop";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
            $stmt->bindParam(":claop", $claop, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt-> execute();
            //  $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar la cantidad");
        }
        
    }
    

}
?>	