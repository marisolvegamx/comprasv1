<?php

require_once "Models/conexion.php";
class DatosInfoProdExhib extends Conexion{

	public function LeeEstatusProd($datosModel, $tabla){

	// busca el id de validacion
	$stmt = Conexion::conectar()-> prepare("SELECT `vap_id`, `vap_idcli`, `vap_observac`, `vap_estatus` FROM `sup_validaprodexhib` WHERE vap_id=:valid and vap_idcli=:idcli;");

		$stmt->bindParam(":valid", $datosModel["idval"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();

	return $stmt->fetchall();

	}


	public function insertaEstatusProd($datosModel, $tabla){

	// inserta estatus prod
	$SQL='INSERT INTO `sup_validaprodexhib`(`vap_id`, `vap_idcli`, `vap_observac`, `vap_estatus`) VALUES ('.$datosModel["idval"].','.$datosModel["idcli"].',"'.$datosModel["observ"].'",'.$datosModel["est"].');';


	$stmt = Conexion::conectar()-> prepare($SQL);

	
		//$stmt->bindParam(":valid", , PDO::PARAM_INT);
		//$stmt->bindParam(":valcli", $datosModel["idcli"], PDO::PARAM_INT);
		//$stmt->bindParam(":observ", , PDO::PARAM_STR);
		//$stmt->bindParam(":estatus", , PDO::PARAM_INT);
		$stmt-> execute();

	}

}
