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
        
        
        $sSQL= "SELECT cor_id id, cor_indice indice,
 cor_valid solicitudId,
cor_rutafoto1 ruta_foto1, cor_rutafoto2 ruta_foto2, 
cor_rutafoto3 ruta_foto3, cor_estatus estatus,
cor_createdat createdAt, cor_numfoto numfoto, 2 estatusSync
FROM $tabla
where cor_indice=:indice and cor_cverecolector=:cverecolector ";
        
        $stmt=DatosCorreccion::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    public  function insertar($datosModel,$cveusuario,$indice,$tabla){
        try{      
            $sSQL= "INSERT INTO $tabla
(cor_id, cor_indice, cor_cverecolector, cor_valid, cor_rutafoto1, cor_rutafoto2,
 cor_rutafoto3, cor_estatus, cor_createdat,cor_numfoto)
VALUES(:cor_id, :cor_indice, :cor_cverecolector, :cor_valid, :cor_rutafoto1, :cor_rutafoto2,
 :cor_rutafoto3, :cor_estatus, :cor_createdat, :cor_numfoto);";
            
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
            $stmt->bindParam(":cor_numfoto", $datosModel[ContratoCorreccion::NUMFOTO], PDO::PARAM_STR);
            
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
WHERE cor_id=:cor_id AND cor_indice=:cor_indice AND cor_cverecolector=:cor_cverecolector and
cor_numfoto=:numfoto;

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
            $stmt->bindParam(":numfoto", $datosModel[ContratoCorreccion::NUMFOTO], PDO::PARAM_STR);
            
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
    
    public function getCorreccionValFoto($indice,$recolector,$corid){
        
        // consulta
        
        $stmt = Conexion::conectar()->prepare("SELECT val_id ,val_inf_id, val_indice ,
val_estatus, val_etapa, i.inf_plantasid  ,
 cn.n5_nombre as plantaNombre  ,val_rec_id,
cn2.n1_nombre clienteNombre,  n5_idn1 ,
v.vi_unedesc nombreTienda,vai_descripcionfoto ,
cc.cad_descripcionesp ,vai_numfoto ,
val_etapa etapa,vai_estatus ,vai_fecha , vai_observaciones , 
 sup_correccion.cor_createdat,sup_correccion.cor_rutafoto1,sup_correccion.cor_rutafoto2,sup_correccion.cor_rutafoto3
FROM sup_validacion
INNER JOIN sup_validafotos ON val_id=vai_id
INNER JOIN sup_correccion
ON sup_correccion.cor_valid = sup_validafotos.vai_id AND
		sup_correccion.cor_numfoto = sup_validafotos.vai_numfoto
inner join ca_catalogosdetalle cc on cc.cad_idopcion =vai_descripcionfoto and cc.cad_idcatalogo =20
inner join informes i on i.inf_id=val_inf_id and val_rec_id=i.inf_usuario and i.inf_indice =val_indice
inner join ca_nivel5 cn on cn.n5_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n5_idn1
inner join visitas v on v.vi_idlocal =i.inf_visitasIdlocal  and v.vi_cverecolector =i.inf_usuario and v.vi_indice =i.inf_indice
 WHERE val_rec_id=:rec
 AND val_indice=:indice
 and sup_correccion.cor_id=corid");
        
        $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
        $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
     //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
        $stmt->bindParam(":corid", $corid, PDO::PARAM_INT);
        $stmt-> execute();
        //	$stmt->debugDumpParams();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
        
    }
    
    public function getCorreccionxValFoto($indice,$recolector,$valid,$numfoto,$tabla){
        
        // consulta
        
        $stmt = Conexion::conectar()->prepare("select sup_correccion.cor_id, 
	sup_correccion.cor_indice, 
	sup_correccion.cor_cverecolector, 
	sup_correccion.cor_valid, 
	sup_correccion.cor_rutafoto1, 
	sup_correccion.cor_rutafoto2, 
	sup_correccion.cor_rutafoto3, 
	sup_correccion.cor_estatus, 
	sup_correccion.cor_createdat, 
	sup_correccion.cor_numfoto FROM $tabla
INNER JOIN sup_validafotos ON val_id=vai_id
INNER JOIN sup_correccion
ON sup_correccion.cor_valid = sup_validafotos.vai_id AND
		sup_correccion.cor_numfoto = sup_validafotos.vai_numfoto
WHERE val_rec_id=:rec
 AND val_indice=:indice
 and cor_valid=:corid and cor_numfoto=:numfoto");
        
        $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
        $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
        //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
        $stmt->bindParam(":corid", $valid, PDO::PARAM_INT);
        $stmt->bindParam(":numfoto", $numfoto, PDO::PARAM_INT);
        $stmt-> execute();
        //	$stmt->debugDumpParams();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
        
    }
    
    public function getUltCorxValFoto($indice,$recolector,$valid,$numfoto,$tabla){
        
        // consulta
        
        $stmt = Conexion::conectar()->prepare("select sup_correccion.cor_id,
	sup_correccion.cor_indice,
	sup_correccion.cor_cverecolector,
	sup_correccion.cor_valid,
	sup_correccion.cor_rutafoto1,
	sup_correccion.cor_rutafoto2,
	sup_correccion.cor_rutafoto3,
	sup_correccion.cor_estatus,
	sup_correccion.cor_createdat,
	sup_correccion.cor_numfoto FROM $tabla
INNER JOIN sup_validafotos ON val_id=vai_id
INNER JOIN sup_correccion
ON sup_correccion.cor_valid = sup_validafotos.vai_id AND
		sup_correccion.cor_numfoto = sup_validafotos.vai_numfoto
WHERE val_rec_id=:rec
 AND val_indice=:indice
 and cor_valid=:corid and cor_numfoto=:numfoto order by cor_id desc limit 1");
        
        $stmt->bindParam(":rec",$recolector , PDO::PARAM_INT);
        $stmt->bindParam(":indice",  $indice, PDO::PARAM_STR);
        //   $stmt->bindParam(":etapa", $etapa, PDO::PARAM_INT);
        $stmt->bindParam(":corid", $valid, PDO::PARAM_INT);
        $stmt->bindParam(":numfoto", $numfoto, PDO::PARAM_INT);
        $stmt-> execute();
        //	$stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
   
    
    
}