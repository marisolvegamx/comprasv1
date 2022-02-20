<?php
class DatosImagenDetalle{
    
    public static function insertaru($datosModel,$cveusuario,$indice,$tabla,$pdo ){
        try{
            
            $sSQL= "SELECT * FROM  $tabla
 where imd_idlocal=:imd_idlocal and
imd_indice=:imd_indice and imd_usuario=:imd_recolector;";
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":imd_idlocal", $datosModel[ContratoImagenes::ID],PDO::PARAM_INT);
            $stmt->bindParam(":imd_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":imd_recolector",$cveusuario, PDO::PARAM_INT);
            //   $stmt->bindParam(":imd_created_at", $datosModel[ContratoImagenes::], PDO::PARAM_STR);
            // $stmt->bindParam(":imd_updated_at", $datosModel[ContratoImagenes::imd_updated_at"], PDO::PARAM_STR);
            
            $stmt-> execute();
            $res=$stmt->fetch();
            if($res!=null&&sizeof($res)>0){
                //ya existe actualizo 
                DatosImagenDetalle::insertar($datosModel, $cveusuario, $indice, $tabla, $pdo);
            }else{
                DatosImagenDetalle::insertar($datosModel, $cveusuario, $indice, $tabla, $pdo);
            }
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.insertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar la imagen");
        }
        
    }
    
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
    
    public static function actualizar($datosModel,$cveusuario,$indice,$tabla,$pdo ){
        try{
            
            $sSQL= "UPDATE $tabla
SET imd_idlocal=:imd_idlocal, imd_descripcion=:imd_descripcion,
 imd_ruta=:imd_ruta, imd_estatus=:imd_estatus
where  imd_idlocal=:imd_idlocal and
imd_indice=:imd_indice and imd_usuario=:imd_recolector;";
            
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
            Utilerias::guardarError("DatosInformeDetalle.actualizar "+$ex->getMessage());
            throw new Exception("Hubo un error al actualizar la imagen");
        }
        
    }
}