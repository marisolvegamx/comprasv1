<?php

class DatosInformeEtapa{
   
    private static $conexion;
    
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
    
  
    public  function getInformesEtapaxId($INDICE,$CVEUSUARIO,$id, $tabla){
        
        
        $sSQL= "SELECT ine_id, ine_indice, ine_cverecolector, ine_plantasid,
 ine_clientesid, ine_etapa, ine_comentarios, ine_totalcajas, ine_totalmuestras, 
ine_estatus, ine_createdat,date_format(ine_createdat, '%d-%m-%Y')
 as fecharep, date_format(ine_createdat, '%H:%i') as horarep ,ca_recolectores.rec_nombre,
n1_nombre,n5_nombre
FROM $tabla
inner join ca_recolectores on	ine_cverecolector = rec_id
inner join ca_nivel5 on n5_id=ine_plantasid
 inner join ca_nivel1 on n1_id=n5_idn1
 where ine_id=:id and ine_cverecolector=:ine_cverecolector 
 and ine_indice=:ine_indice ";
        
        $stmt=DatosInformeEtapa::getInstance()->prepare($sSQL);
        $stmt->bindParam(":ine_indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":ine_cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt-> execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    public  function insertar($datosModel,$cveusuario,$indice,$tabla,$pdo){
        try{    
         
            $sSQL= "INSERT INTO $tabla
(ine_id, ine_indice, ine_cverecolector, ine_plantasid, ine_clientesid,
 ine_etapa, ine_comentarios, ine_totalcajas, ine_totalmuestras,
 ine_createdat)
VALUES(:ine_id, :ine_indice, :ine_cverecolector, :ine_plantasid, :ine_clientesid,
 :ine_etapa,:ine_comentarios, :ine_totalcajas, :ine_totalmuestras, :ine_createdat);";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":ine_id", $datosModel[ContratoInfEtapa::ID],PDO::PARAM_INT);
            $stmt->bindParam(":ine_indice",  $indice,PDO::PARAM_STR);
            $stmt->bindParam(":ine_cverecolector", $cveusuario, PDO::PARAM_INT);
            $stmt->bindParam(":ine_plantasid", $datosModel[ContratoInfEtapa::PLANTASID], PDO::PARAM_INT);
            $stmt->bindParam(":ine_clientesid", $datosModel[ContratoInfEtapa::CLIENTESID], PDO::PARAM_INT);
           
            $stmt->bindParam(":ine_etapa",  $datosModel[ContratoInfEtapa::ETAPA], PDO::PARAM_STR);
            $stmt->bindParam(":ine_comentarios",  $datosModel[ContratoInfEtapa::COMENTARIOS], PDO::PARAM_STR);
            $stmt->bindParam(":ine_totalcajas", $datosModel[ContratoInfEtapa::TOTALCAJAS], PDO::PARAM_INT);
            
            $stmt->bindParam(":ine_totalmuestras", $datosModel[ContratoInfEtapa::TOTALMUESTRAS], PDO::PARAM_INT);
           //  $stmt->bindParam(":ine_estatus", $datosModel[ContratoInfEtapa::ESTATUS],PDO::PARAM_INT);
            $stmt->bindParam(":ine_createdat", $datosModel[ContratoInfEtapa::CREATEDAT], PDO::PARAM_STR);
          
              
            if(!$stmt-> execute())
            {
                //$stmt->debugDumpParams();
               // var_dump($stmt->errorInfo());
                throw new Exception("DatosInformeEtapa.inesertar ".$stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
       //     echo 
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeEtapa.inesertar ".$ex->getMessage());
            echo $ex->getMessage();
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public function updateInforme($datosModel,$cveusuario,$indice,$tabla,$pdo){
        $sSQL= "UPDATE comprasdata.informes_etapa
SET ine_plantasid=:ine_plantasid, ine_clientesid=:ine_clientesid, ine_etapa=:ine_etapa,
 ine_comentarios=:ine_comentarios, ine_totalcajas=:ine_totalcajas, ine_totalmuestras=:ine_totalmuestras,

 ine_createdat=:ine_createdat
WHERE ine_id=:ine_id AND ine_indice=:ine_indice AND ine_cverecolector=:ine_cverecolector;";
        try{
            $stmt=$pdo->prepare($sSQL);
            
            $stmt->bindParam(":ine_id", $datosModel[ContratoInfEtapa::ID],PDO::PARAM_INT);
            $stmt->bindParam(":ine_indice",  $indice,PDO::PARAM_STR);
            $stmt->bindParam(":ine_cverecolector", $cveusuario, PDO::PARAM_INT);
            $stmt->bindParam(":ine_plantasid", $datosModel[ContratoInfEtapa::PLANTASID], PDO::PARAM_INT);
            $stmt->bindParam(":ine_clientesid", $datosModel[ContratoInfEtapa::CLIENTESID], PDO::PARAM_INT);
            
            $stmt->bindParam(":ine_etapa",  $datosModel[ContratoInfEtapa::ETAPA], PDO::PARAM_STR);
            $stmt->bindParam(":ine_comentarios",  $datosModel[ContratoInfEtapa::COMENTARIOS], PDO::PARAM_STR);
            $stmt->bindParam(":ine_totalcajas", $datosModel[ContratoInfEtapa::TOTALCAJAS], PDO::PARAM_INT);
            
            $stmt->bindParam(":ine_totalmuestras", $datosModel[ContratoInfEtapa::TOTALMUESTRAS], PDO::PARAM_INT);
            //  $stmt->bindParam(":ine_estatus", $datosModel[ContratoInfEtapa::ESTATUS],PDO::PARAM_INT);
            $stmt->bindParam(":ine_createdat", $datosModel[ContratoInfEtapa::CREATEDAT], PDO::PARAM_STR);
            
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            //     echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeEtapa.actualizar "+$ex->getMessage());
            
            throw new Exception("Hubo un error al actualizar el informe");
        }
    }
    
    
  
    
    
}