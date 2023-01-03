<?php

require_once "Models/conexion.php";


class EnlacesModel extends Conexion{
	# REGISTRO DE USUARIOS
	#---------------------------------------------
	public function listaOpcionesMenu($gpo, $tabla){

		$stmt = Conexion::conectar()-> prepare("select * from  $tabla 
inner join cnfg_menu on cpe_claveopcion=men_claveopcion
where cpe_grupo='adm'");

		$stmt->bindParam(":gpo", $gpo, PDO::PARAM_STR);

		$stmt-> execute();

		return $stmt->fetchall();

		$stmt->close();
	}


}

?>	



