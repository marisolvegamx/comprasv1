<?php

require_once "Models/conexion.php";
class DatosValidacion extends Conexion{

	
	public function ConsultaValidacion($datosModel, $tabla){

		// consulta 
    $stmt = Conexion::conectar()-> prepare("SELECT * FROM `sup_validasecciones` inner join sup_validacion on vas_id=val_id WHERE val_indice=:indice and val_inf_id=:idinf and val_rec_id=:idrec;");

    	$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();

		return $stmt->fetchall();

	}

	public function InsertaValidacion($datosModel, $tabla){

		// consulta 
    $stmt = Conexion::conectar()-> prepare("INSERT INTO $tabla (`val_inf_id`, `val_rec_id`, `val_indice`,  `val_pla_id`, `val_estatus`) VALUES (:idinf,:idrec,:indice, :idpla,:estatus)");

    	$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idpla", $datosModel["idplan"], PDO::PARAM_INT);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		$stmt-> execute();

	

	}

	public function LeeIdValidacion($datosModel, $tabla){


	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT `val_id` FROM $tabla WHERE  `val_inf_id`=:idinf and  `val_rec_id`=:valrec and `val_indice`=:indice and `val_pla_id`=:plaid");

		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":valrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":plaid", $datosModel["idplan"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}

	public function insertaValidacionsec($datosModel, $tabla){
  	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("INSERT INTO `sup_validasecciones`(`vas_id`, `vas_idseccion`, `vas_descripcion`, `vas_aprobada`, `vas_noaplica`, `vas_observaciones`, `vas_estatus`) VALUES (:idval,:idsec,:descrip,:aprob,:noap,:observ,:estatus)");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt->bindParam(":descrip", $datosModel["descrip"], PDO::PARAM_STR);
		$stmt->bindParam(":aprob", $datosModel["idaprob"], PDO::PARAM_INT);
		$stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
		$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		
		$stmt-> execute();

	}

	
	
	public function actualizaValidacionsec($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("UPDATE `sup_validasecciones` SET `vas_aprobada`=:idaprob, `vas_observaciones`=:observ,`vas_estatus`=:estatus WHERE `vas_id`=:idval and `vas_idseccion`=:idsec;");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt->bindParam(":idaprob", $datosModel["idaprob"], PDO::PARAM_INT);
		$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		
		$stmt-> execute();
	}


public function actualizaValidacionpr($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("UPDATE `sup_validacion` SET `val_estatus`=:estatus WHERE `val_id`=:idval");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		
		$stmt-> execute();
	}

}	
