<?php


class DatosValFotos extends Conexion{

	
	public function getValidacionFotos($indice,$recolector,$etapa,$estatus, $tabla){

		// consulta 
		
	    $stmt = Conexion::conectar()->prepare("SELECT val_id as id,val_inf_id as informesId, val_indice as indice,
val_estatus, val_etapa, i.inf_plantasid as plantasId ,
 cn.n5_nombre as plantaNombre  ,
cn2.n1_nombre clienteNombre,  n5_idn1 as clientesId,
v.vi_unedesc nombreTienda,vai_descripcionfoto descripcionId,cc.cad_descripcionesp descripcionFoto,vai_numfoto numFoto,
val_etapa etapa,vai_estatus as estatus,vai_fecha createdAt, 1 as contador,vai_observaciones motivo,
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
AND val_etapa=:etapa and vai_estatus=:estatus");

        $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
        $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
        $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
        $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
		$stmt-> execute();
	//	$stmt->debugDumpParams();
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
and vas_idseccion in (7,10)
where inf_indice=:indice and inf_usuario=:rec and (ind_estatus=:estatus or ind_estatus=4)");
	    
	    $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
	    $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
	   
	    $stmt->bindParam(":estatus", $estatus, PDO::PARAM_INT);
	    $stmt-> execute();
	    	$stmt->debugDumpParams();
	    return $stmt->fetchall(PDO::FETCH_ASSOC);
	    
	}
	
	public function getValidacionxId($indice,$recolector,$corid,$numfoto){
	    
	    // consulta
	    
	    $stmt = Conexion::conectar()->prepare("SELECT val_id ,val_inf_id, val_indice ,
val_estatus, val_etapa, i.inf_plantasid  ,
 cn.n5_nombre as plantaNombre  ,val_rec_id,
cn2.n1_nombre clienteNombre,  n5_idn1 ,
v.vi_unedesc nombreTienda,vai_descripcionfoto ,
cc.cad_descripcionesp ,vai_numfoto ,
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
	

	

}	
