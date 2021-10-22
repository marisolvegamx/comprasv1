<?php
class DatosImagenDetalle{
    
    public static function insertar($datosModel,$tabla){
        try{
            
            $sSQL= "INSERT INTO $tabla
(imd_idlocal, imd_descripcion, imd_ruta, imd_estatus, imd_indice, imd_usuario,
 imd_created_at, imd_updated_at)
VALUES(:imd_idlocal, :imd_descripcion, :imd_ruta, :imd_estatus, :imd_indice, :imd_usuario, 
:imd_created_at, :imd_updated_at); ";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":imd_idlocal", $datosModel["imd_idlocal"],PDO::PARAM_INT);
            $stmt->bindParam(":imd_descripcion", $datosModel["imd_descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":imd_estatus", $datosModel["imd_estatus"], PDO::PARAM_INT);
            
            $stmt->bindParam(":imd_ruta", $datosModel["imd_ruta"], PDO::PARAM_STR);
            $stmt->bindParam(":imd_indice", $datosModel["imd_indice"], PDO::PARAM_STR);
            $stmt->bindParam(":imd_usuario", $datosModel["imd_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":imd_created_at", $datosModel["imd_created_at"], PDO::PARAM_STR);
            $stmt->bindParam(":imd_updated_at", $datosModel["imd_updated_at"], PDO::PARAM_STR);
            
            $stmt-> execute();
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
}