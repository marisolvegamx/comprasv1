<?php
class DatosProductoExhibido{
    private static $conexion;
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
    
    public  function getProductosEx($INDICE,$CVEUSUARIO,$tabla){
        
        
        $sSQL= "SELECT pe_idlocal id, pe_visitasId visitasId, pe_imagenId imagenId, pe_clienteId clienteId,
2 estatusSync, n1_nombre as nombreCliente
FROM $tabla inner join ca_nivel1 cn 
on cn.n1_id =pe_clienteId
where pe_indice=:indice and pe_recolector=:cverecolector";
        
        $stmt=DatosProductoExhibido::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public  function getProductosExxVisita($INDICE,$CVEUSUARIO,$visita,$tabla){
        
        
        $sSQL= "SELECT pe_idlocal id, pe_visitasId visitasId, pe_imagenId imagenId, pe_clienteId clienteId,
2 estatusSync, n1_nombre as nombreCliente
FROM $tabla inner join ca_nivel1 cn
on cn.n1_id =pe_clienteId
where pe_indice=:indice and pe_recolector=:cverecolector and pe_visitasId=:visita ";
        
        $stmt=DatosProductoExhibido::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":visita",  $visita, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public  function getProdExxCliente($INDICE,$CVEUSUARIO,$visita,$cliente,$tabla){
        
        
        $sSQL= "SELECT imd_idlocal id, imd_descripcion descripcion, imd_ruta ruta,
 imd_estatus estatus,2 estatusSync, imd_indice indice,
imd_created_at createdAt, imd_updated_at updatedAt
FROM $tabla inner join ca_nivel1 cn
on cn.n1_id =pe_clienteId
inner join imagen_detalle imd on imd.imd_idlocal =pe_imagenId  and  imd_indice =producto_exhibido.pe_indice and imd_usuario =producto_exhibido.pe_recolector 
where pe_indice=:indice and pe_recolector=:cverecolector and pe_visitasId=:visita and pe_clienteId=:cliente ";
        
        $stmt=DatosProductoExhibido::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":visita",  $visita, PDO::PARAM_INT);
        $stmt->bindParam(":cliente",  $cliente, PDO::PARAM_INT);
        $stmt-> execute();
       // $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public static function insertaru($datosModel,$usuario,$indice,$tabla,$pdo){
        try{
            
            $sSQL= "SELECT * FROM  $tabla
 where pe_idlocal=:pe_idlocal and 
pe_recolector=:pe_recolector and pe_indice=:pe_indice;";
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":pe_idlocal", $datosModel[ContratoProductoEx::ID],PDO::PARAM_INT);
            $stmt->bindParam(":pe_recolector", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":pe_indice", $indice, PDO::PARAM_STR);
            //   $stmt->bindParam(":imd_created_at", $datosModel[ContratoImagenes::], PDO::PARAM_STR);
            // $stmt->bindParam(":imd_updated_at", $datosModel[ContratoImagenes::imd_updated_at"], PDO::PARAM_STR);
            
            $stmt->execute();
           // $stmt->debugDumpParams();
            $res=$stmt->fetch();
            //var_dump($res);
            if($res!=null&&sizeof($res)>0){
                //ya existe actualizo
                DatosProductoExhibido::actualizar($datosModel, $usuario, $indice, $tabla, $pdo);
            }else{
                DatosProductoExhibido::insertar($datosModel, $usuario, $indice,$tabla, $pdo);
            }
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosProdEx.insertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar la imagen");
        }
        
    }
    public static function insertar($datosModel,$usuario,$indice,$tabla,$pdo){
        try{
          
            $sSQL= " INSERT INTO $tabla
(pe_idlocal, pe_visitasId, pe_imagenId, pe_clienteId,pe_recolector,pe_indice)
VALUES(:pe_idlocal, :pe_visitasId, :pe_imagenId, :pe_clienteId,:pe_recolector,:pe_indice); ";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":pe_idlocal", $datosModel[ContratoProductoEx::ID],PDO::PARAM_INT);
            $stmt->bindParam(":pe_visitasId", $datosModel[ContratoProductoEx::VISITASID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_imagenId", $datosModel[ContratoProductoEx::IMAGENID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_clienteId", $datosModel[ContratoProductoEx::CLIENTESID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_recolector", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":pe_indice", $indice, PDO::PARAM_STR);
            
            if(!$stmt-> execute())
            {
                //echo "--".$usuario;
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar ".$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public static function actualizar($datosModel,$usuario,$indice,$tabla,$pdo){
        try{
            
            $sSQL= " UPDATE $tabla
SET  pe_visitasId=:pe_visitasId, pe_imagenId=:pe_imagenId, pe_clienteId=:pe_clienteId
where pe_idlocal=:pe_idlocal and 
pe_recolector=:pe_recolector and pe_indice=:pe_indice; ";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":pe_idlocal", $datosModel[ContratoProductoEx::ID],PDO::PARAM_INT);
            $stmt->bindParam(":pe_visitasId", $datosModel[ContratoProductoEx::VISITASID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_imagenId", $datosModel[ContratoProductoEx::IMAGENID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_clienteId", $datosModel[ContratoProductoEx::CLIENTESID], PDO::PARAM_INT);
            $stmt->bindParam(":pe_recolector", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":pe_indice", $indice, PDO::PARAM_STR);
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.actualizar ".$ex->getMessage());
            throw new Exception("Hubo un error al actualizar el informe");
        }
        
    }
}