<?php


class DatosValFotos extends Conexion{

	
	public function getValidacionFotos($indice,$recolector,$etapa,$estatus, $tabla){

		// consulta 
		/***falta motivo y total_fotos***/
        $stmt = Conexion::conectar()->prepare("SELECT val_id as id,val_inf_id as informesId, val_indice as indice,
val_estatus, val_etapa, i.inf_plantasid as plantasId ,
 cn.n5_nombre as plantaNombre  ,
cn2.n1_nombre clienteNombre,  n5_idn1 as clientesId,
v.vi_unedesc nombreTienda,vai_descripcionfoto descripcionId,cc.cad_descripcionesp descripcionFoto,vai_numfoto numFoto,
val_etapa etapa,vai_estatus as estatus
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
		//$stmt->debugDumpParams();
		return $stmt->fetchall(PDO::FETCH_ASSOC);

	}

	

}	
