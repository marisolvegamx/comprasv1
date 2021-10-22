<?php

class DatosVisita{
    
    public static function insertar($datosModel,$tabla){
        try{
            
            $sSQL= " INSERT INTO $tabla
( vi_idlocal, vi_geolocalizacion, vi_tiendaid, vi_fotofachada, vi_estatus, vi_cverecolector, vi_createdat, vi_updatedat)
VALUES( :vi_idlocal, :vi_geolocalizacion, :vi_tiendaid, :vi_fotofachada, :vi_estatus, :vi_cverecolector, :vi_createdat, :vi_updatedat);";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":vi_idlocal", $datosModel["vi_idlocal"],PDO::PARAM_INT);
            $stmt->bindParam(":vi_geolocalizacion", $datosModel["vi_geolocalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":vi_tiendaid", $datosModel["vi_tiendaid"], PDO::PARAM_INT);
            $stmt->bindParam(":vi_fotofachada", $datosModel["vi_fotofachada"], PDO::PARAM_INT);
            $stmt->bindParam(":vi_estatus", $datosModel["vi_estatus"], PDO::PARAM_INT);
            $stmt->bindParam(":vi_cverecolector", $datosModel["vi_cverecolector"], PDO::PARAM_STR);
            $stmt->bindParam(":vi_createdat", $datosModel["vi_createdat"], PDO::PARAM_STR);
            $stmt->bindParam(":vi_updatedat", $datosModel["vi_updatedat"], PDO::PARAM_STR);
            
            $stmt-> execute();
         //   echo $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.inesertar "+$ex->getMessage());
            echo "error";
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
}