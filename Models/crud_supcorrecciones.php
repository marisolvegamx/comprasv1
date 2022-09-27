<?php

class DatosCorreccion{
   
    private static $conexion;
    
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
  
    public  function getCorrecciones($INDICE,$CVEUSUARIO,$tabla){
        
        
        $sSQL= "SELECT inf_visitasIdlocal visitasId, inf_id id,
 inf_consecutivo consecutivo, inf_segunda_muestra segundaMuestra,
inf_tercera_muestra terceraMuestra,   inf_comentarios comentarios,
inf_estatus estatus,2 estatusSync
 inf_primera_muestra primeraMuestra, inf_plantasid plantasId,
 inf_ticket_compra ticket_compra, inf_condiciones_traslado condiciones_traslado,
inf_causa_nocompra causa_nocompra, cn.n4_nombre as plantaNombre  ,cn2.n1_nombre clienteNombre
1 estatus, 2 estatusSync,inf_primera_muestra sinproducto,
FROM informes
inner join ca_nivel4 cn on cn.n4_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n4_idn1
FROM $tabla
inner join ca_nivel4 cn on cn.n4_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n4_idn1
where inf_indice=:indice and inf_usuario=:cverecolector ";
        
        $stmt=DatosCorreccion::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    public  function insertar($datosModel,$cveusuario,$indice,$tabla){
        try{      
            $sSQL= "INSERT INTO $tabla
(cor_id, cor_indice, cor_cverecolector, cor_valid, cor_rutafoto1, cor_rutafoto2,
 cor_rutafoto3, cor_estatus, cor_createdat)
VALUES(:cor_id, :cor_indice, :cor_cverecolector, :cor_valid, :cor_rutafoto1, :cor_rutafoto2,
 :cor_rutafoto3, :cor_estatus, :cor_createdat);";
            
            $stmt=DatosCorreccion::getInstance()->prepare($sSQL);
            $stmt->bindParam(":cor_id", $datosModel[ContratoCorreccion::ID],PDO::PARAM_INT);
            $stmt->bindParam(":cor_indice", $indice,PDO::PARAM_STR);
            $stmt->bindParam(":cor_cverecolector", $cveusuario, PDO::PARAM_INT);
            $stmt->bindParam(":cor_valid", $datosModel[ContratoCorreccion::VALID], PDO::PARAM_INT);
            $stmt->bindParam(":cor_rutafoto1", $datosModel[ContratoCorreccion::RUTAFOTO1], PDO::PARAM_STR);
           
            $stmt->bindParam(":cor_rutafoto2", $datosModel[ContratoCorreccion::RUTAFOTO2], PDO::PARAM_STR);
            $stmt->bindParam(":cor_rutafoto3", $datosModel[ContratoCorreccion::RUTAFOTO3], PDO::PARAM_STR);
            
            $stmt->bindParam(":cor_estatus", $datosModel[ContratoCorreccion::ESTATUS], PDO::PARAM_INT);
            $stmt->bindParam(":cor_createdat", $datosModel[ContratoCorreccion::CREATEDAT],PDO::PARAM_STR);
               
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
       //     echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosCorreccion.inesertar "+$ex->getMessage());
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    public function update($datosModel,$cveusuario,$indice,$tabla){
        $sSQL= "UPDATE $tabla
SET cor_valid=:cor_valid, cor_rutafoto1=:cor_rutafoto1, cor_rutafoto2=:cor_rutafoto2, 
cor_rutafoto3=:cor_rutafoto3,
 cor_estatus=:cor_estatus, cor_createdat=:cor_createdat
WHERE cor_id=:cor_id AND cor_indice=:cor_indice AND cor_cverecolector=:cor_cverecolector;

";
        try{
            $stmt=DatosCorreccion::getInstance()->prepare($sSQL);
            $stmt->bindParam(":cor_id", $datosModel[ContratoCorreccion::ID],PDO::PARAM_INT);
            $stmt->bindParam(":cor_indice", $indice,PDO::PARAM_STR);
            $stmt->bindParam(":cor_cverecolector", $cveusuario, PDO::PARAM_INT);
            $stmt->bindParam(":cor_valid", $datosModel[ContratoCorreccion::VALID], PDO::PARAM_INT);
            $stmt->bindParam(":cor_rutafoto1", $datosModel[ContratoCorreccion::RUTAFOTO1], PDO::PARAM_STR);
            
            $stmt->bindParam(":cor_rutafoto2", $datosModel[ContratoCorreccion::RUTAFOTO2], PDO::PARAM_STR);
            $stmt->bindParam(":cor_rutafoto3", $datosModel[ContratoCorreccion::RUTAFOTO3], PDO::PARAM_STR);
            
            $stmt->bindParam(":cor_estatus", $datosModel[ContratoCorreccion::ESTATUS], PDO::PARAM_INT);
            $stmt->bindParam(":cor_createdat", $datosModel[ContratoCorreccion::CREATEDAT],PDO::PARAM_STR);
            
            
        if(!$stmt-> execute())
        {
            
            throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
        }
        //     echo $stmt->debugDumpParams();
    }catch(PDOException $ex){
        Utilerias::guardarError("DatosInforme.actualizar "+$ex->getMessage());
        
        throw new Exception("Hubo un error al actualizar el informe");
    }
    }
   
   
  
    public  function getCorreccionxid($indice,$cveusuario,$id,$tabla){
        
        
        $sSQL= "SELECT cor_id, cor_indice, cor_cverecolector, cor_valid, cor_rutafoto1,
 cor_rutafoto2, cor_rutafoto3, cor_estatus, cor_createdat
FROM $tabla WHERE cor_id=:cor_id AND cor_indice=:cor_indice AND cor_cverecolector=:cor_cverecolector;";
        
        $stmt=DatosInforme::getInstance()->prepare($sSQL);
        $stmt->bindParam(":cor_id", $id,PDO::PARAM_INT);
        $stmt->bindParam(":cor_indice", $indice,PDO::PARAM_STR);
        $stmt->bindParam(":cor_cverecolector", $cveusuario, PDO::PARAM_INT);
        
        
        $stmt-> execute();
        //  $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
   
    
    
}