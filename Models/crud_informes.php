<?php

class DatosInforme{
    
    public static function insertar($datosModel,$tabla){
        try{
            
            $sSQL= "INSERT INTO $tabla
( inf_consecutivo, inf_visitasIdlocal, inf_segunda_muestra, inf_tercera_muestra,inf_indice, inf_usuario,
 inf_comentarios, inf_estatus, inf_created_at, inf_updated_at, inf_primera_muestra, inf_plantasid,
 inf_ticket_compra, inf_condiciones_traslado)
VALUES(:inf_consecutivo, :inf_visitasIdlocal, :inf_segunda_muestra, :inf_tercera_muestra, :inf_indice,:inf_usuario, 
:inf_comentarios, :inf_estatus, :inf_created_at, :inf_updated_at, :inf_primera_muestra, :inf_plantasid,
:inf_ticket_compra, :inf_condiciones_traslado);
";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":inf_consecutivo", $datosModel["inf_consecutivo"],PDO::PARAM_INT);
            $stmt->bindParam(":inf_visitasIdlocal", $datosModel["inf_visitasIdlocal"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_segunda_muestra", $datosModel["inf_segunda_muestra"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_tercera_muestra", $datosModel["inf_tercera_muestra"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_indice", $datosModel["inf_indice"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_usuario", $datosModel["inf_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":inf_comentarios", $datosModel["inf_comentarios"], PDO::PARAM_STR);
            
            $stmt->bindParam(":inf_estatus", $datosModel["inf_estatus"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_created_at", $datosModel["inf_created_at"], PDO::PARAM_STR);
            $stmt->bindParam(":inf_updated_at", $datosModel["inf_updated_at"], PDO::PARAM_STR);
            $stmt->bindParam(":inf_primera_muestra", $datosModel["inf_primera_muestra"],PDO::PARAM_INT);
            $stmt->bindParam(":inf_plantasid", $datosModel["inf_plantasid"], PDO::PARAM_INT);
             $stmt->bindParam(":inf_ticket_compra", $datosModel["inf_ticket_compra"], PDO::PARAM_INT);
            $stmt->bindParam(":inf_condiciones_traslado", $datosModel["inf_condiciones_traslado"], PDO::PARAM_INT);
               
            $stmt-> execute();
            echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInforme.inesertar "+$ex->getMessage());
            echo "error";
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
}