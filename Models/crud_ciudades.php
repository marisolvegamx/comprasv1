<?php
require_once "Models/conexion.php";

class DatosCiudadesResidencia{
     public function listaCiudadesxPais($datosModel, $tabla){
		$stmt = Conexion::conectar()-> prepare("SELECT ciu_id, ciu_descripcionesp, ciu_descripcioning, ciu_paisid
FROM $tabla
where ciu_paisid=:id");
         
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
		
		$stmt-> execute();

		return $stmt->fetchAll();
	}
        
        
     
 
}
