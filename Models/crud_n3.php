<?php

require_once "Models/conexion.php";

class Datosntres extends Conexion{

	# CLASE NIVEL 1n1

	public function vistantresModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT n3_idn1, n1_nombre, n3_idn2, n2_nombre, n3_id, n3_nombre FROM $tabla inner JOIN ca_nivel2 ON n3_idn2=n2_id INNER join ca_nivel1 ON n3_idn1=n1_id");

		//$stmt-> bindParam(":idn2", $datosModel, PDO::PARAM_INT);

				$stmt-> execute();

                

		return $stmt->fetchAll();

	}


    public function vistantreslModel($tabla){

        $stmt = Conexion::conectar()-> prepare("SELECT n3_id, n3_idn1, n3_idn2, n3_nombre FROM $tabla");

        //$stmt-> bindParam(":idn2", $datosModel, PDO::PARAM_INT);

                $stmt-> execute();

                

        return $stmt->fetchAll();

    }

	public function vistaN3opcionModel($idn3, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT n3_idn1, n3_idn2, n3_id, n3_nombre FROM ca_nivel3 WHERE n3_id=:idn3");



		$stmt-> bindParam(":idn3", $idn3, PDO::PARAM_INT);

		

		$stmt-> execute();



		return $stmt->fetch();

	}	  
  public function vistaN3Byn2($idn2, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT n3_idn1, n3_idn2, n3_id, n3_nombre FROM ca_nivel3 WHERE n3_idn2=:idn2");



    $stmt-> bindParam(":idn2", $idn2, PDO::PARAM_INT);

    

    $stmt-> execute();



    return $stmt->fetchAll();

  }   

	public function vistatresModel($datosModel,$idn3,$tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT n3_id, n3_nombre FROM $tabla WHERE n3_idn2=:idn2 and n3_id=:idn3");

		$stmt-> bindParam(":idn2", $datosModel, PDO::PARAM_INT);

		$stmt-> bindParam(":idn3", $idn3, PDO::PARAM_INT);

		



		$stmt-> execute();



		return $stmt->fetchAll();

	}



	 public function nombreNivel3($id,$tabla) {



            $sql = "SELECT n3_id, n3_nombre FROM $tabla where n3_id=:id ";



            $stmt = Conexion::conectar()-> prepare($sql);

            $stmt->bindParam(":id",$id,PDO::PARAM_INT);

            $stmt->execute();

            $res=$stmt->fetchAll();

            foreach ($res as $row) {

              $nombre = $row["n3_nombre"];

            }
			$res=null;
			$stmt->closeCursor();
			$stmt=null;
        	//return $nombre;

        }
        
        
        /**
         * Add a row in ca_nivel3
         * @param array data
         */
        function add($clanivel1,$clanivel2,$nombre,$tabla){
        	try{
        	

            $query = "INSERT INTO `ca_nivel3`(`n3_idn1`,`n3_idn2`, `n3_nombre`) VALUES (:clanivel1, :clanivel2, :nombre)";
            $stmt = Conexion::conectar()-> prepare($query) ;
        	
             $stmt->bindParam(":clanivel1",$clanivel1,PDO::PARAM_INT);
             $stmt->bindParam(":clanivel2",$clanivel2,PDO::PARAM_INT);
             $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        	
             $stmt->execute();
            //   $stmt->debugDumpParams();
           }    catch (PDOException $e) {
              echo $e->getMessage();
            throw new Exception("Error al ejecutar consulta en la bd");
        }catch(Exception $ex){
            echo $ex->getMessage();
           
           }
        	
        }
        
        
        
        /**
         * Update a row in ca_nivel3
         * @param array data
         */
        public function update($datosModel,$tabla){
        try{
            $query = "UPDATE ca_nivel3 SET n3_idn2=:n3_idn2, n3_nombre=:n3_nombre, n3_idn1=:n3_idn1 WHERE n3_id = :n3_id";
       	
              $stmt=Conexion::conectar()->prepare($query);
              $stmt->bindParam(":n3_idn1", $datosModel["n3_idn1"],PDO::PARAM_INT);
              $stmt->bindParam(":n3_idn2", $datosModel["n3_idn2"], PDO::PARAM_INT);
              $stmt->bindParam(":n3_id", $datosModel["n3_id"],PDO::PARAM_INT);
              $stmt->bindParam(":n3_nombre", $datosModel["n3_nombre"],PDO::PARAM_STR);

              $stmt-> execute();
              return (1);

        	 }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar el pais");
            }
        }
        

        
        /**
         * Delete a row in ca_nivel3
         * @param Int n3_id
         */
        function del($n3_id,$tabla){
        	
        	$query = "DELETE FROM $tabla WHERE n3_id = :n3_id";
        	$q = Conexion::conectar()->prepare($query);
        	
        	if ($q->execute(array(':n3_id' => $n3_id ))){
        		return (1);
        	}
        	else{
        		return(0);
        	}
        }
        
        
        
        

}
