<?php

class DatosInfEtapaDet{
   
    private static $conexion;
    
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
    
  
    public  function getInfEtapaDetxId($INDICE,$CVEUSUARIO,$id, $tabla){
        
        
        $sSQL= "SELECT ied_id, ied_indice, ied_cverecolector, ied_infetapaid,
 ied_rutafoto, ied_qr, ied_nummuestra, ied_descripcionid, ied_numcaja
FROM $tabla where ied_id=:id and ied_indice=:indice and ied_cverecolector=:cverecolector ";
        
        $stmt=DatosInfEtapaDet::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt-> execute();
      
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public  function getInfEtapaDetxInf($INDICE,$CVEUSUARIO,$id,$etapa, $tabla){
        
        
        $sSQL= "SELECT ied_id, ied_indice, ied_cverecolector, ied_infetapaid,
 ied_rutafoto, ied_qr, ied_nummuestra, ied_descripcionid, ied_numcaja
FROM $tabla
inner join informes_etapa ie on
	ied_infetapaid = ine_id
	and ine_cverecolector = ied_cverecolector
	and ine_indice = ied_indice
	and ine_etapa =:etapa
  where ied_infetapaid=:id and ied_indice=:indice and ied_cverecolector=:cverecolector ";
        
        $stmt=DatosInfEtapaDet::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":etapa",  $etapa, PDO::PARAM_INT);
        $stmt-> execute();
       // $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    public  function insertar($datosModel,$cveusuario,$indice,$tabla,$pdo){
        try{      
            $sSQL= "INSERT INTO $tabla
(ied_id, ied_indice, ied_cverecolector, ied_infetapaid, ied_rutafoto, ied_qr,
 ied_nummuestra, ied_descripcionid, ied_numcaja)
VALUES(:ied_id, :ied_indice, :ied_cverecolector, :ied_infetapaid, :ied_rutafoto,:ied_qr,
 :ied_nummuestra, :ied_descripcionid, :ied_numcaja);";
         //   var_dump($datosModel);
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":ied_id", $datosModel[ContratoInfEtapaDet::ID],PDO::PARAM_INT);
            $stmt->bindParam(":ied_indice",  $indice,PDO::PARAM_STR);
            $stmt->bindParam(":ied_cverecolector", $cveusuario, PDO::PARAM_INT);
            $stmt->bindParam(":ied_infetapaid", $datosModel[ContratoInfEtapaDet::INFETAPAID], PDO::PARAM_INT);
            $stmt->bindParam(":ied_rutafoto", $datosModel[ContratoInfEtapaDet::RUTAFOTO], PDO::PARAM_STR);
           
            $stmt->bindParam(":ied_qr",  $datosModel[ContratoInfEtapaDet::QR], PDO::PARAM_STR);
             
            $stmt->bindParam(":ied_nummuestra", $datosModel[ContratoInfEtapaDet::NUMMUESTRA], PDO::PARAM_INT);
           //  $stmt->bindParam(":ine_estatus", $datosModel[ContratoInfEtapaDet::ESTATUS],PDO::PARAM_INT);
            $stmt->bindParam(":ied_descripcionid", $datosModel[ContratoInfEtapaDet::DESCRIPCIONID], PDO::PARAM_STR);
            $stmt->bindParam(":ied_numcaja",  $datosModel[ContratoInfEtapaDet::NUMCAJA], PDO::PARAM_INT);
            
              
            if(!$stmt-> execute())
            {
               // $stmt->debugDumpParams();
                throw new Exception("DatosInfEtapaDet.inesertar ".$stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
       //     echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInfEtapaDet.inesertar ".$ex->getMessage());
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
   
    
    public function updateInforme($datosModel,$cveusuario,$indice,$tabla,$pdo){
        $sSQL= "UPDATE informes_etapadet
SET ied_infetapaid=:ied_infetapaid, ied_rutafoto=:ied_rutafoto, ied_qr=:ied_qr,
 ied_nummuestra=:ied_nummuestra, ied_descripcionid=:ied_descripcionid, ied_numcaja=:ied_numcaja
WHERE ied_id=:ied_id AND ied_indice=:ied_indice AND ied_cverecolector=:ied_cverecolector;";
        try{
        $stmt=$pdo->prepare($sSQL);
       
        $stmt->bindParam(":ine_id", $datosModel[ContratoInfEtapaDet::ID],PDO::PARAM_INT);
        $stmt->bindParam(":ied_id", $datosModel[ContratoInfEtapaDet::ID],PDO::PARAM_INT);
        $stmt->bindParam(":ied_indice",  $indice,PDO::PARAM_STR);
        $stmt->bindParam(":ied_cverecolector", $cveusuario, PDO::PARAM_INT);
        $stmt->bindParam(":ied_infetapaid", $datosModel[ContratoInfEtapaDet::INFETAPAID], PDO::PARAM_INT);
        $stmt->bindParam(":ied_rutafoto", $datosModel[ContratoInfEtapaDet::RUTAFOTO], PDO::PARAM_STR);
        
        $stmt->bindParam(":ied_qr",  $datosModel[ContratoInfEtapaDet::QR], PDO::PARAM_STR);
        
        $stmt->bindParam(":ied_nummuestra", $datosModel[ContratoInfEtapaDet::NUMMUESTRA], PDO::PARAM_INT);
        //  $stmt->bindParam(":ine_estatus", $datosModel[ContratoInfEtapaDet::ESTATUS],PDO::PARAM_INT);
        $stmt->bindParam(":ied_descripcionid", $datosModel[ContratoInfEtapaDet::DESCRIPCIONID], PDO::PARAM_STR);
        $stmt->bindParam(":ied_numcaja",  $datosModel[ContratoInfEtapaDet::NUMCAJA], PDO::PARAM_INT);
        
        
        if(!$stmt-> execute())
        {
            
            throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
        }
        //     echo $stmt->debugDumpParams();
    }catch(PDOException $ex){
        Utilerias::guardarError("DatosInfEtapaDet.actualizar "+$ex->getMessage());
        
        throw new Exception("Hubo un error al actualizar el informe");
    }
    }
  
  
    
    
}