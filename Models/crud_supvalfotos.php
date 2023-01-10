<?php


class DatosValFotos extends Conexion{

	
	public function getValidacionFotos($indice,$recolector,$etapa,$estatus, $tabla){

		// consulta 
		
	    $stmt = Conexion::conectar()->prepare("SELECT val_id as id,val_inf_id as informesId, val_indice as indice,
val_estatus, val_etapa, i.inf_plantasid as plantasId ,
 cn.n5_nombre as plantaNombre  ,
cn2.n1_nombre clienteNombre,  n5_idn1 as clientesId,
v.vi_unedesc nombreTienda,vai_descripcionfoto descripcionId,cc.cad_descripcionesp descripcionFoto,vai_numfoto numFoto,
val_etapa etapa,vai_estatus as estatus,vai_fecha createdAt, vai_numcorreccion as contador,vai_observaciones motivo,
CASE
    WHEN cad_descripcionesp='foto_atributoa' THEN 'FOTO POSICION 1'
     WHEN cad_descripcionesp='foto_atributob' THEN 'FOTO POSICION 2'
      WHEN cad_descripcionesp='foto_atributoc' THEN 'FOTO POSICION 3'
    WHEN cad_descripcionesp = 'etiqueta_evaluacion' THEN 'ETIQUETA EVALUACION'
     WHEN cad_descripcionesp = 'foto_codigo_produccion' THEN 'FOTO CODIGO DE PRODUCCION'
    ELSE UPPER(cad_descripcionesp)
END as descMostrar
FROM $tabla
INNER JOIN sup_validafotos ON val_id=vai_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join informes i on i.inf_id=val_inf_id and val_rec_id=i.inf_usuario and i.inf_indice =val_indice
inner join ca_nivel5 cn on cn.n5_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n5_idn1
inner join visitas v on v.vi_idlocal =i.inf_visitasIdlocal  and v.vi_cverecolector =i.inf_usuario and v.vi_indice =i.inf_indice
WHERE val_rec_id=:rec
AND val_indice=:indice
AND val_etapa=:etapa and (vai_estatus=:estatus or vai_estatus=5)");

        $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
        $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
        $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
		$stmt-> execute();
	//	$stmt->debugDumpParams();
		return $stmt->fetchall(PDO::FETCH_ASSOC);

	}
	
	
	public function getValidacionFotosVis($indice,$recolector,$etapa,$estatus, $tabla){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare(" SELECT val_id as id,val_inf_id as informesId, val_indice as indice,
val_estatus, val_etapa, val_vis_id,
v.vi_unedesc nombreTienda,vai_descripcionfoto descripcionId,
cc.cad_descripcionesp descripcionFoto,vai_numfoto numFoto,
val_etapa etapa,vai_estatus as estatus,vai_fecha createdAt,
vai_numcorreccion as contador,vai_observaciones motivo,
CASE
    WHEN cad_descripcionesp='foto_atributoa' THEN 'FOTO POSICION 1'
     WHEN cad_descripcionesp='foto_atributob' THEN 'FOTO POSICION 2'
      WHEN cad_descripcionesp='foto_atributoc' THEN 'FOTO POSICION 3'
    WHEN cad_descripcionesp = 'etiqueta_evaluacion' THEN 'ETIQUETA EVALUACION'
     WHEN cad_descripcionesp = 'foto_codigo_produccion' THEN 'FOTO CODIGO DE PRODUCCION'
    ELSE UPPER(cad_descripcionesp)
END as descMostrar
FROM sup_validacion 
INNER JOIN sup_validafotos ON val_id=vai_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join visitas v on v.vi_idlocal =val_vis_id  and v.vi_cverecolector =val_rec_id 
and v.vi_indice =val_indice 
WHERE val_rec_id=:rec
AND val_indice=:indice
AND val_etapa=:etapa and (vai_estatus=:estatus or vai_estatus=5) 
order  by val_vis_id");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
	    $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	public function getValidacionEtaxId($indice,$recolector,$valid,$numfoto, $tabla){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare("SELECT val_id as id,val_inf_id as informesId, val_indice as indice,
val_estatus, val_etapa, i.ine_plantasid as plantasId ,
 cn.n5_nombre as plantaNombre  ,
cn2.n1_nombre clienteNombre,  n5_idn1 as clientesId,
vai_descripcionfoto,cc.cad_descripcionesp descripcionFoto,vai_numfoto numfoto,
val_etapa etapa,vai_estatus ,vai_consecutivoinf,date_format(vai_fecha, '%d-%m-%Y')  fecha, vai_numcorreccion ,vai_observaciones ,
CASE
    WHEN cad_descripcionesp='foto_atributoa' THEN 'FOTO POSICION 1'
     WHEN cad_descripcionesp='foto_atributob' THEN 'FOTO POSICION 2'
      WHEN cad_descripcionesp='foto_atributoc' THEN 'FOTO POSICION 3'
    WHEN cad_descripcionesp = 'etiqueta_evaluacion' THEN 'ETIQUETA EVALUACION'
     WHEN cad_descripcionesp = 'foto_codigo_produccion' THEN 'FOTO CODIGO DE PRODUCCION'
    WHEN cad_descripcionesp = 'foto_preparacion' THEN 'FOTO PREPARACION'
   ELSE UPPER(cad_descripcionesp)
END as descMostrar
FROM sup_validacion sv 
INNER JOIN sup_validafotos ON val_id=vai_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join informes_etapa  i on i.ine_id=val_inf_id and val_rec_id=i.ine_cverecolector 
and i.ine_indice =val_indice
inner join ca_nivel5 cn on cn.n5_id =ine_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n5_idn1
WHERE val_rec_id=:rec
AND val_indice=:indice
 and val_id=:valid and vai_numfoto=:numfoto");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	   // $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
	    $stmt->bindParam(":numfoto", $numfoto, PDO::PARAM_INT);
	    $stmt->bindParam(":valid", $valid, PDO::PARAM_INT);
	    $stmt-> execute();
	   // $stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	public function getMuestrasCanceladas($indice,$recolector,$estatus){
	    
	    // consulta
	    /***busca en la lista de compra si ya están aceptadas todas**/
	    $stmt = Conexion::conectar()->prepare("select inf_id, inf_visitasIdlocal ,ind_id, ind_comprasid, ind_compraddetid ,ind_comprasIdbu , ind_comprasDetIdbu ,vas_observaciones
,vas_fecha, lid_cantidad, lid_saldoaceptado 
from informes 
i inner join informe_detalle det 
on inf_id=det.ind_informes_id  and inf_indice =det.ind_indice 
and inf_usuario =det.ind_recolector 
inner join sup_validacion sv on sv.val_indice =inf_indice
and sv.val_rec_id =inf_usuario and sv.val_etapa =2 and sv.val_inf_id =inf_id
inner join sup_validasecciones sv2 on val_id=sv2.vas_id and vas_nummuestra=ind_id
inner join pr_listacompradetalle pl on pl.lid_idlistacompra =ind_comprasid and lid_idprodcompra=ind_compraddetid
and vas_idseccion in (7,10,4,5,6)
where inf_indice=:indice and inf_usuario=:rec and (ind_estatus=:estatus or ind_estatus=5)");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	   
	    $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	public function getValidacionxId($indice,$recolector,$corid,$numfoto){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare("SELECT val_id ,val_inf_id, val_indice ,
val_estatus, val_etapa, i.inf_plantasid  ,
 cn.n5_nombre as plantaNombre  ,val_rec_id,
cn2.n1_nombre clienteNombre,  n5_idn1 ,
v.vi_unedesc nombreTienda,vai_descripcionfoto ,vai_consecutivoinf,
cc.cad_descripcionesp ,vai_numfoto ,vai_numcorreccion,
val_etapa etapa,vai_estatus ,vai_fecha , vai_observaciones ,date_format(vai_fecha, '%d-%m-%Y') as fecha,
CASE
    WHEN cad_descripcionesp='foto_atributoa' THEN 'FOTO POSICION 1'
     WHEN cad_descripcionesp='foto_atributob' THEN 'FOTO POSICION 2'
      WHEN cad_descripcionesp='foto_atributoc' THEN 'FOTO POSICION 3'
    WHEN cad_descripcionesp = 'etiqueta_evaluacion' THEN 'ETIQUETA EVALUACION'
     WHEN cad_descripcionesp = 'foto_codigo_produccion' THEN 'FOTO CODIGO DE PRODUCCION'
    ELSE UPPER(cad_descripcionesp)
END as descMostrar
FROM sup_validacion
INNER JOIN sup_validafotos ON val_id=vai_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join informes i on i.inf_id=val_inf_id and val_rec_id=i.inf_usuario and i.inf_indice =val_indice
inner join ca_nivel5 cn on cn.n5_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n5_idn1
inner join visitas v on v.vi_idlocal =i.inf_visitasIdlocal  and v.vi_cverecolector =i.inf_usuario and v.vi_indice =i.inf_indice
 WHERE val_rec_id=:rec
 AND val_indice=:indice
 and val_id=:corid and vai_numfoto=:numfoto");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
	    $stmt->bindParam(":corid", $corid, PDO::PARAM_INT);
	    $stmt->bindParam(":numfoto", $numfoto, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	public function actualizaContValFotos($datosModel, $tabla){
	    try {
	        // busca el id de validacion
	        $stmt = Conexion::conectar()-> prepare("UPDATE $tabla 
SET `vai_estatus`=:estatus, vai_numcorreccion=vai_numcorreccion+1,
vai_observaciones=:motivo WHERE `vai_id`=:idval and `vai_numfoto`=:numimg");
	        
	        $stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
	        $stmt->bindParam(":estatus", $datosModel["est"], PDO::PARAM_INT);
	        $stmt->bindParam(":numimg", $datosModel["idimg"], PDO::PARAM_INT);
	      //  $stmt->bindParam(":numcor", $datosModel["numcor"], PDO::PARAM_INT);
	        $stmt->bindParam(":motivo", $datosModel["motivo"], PDO::PARAM_STR);
	        $stmt-> execute();
	      //  $stmt->debugDumpParams();
	        return "success";
	    } catch (Exception $ex) {
	        
	        return "error";
	    }
	}
	
	public function getInformesCancelados($indice,$recolector,$estatus){
	    
	    // consulta
	    /***busca en la lista de compra si ya están aceptadas todas**/
	    $stmt = Conexion::conectar()->prepare("SELECT val_inf_id, val_rec_id, val_indice, val_id, val_estatus, val_etapa
FROM sup_validacion
where val_estatus=:estatus and val_rec_id=:rec and val_indice=:indice");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    
	    $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	
	public function getValidacionsimxId($indice,$recolector,$corid){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare("SELECT val_inf_id, val_rec_id, val_indice, val_id, val_estatus, val_etapa, val_vis_id
FROM sup_validacion where val_rec_id=:rec and val_indice=:indice and val_id=:corid");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
	    $stmt->bindParam(":corid", $corid, PDO::PARAM_INT);
	  
	    $stmt-> execute();
	   // 	$stmt->debugDumpParams();
	    return $stmt->fetch(PDO::FETCH_ASSOC);
	    
	}
	
	public function getValidacionVisxId($indice,$recolector,$corid,$numfoto){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare("SELECT val_id ,val_inf_id, val_indice ,
val_estatus, val_etapa,val_rec_id,
v.vi_unedesc nombreTienda,vai_descripcionfoto ,vai_consecutivoinf,
cc.cad_descripcionesp ,vai_numfoto ,vai_numcorreccion,
val_etapa etapa,vai_estatus ,vai_fecha , vai_observaciones ,date_format(vai_fecha, '%d-%m-%Y') as fecha,
CASE
    WHEN cad_descripcionesp='foto_atributoa' THEN 'FOTO POSICION 1'
     WHEN cad_descripcionesp='foto_atributob' THEN 'FOTO POSICION 2'
      WHEN cad_descripcionesp='foto_atributoc' THEN 'FOTO POSICION 3'
    WHEN cad_descripcionesp = 'etiqueta_evaluacion' THEN 'ETIQUETA EVALUACION'
     WHEN cad_descripcionesp = 'foto_codigo_produccion' THEN 'FOTO CODIGO DE PRODUCCION'
      ELSE UPPER(cad_descripcionesp)
END as descMostrar
FROM sup_validacion
INNER JOIN sup_validafotos ON val_id=vai_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join visitas v on v.vi_idlocal =val_vis_id  and v.vi_cverecolector =val_rec_id 
and v.vi_indice =val_indice 
 WHERE val_rec_id=:rec
 AND val_indice=:indice
 and val_id=:corid and vai_numfoto=:numfoto");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
	    $stmt->bindParam(":corid", $corid, PDO::PARAM_INT);
	    $stmt->bindParam(":numfoto", $numfoto, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	
	public function getEtapaCanceladas($indice,$recolector,$estatus){
	    
	    // consulta
	    /***busca en la lista de compra si ya están aceptadas todas**/
	    $stmt = Conexion::conectar()->prepare("select ine_id as inf_id, vas_observaciones
,vas_fecha
from informes_etapa i 
inner join sup_validacion sv on sv.val_indice =ine_indice
and sv.val_rec_id =ine_cverecolector and sv.val_etapa =1 and sv.val_inf_id =ine_id
inner join sup_validasecciones sv2 on val_id=sv2.vas_id 
 and vas_idseccion in (22)
 where ine_indice=:indice and ine_cverecolector =:rec and (ine_estatus=:estatus or ine_estatus=5)");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	    
	    $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
	    $stmt-> execute();
	    //	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	
}	
