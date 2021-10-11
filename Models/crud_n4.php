<?php



require_once "Models/conexion.php";

class Datosncua extends Conexion{

	# CLASE NIVEL 1n1
	public function vistancuaModel($datosModel,$tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT `n4_idn3`, `n4_id`, `n4_nombre`, `n4_idn1`, `n4_idn2`,  n2_nombre, n1_nombre FROM `ca_nivel4`
            INNER join ca_nivel2 ON n4_idn2=n2_id and n4_idn1=n2_idn1 
            INNER JOIN ca_nivel1 on n4_idn1 = n1_id;");

		$stmt-> execute();

		return $stmt->fetchAll();

	}


public function listancuaModel($tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT `n4_idn3`, `n4_id`, `n4_nombre`, `n4_idn1`, `n4_idn2` FROM `ca_nivel4`;");

    $stmt-> execute();

    return $stmt->fetchAll();

  }


	public function vistaN4opcionModel($idn4, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT n4_idn1, n4_idn2, n4_id, n4_nombre,n4_idn3 FROM ca_nivel4 WHERE n4_id=:idn4");



		$stmt-> bindParam(":idn4", $idn4, PDO::PARAM_INT);

		

		$stmt-> execute();



		return $stmt->fetch();

	}

public function vistaN4Byn3($idn3, $tabla){

        $stmt = Conexion::conectar()-> prepare("SELECT n4_idn1, n4_idn2, n4_id, n4_nombre,n4_idn3 FROM ca_nivel4 WHERE n4_idn3=:idn3");



        $stmt-> bindParam(":idn3", $idn3, PDO::PARAM_INT);

        

        $stmt-> execute();

      // $stmt->debugDumpParams();

        return $stmt->fetchAll();

    }


 public function nombreNivel4($id,$tabla) {



            $sql = "SELECT n4_id, n4_nombre FROM $tabla where n4_id=:id ";



            $stmt = Conexion::conectar()-> prepare($sql);

            $stmt->bindParam(":id",$id,PDO::PARAM_INT);

            $stmt->execute();

            $res=$stmt->fetchAll();

            foreach ($res as $row) {

              $nombre = $row["n4_nombre"];

            }
            $res=null;
            $stmt->closeCursor();
            $stmt=null;
             //return $nombre;

        }
        
        function add($n4_idn3,$n4_nombre,$n4_idn1,$n4_idn2,$tabla){
        	
        	$stmt = Conexion::conectar()-> prepare("SELECT max(n4_id) FROM $tabla ");
        	$stmt-> execute();     	
        	
        	$res= $stmt->fetch();
        	//var_dump($res);
        	if($res)
        		$n4_id=$res[0]+1;
        	else
        		$n4_id=1;
        		//echo $n4_id;
        	$query = "INSERT INTO $tabla  (n4_idn3, n4_id, n4_nombre,n4_idn1,n4_idn2)
		VALUES (
			:n4_idn3,
			:n4_id,
			:n4_nombre,:n4_idn1,:n4_idn2)";
        	$q = Conexion::conectar()->prepare($query);
        	
        	
        	if ($q->execute(array(':n4_idn3' => $n4_idn3,
                ':n4_idn2' => $n4_idn2,
                ':n4_idn1' => $n4_idn1,
                ':n4_id' => $n4_id,
              ':n4_nombre' => $n4_nombre))){
        		
        		return (Conexion::conectar()->lastInsertId());
        	}
        	else{
        		return(0);
        	}
        }
        
        
        
        /**
         * Update a row in ca_nivel4
         * @param array data
         */
        function update($datosModel, $tabla){
            //var_dump($datosModel);
        try{
          $query = "UPDATE ca_nivel4 SET n4_idn3 = :n4_idn3, n4_idn2 = :n4_idn2, n4_idn1 = :n4_idn1,
            n4_nombre = :n4_nombre WHERE n4_id = :n4_id ";
        
              $stmt=Conexion::conectar()->prepare($query);
              $stmt->bindParam(":n4_idn1", $datosModel["n4_idn1"],PDO::PARAM_INT);
              $stmt->bindParam(":n4_idn2", $datosModel["n4_idn2"], PDO::PARAM_INT);
              $stmt->bindParam(":n4_idn3", $datosModel["n4_idn3"], PDO::PARAM_INT);
              $stmt->bindParam(":n4_id", $datosModel["n4_id"],PDO::PARAM_INT);
              $stmt->bindParam(":n4_nombre", $datosModel["n4_nombre"],PDO::PARAM_STR);

              $stmt-> execute();
              return (1);

             }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar la ciudad");
              return (0);
            }
        


        }
        
        
        
        /**
         * Delete a row in ca_nivel4
         * @param Int n4_id
         */
        function del($n4_id,$tabla){
        	
        	$query = "DELETE FROM $tabla WHERE n4_id = :n4_id";
        	$q = Conexion::conectar()->prepare($query);
        	
        	if ($q->execute(array(':n4_id' => $n4_id ))){
        		return (1);
        	}
        	else{
        		return(0);
        	}
        }
        

}
