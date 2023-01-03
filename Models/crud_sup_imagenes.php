<?php

require_once "Models/conexion.php";
class DatosImgInformes extends Conexion{

	
	public function vistaImgInfModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `imagen_detalle` where imd_indice = :indice and imd_usuario=:idrec and imd_idlocal=:idimg;");

		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idimg", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
//$stmt->debugDumpParams();
		return $stmt->fetchall();

    }

    public function actualizaestatusimg($datosModel, $tabla){

    // busca el numero de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `imagen_detalle` where imd_indice = :indice and imd_usuario=:idrec and imd_idlocal=:idimg;");

		$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idimg", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();

		return $stmt->fetchall();

	//revisa si existe 		

    }



public function actualizacatalogoimg($datosModel, $tabla){

    // busca el numero de validacion
	$stmt = Conexion::conectar()-> prepare("UPDATE `ca_unegocios` SET `une_fotofachada`=:nomimg WHERE `une_id`=:uneid;");

		$stmt->bindParam(":nomimg", $datosModel["nomimg"], PDO::PARAM_STR);
		$stmt->bindParam(":uneid", $datosModel["uneid"], PDO::PARAM_INT);
		

		return $stmt->fetchall();

	//revisa si existe 		

    }

public function LeeEstatusfoto($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT `vai_id`, `vai_numfoto`, `vai_descripcionfoto`, `vai_estatus` FROM `sup_validafotos` WHERE vai_id=:idval and vai_numfoto=:idfoto;");

		$stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idfoto", $datosModel["idfoto"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}


}