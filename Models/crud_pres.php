<?php
require_once "Models/conexion.php";
class DatosPres extends Conexion{

	# CLASE NIVEL 1n1
	public function vistapresModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarPres($datosModel,$tabla){
          	//try{
          		
              $sSQL= "INSERT INTO ca_presentacion(pre_cliente, pre_tipoempaque, pre_tamano, pre_presentacion) VALUES (:cliente,:tipoemp,:tamano,:pres);";
          		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":cliente", $datosModel["cliente"],PDO::PARAM_STR);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"], PDO::PARAM_STR);
              $stmt->bindParam(":tamano", $datosModel["tamano"], PDO::PARAM_STR);
              $stmt->bindParam(":pres", $datosModel["pres"],PDO::PARAM_STR);

          		$stmt-> execute();
          		
          	//}//catch(PDOException $ex){
          		//throw new Exception("Hubo un error al insertar el recolector");
          	//}
          	
    }

    public function editapresModel($preid, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where pre_id=:preid");
		 $stmt->bindParam(":preid", $preid,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function actualizarPres($datosModel,$tabla){
          	//try{
          		
              $sSQL= "UPDATE ca_presentacion SET ,pre_cliente=:cliente,pre_tipoempaque=:tipoemp,pre_tamano=:tamano,pre_presentacion=:pres WHERE pre_id=:idpres";
          		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":cliente", $datosModel["cliente"],PDO::PARAM_STR);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"], PDO::PARAM_STR);
              $stmt->bindParam(":tamano", $datosModel["tamano"], PDO::PARAM_STR);
              $stmt->bindParam(":pres", $datosModel["pres"],PDO::PARAM_STR);
              $stmt->bindParam(":idpres", $datosModel["idpres"],PDO::PARAM_STR);


          		$stmt-> execute();
          		
          	//}//catch(PDOException $ex){
          		//throw new Exception("Hubo un error al insertar el recolector");
          	//}
          	
    }
}	