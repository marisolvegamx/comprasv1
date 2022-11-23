<?php

require_once "Models/conexion.php";
class DatosSupvisita extends Conexion{

	
	public function vistaSupInfvisModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT *, date_format(vi_createdat, '%d-%m-%Y') as fecharep, date_format(vi_createdat, '%H:%i') as horarep FROM `visitas` inner join informes on inf_visitasidlocal=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector  where inf_id=:idv and inf_indice=:indice and inf_usuario=:cverec;");


		$stmt->bindParam(":idv", $datosModel["idinf"],PDO::PARAM_INT);
	    $stmt->bindParam(":indice", $datosModel["idmes"],PDO::PARAM_STR);
	    $stmt->bindParam(":cverec", $datosModel["idrec"],PDO::PARAM_INT);
		$stmt-> execute();
	  
	    return $stmt->fetchall();

    }

      public function vistaSuplistatiendasModel($datosModel, $tabla){

	
		$stmt = Conexion::conectar()-> prepare("SELECT (inf_id) AS ID, N4_NOMBRE AS CIUDAD, vi_unedesc, vi_cverecolector, val_estatus as EST, PEPSI AS TPEPSI, penafiel AS TPENA, electrop AS TELEC FROM ( SELECT inf_id, vi_unedesc, n5_idn4, val_estatus, if(n5_idn1=4,1,0) as pepsi, if(n5_idn1=5,1,0) as penafiel, if(n5_idn1=6,1,0) as electrop, vi_cverecolector FROM `informes` inner join visitas on inf_indice=vi_indice and inf_visitasidlocal=vi_idlocal and inf_usuario= vi_cverecolector left join sup_validacion on inf_indice=val_indice and inf_id=val_inf_id and inf_usuario= val_rec_id left join ca_nivel5 on n5_id=inf_plantasid where inf_indice =:indice and n5_supervisor =:idsup order by inf_id) AS A inner join ca_nivel4 on n5_idn4=n4_id where n4_nombre= :idciu order by inf_id;");

		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_STR);
		$stmt-> execute();
		return $stmt->fetchall();

    }

    
  public function vistaSuplistacomprasModel($datosModel, $tabla){

	
		$stmt = Conexion::conectar()-> prepare("SELECT n4_nombre, n5_supervisor, inf_usuario, inf_indice, val_etapa, count(inf_id) as totinf, count(val_estatus) as estatus, sum(if(vai_cliente=4,1,0)) as pepsi , sum(if(vai_cliente=5,1,0)) as pena, sum(if(vai_cliente=6,1,0)) as elec FROM `informes` inner join ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel4 on n5_idn4=n4_id left join sup_validacion on inf_id=val_id and inf_indice=val_indice And inf_usuario=val_rec_id left join sup_validafotos on val_id=vai_id where inf_indice =:indice and n5_supervisor=:idsup and n4_nombre= :idciu group by n4_nombre, n5_supervisor, inf_indice, val_etapa;");

		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_STR);
		$stmt-> execute();
	//	$stmt->debugDumpParams();
		return $stmt->fetchall();

    }



}
?>

