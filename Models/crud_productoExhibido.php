<?php
class DatosProductoExhibido{
    
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
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar ".$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
}