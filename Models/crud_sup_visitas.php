<?php

require_once "Models/conexion.php";
class DatosSupvisita extends Conexion{

	
	public function vistaSupInfvisModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT *, date_format(vi_createdat, '%d-%m-%Y')
 as fecharep, date_format(vi_createdat, '%H:%i') as horarep 
FROM `visitas` inner join informes on inf_visitasIdlocal=vi_idlocal and inf_indice=vi_indice 
and inf_usuario=vi_cverecolector  where inf_id=:idv and inf_indice=:indice and
 inf_usuario=:cverec;");


		$stmt->bindParam(":idv", $datosModel["idinf"],PDO::PARAM_INT);
	    $stmt->bindParam(":indice", $datosModel["idmes"],PDO::PARAM_STR);
	    $stmt->bindParam(":cverec", $datosModel["idrec"],PDO::PARAM_INT);
	    
		$stmt-> execute();
	  
	    return $stmt->fetchall();

    }

      public function vistaSuplistatiendasModel($datosModel, $tabla){

	 // $stmt = Conexion::conectar()-> prepare("SELECT `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_idn1, n5_supervisor, inf_estatus, vi_tiendaid, une_descripcion,  une_puntocardinal, une_tipotienda FROM `informes` inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector left join ca_unegocios on vi_tiendaid=une_id inner join ca_nivel5 on inf_plantasid=n5_id where n5_supervisor=:idsup and inf_indice=:indice and inf_plantasid=:idplan;");

	//	$stmt = Conexion::conectar()-> prepare("SELECT vi_unedesc, vi_indice, inf_id, vi_cverecolector, inf_plantasid FROM `visitas` inner join informes on inf_indice=vi_indice and inf_usuario=vi_cverecolector and vi_idlocal=inf_id left join ca_nivel5 on n5_id=inf_plantasid WHERE vi_indice=:indice and n5_supervisor=:idsup and n5_idn4=:idciu;");


		$stmt = Conexion::conectar()-> prepare("SELECT (inf_id) AS ID, N4_NOMBRE AS CIUDAD, vi_unedesc, vi_cverecolector, val_estatus as EST, PEPSI AS TPEPSI, penafiel AS TPENA, electrop AS TELEC FROM ( SELECT inf_id, vi_unedesc, n5_idn4, val_estatus, if(n5_idn1=4,1,0) as pepsi, if(n5_idn1=5,1,0) as penafiel, if(n5_idn1=6,1,0) as electrop, vi_cverecolector FROM `informes` inner join visitas on inf_indice=vi_indice and inf_visitasIdlocal=vi_idlocal and inf_usuario= vi_cverecolector left join sup_validacion on inf_indice=val_indice and inf_id=val_inf_id and inf_usuario= val_rec_id left join ca_nivel5 on n5_id=inf_plantasid where inf_indice =:indice and n5_supervisor =:idsup order by inf_id) AS A inner join ca_nivel4 on n5_idn4=n4_id where n4_nombre= :idciu order by inf_id;");

		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_STR);
		$stmt-> execute();
		return $stmt->fetchall();

    }
}
?>

