<?php

require_once "Models/conexion.php";


class EnlacesModel extends Conexion{
	# REGISTRO DE USUARIOS
	#---------------------------------------------
	public function listaOpcionesMenu($gpo, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT idgrupo, grupospermisos.idpermiso, nombrepermiso FROM $tabla inner join permisos on grupospermisos.idpermiso=permisos.idpermiso where idgrupo=:gpo");

		$stmt->bindParam(":gpo", $gpo, PDO::PARAM_STR);

		$stmt-> execute();

		return $stmt->fetchall();

		$stmt->close();
	}


}

?>	



