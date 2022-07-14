<?php

require_once "Models/conexion.php";
class DatosSupvisita extends Conexion{

	
	public function vistaSupInfvisModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT *, date_format(vi_createdat, '%d-%m-%Y') as fecharep, date_format(vi_createdat, '%H:%i') as horarep FROM `visitas` inner join informes on inf_visitasIdlocal=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector  where inf_id=:idv and inf_indice=:indice and inf_usuario=:cverec;");

		$stmt->bindParam(":idv", $datosModel["idinf"],PDO::PARAM_INT);
	    $stmt->bindParam(":indice", $datosModel["idmes"],PDO::PARAM_STR);
	    $stmt->bindParam(":cverec", $datosModel["idrec"],PDO::PARAM_INT);
	    
		$stmt-> execute();
	  
	    return $stmt->fetchall();

    }

      public function vistaSuplistatiendasModel($datosModel, $tabla){

	  $stmt = Conexion::conectar()-> prepare("SELECT `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_idn1, n5_supervisor, inf_estatus, vi_tiendaid, une_descripcion,  une_puntocardinal, une_tipotienda FROM `informes` inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector left join ca_unegocios on vi_tiendaid=une_id inner join ca_nivel5 on inf_plantasid=n5_id where n5_supervisor=:idsup and inf_indice=:indice and inf_plantasid=:idplan;");

	

		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idplan", $datosModel["idplan"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }
}
?>

