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
    $stmt = Conexion::conectar()-> prepare("INSERT INTO $tabla (`val_inf_id`, `val_rec_id`, `val_indice`, `val_etapa`, `val_estatus`) VALUES (:idinf,:idrec,:indice,:etapa, :estatus)");

    	$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		$stmt->bindParam(":etapa", $datosModel["ideta"], PDO::PARAM_INT);
		$stmt-> execute();

	

	}

	public function LeeIdValidacion($datosModel, $tabla){


	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT `val_id`, `val_estatus` FROM $tabla WHERE  `val_inf_id`=:idinf and  `val_rec_id`=:valrec and `val_indice`=:indice and `val_etapa`=:ideta");

		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":valrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}

    public function LeeIdImgValidacion($datosModel, $tabla){


	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla WHERE `vas_id`=:idinf and vas_idseccion =:idsec;");

		$stmt->bindParam(":idinf", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}





	public function insertaValidacionsec($datosModel, $tabla){
  	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("INSERT INTO `sup_validasecciones`(`vas_id`, `vas_idseccion`, `vas_descripcion`, `vas_aprobada`, `vas_noaplica`, `vas_observaciones`, `vas_estatus`) VALUES (:idval, :idsec, :descrip, :aprob, :noap, :observ, :estatus);");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt->bindParam(":descrip", $datosModel["descrip"], PDO::PARAM_STR);
		$stmt->bindParam(":aprob", $datosModel["idaprob"], PDO::PARAM_INT);
		$stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
		$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
		$stmt->bindParam(":estatus", $datosModel["estatus"], PDO::PARAM_INT);
		
		$stmt-> execute();

	}

	
	public function ingresaregvalsec($datosModel, $tabla){
//     echo "estoy en query";
	// busca el id de validacion
     $sql= 'INSERT INTO sup_validasecciones (vas_id, vas_idseccion, vas_descripcion, vas_aprobada, vas_noaplica, vas_observaciones, vas_estatus) VALUES ('.$datosModel["idval"].','.$datosModel["idsec"].',"'.$datosModel["descrip"].'",'.$datosModel["idaprob"].','.$datosModel["noap"].',"'.$datosModel["observ"].'",'.$datosModel["estatus"].');';

   
	//var_dump($sql);
	$stmt = Conexion::conectar()-> prepare($sql);

	//$stmt = Conexion::conectar()-> prepare("INSERT INTO sup_validasecciones (vas_id, vas_idseccion, vas_descripcion, vas_apro$datosModel["idaprob"].'b'.ada, vas_noaplica, vas_observaciones, vas_estatus) VALUES (:idval,:idsec,:descrip,:aprob,:noap,:observ,:est);");

		//$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		//$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		//$stmt->bindParam(":descrip", $datosModel["descrip"], PDO::PARAM_STR);
		//$stmt->bindParam(":aprob", $datosModel["idaprob"], PDO::PARAM_INT);
		//$stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
		//$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
		//$stmt->bindParam(":est", $datosModel["estatus"], PDO::PARAM_INT);
		//var_dump($stmt);
		$stmt-> execute();

	}


	
	public function actualizaValidacionsec($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("UPDATE `sup_validasecciones` SET `vas_aprobada`=:idaprob, `vas_noaplica`=:noap, `vas_observaciones`=:observ,`vas_estatus`=:estatus WHERE `vas_id`=:idval and `vas_idseccion`=:idsec;");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt->bindParam(":idaprob", $datosModel["idaprob"], PDO::PARAM_INT);
		$stmt->bindParam(":noap", $datosModel["noap"], PDO::PARAM_INT);
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



public function LeeIdvalidafoto($idval, $idimg, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `sup_validafotos` where vai_id=:idval and vai_numfoto=:idimg;");

	$stmt->bindParam(":idval", $idval, PDO::PARAM_INT);
    $stmt->bindParam(":idimg", $idimg, PDO::PARAM_INT);
	$stmt-> execute();

	return $stmt->fetchall();

	}


public function actualizaValidacionimg($datosModel, $tabla){
 try {
	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("UPDATE $tabla SET `vai_estatus`=:estatus WHERE `vai_id`=:idval and `vai_numfoto`=:numimg");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":estatus", $datosModel["est"], PDO::PARAM_INT);
		$stmt->bindParam(":numimg", $datosModel["idimg"], PDO::PARAM_INT);
	
		$stmt-> execute();
		    return "success";
        } catch (Exception $ex) {

            return "error";
        }        
	}


    public function ingresaValidacionimg($datosModel, $tabla){

	// busca el id de validacion
    $sql='INSERT INTO `sup_validafotos`(`vai_id`, `vai_numfoto`, `vai_descripcionfoto`, `vai_estatus`, `vai_observaciones`)
 VALUES ('.$datosModel["idval"].','.$datosModel["idimg"].','.$datosModel["desimg"].','.$datosModel["est"].',"'.$datosModel["observ"].'");';
   	//	echo $sql;
	$stmt = Conexion::conectar()-> prepare($sql);

	//	$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
	//	$stmt->bindParam(":estatus", $datosModel["est"], PDO::PARAM_INT);
	//	$stmt->bindParam(":numimg", $datosModel["idimg"], PDO::PARAM_INT);
	//	$stmt->bindParam(":descripfoto", $datosModel["desimg"], PDO::PARAM_STR);
	//	$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
	//	$stmt->bindParam(":observ", $datosModel["observ"], PDO::PARAM_STR);
		$stmt-> execute();
		        
	}

public function LeeImgticket($uneid, $recid, $indice, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `ca_uneimagenes` where ui_uneid = :uneid and ui_tikindice=:indice and ui_tikrecolector =:recid; 
");

	$stmt->bindParam(":uneid", $uneid, PDO::PARAM_INT);
    $stmt->bindParam(":indice", $indice, PDO::PARAM_INT);
    $stmt->bindParam(":recid", $recid, PDO::PARAM_INT);
	$stmt-> execute();

	return $stmt->fetchall();

	}

	public function LeeEstatusSec($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT vas_aprobada, vas_noaplica FROM $tabla inner join sup_validasecciones on val_id=vas_id where val_inf_id=:idinf and val_rec_id=:valrec and val_indice = :indice  and val_etapa=:ideta and vas_idseccion=:idsec;");

		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":valrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);
		$stmt->bindParam(":idsec", $datosModel["idsec"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}



public function LeeEstatusFoto($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT `vai_id`, `vai_numfoto`, `vai_descripcionfoto`, `vai_observaciones`, `vai_estatus` FROM `sup_validafotos` INNER JOIN sup_validacion ON sup_validacion.val_id= sup_validafotos.vai_id WHERE val_indice=:indice AND val_rec_id=:idrec and val_etapa =:ideta and val_inf_id=:idinf and vai_numfoto = :idfoto;
");

		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);
		$stmt->bindParam(":idfoto", $datosModel["idfoto"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}

}	
