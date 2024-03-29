<?php

require_once "Models/conexion.php";
class DatosRecolector extends Conexion{

	# CLASE NIVEL 1n1
	public function vistarecModel($tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla order by rec_nombre;");

		$stmt-> execute();
		return $stmt->fetchAll();

	}

    public function insertarRec($datosModel,$tabla){
          	//try{
          		
              $sSQL= "INSERT INTO $tabla(rec_nombre, rec_tipo, rec_pais, rec_ciudad, rec_direccion, rec_direccion_eti, rec_celular, rec_telefono_casa, rec_telefono_trabajo, rec_telefono_familia, rec_email_personal, rec_email_oficina, rec_tarjeta, rec_ser_pepsi, rec_ser_penafiel, rec_ser_electro) VALUES (:nomrec,:tiporec, :paisrec, :ciudadrec, :dircasa, :direti, :numcel, :telcasa, :telofi, :telfam, :emailper, :emailtrab,:numtarjeta, :chkpepsi, :chkpenaf, :chkelectro);";
          		
          		$stmt=Conexion::conectar()->prepare($sSQL);
          		$stmt->bindParam(":nomrec", $datosModel["nomrec"],PDO::PARAM_STR);
          		$stmt->bindParam(":dircasa", $datosModel["dircasa"], PDO::PARAM_STR);
              $stmt->bindParam(":direti", $datosModel["direti"], PDO::PARAM_STR);
              $stmt->bindParam(":paisrec", $datosModel["paisrec"],PDO::PARAM_INT);
              $stmt->bindParam(":ciudadrec", $datosModel["ciudadrec"],PDO::PARAM_INT);
              $stmt->bindParam(":tiporec", $datosModel["tiporec"],PDO::PARAM_INT);
              $stmt->bindParam(":numtarjeta", $datosModel["numtarjeta"],PDO::PARAM_STR);
              $stmt->bindParam(":emailtrab", $datosModel["emailtrab"],PDO::PARAM_STR);
              $stmt->bindParam(":emailper",$datosModel["emailper"],PDO::PARAM_STR);
              $stmt->bindParam(":numcel",$datosModel["numcel"],PDO::PARAM_STR);
              $stmt->bindParam(":telcasa",$datosModel["telcasa"],PDO::PARAM_STR);
              $stmt->bindParam(":telofi",$datosModel["telofi"],PDO::PARAM_STR);
              $stmt->bindParam(":telfam", $datosModel["telfam"],PDO::PARAM_STR);
              $stmt->bindParam(":chkpepsi", $datosModel["chkpepsi"],PDO::PARAM_INT);
              $stmt->bindParam(":chkpenaf", $datosModel["chkpenaf"],PDO::PARAM_INT);
              $stmt->bindParam(":chkelectro", $datosModel["chkelectro"],PDO::PARAM_INT);
                 
          		$stmt-> execute();
          		
          	//}//catch(PDOException $ex){
          		//throw new Exception("Hubo un error al insertar el recolector");
          	//}
          	
    }
          
          
    public function vistarecolectorDetalle($nrec, $tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT rec_nombre, rec_pais, rec_ciudad, rec_tarjeta, rec_telefono_casa, rec_telefono_familia, rec_telefono_trabajo, rec_tipo, rec_celular, rec_email_oficina, rec_email_personal, rec_direccion, rec_direccion_eti, rec_ser_pepsi, rec_ser_penafiel, rec_ser_electro FROM ca_recolectores WHERE rec_id=:nrec");

        $stmt->bindParam(":nrec", $nrec, PDO::PARAM_INT);



        $stmt->execute();



        return $stmt->fetch();
    }
       
          
     public function actualizaRec($datosModel,$tabla){
            try{      

           
              $sSQL= "UPDATE ca_recolectores SET rec_nombre=:nomrec, rec_pais=:paisrec, rec_ciudad=:ciudadrec, rec_tarjeta=:numtarjeta, rec_telefono_casa=:telcasa, rec_telefono_familia=:telfam, rec_telefono_trabajo=:telofi, rec_tipo=:tiporec,rec_celular=:numcel, rec_email_oficina=:emailtrab, rec_email_personal=:emailper, rec_ser_pepsi=:chkpepsi, rec_ser_penafiel=:chkpenaf, rec_ser_electro=:chkelectro, rec_direccion=:dircasa,rec_direccion_eti=:direti WHERE rec_id=:idrec";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idrec", $datosModel["idrec"],PDO::PARAM_INT);
              $stmt->bindParam(":nomrec", $datosModel["nomrec"],PDO::PARAM_STR);
              $stmt->bindParam(":dircasa", $datosModel["dircasa"], PDO::PARAM_STR);
              $stmt->bindParam(":direti", $datosModel["direti"], PDO::PARAM_STR);
              $stmt->bindParam(":paisrec", $datosModel["paisrec"],PDO::PARAM_STR);
              $stmt->bindParam(":ciudadrec", $datosModel["ciudadrec"],PDO::PARAM_INT);
              $stmt->bindParam(":tiporec", $datosModel["tiporec"],PDO::PARAM_STR);
              $stmt->bindParam(":numtarjeta", $datosModel["numtarjeta"],PDO::PARAM_STR);
              $stmt->bindParam(":chkpepsi", $datosModel["chkpepsi"],PDO::PARAM_INT);
              $stmt->bindParam(":chkpenaf", $datosModel["chkpenaf"],PDO::PARAM_INT);
              $stmt->bindParam(":chkelectro", $datosModel["chkelectro"],PDO::PARAM_INT);
              $stmt->bindParam(":emailtrab", $datosModel["emailtrab"],PDO::PARAM_STR);
              $stmt->bindParam(":emailper",$datosModel["emailper"],PDO::PARAM_STR);
              $stmt->bindParam(":numcel",$datosModel["numcel"],PDO::PARAM_STR);
              $stmt->bindParam(":telcasa",$datosModel["telcasa"],PDO::PARAM_STR);
              $stmt->bindParam(":telofi",$datosModel["telofi"],PDO::PARAM_STR);
              $stmt->bindParam(":telfam", $datosModel["telfam"],PDO::PARAM_STR);


              $stmt-> execute();
              
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al insertar el recolector");
            }
            
    }     
          
public function eliminaRec($idrec,$tabla){
            //try{      
              
              $sSQL= "DELETE FROM $tabla WHERE rec_id=:idrec";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":idrec", $idrec,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            //}//catch(PDOException $ex){
              //throw new Exception("Hubo un error al insertar el recolector");
            //}
            
    }

public function vistarecdetModel($numrec, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT rec_id, rec_nombre FROM $tabla where rec_id=:recid");
    $stmt->bindParam(":recid", $numrec,PDO::PARAM_INT);      
    $stmt-> execute();
    return $stmt->fetchAll();

  }

public function vistarecxnombre($nomrec, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT rec_id, rec_nombre FROM $tabla where rec_nombre=:nomrec");
    $stmt->bindParam(":nomrec", $nomrec,PDO::PARAM_STR);      
    $stmt-> execute();
    return $stmt->fetchAll();

  }






