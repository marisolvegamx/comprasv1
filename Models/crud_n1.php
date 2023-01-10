<?php

require_once "Models/conexion.php";
class Datosnuno extends Conexion{

	# CLASE NIVEL 1n1
	public function vistaN1Model($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT n1_id, n1_nombre FROM $tabla ");

		$stmt-> execute();
   // $stmt->debugDumpParams();
		return $stmt->fetchAll();

	}


	public function vistaN1opcionModel($idn1, $tabla){
    //echo $idn1;

		$stmt = Conexion::conectar()-> prepare("SELECT  n1_id, n1_nombre FROM ca_nivel1 WHERE n1_id=:idn1");
		$stmt-> bindParam(":idn1", $idn1, PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();
		$stmt->close();

	}	  
	
	public function getNombre($idn1, $tabla){
	    //echo $idn1;
	    
	    $stmt = Conexion::conectar()-> prepare("SELECT  n1_id, n1_nombre FROM ca_nivel1 WHERE n1_id=:idn1");
	    $stmt-> bindParam(":idn1", $idn1, PDO::PARAM_INT);
	    $stmt-> execute();
	    return $stmt->fetch();
	    $stmt->close();
	    
	}	  

  public function vistaN1opcionModelClien($idn1, $tabla){
    //echo $idn1;

    $stmt = Conexion::conectar()-> prepare("SELECT n1_nombre FROM ca_nivel1 WHERE n1_id=:idn1");
    $stmt-> bindParam(":idn1", $idn1, PDO::PARAM_INT);
    $stmt-> execute();
    return $stmt->fetch();
    $stmt->close();

  }  

  public function vistaN1nombreModel($idn1, $tabla){
    //echo $idn1;

    $stmt = Conexion::conectar()-> prepare("SELECT n1_id, n1_nombre FROM ca_nivel1 WHERE n1_id=:idn1");
    $stmt-> bindParam(":idn1", $idn1, PDO::PARAM_INT);
    $stmt-> execute();
    $result_cat=$stmt->fetchall();
     foreach($result_cat as $row_cat) {
        $res = $row_cat["n1_nombre"];
    }
     $stmt->closeCursor();     
     $result_cat=$stmt=null;
      return $res;
    
  } 
	
	public function listaxCliente($idcli, $tabla){
	    
	    $stmt = Conexion::conectar()-> prepare("SELECT n1_id, n1_nombre, n1_idcliente FROM ca_nivel1 WHERE n1_idcliente=:idcli");
	    
	    $stmt-> bindParam(":idcli", $idcli, PDO::PARAM_INT);
    
	    $stmt-> execute();
    
	    return $stmt->fetchAll();

	   
	    
	}
	

 public function nombreNivel1($id,$tabla) {


            $sql = "SELECT n1_id, n1_nombre FROM $tabla where n1_id=:id ";

            $stmt = Conexion::conectar()-> prepare($sql);
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);

            $stmt->execute();

            $res=$stmt->fetchAll();

          

            foreach ($res as $row) {

               $nombre = $row["n1_nombre"];

            }

      //      return $nombre;

          }
          
          public static function insertar($nombre, $tabla){
          	try{
          		
          		$sSQL= "INSERT INTO ca_nivel1
            ( n1_nombre) VALUES ( :nombre );";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
          		//$stmt->bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
          		
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el nombre");
          	}
          	
          }
          
          
          
          
          /**
           * Update a row in ca_nivel1
           * @param array data
           */
          function update($data,$tabla){
          	
          	$query = "UPDATE $tabla SET
		
		`n1_nombre` = :n1_nombre
	WHERE `n1_id` = :n1_id ";
          	
          	$q = Conexion::conectar()->prepare($query);
          	
          	
          	if ($q->execute(array(':n1_id' => $data['n1_id'], ':n1_nombre' => $data['n1_nombre']))){
          		
          		return (1);
          	}
          	else{
          		return(0);
          	}
          }
          
          
          
          /**
           * Delete a row in ca_nivel1
           * @param Int id
           */
          function del($id,$tabla){
          	
          	$query = "DELETE FROM $tabla WHERE n1_id = :id";
          	$q = Conexion::conectar()->prepare($query);
          	
          	if ($q->execute(array(':id' => $id ))){
          		return (1);
          	}
          	else{
          		return(0);
          	}
          }
          
          
          
          

}
