<?php
class DatosImagenDetalle{
    
    public static function insertar($datosModel,$cveusuario,$indice,$tabla,$pdo ){
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
            $stmt->bindParam(":imd_recolector",$cveusuario, PDO::PARAM_INT);
         //   $stmt->bindParam(":imd_created_at", $datosModel[ContratoImagenes::], PDO::PARAM_STR);
           // $stmt->bindParam(":imd_updated_at", $datosModel[ContratoImagenes::imd_updated_at"], PDO::PARAM_STR);
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
          
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.insertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar la imagen");
        }
        
    }
}