  public function vistarecxCliente($cliente, $tabla){
      
      $sql="SELECT rec_id, rec_nombre,
      rec_ser_pepsi
      FROM $tabla ";
      if($cliente==4)
          $sql.="where rec_ser_pepsi=-1";
          if($cliente==5)
              $sql.="where rec_ser_penafiel=-1";
              
              if($cliente==6)
                  $sql.="where rec_ser_electro=-1";
                  
                  
                  $stmt = Conexion::conectar()-> prepare($sql);
                  
                  $stmt-> execute();
                  return $stmt->fetchAll();
                  
  }

   public function vistaetaparecModel($datosModel, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT red_idetapa FROM `ca_recolectoresdetalle` where red_id=:recid and red_idcliente=:idcli and red_idetapa=ideta;");

    $stmt->bindParam(":recid", $datosModel["idrec"], PDO::PARAM_INT);
    $stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
    $stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);      
    $stmt-> execute();
    return $stmt->fetch();

  }

public function borraetaparecolector($datosModel, $tabla){
    //var_dump($datosModel);
    $stmt = Conexion::conectar()-> prepare("DELETE FROM `ca_recolectoresdetalle` WHERE red_id=:recid and red_idcliente=:idcli and red_idetapa=:ideta;");

    $stmt->bindParam(":recid", $datosModel["idrec"], PDO::PARAM_INT);
    $stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
    $stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);      
    $stmt-> execute();

  }

public function leeetaparecolector($datosModel, $tabla){

    $stmt = Conexion::conectar()-> prepare("SELECT `red_id`, `red_idcliente`, `red_idetapa` FROM `ca_recolectoresdetalle` WHERE red_id=:recid and red_idcliente=:idcli and red_idetapa=:ideta;");

    $stmt->bindParam(":recid", $datosModel["idrec"], PDO::PARAM_STR);
    $stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
    $stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_STR);      
    $stmt-> execute();
    return $stmt->fetch();
  }


  public function insertaetaparecolector($datosModel, $tabla){
     //var_dump($datosModel);
    $stmt = Conexion::conectar()-> prepare("INSERT INTO `ca_recolectoresdetalle`(`red_id`, `red_idcliente`, `red_idetapa`) VALUES (:recid,:idcli,:ideta)");

    $stmt->bindParam(":recid", $datosModel["idrec"], PDO::PARAM_INT);
    $stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
    $stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);      
    $stmt-> execute();

  }
  public function actualizarEtapa($idrec,$etapa,$tabla){
      try{
          
          
          $sSQL= "UPDATE $tabla SET 
  rec_etapaactual=:etapa WHERE rec_id=:idrec";
          
          $stmt=Conexion::conectar()->prepare($sSQL);
          $stmt->bindParam(":idrec", $idrec,PDO::PARAM_INT);
       
          $stmt->bindParam(":etapa", $etapa,PDO::PARAM_STR);
          
          
          $stmt-> execute();
          
      }catch(PDOException $ex){
          throw new Exception("Hubo un error al actualizar etapa del recolector");
      }
      
  }    


}
