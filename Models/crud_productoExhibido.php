<?php
class DatosProductoExhibido{
    
    public static function insertar($datosModel,$tabla){
        try{
            
            $sSQL= " INSERT INTO $tabla
(pe_idlocal, pe_visitasId, pe_imagenId, pe_clienteId)
VALUES(:pe_idlocal, :pe_visitasId, :pe_imagenId, :pe_clienteId); ";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":pe_idlocal", $datosModel["pe_idlocal"],PDO::PARAM_INT);
            $stmt->bindParam(":pe_visitasId", $datosModel["pe_visitasId"], PDO::PARAM_INT);
            $stmt->bindParam(":pe_imagenId", $datosModel["pe_imagenId"], PDO::PARAM_INT);
            $stmt->bindParam(":pe_clienteId", $datosModel["pe_clienteId"], PDO::PARAM_INT);
           // $stmt->bindParam(":pd_usuario", $datosModel["pd_usuario"], PDO::PARAM_STR);
           // $stmt->bindParam(":pd_indice", $datosModel["pd_indice"], PDO::PARAM_STR);
            
            $stmt-> execute();
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
}