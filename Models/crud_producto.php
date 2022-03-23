<?php
require_once "Models/conexion.php";
class DatosProd extends Conexion{

	# CLASE NIVEL 1n1
	public function vistaprodModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarProd($datosModel,$tabla){
          	try{
          		
              $sSQL= "INSERT INTO ca_productos(pro_cliente, pro_categoria, pro_producto) VALUES (:cliente,:categoria,:nompro);";


          		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":cliente", $datosModel["cliente"],PDO::PARAM_INT);
          	  $stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_INT);
              $stmt->bindParam(":nompro", $datosModel["nomprod"], PDO::PARAM_STR);

          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }

    public function editaprodModel($proid, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where pro_id=:proid");
		 $stmt->bindParam(":proid", $proid,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function actualizarProd($datosModel,$tabla){
          	try{
          		
              $sSQL= "UPDATE ca_productos SET pro_cliente=:cliente, pro_categoria=:categoria, pro_producto=:producto WHERE pro_id=:idprod";
	
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":cliente", $datosModel["cliente"],PDO::PARAM_STR);
          	  $stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_STR);
              $stmt->bindParam(":producto", $datosModel["producto"],PDO::PARAM_STR);
              $stmt->bindParam(":idprod", $datosModel["idprod"],PDO::PARAM_STR);


          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }


    public function eliminaProd($idprod,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE pro_id=:idprod";
              //echo $sSQL;
              //echo $idprod;
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idprod", $idprod,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar el recolector");
            }
            
    }


public function listaprodModel($cliid, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT pro_id, pro_producto FROM `ca_productos` where pro_cliente=:cliid;");
     $stmt->bindParam(":cliid", $cliid,PDO::PARAM_INT);

    $stmt-> execute();
    return $stmt->fetchAll();

  }


  public function getnomprodModel($proid, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where pro_id=:proid");
     $stmt->bindParam(":proid", $proid,PDO::PARAM_INT);

    $stmt-> execute();
    $result_cat=$stmt->fetchall();
     foreach($result_cat as $row_cat) {        
            $res= $row_cat["pro_producto"];
     }
     $stmt->closeCursor();     
     $result_cat=$stmt=null;
      return $res;
  }

}	