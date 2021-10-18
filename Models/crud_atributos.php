<?php
//require_once "Models/conexion.php";
class DatosAtrib extends Conexion{

	# CLASE NIVEL 1n1
	public function vistaatribModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla");

		$stmt-> execute();
		return $stmt->fetchAll();

	}


	public function insertarAtrib($datosModel,$tabla){
          	try{
          		
              $sSQL= "INSERT INTO `ca_atributo`(`id_tipoempaque`, `at_nombre`) VALUES (:tipoemp,:nomatrib)";
                                		
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"],PDO::PARAM_INT);
          	  $stmt->bindParam(":nomatrib", $datosModel["nomatrib"], PDO::PARAM_STR);
              
          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el atributo");
          	}
          	
    }

    public function editaprodModel($atrid, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where id_atributo=:atrid");
		 $stmt->bindParam(":atrid", $atrid,PDO::PARAM_INT);

		$stmt-> execute();
		return $stmt->fetchAll();

	}

	public function actualizarAtr($datosModel,$tabla){
          	try{
          		
              $sSQL= "UPDATE `ca_atributo` SET `id_tipoempaque` =:tipoemp,`at_nombre`=:nomatr WHERE `id_atributo`=:idatr";
	
          	  $stmt=Conexion::conectar()->prepare($sSQL);
          	  $stmt->bindParam(":tipoemp", $datosModel["tipoemp"],PDO::PARAM_INT);
          	  $stmt->bindParam(":nomatr", $datosModel["nomatrib"], PDO::PARAM_STR);
              $stmt->bindParam(":idatr", $datosModel["idatr"],PDO::PARAM_INT);
             

          		$stmt-> execute();
          		
          	}catch(PDOException $ex){
          		throw new Exception("Hubo un error al insertar el recolector");
          	}
          	
    }


    public function eliminaAtrib($idprod,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE id_atributo=:idprod";
              //echo $sSQL;
              //echo $idprod;
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idprod", $idprod,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar el atributo");
            }
            
    }
    
    public function getAtributos($tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT id_tipoempaque, cad_descripcionesp as nombre_empaqueesp,
    cad_descripcioning as nombre_empaque_ing,
    id_atributo, at_nombre
    FROM $tabla
    inner join ca_catalogosdetalle
    on cad_idopcion=id_tipoempaque and cad_idcatalogo=12");
        
        $stmt-> execute();
        echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    
}	