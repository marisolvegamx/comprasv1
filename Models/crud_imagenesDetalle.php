<?php
class DatosImagenDetalle{
    
    public static function insertar($datosModel,$cveusuario,$indice,$tabla){
        try{
            
            $sSQL= "INSERT INTO $tabla
(imd_idlocal, imd_descripcion, imd_ruta, imd_estatus, imd_indice, imd_usuario)
VALUES(:imd_idlocal, :imd_descripcion, :imd_ruta, :imd_estatus, :imd_indice, :imd_recolector); ";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":imd_idlocal", $datosModel[ContratoImagenes::ID],PDO::PARAM_INT);
            $stmt->bindParam(":imd_descripcion", $datosModel[ContratoImagenes::DESCRIPCION], PDO::PARAM_STR);
            $stmt->bindParam(":imd_estatus", $datosModel[ContratoImagenes::ESTATUS], PDO::PARAM_INT);
            
            $stmt->bindParam(":imd_ruta", $datosModel[ContratoImagenes::RUTA], PDO::PARAM_STR);
            $stmt->bindParam(":imd_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":imd_usuario",$cveusuario, PDO::PARAM_NT);
         //   $stmt->bindParam(":imd_created_at", $datosModel[ContratoImagenes::], PDO::PARAM_STR);
           // $stmt->bindParam(":imd_updated_at", $datosModel[ContratoImagenes::imd_updated_at"], PDO::PARAM_STR);
            
            $stmt-> execute();
            if(sizeof($stmt->errorInfo())){
                throw new Exception($stmt->errorInfo()[2]);
            }
      //      echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
}